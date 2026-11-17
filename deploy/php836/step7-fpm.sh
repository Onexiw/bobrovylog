#!/bin/bash
set -u
P=/opt/php-8.3.36
mkdir -p "$P/etc/php-fpm.d" /var/run/php836 /var/log/php836 /var/opt/php836/session

if [ ! -f "$P/etc/php-fpm.conf" ]; then
  cp -a /etc/opt/remi/php83/php-fpm.conf "$P/etc/php-fpm.conf"
fi
# include на наш каталог
sed -i 's#^include=.*#include=/opt/php-8.3.36/etc/php-fpm.d/*.conf#' "$P/etc/php-fpm.conf"
sed -i "s#^pid = .*#pid = /var/run/php836/php-fpm.pid#" "$P/etc/php-fpm.conf" 2>/dev/null || true
grep -q '^error_log' "$P/etc/php-fpm.conf" && sed -i "s#^error_log = .*#error_log = /var/log/php836/fpm-error.log#" "$P/etc/php-fpm.conf"

cp -a /etc/opt/remi/php83/php-fpm.d/www.conf "$P/etc/php-fpm.d/www.conf"
W="$P/etc/php-fpm.d/www.conf"
sed -i 's#^listen = .*#listen = 127.0.0.1:9004#' "$W"
sed -i 's#^user = .*#user = bitrix#' "$W"
sed -i 's#^group = .*#group = bitrix#' "$W"
sed -i 's#^pm = .*#pm = ondemand#' "$W"
sed -i 's#^pm.max_children = .*#pm.max_children = 30#' "$W"
sed -i 's#^pm.process_idle_timeout = .*#pm.process_idle_timeout = 10s#' "$W"
sed -i 's#^pm.max_requests = .*#pm.max_requests = 500#' "$W"
sed -i 's#^slowlog = .*#slowlog = /var/log/php836/fpm-slow.log#' "$W"
sed -i "s#^php_admin_value\[error_log\] = .*#php_admin_value[error_log] = /var/log/php836/fpm-www-error.log#" "$W"
grep -q 'session.save_path' "$W" || echo 'php_admin_value[session.save_path] = /tmp/php_sessions/www' >> "$W"
chmod 777 /tmp/php_sessions/www 2>/dev/null || mkdir -p /tmp/php_sessions/www
chown -R bitrix:bitrix /tmp/php_sessions/www 2>/dev/null || true

echo "=== проверка конфигурации fpm ==="
"$P/sbin/php-fpm" -t -y "$P/etc/php-fpm.conf" 2>&1 | tail -3

echo "=== systemd unit ==="
cp -a /usr/lib/systemd/system/php83-php-fpm.service /etc/systemd/system/php836-fpm.service
sed -i 's#^ExecStart=.*#ExecStart=/opt/php-8.3.36/sbin/php-fpm --nodaemonize --fpm-config /opt/php-8.3.36/etc/php-fpm.conf#' /etc/systemd/system/php836-fpm.service
sed -i 's#^PIDFile=.*#PIDFile=/var/run/php836/php-fpm.pid#' /etc/systemd/system/php836-fpm.service
sed -i 's#^RuntimeDirectory=.*#RuntimeDirectory=php836#' /etc/systemd/system/php836-fpm.service
sed -i 's#^Description=.*#Description=PHP 8.3.36 FastCGI Process Manager (new, test pool)#' /etc/systemd/system/php836-fpm.service
sed -i 's#^After=.*#After=network.target#' /etc/systemd/system/php836-fpm.service
cat /etc/systemd/system/php836-fpm.service | grep -E "ExecStart|PIDFile|RuntimeDirectory|User|Group|Type"
systemctl daemon-reload
systemctl enable --now php836-fpm 2>&1 | tail -2
sleep 3
systemctl is-active php836-fpm
ss -ltnp 2>/dev/null | grep 9004 || echo "порт 9004 не слушается"

echo "=== nginx test vhost :8080 (docroot staging) ==="
cat > /etc/nginx/bx/site_enabled/php836-check.conf <<'EOF'
server {
    listen 127.0.0.1:8080;
    server_name _;
    root /home/bitrix/stage;
    index index.php index.html;

    location ~* ^/(upload|bitrix)/.*\.(php|php3|php4|php5|php6|php7|phtml)$ { deny all; }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9004;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME /home/bitrix/stage$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT /home/bitrix/stage;
        fastcgi_param HTTPS "";
        fastcgi_keep_conn on;
        fastcgi_read_timeout 300;
    }

    location / {
        try_files $uri $uri/ /bitrix/urlrewrite.php?$query_string;
    }
}
EOF
nginx -t 2>&1 | tail -2 && systemctl reload nginx && echo NGINX_RELOADED

echo "=== проба PHP на :8080 ==="
cat > /home/bitrix/stage/_php836.php <<'PHP'
<?php
echo "PHP ".PHP_VERSION."\n";
echo "sapi=".PHP_SAPI."\n";
echo "upload_progress=".var_export((bool)ini_get('session.upload_progress.enabled'), true)." strict=".ini_get('session.use_strict_mode')."\n";
echo "modules=".implode(',', array_slice(get_loaded_extensions(),0,100))."\n";
PHP
chown bitrix:bitrix /home/bitrix/stage/_php836.php
curl -sS -H "Host: stage.bobrovylog.ru" "http://127.0.0.1:8080/_php836.php"
rm -f /home/bitrix/stage/_php836.php

echo "=== страницы staging на PHP 8.3.36 ==="
for u in / /raspisanie/ /services/ /news/ /bitrix/admin/; do
  echo -n "$u: "; curl -sS -o /dev/null -w "%{http_code}\n" -H "Host: stage.bobrovylog.ru" "http://127.0.0.1:8080$u"
done
