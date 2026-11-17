#!/bin/bash
set -u
LOG=/root/php836-build3.log
exec > >(tee -a "$LOG") 2>&1
echo "=== $(date) OpenSSL 1.1.1w + PHP 8.3.36 ==="

# 1) OpenSSL 1.1.1w
cd /usr/local/src
if [ ! -f openssl-1.1.1w.tar.gz ]; then
  curl -fsSLO https://www.openssl.org/source/openssl-1.1.1w.tar.gz || { echo "ОШИБКА загрузки openssl"; exit 1; }
fi
if [ ! -f /opt/openssl11/lib/libssl.so.1.1 ]; then
  rm -rf openssl-1.1.1w
  tar xzf openssl-1.1.1w.tar.gz
  cd openssl-1.1.1w
  ./config --prefix=/opt/openssl11 --openssldir=/opt/openssl11/ssl shared zlib 2>&1 | tail -5
  make -j2 2>&1 | tail -5
  make install_sw 2>&1 | tail -3
  cd ..
fi
ls -la /opt/openssl11/lib/libssl.so.1.1 /opt/openssl11/lib/libcrypto.so.1.1 || { echo "ОШИБКА openssl install"; exit 1; }

# 2) PHP с openssl из /opt/openssl11 и rpath
cd /usr/local/src/php-8.3.36
make distclean >/dev/null 2>&1 || true
export PKG_CONFIG_PATH=/opt/openssl11/lib/pkgconfig
./configure \
  --prefix=/opt/php-8.3.36 \
  --with-config-file-path=/opt/php-8.3.36/etc \
  --with-config-file-scan-dir=/opt/php-8.3.36/etc/php.d \
  --enable-fpm --with-fpm-user=bitrix --with-fpm-group=bitrix \
  --disable-cgi --disable-phpdbg \
  --with-openssl=/opt/openssl11 --with-zlib \
  --enable-opcache --enable-sockets --enable-pcntl \
  --without-sqlite3 --without-pdo-sqlite \
  --without-pear \
  LDFLAGS="-Wl,-rpath,/opt/openssl11/lib" \
  2>&1 | tail -8
[ -f Makefile ] || { echo "ОШИБКА configure"; exit 1; }
make -j2 2>&1 | tail -6
[ -x sapi/fpm/php-fpm ] || { echo "ОШИБКА сборки php"; exit 1; }
make install 2>&1 | tail -3
echo "=== итог ==="
/opt/php-8.3.36/bin/php -v | head -2
/opt/php-8.3.36/sbin/php-fpm -v | head -2
ldd /opt/php-8.3.36/sbin/php-fpm | grep -E "ssl|crypto"
echo "=== $(date) готово ==="
