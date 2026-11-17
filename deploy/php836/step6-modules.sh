#!/bin/bash
set -u
P=/opt/php-8.3.36
D="$P/etc/php.d"
DIS="$D/disabled"
mkdir -p "$DIS" /var/log/php836

echo "=== модули, собранные в ядро (php -n) ==="
"$P/bin/php" -n -m 2>/dev/null | tr '\n' ' '; echo

# 1) убираем ini для модулей, уже встроенных в ядро
BUILTINS=$("$P/bin/php" -n -m 2>/dev/null | tr 'A-Z' 'a-z')
for f in "$D"/*.ini; do
  [ -f "$f" ] || continue
  b=$(basename "$f")
  case "$b" in
    00-local-paths.ini|10-opcache.ini|99-bitrix.ini) continue ;;
  esac
  mod=$(grep -oE '^extension[[:space:]]*=[[:space:]]*"?[a-zA-Z0-9_]+' "$f" | head -1 | sed -E 's/.*=[[:space:]]*"?//' | tr 'A-Z' 'a-z')
  if [ -n "$mod" ] && echo "$BUILTINS" | grep -qx "$mod"; then
    mv "$f" "$DIS/"
    echo "выключен дубль: $b (модуль $mod встроен)"
  fi
done

# 2) итеративно отключаем модули, которые не грузятся
for i in $(seq 1 40); do
  ERR=$("$P/bin/php" -c "$P/etc/php.ini" -m 2>&1 >/dev/null)
  BAD=$(echo "$ERR" | grep -oE 'Unable to load dynamic library [^ ]*(/|")[a-zA-Z0-9_]+\.so' | tail -1 | sed -E 's#.*/##; s/"//')
  if [ -z "$BAD" ]; then
    echo "ошибок загрузки нет (итерация $i)"
    break
  fi
  name="${BAD%.so}"
  f=$(grep -lE "extension[[:space:]]*=[[:space:]]*\"?${name}\"?" "$D"/*.ini 2>/dev/null | head -1)
  if [ -n "$f" ]; then
    mv "$f" "$DIS/"
    echo "выключен: $(basename "$f") (не грузится $BAD)"
  else
    echo "НЕ НАЙДЕН ini для $BAD; ошибка: $ERR" | head -3
    break
  fi
done

echo ""
echo "=== итоговый список модулей ==="
"$P/bin/php" -c "$P/etc/php.ini" -m 2>&1 | tr '\n' ' '; echo
echo ""
echo "=== обязательные для Битрикса ==="
for m in mysqli pdo_mysql mbstring gd zip intl curl openssl xml dom simplexml xsl sodium apcu memcache opcache exif fileinfo iconv bcmath calendar ctype tokenizer ldap gettext ftp bz2 session filter json; do
  if "$P/bin/php" -c "$P/etc/php.ini" -m 2>/dev/null | grep -qx "$m"; then :; else echo "НЕТ: $m"; fi
done
echo "=== проверка чувствительных настроек ==="
"$P/bin/php" -c "$P/etc/php.ini" -r 'echo "upload_progress=".var_export((bool)ini_get("session.upload_progress.enabled"),true)." strict=".ini_get("session.use_strict_mode")." memory=".ini_get("memory_limit").PHP_EOL;' 2>&1
