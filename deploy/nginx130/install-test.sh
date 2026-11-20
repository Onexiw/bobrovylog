#!/bin/bash
set -u
BACKUP=/root/backup-nginx-1.20.2-20261120
mkdir -p "$BACKUP"
cp -a /usr/sbin/nginx "$BACKUP/nginx-1.20.2.bin"
cp -a /usr/sbin/nginx "$BACKUP/nginx-1.20.2.bin.$(date +%H%M%S)" 2>/dev/null || true
echo "=== бэкап: $BACKUP ==="
rpm -q bx-nginx >/dev/null 2>&1 && rpm -q bx-nginx

NEW=/usr/local/src/ngx-build/nginx-1.30.7/objs/nginx
[ -x "$NEW" ] || { echo "НЕТ НОВОГО БИНАРНИКА"; exit 1; }

echo "=== проверка конфига новым бинарником ДО установки ==="
"$NEW" -t -c /etc/nginx/nginx.conf 2>&1 | tail -3 || { echo "CONFIG_FAIL"; exit 1; }

echo "=== установка ==="
install -m 755 "$NEW" /usr/sbin/nginx
/usr/sbin/nginx -v
echo "=== версия/модули ==="
/usr/sbin/nginx -V 2>&1 | tr ' ' '\n' | grep -E "nginx version|brotli|http_v2|https" ; /usr/sbin/nginx -V 2>&1 | grep -c "push-stream"
echo "=== restart ==="
systemctl restart nginx && echo NGINX_RESTARTED
sleep 3
systemctl is-active nginx
echo "=== страницы (HTTP/1.1, пока h2 выключен) ==="
for u in / /raspisanie/ /services/ /news/ /bitrix/admin/; do echo -n "$u: "; curl -sS -o /dev/null -w "%{http_code}\n" -H "Host: bobrovylog.ru" "http://127.0.0.1$u"; done
echo -n "HTTPS: "; curl -sS -k -o /dev/null -w "%{http_code}\n" --resolve bobrovylog.ru:443:127.0.0.1 https://bobrovylog.ru/
echo "=== brotli/gzip ==="
echo -n "brotli: "; curl -sSI -k --compressed -H "Accept-Encoding: br" --resolve bobrovylog.ru:443:127.0.0.1 https://bobrovylog.ru/ | grep -i "content-encoding" | head -1
echo -n "gzip: "; curl -sSI -k -H "Accept-Encoding: gzip" --resolve bobrovylog.ru:443:127.0.0.1 https://bobrovylog.ru/ | grep -i "content-encoding" | head -1
echo "=== TLS версия ==="
echo | openssl s_client -connect 127.0.0.1:443 -servername bobrovylog.ru -tls1_3 2>/dev/null | grep -E "Protocol|Cipher" | head -2
echo "=== ошибки nginx ==="
tail -5 /var/log/nginx/error.log
echo "=== health ==="
/usr/local/bin/dsh-health.sh; tail -1 /var/log/dsh-health.log
