#!/bin/bash
set -u
LOG=/root/php836-build.log
exec > >(tee -a "$LOG") 2>&1
echo "=== $(date) старт сборки PHP 8.3.36 ==="

# zlib-devel при необходимости
if ! rpm -q zlib-devel >/dev/null 2>&1; then
  echo "=== ставим zlib-devel ==="
  yum -y --disablerepo='*' --enablerepo=vault-base,vault-updates,vault-extras \
    install zlib-devel 2>&1 | tail -5
fi

mkdir -p /usr/local/src
cd /usr/local/src
if [ ! -f php-8.3.36.tar.gz ]; then
  echo "=== скачиваем исходники ==="
  curl -fsSLO https://www.php.net/distributions/php-8.3.36.tar.gz || { echo "ОШИБКА загрузки"; exit 1; }
fi
echo "=== sha256 ==="
sha256sum php-8.3.36.tar.gz
echo "ожидается: c93f3441f87f6ab156bef4432db215d7e61ca2c0183bb3a2aa28d9886ab59f53"

rm -rf php-8.3.36
tar xzf php-8.3.36.tar.gz
cd php-8.3.36

echo "=== configure (минимальное ядро; расширения — модули remi) ==="
./configure \
  --prefix=/opt/php-8.3.36 \
  --with-config-file-path=/opt/php-8.3.36/etc \
  --with-config-file-scan-dir=/opt/php-8.3.36/etc/php.d \
  --enable-fpm --with-fpm-user=bitrix --with-fpm-group=bitrix \
  --disable-cgi --disable-phpdbg \
  --disable-all --enable-filter --enable-session --enable-pcntl --enable-sockets \
  --with-zlib --with-libxml-dir=/usr --enable-opcache \
  --without-pear \
  2>&1 | tail -25
if [ ! -f Makefile ]; then echo "ОШИБКА configure"; exit 1; fi

echo "=== make -j2 ==="
make -j2 2>&1 | tail -20
if [ ! -x sapi/fpm/php-fpm ]; then echo "ОШИБКА сборки fpm"; exit 1; fi

echo "=== make install ==="
make install 2>&1 | tail -10
echo "=== версия ==="
/opt/php-8.3.36/bin/php -v
/opt/php-8.3.36/sbin/php-fpm -v
echo "=== $(date) сборка завершена ==="
