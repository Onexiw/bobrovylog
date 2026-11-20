#!/bin/bash
set -u
NEW=/usr/local/src/ngx-build/nginx-1.30.7/objs/nginx
OLD=/root/backup-nginx-1.20.2-20261120/nginx-1.20.2.bin
[ -x "$NEW" ] || { echo "НЕТ БИНАРНИКА"; exit 1; }

echo "=== установка 1.30.7 ==="
install -m 755 "$NEW" /usr/sbin/nginx
/usr/sbin/nginx -v
systemctl restart nginx
sleep 3
if [ "$(systemctl is-active nginx)" != "active" ]; then
  echo "NGINX НЕ СТАРТОВАЛ — ОТКАТ"
  install -m 755 "$OLD" /usr/sbin/nginx
  systemctl restart nginx
  systemctl is-active nginx
  exit 1
fi
echo NGINX_ACTIVE

echo "=== проверки ==="
for u in / /raspisanie/ /services/ /news/ /about/ /bitrix/admin/; do echo -n "http $u: "; curl -sS -o /dev/null -w "%{http_code}\n" -H "Host: bobrovylog.ru" "http://127.0.0.1$u"; done
echo -n "https home: "; curl -sS -k -o /dev/null -w "%{http_code}\n" --resolve bobrovylog.ru:443:127.0.0.1 https://bobrovylog.ru/
echo -n "static: "; curl -sS -o /dev/null -w "%{http_code}\n" -H "Host: bobrovylog.ru" "http://127.0.0.1/local/templates/bobrovy_log_multilang/template_styles.css"
echo "=== brotli/gzip ==="
curl -sSI -k -H "Accept-Encoding: br" --resolve bobrovylog.ru:443:127.0.0.1 https://bobrovylog.ru/ | grep -i "content-encoding" | head -1
curl -sSI -k -H "Accept-Encoding: gzip" --resolve bobrovylog.ru:443:127.0.0.1 https://bobrovylog.ru/ | grep -i "content-encoding" | head -1
echo "=== TLS 1.3 ==="
echo | openssl s_client -connect 127.0.0.1:443 -servername bobrovylog.ru -tls1_3 2>/dev/null | grep -E "Protocol|Cipher" | head -2
echo "=== ошибки ==="
tail -8 /var/log/nginx/error.log
echo "=== health ==="
/usr/local/bin/dsh-health.sh; tail -1 /var/log/dsh-health.log
