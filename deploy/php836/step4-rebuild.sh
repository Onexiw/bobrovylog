#!/bin/bash
set -u
LOG=/root/php836-build2.log
exec > >(tee -a "$LOG") 2>&1
echo "=== $(date) пересборка PHP 8.3.36 с openssl/libxml ==="

yum -y --disablerepo='*' --enablerepo=vault-base,vault-updates,vault-extras install openssl-devel 2>&1 | tail -4

cd /usr/local/src/php-8.3.36
make distclean >/dev/null 2>&1 || true

./configure \
  --prefix=/opt/php-8.3.36 \
  --with-config-file-path=/opt/php-8.3.36/etc \
  --with-config-file-scan-dir=/opt/php-8.3.36/etc/php.d \
  --enable-fpm --with-fpm-user=bitrix --with-fpm-group=bitrix \
  --disable-cgi --disable-phpdbg \
  --with-openssl --with-zlib \
  --enable-opcache --enable-sockets --enable-pcntl \
  --without-pear \
  2>&1 | tail -12
[ -f Makefile ] || { echo "ОШИБКА configure"; exit 1; }

make -j2 2>&1 | tail -8
[ -x sapi/fpm/php-fpm ] || { echo "ОШИБКА сборки"; exit 1; }
make install 2>&1 | tail -5
echo "=== версия ==="
/opt/php-8.3.36/bin/php -v | head -2
echo "=== $(date) готово ==="
