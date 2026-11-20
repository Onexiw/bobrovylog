# nginx 1.20.2 → 1.30.7 (критические CVE, 20.11.2026)

ИБ (Г. Жовтневый): критические уязвимости nginx — CVE-2026-123007, CVE-2026-123633, CVE-2026-123634, CVE-2026-121810, CVE-2026-113425. Требования: отключить HTTP/2/HTTP/3 и обновиться до **1.30.7 stable** / 1.31.9 mainline.

## Выполнено

1. **Митигация (немедленно):** убран `http2` из `listen 443` в `ssl.s1/ssl.s2`, nginx перезапущен; HTTP/2 выключен, сайт работал на HTTP/1.1. QUIC/HTTP/3 в конфигурации отсутствовали.
2. **Обновление до 1.30.7** — собрано из исходников (RPM для CentOS 7 EOL нет):
   - та же конфигурация модулей, что у BitrixEnv-сборки: brotli, push-stream, mod_zip, headers-more, http_v2, http_ssl, mail, mail_ssl, realip, addition, sub, dav, flv, mp4, gunzip, gzip_static, random_index, secure_link, stub_status, auth_request, file_aio;
   - OpenSSL 1.1.1w подключается в nginx статически из исходников (`/usr/local/src/openssl-1.1.1w`), TLS 1.3 включён;
   - бинарник: `/usr/sbin/nginx`, старый сохранён в `/root/backup-nginx-1.20.2-20261120/nginx-1.20.2.bin`.
3. **После обновления HTTP/2 снова включён** через `http2 on;` (уязвимости закрыты в 1.30.7); параметр `listen ... http2` устарел и удалён.

## Результаты проверок

- `nginx -v` → **1.30.7**, `nginx -t` — без ошибок и предупреждений.
- ALPN: **h2**; TLS 1.3 (`TLS_AES_256_GCM_SHA384`).
- brotli (`Content-Encoding: br`) и gzip работают.
- Все ключевые страницы и админка — 200, HTTPS — 200, 5xx нет, health `status=OK`.
- push-stream модуль загружен (Bitrix push server).

## Откат

```bash
install -m 755 /root/backup-nginx-1.20.2-20261120/nginx-1.20.2.bin /usr/sbin/nginx
systemctl restart nginx
```
Конфиги: бэкап `/root/backup-nginx-h2-20261120/`.

## Важные замечания

- `/usr/sbin/nginx` теперь не управляется RPM (`bx-nginx-1.20.2`); при `yum update` пакет может перезаписать бинарник. Профилактика: исключить `bx-nginx` из обновлений (`yum --exclude=bx-nginx update`) или пересобрать после обновления.
- ⚠️ `sed -i` по **симлинкам** `bx/site_enabled/ssl.*` заменяет ссылку обычным файлом (так и случилось при митигации) — правки в `site_avaliable` перестают применяться. Симлинки восстановлены; при правках конфигов проверять `ls -la` и `nginx -T`.
- Скрипты сборки/проверки: `deploy/nginx130/`.
- Долгосрочно CentOS 7 EOL: nginx придётся собирать вручную при новых CVE — нужен план миграции ОС.
