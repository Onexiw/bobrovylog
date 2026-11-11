#!/bin/bash
# Патч совместимости стороннего модуля mibok.rasp с PHP 8.x:
# 4 метода вызываются статически, но были объявлены нестатическими.
# В PHP 8 это фатальная ошибка "Non-static method ... cannot be called statically".
# Скрипт идемпотентен: повторный запуск ничего не меняет.
#
# Использование: bash patch-mibok-rasp.sh /home/bitrix/www
# (для staging — bash patch-mibok-rasp.sh /home/bitrix/stage)

set -eu
ROOT="${1:-/home/bitrix/www}"
FILE="$ROOT/bitrix/modules/mibok.rasp/include.php"

if [ ! -f "$FILE" ]; then
    echo "Нет файла: $FILE" >&2
    exit 1
fi

if grep -qE "^\s*static function (ruDateFull|enDateFull|GetNewTable|isCellTimetable)\(" "$FILE"; then
    echo "Патч уже применён: $FILE"
else
    BACKUP="${FILE}.bak-$(date +%Y%m%d-%H%M%S)"
    cp -a "$FILE" "$BACKUP"
    sed -i -E 's/^(\s*)function (ruDateFull|enDateFull|GetNewTable|isCellTimetable)\(/\1static function \2(/' "$FILE"
    echo "Патч применён. Бэкап: $BACKUP"
fi

php -l "$FILE"
grep -nE "function (ruDateFull|enDateFull|GetNewTable|isCellTimetable)\(" "$FILE"
