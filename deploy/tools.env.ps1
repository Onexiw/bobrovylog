# Окружение для скриптов проекта bobrovylog.
# Подключить перед работой:  . .\deploy\tools.env.ps1
# (в PowerShell точка перед путём = выполнить в текущем окружении)

$env:GIT_EXE = Join-Path $env:LOCALAPPDATA 'Programs\Git\cmd\git.exe'
$env:PHP_EXE = Join-Path $env:LOCALAPPDATA 'Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe'
$env:SSH_EXE = 'C:\Windows\System32\OpenSSH\ssh.exe'
$env:SCP_EXE = 'C:\Windows\System32\OpenSSH\scp.exe'
$env:SFTP_EXE = 'C:\Windows\System32\OpenSSH\sftp.exe'

if (-not (Test-Path $env:GIT_EXE)) { Write-Warning "Git не найден: $env:GIT_EXE" }
if (-not (Test-Path $env:PHP_EXE)) { Write-Warning "PHP не найден: $env:PHP_EXE" }

$env:PATH = "{0};{1};{2}" -f (Split-Path $env:GIT_EXE), (Split-Path $env:PHP_EXE), $env:PATH

Write-Host "tools.env: git=$( & $env:GIT_EXE --version 2>$null ) php=$( & $env:PHP_EXE -r 'echo PHP_VERSION;' 2>$null )"
