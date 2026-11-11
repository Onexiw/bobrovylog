# Скрипты выгрузки bobrovylog

## Запуск

В системе действует политика, запрещающая выполнение `.ps1`, поэтому запускать так:

```powershell
powershell.exe -NoProfile -ExecutionPolicy Bypass -File deploy\pull-site.ps1
powershell.exe -NoProfile -ExecutionPolicy Bypass -File deploy\check-php.ps1
powershell.exe -NoProfile -ExecutionPolicy Bypass -File deploy\push-files.ps1 -Files "local\templates\bobrovy_log_multilang\header.php"
```

Важно: файлы `.ps1` хранятся в **UTF-8 с BOM** — PowerShell 5.1 иначе читает кириллицу как ANSI и падает с ошибкой разбора. Если редактируете скрипты сторонним инструментом, проверяйте, что BOM на месте.

## Доступ

Файл `_local/access.json` (шаблон — `_local/access.example.json`, в git не попадает):

```json
{
  "host": "IP или домен хостинга",
  "port": 22,
  "user": "логин SSH",
  "auth": "key",
  "key_path": "C:\\...\\_local\\bobrovylog_ed25519",
  "site_root": "/var/www/.../bobrovylog.ru"
}
```

Нужен ключевой доступ: публичный ключ `_local/bobrovylog_ed25519.pub` добавляется на хостинге
(панель data-pool → SSH-ключи, либо в `~/.ssh/authorized_keys`). Парольный вход скрипты не используют —
он небезопасен для автоматизации.

## Скрипты

| Скрипт | Что делает |
|---|---|
| `pull-site.ps1` | Снимает полную копию кода с хостинга в `site/` (без кэша и `upload`), показывает статистику |
| `check-php.ps1` | Проверяет синтаксис PHP: `php -l` по изменённым файлам или указанным |
| `push-files.ps1` | Бэкапит файлы на сервере и выгружает изменённые в прод |
| `tools.env.ps1` | Прописывает пути к Git/PHP на этой машине (подключать через `. .\deploy\tools.env.ps1`) |

## Правила безопасности

1. Первым делом `pull-site.ps1` — снимок «как есть с прода» + коммит в git.
2. Любая правка: локально → `check-php.ps1` → `push-files.ps1` (с бэкапом) → запись в `docs/журнал-изменений.md`.
3. Не выгружать `bitrix/cache`, `upload`, `bitrix/backup` — это генерируемое/медиа, не код.
