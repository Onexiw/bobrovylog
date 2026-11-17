#!/bin/bash
set -u
P=/opt/php-8.3.36
mkdir -p "$P/etc/php.d" /var/log/php836
cp -a /etc/opt/remi/php83/php.ini "$P/etc/php.ini"

# extension_dir должен указывать на модули remi
grep -n '^extension_dir' "$P/etc/php.ini" || echo 'extension_dir = "/opt/remi/php83/root/usr/lib64/php/modules"' >> "$P/etc/php.ini"

echo "=== копируем ini расширений (кроме opcache — он собран) ==="
for f in /etc/opt/remi/php83/php.d/*.ini; do
  b=$(basename "$f")
  case "$b" in
    10-opcache.ini) continue ;;
  esac
  cp -a "$f" "$P/etc/php.d/$b"
done
ls "$P/etc/php.d" | tr '\n' ' '; echo

echo "=== где opcache.so после установки ==="
find "$P" -name 'opcache.so' 2>/dev/null
MODDIR=$(find "$P" -type d -name 'no-debug-non-zts-*' | head -1)
echo "moddir: ${MODDIR:-нет}"
if [ -n "$MODDIR" ] && [ -f "$MODDIR/opcache.so" ]; then
  echo "zend_extension=$MODDIR/opcache.so" > "$P/etc/php.d/10-opcache.ini"
fi

echo "=== локальные пути (error_log, temp) ==="
cat > "$P/etc/php.d/00-local-paths.ini" <<'EOF'
error_log = /var/log/php836/php_errors.log
sys_temp_dir = /tmp
upload_tmp_dir =
EOF

echo "=== проверка загрузки модулей ==="
"$P/bin/php" -c "$P/etc/php.ini" -v 2>&1 | head -3
echo "--- stderr/errors ---"
"$P/bin/php" -c "$P/etc/php.ini" -m 2>&1 | head -80
