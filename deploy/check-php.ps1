# Проверка синтаксиса PHP перед выгрузкой.
# Запуск:  pwsh -File deploy\check-php.ps1                 (все изменённые по git файлы)
#          pwsh -File deploy\check-php.ps1 -Files "site\local\a.php","site\local\b.php"
param(
    [string[]]$Files
)

$ErrorActionPreference = 'Continue'
$proj = Split-Path $PSScriptRoot -Parent
. (Join-Path $PSScriptRoot 'tools.env.ps1') | Out-Null

if (-not $Files -or $Files.Count -eq 0) {
    $git = $env:GIT_EXE
    if (-not $git -or -not (Test-Path $git)) { throw "git не найден (tools.env.ps1)" }
    $changed = & $git -C $proj status --porcelain 2>$null | ForEach-Object { $_.Substring(3).Trim('"') }
    $Files = $changed | Where-Object { $_ -match '\.php$' } | ForEach-Object { Join-Path $proj $_ }
}

$Files = @($Files | Where-Object { $_ -match '\.php$' -and (Test-Path $_) })
if ($Files.Count -eq 0) {
    Write-Host "Изменённых PHP-файлов нет — проверять нечего."
    exit 0
}

$php = $env:PHP_EXE
$failed = 0
foreach ($f in $Files) {
    $out = & $php -l $f 2>&1
    if ($LASTEXITCODE -eq 0) {
        Write-Host "OK    $f"
    } else {
        $failed++
        Write-Host "FAIL  $f"
        $out | ForEach-Object { "      $_" }
    }
}

Write-Host ""
if ($failed -gt 0) {
    Write-Host "Ошибок: $failed — выгрузку делать нельзя." -ForegroundColor Red
    exit 1
}
Write-Host "Синтаксис в порядке: $($Files.Count) файл(ов)."
