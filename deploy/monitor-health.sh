#!/bin/bash
# DSH health check: мониторинг продакшена bobrovylog.ru
# Запуск по cron каждые 5 минут, результат пишется в /var/log/dsh-health.log
# Установка: /usr/local/bin/dsh-health.sh

set -u
LOG=/var/log/dsh-health.log
OFFSET_FILE=/var/run/dsh-health-offset
ACCESS_LOG=/var/log/nginx/default_access.log
TS=$(date -Iseconds)
fails=0
notes=""

# 1. HTTP-коды ключевых страниц
codes=""
for u in / /raspisanie/ /services/ /news/ /about/ /bitrix/admin/; do
    c=$(curl -sS -o /dev/null -m 15 -w "%{http_code}" -H "Host: bobrovylog.ru" "http://127.0.0.1${u}" 2>/dev/null || echo "ERR")
    codes="${codes} ${u}=${c}"
    if [ "$c" != "200" ]; then
        fails=$((fails + 1))
        notes="${notes} http_fail:${u}=${c}"
    fi
done

# 2. Диск
disk=$(df -P / | awk 'NR==2 {gsub("%","",$5); print $5}')
if [ "${disk:-0}" -ge 85 ]; then
    fails=$((fails + 1))
    notes="${notes} disk=${disk}%"
fi

# 3. Память (доступно MB)
mem=$(free -m | awk '/Mem:/ {print $7}')
if [ "${mem:-0}" -lt 200 ]; then
    fails=$((fails + 1))
    notes="${notes} mem_low=${mem}MB"
fi

# 4. Срок TLS-сертификата
end=$(echo | openssl s_client -connect 127.0.0.1:443 -servername bobrovylog.ru 2>/dev/null \
      | openssl x509 -noout -enddate 2>/dev/null | cut -d= -f2)
cert_days=""
if [ -n "$end" ]; then
    end_ts=$(date -d "$end" +%s 2>/dev/null || echo 0)
    now=$(date +%s)
    cert_days=$(( (end_ts - now) / 86400 ))
    if [ "$cert_days" -lt 30 ]; then
        fails=$((fails + 1))
        notes="${notes} cert_days=${cert_days}"
    fi
fi

# 5. Сервисы
svc=""
for s in nginx php83-php-fpm mysqld memcached crond; do
    a=$(systemctl is-active "$s" 2>/dev/null || echo unknown)
    svc="${svc}${s}=${a} "
    if [ "$a" != "active" ]; then
        fails=$((fails + 1))
        notes="${notes} svc_fail:${s}=${a}"
    fi
done

# 6. 5xx с прошлого запуска
five=0
if [ -f "$ACCESS_LOG" ]; then
    total=$(wc -l < "$ACCESS_LOG")
    prev=$(cat "$OFFSET_FILE" 2>/dev/null || echo 0)
    if [ "$total" -ge "$prev" ]; then
        lines=$((total - prev))
        if [ "$lines" -gt 0 ]; then
            five=$(tail -n "$lines" "$ACCESS_LOG" | awk '$8 ~ /^5/ {c++} END {print c+0}')
        fi
        echo "$total" > "$OFFSET_FILE"
    fi
    if [ "${five:-0}" -gt 5 ]; then
        fails=$((fails + 1))
        notes="${notes} 5xx=${five}"
    fi
fi

status="OK"
[ "$fails" -gt 0 ] && status="ALERT"

echo "${TS} status=${status} http:${codes} disk=${disk}% mem_avail=${mem}MB cert_days=${cert_days} 5xx_since_last=${five} services:[${svc}]${notes}" >> "$LOG"
exit 0
