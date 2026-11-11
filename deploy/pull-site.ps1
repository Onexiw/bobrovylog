# Полная выгрузка кода сайта с хостинга в site/ (снимок «как есть с прода»).
# Запуск:  pwsh -File deploy\pull-site.ps1
# Требует заполненный _local/access.json и SSH-ключ.
param(
    [switch]$Force
)

$ErrorActionPreference = 'Stop'
$proj = Split-Path $PSScriptRoot -Parent
$cfgPath = Join-Path $proj '_local\access.json'
$siteDir = Join-Path $proj 'site'

if (-not (Test-Path $cfgPath)) {
    throw "Нет файла $cfgPath. Скопируйте access.example.json -> access.json и заполните."
}
$cfg = Get-Content $cfgPath -Raw | ConvertFrom-Json
foreach ($f in @('host', 'user', 'site_root')) {
    if (-not $cfg.$f) { throw "В access.json не заполнено поле '$f'" }
}

$port = if ($cfg.port) { $cfg.port } else { 22 }
$sshArgs = @('-p', "$port", '-o', 'BatchMode=yes', '-o', 'ConnectTimeout=15')
if ($cfg.auth -eq 'key' -and $cfg.key_path) {
    $sshArgs += @('-i', $cfg.key_path, '-o', 'IdentitiesOnly=yes')
}
$remote = "$($cfg.user)@$($cfg.host)"
$remoteRoot = $cfg.site_root.TrimEnd('/')

$tmpTgz = Join-Path $env:TEMP 'bobrovylog-site.tgz'
$remoteTgz = '/tmp/bobrovylog-site.tgz'

$excludes = @(
    'bitrix/cache', 'bitrix/managed_cache', 'bitrix/stack_cache',
    'bitrix/html_pages', 'bitrix/backup', 'bitrix/tmp',
    'upload', '.git'
) | ForEach-Object { "--exclude=$_" }

if (-not (Test-Path $siteDir)) { New-Item -ItemType Directory -Path $siteDir | Out-Null }
if ((Get-ChildItem $siteDir -Force | Measure-Object).Count -gt 0 -and -not $Force) {
    throw "Папка site/ не пуста. Запустите с -Force, если хотите перезаписать."
}

Write-Host "1/4 Подключение к $remote (порт $port)..."
& ssh.exe @sshArgs $remote "echo OK; cd '$remoteRoot' && pwd" 2>&1 | ForEach-Object { $_ }
if ($LASTEXITCODE -ne 0) { throw "Не удалось подключиться по SSH (код $LASTEXITCODE)" }

Write-Host "2/4 Упаковка кода на сервере (без кэша и upload)..."
$tarCmd = "cd '$remoteRoot' && tar czf $remoteTgz $($excludes -join ' ') . && ls -lh $remoteTgz"
& ssh.exe @sshArgs $remote $tarCmd 2>&1 | ForEach-Object { $_ }
if ($LASTEXITCODE -ne 0) { throw "Ошибка упаковки на сервере (код $LASTEXITCODE)" }

Write-Host "3/4 Скачивание архива..."
& scp.exe -P $port $(if ($cfg.auth -eq 'key' -and $cfg.key_path) { @('-i', $cfg.key_path, '-o', 'IdentitiesOnly=yes') } else { @() }) "${remote}:$remoteTgz" $tmpTgz 2>&1 | ForEach-Object { $_ }
if ($LASTEXITCODE -ne 0) { throw "Ошибка скачивания (код $LASTEXITCODE)" }

Write-Host "4/4 Распаковка в site/..."
& tar.exe -xzf $tmpTgz -C $siteDir
if ($LASTEXITCODE -ne 0) { throw "Ошибка распаковки (код $LASTEXITCODE)" }

& ssh.exe @sshArgs $remote "rm -f $remoteTgz" 2>&1 | Out-Null

$files = Get-ChildItem $siteDir -Recurse -File -Force
$sizeMb = [math]::Round(($files | Measure-Object Length -Sum).Sum / 1MB, 1)
Write-Host ""
Write-Host "Готово: $($files.Count) файлов, $sizeMb МБ в site/"
Write-Host "Дальше: git add -A; git commit -m 'Код сайта как есть с прода (снимок <дата>)'; git push"
