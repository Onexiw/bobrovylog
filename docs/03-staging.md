# Staging-площадка (stage.bobrovylog.ru)

Создана 11.11.2026 на том же сервере, что и прод. Нужна для проверки правок до выкатки.

## Что сделано

| Компонент | Значение |
|---|---|
| Домен | `stage.bobrovylog.ru` (TLS-сертификат `*.bobrovylog.ru` уже покрывает) |
| Docroot | `/home/bitrix/stage` (копия прода, 1.7 ГБ) |
| База | `sitemanager_stage` (копия прода: 396 таблиц, 191 МБ) |
| Пользователь БД | `bitrix0` с правами на `sitemanager_stage` |
| nginx vhost | `/etc/nginx/bx/site_avaliable/s2.conf` + `ssl.s2.conf` (симлинки в `site_enabled/`) |
| Apache vhost | не используется: staging переведён на nginx + php-fpm 8.1, Apache-виртуалхост удалён 11.11.2026 |
| Настройки БД | `/home/bitrix/stage/bitrix/.settings.php` → `sitemanager_stage`, `php_interface/dbconn.php` → `$DBName = "sitemanager_stage"` |
| Домены в БД | `b_lang`: все сайты (`s1`, `dg`, `fa`, `nb`, `nj`, `zh`) переведены на `stage.bobrovylog.ru` |
| Индексация | `robots.txt` с `Disallow: /` + заголовок `X-Robots-Tag: noindex, nofollow` |
| Логи | `/var/log/httpd/stage_error.log`, `/var/log/nginx/stage_error.log` |

## PHP 8.1 и маршрутизация staging

- PHP: **php-fpm 8.3.8** на `127.0.0.1:9003` (прод остаётся на mod_php 7.4); также установлены php-fpm 8.1 (`:9001`) и 8.2 (`:9002`) — подробности в `docs/05-php8-миграция.md`.
- nginx staging: `location ~ \.php$ → fastcgi_pass 127.0.0.1:9001`, fallback — **`/bitrix/urlrewrite.php`** (как в штатном маршрутизаторе Битрикса на проде; ранее было `/index.php`, из-за чего битые URL отдавали 200 — soft-404).
- Паритет с продом: **119 внутренних ссылок — 0 расхождений** по кодам ответов; статика отдаётся nginx напрямую.

## Проверки

- `http(s) stage` → 200, заголовок «Фанпарк Бобровый лог».
- `http(s) prod` → 200 (не затронут).
- Админка stage → 200.
- Снаружи по SNI (`stage.bobrovylog.ru` → 62.213.48.144) → 200 + noindex.

## Что нужно доделать

1. **DNS**: создать A-запись `stage.bobrovylog.ru` → `62.213.48.144` в панели data-pool.
2. Пока DNS нет, проверить можно локально с сервера:
   `curl -k -H "Host: stage.bobrovylog.ru" https://127.0.0.1/`

## Ограничения и предупреждения

1. **`upload` — симлинк на прод** (`/home/bitrix/stage/upload` → `/home/bitrix/www/upload`).
   Картинки и файлы staging читает из прода. Если на staging загрузить файл через админку — он окажется в проде. Для тяжёлых тестов загрузки это надо переделать на отдельный upload.
2. **Почта**: staging использует те же настройки почты, что и прод. Не тестировать формы, которые реально шлют письма клиентам, пока почта не перенастроена/отключена.
3. Место на диске: после копирования свободно ~4.5 ГБ (было 6.6 ГБ).
4. Данные в staging-БД — снимок на 11.11.2026; перед крупными тестами обновлять из прода.

## Как обновить staging из прода

```bash
# код (без upload, кэшей, бэкапов)
rsync -a --exclude upload --exclude bitrix/cache --exclude bitrix/managed_cache \
  --exclude bitrix/stack_cache --exclude bitrix/backup \
  /home/bitrix/www/ /home/bitrix/stage/

# база
mysqldump --single-transaction --quick sitemanager | mysql sitemanager_stage
```

После обновления БД снова перевести домены:
```sql
UPDATE b_lang SET SERVER_NAME='stage.bobrovylog.ru';
```
и проверить, что `/home/bitrix/stage/bitrix/.settings.php` указывает на `sitemanager_stage`.

## Откат

Удалить staging, не трогая прод:
```bash
rm -f /etc/nginx/bx/site_enabled/s2.conf /etc/nginx/bx/site_enabled/ssl.s2.conf
rm -f /etc/nginx/bx/site_avaliable/s2.conf /etc/nginx/bx/site_avaliable/ssl.s2.conf
rm -f /etc/httpd/bx/conf/bx_ext_stage.bobrovylog.ru.conf
nginx -t && systemctl reload nginx && apachectl configtest && systemctl reload httpd
mysql -e "DROP DATABASE sitemanager_stage;"
rm -rf /home/bitrix/stage
```
