#!/bin/bash
# Резервная копия продакшена перед обновлением ядра/рискованными работами.
# Деплой-скрипт, запускать НА СЕРВЕРЕ от root:
#   bash backup-prod.sh [каталог-назначения]
# По умолчанию: /root/backups
#
# Делает:
#   1) дамп БД sitemanager (gzip);
#   2) архив кода /home/bitrix/www без upload, bitrix/backup, кэшей;
#   3) служебный отчёт (размеры, версия Битрикса, список файлов).

set -euo pipefail
OUT="${1:-/root/backups}"
STAMP="$(date +%Y%m%d-%H%M%S)"
DB="${DB_NAME:-sitemanager}"
DOCROOT="${DOCROOT:-/home/bitrix/www}"

mkdir -p "$OUT"
cd "$OUT"

echo "[1/3] Дамп БД $DB ..."
mysqldump --single-transaction --quick --default-character-set=utf8 "$DB" | gzip > "db-${DB}-${STAMP}.sql.gz"

echo "[2/3] Архив кода ..."
tar czf "site-code-${STAMP}.tgz" -C "$DOCROOT" \
    --exclude=upload \
    --exclude=bitrix/backup \
    --exclude=bitrix/cache \
    --exclude=bitrix/managed_cache \
    --exclude=bitrix/stack_cache \
    --exclude=bitrix/tmp \
    --exclude=bitrix/html_pages \
    --exclude='*.log' \
    .

echo "[3/3] Отчёт ..."
{
    echo "date: $(date -Iseconds)"
    echo "host: $(hostname)"
    echo "database: $DB"
    echo "docroot: $DOCROOT"
    echo "bitrix version: $(grep -h SM_VERSION "$DOCROOT/bitrix/modules/main/classes/general/version.php" 2>/dev/null | head -1)"
    echo "php cli: $(php -v 2>/dev/null | head -1)"
    echo "disk: $(df -h / | tail -1)"
    echo "--- backup files ---"
    ls -lh "db-${DB}-${STAMP}.sql.gz" "site-code-${STAMP}.tgz"
} > "report-${STAMP}.txt"

echo "Готово: $OUT"
ls -lh "db-${DB}-${STAMP}.sql.gz" "site-code-${STAMP}.tgz" "report-${STAMP}.txt"
echo
echo "Восстановление:"
echo "  gunzip < db-${DB}-${STAMP}.sql.gz | mysql $DB"
echo "  tar xzf site-code-${STAMP}.tgz -C $DOCROOT"
