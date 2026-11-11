# Выгрузка изменённых файлов на прод с бэкапом на сервере.
# Запуск:  pwsh -File deploy\push-files.ps1 -Files "local\a.php","local\b.php"
#          (пути относительно site/)
param(
    [Parameter(Mandatory = $true)][string[]]$Files,
    [switch]$SkipPhpCheck,
    [switch]$DryRun
)

$ErrorActionPreference = 'Stop'
$proj = Split-Path $PSScriptRoot -Parent
$cfgPath = Join-Path $proj '_local\access.json'
$siteDir = Join-Path $proj 'site'

if (-not (Test-Path $cfgPath)) { throw "Нет $cfgPath. Заполните по шаблону access.example.json." }
$cfg = Get-Content $cfgPath -Raw | ConvertFrom-Json
foreach ($f in @('host', 'user', 'site_root')) {
    if (-not $cfg.$f) { throw "В access.json не заполнено поле '$f'" }
}

$port = if ($cfg.port) { $cfg.port } else { 22 }
$scpArgs = @('-P', "$port")
$sshArgs = @('-p', "$port", '-o', 'BatchMode=yes', '-o', 'ConnectTimeout=15')
if ($cfg.auth -eq 'key' -and $cfg.key_path) {
    $sshArgs += @('-i', $cfg.key_path, '-o', 'IdentitiesOnly=yes')
    $scpArgs += @('-i', $cfg.key_path, '-o', 'IdentitiesOnly=yes')
}
$remote = "$($cfg.user)@$($cfg.host)"
$remoteRoot = $cfg.site_root.TrimEnd('/')
$stamp = Get-Date -Format 'yyyyMMdd-HHmmss'

$localFiles = @()
foreach ($rel in $Files) {
    $rel = $rel.TrimStart('\', '/')
    $full = Join-Path $siteDir $rel
    if (-not (Test-Path $full)) { throw "Файла нет локально: $full" }
    $localFiles += [pscustomobject]@{ Rel = ($rel -replace '\\', '/'); Full = $full }
}

if (-not $SkipPhpCheck) {
    Write-Host "Проверка синтаксиса PHP..."
    $phpFiles = $localFiles | Where-Object { $_.Rel -match '\.php$' } | ForEach-Object { $_.Full }
    if ($phpFiles.Count -gt 0) {
        & pwsh -NoProfile -File (Join-Path $PSScriptRoot 'check-php.ps1') -Files $phpFiles
        if ($LASTEXITCODE -ne 0) { throw "Проверка PHP не прошла — выгрузка отменена." }
    }
}

Write-Host "Бэкап текущих файлов на сервере: _backup/$stamp/"
foreach ($f in $localFiles) {
    $dir = ($f.Rel -split '/')[0..(($f.Rel -split '/').Count - 2)] -join '/'
    $cmd = "cd '$remoteRoot' && mkdir -p '_backup/$stamp/$dir' && cp -p '$($f.Rel)' '_backup/$stamp/$($f.Rel)' 2>/dev/null; true"
    & ssh.exe @sshArgs $remote $cmd 2>&1 | Out-Null
}

foreach ($f in $localFiles) {
    if ($DryRun) {
        Write-Host "[dry-run] $remoteRoot/$($f.Rel)  <==  $($f.Full)"
        continue
    }
    Write-Host "Отправка $remoteRoot/$($f.Rel)"
    & scp.exe @scpArgs $f.Full "${remote}:$remoteRoot/$($f.Rel)"
    if ($LASTEXITCODE -ne 0) { throw "Ошибка отправки $($f.Rel)" }
}

Write-Host ""
Write-Host "Готово. Не забудьте записать изменение в docs/журнал-изменений.md"
Write-Host "Откат: на сервере скопировать файлы из _backup/$stamp/ обратно в $remoteRoot/"
