# PHP 8.3.36 — security-обновление

Дата подготовки: 17.11.2026. **Переключено на проде: 18.11.2026** (nginx → php-fpm 8.3.36, порт 9004).

## Зачем
ИБ (Г. Жовтневый): версия 8.3.8 не содержит патчей уязвимостей, требуется **8.3.36+** для ветки 8.3.
До переключения на проде уже применена митигация в `php.ini`:
`session.upload_progress.enabled = Off`, `session.use_strict_mode = 1`.

## Почему не через yum
CentOS 7 — EOL: Remi прекратил сборки для EL7 (максимум 8.3.8 даже на официальном зеркале `rpms.remirepo.net`).
PHP 8.3.36 (релиз 21.10.2026) доступен только исходниками.

## Что собрано на стенде
- **OpenSSL 1.1.1w** в `/opt/openssl11` (системный OpenSSL 1.0.2 не подходит PHP 8.3; PHP собран с `-rpath`).
- **PHP 8.3.36** в `/opt/php-8.3.36` (NTS, FPM+CLI): встроены openssl, zlib, opcache, sockets, pcntl, libxml/dom/xml/simplexml/xmlreader/xmlwriter/tokenizer/ctype/fileinfo/phar/PDO/posix.
- Расширения **remi (ABI 20230831)** переиспользованы через `php.d`: mysqli/mysqlnd/pdo_mysql, mbstring, gd, zip, intl, curl, sodium, apcu, memcache, exif, ldap, gettext, iconv, bcmath, bz2, calendar, ftp, sqlite3, pdo_sqlite, xsl.
- Конфиги: `/opt/php-8.3.36/etc/php.ini` + `php.d/`:
  - `00-local-paths.ini` — CA-бандл `/etc/pki/tls/certs/ca-bundle.crt`, error_log;
  - `10-opcache.ini` — zend_extension;
  - `99-bitrix.ini` — лимиты Битрикса + security-настройки.
- FPM пул: **127.0.0.1:9004**, systemd-сервис `php836-fpm.service` (`Type=simple`), ondemand, max_children 30, session.save_path `/tmp/php_sessions/www`.
- Тестовый nginx-vhost **:8080** (docroot staging): `/etc/nginx/bx/site_enabled/php836-check.conf`.

Все конфиги/скрипты сборки сохранены в репозитории: `deploy/php836/`.

## Результаты проверок (staging на :8080)
- `PHP 8.3.36`, SAPI `fpm-fcgi`; `upload_progress=false`, `strict=1`.
- HTTPS через PHP (file_get_contents) и curl-расширение — OK.
- БД/Битрикс — OK; агенты (`CAgent::CheckAgents`) — OK.
- Страницы `/`, `/raspisanie/`, `/services/`, `/news/`, `/about/`, `/bitrix/admin/` — 200; админка с формой входа.
- Паритет 25 внутренних ссылок staging vs prod — 1 расхождение (`/services/attraktsion-rodelban/`: контент есть в staging-БД, нет в prod — не связано с PHP).
- TTFB сопоставим с 8.3.8 (~0.13–0.18 с).

## Как переключить прод (следующий шаг, требует согласования)
1. Убедиться, что стенд `:8080` стабилен.
2. В `/etc/nginx/bx/site_avaliable/s1.conf`, `ssl.s1.conf`, `s2.conf`, `ssl.s2.conf` заменить `fastcgi_pass 127.0.0.1:9003` → `127.0.0.1:9004` (предварительно бэкап конфигов).
3. `nginx -t && systemctl reload nginx`; smoke-тесты; наблюдение 5xx.
4. Cron Битрикса перевести на `/opt/php-8.3.36/bin/php -c /opt/php-8.3.36/etc/php.ini`.
5. Старый пул 9003 (8.3.8) держать для отката 1–2 дня, затем выключить.

## Откат
Вернуть `fastcgi_pass ...:9003` и `systemctl reload nginx`. Сервис `php836-fpm` можно оставить/остановить: `systemctl stop php836-fpm`.

## Ограничения
- CentOS 7 EOL: долгосрочно нужна миграция ОС (сборки из исходников придётся обновлять вручную).
- Нет `readline` в CLI (не критично для cron).
- Расширения remi совместимы в пределах 8.3; при смене major-версии PHP потребуется пересборка.

## Переключение прода (выполнено 18.11.2026)

- `/etc/nginx/bx/site_avaliable/{s1,ssl.s1,s2,ssl.s2}.conf`: `fastcgi_pass 127.0.0.1:9003` → **9004**; `nginx -t` OK, reload.
- Прод и staging переведены на PHP 8.3.36: `X-Powered-By: PHP/8.3.36`, все ключевые страницы и админка — 200, коды до/после совпали (0 расхождений), паритет ссылок — 200, 5xx нет.
- Cron Битрикса переведён на `/opt/php-8.3.36/bin/php -c /opt/php-8.3.36/etc/php.ini`; агенты выполняются на новом PHP.
- OPcache включён (использовано ~48 МБ), TTFB ~0.12 с, health-check `status=OK`.
- Бэкап конфигов/крона: `/root/backup-switch-php836-20261118/`.
- Старый пул **9003 (PHP 8.3.8) оставлен запущенным** для быстрого отката; остановить после 1–2 дней наблюдения: `systemctl stop php83-php-fpm`.
- Тестовый vhost `:8080` (только localhost) оставлен как стенд.
- Примечание: `/sitemap.xml` отсутствует (было и до обновления — вне рамок задачи).
