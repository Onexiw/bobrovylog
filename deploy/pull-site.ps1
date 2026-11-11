# Выгрузка кода сайта с хостинга в site/.
#   pwsh -File deploy\pull-site.ps1          (только кастомный код, ~70 МБ)
#   pwsh -File deploy\pull-site.ps1 -Full    (плюс ядро Битрикса, ~1.3 ГБ)
#   -Force — перезаписать непустой site/
param(
    [switch]$Full,
    [switch]$Force
)

$ErrorActionPreference = 'Stop'
$proj = Split-Path $PSScriptRoot -Parent
$cfgPath = Join-Path $proj '_local\access.json'
$siteDir = Join-Path $proj 'site'

if (-not (Test-Path $cfgPath)) { throw "Нет файла $cfgPath. Заполните по шаблону access.example.json." }
$cfg = Get-Content $cfgPath -Raw -Encoding UTF8 | ConvertFrom-Json
foreach ($f in @('host', 'user', 'site_root')) {
    if (-not $cfg.$f) { throw "В access.json не заполнено поле '$f'" }
}

$port = if ($cfg.port) { $cfg.port } else { 22 }
$sshArgs = @('-p', "$port", '-o', 'BatchMode=yes', '-o', 'ConnectTimeout=15', '-o', 'StrictHostKeyChecking=accept-new')
$scpArgs = @('-P', "$port")
if ($cfg.auth -eq 'key' -and $cfg.key_path) {
    $sshArgs += @('-i', $cfg.key_path, '-o', 'IdentitiesOnly=yes')
    $scpArgs += @('-i', $cfg.key_path, '-o', 'IdentitiesOnly=yes')
}
$remote = "$($cfg.user)@$($cfg.host)"
$root = $cfg.site_root.TrimEnd('/')

$excludes = @(
    './bitrix/cache', './bitrix/managed_cache', './bitrix/stack_cache', './bitrix/_cache',
    './bitrix/backup', './bitrix/tmp', './bitrix/updates',
    './upload', './images', './karta', './karta-2',
    './bitrix/.settings.php', './bitrix/.settings_extra.php', './.git'
)
if (-not $Full) {
    $excludes += @('./bitrix/modules', './bitrix/js', './bitrix/components/bitrix', './bitrix/images')
}
$exArgs = ($excludes | ForEach-Object { "--exclude=$_" }) -join ' '

$tmpTgz = Join-Path $env:TEMP 'bobrovylog-code.tgz'
$remoteTgz = '/tmp/bobrovylog-code.tgz'

if (-not (Test-Path $siteDir)) { New-Item -ItemType Directory -Path $siteDir | Out-Null }
if ((Get-ChildItem $siteDir -Force | Measure-Object).Count -gt 0 -and -not $Force) {
    throw "Папка site/ не пуста. Запустите с -Force, если хотите перезаписать."
}

Write-Host "[1/6] Проверка SSH: $remote (порт $port)"
& ssh.exe @sshArgs $remote "echo OK" 2>&1 | Out-Null
if ($LASTEXITCODE -ne 0) { throw "Не удалось подключиться по SSH (код $LASTEXITCODE)" }

Write-Host "[2/6] Упаковка на сервере (режим: $(if ($Full) { 'полный' } else { 'только код' }))"
$tarCmd = "cd '$root' && tar czf $remoteTgz $exArgs . && ls -lh $remoteTgz"
& ssh.exe @sshArgs $remote $tarCmd 2>&1 | ForEach-Object { $_ }
if ($LASTEXITCODE -ne 0) { throw "Ошибка упаковки на сервере (код $LASTEXITCODE)" }

Write-Host "[3/6] Скачивание архива"
& scp.exe @scpArgs "${remote}:$remoteTgz" $tmpTgz 2>&1 | ForEach-Object { $_ }
if ($LASTEXITCODE -ne 0) { throw "Ошибка скачивания (код $LASTEXITCODE)" }

Write-Host "[4/6] Распаковка в site/"
& tar.exe -xzf $tmpTgz -C $siteDir
if ($LASTEXITCODE -ne 0) { throw "Ошибка распаковки (код $LASTEXITCODE)" }

Write-Host "[5/6] Манифест полного дерева прода (для справки)"
$manifestPath = Join-Path $proj '_local\manifest-прода.txt'
$manCmd = "cd '$root' && find . -type f -printf '%s\t%p\n' 2>/dev/null | sort -k2 > /tmp/manifest.txt && wc -l /tmp/manifest.txt"
& ssh.exe @sshArgs $remote $manCmd 2>&1 | ForEach-Object { $_ }
& scp.exe @scpArgs "${remote}:/tmp/manifest.txt" $manifestPath 2>&1 | Out-Null

Write-Host "[6/6] Уборка на сервере"
& ssh.exe @sshArgs $remote "rm -f $remoteTgz /tmp/manifest.txt" 2>&1 | Out-Null

$files = Get-ChildItem $siteDir -Recurse -File -Force
$sizeMb = [math]::Round(($files | Measure-Object Length -Sum).Sum / 1MB, 1)
Write-Host ""
Write-Host "Готово: $($files.Count) файлов, $sizeMb МБ в site/"
Write-Host "Манифест: $manifestPath"
Write-Host "Дальше: git add -A; git commit -m 'Код сайта как есть с прода'; git push"
