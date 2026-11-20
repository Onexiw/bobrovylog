#!/bin/bash
set -u
LOG=/root/nginx-1.30.7-build.log
exec > >(tee -a "$LOG") 2>&1
echo "=== $(date) сборка nginx 1.30.7 ==="
D=/usr/local/src/ngx-build
mkdir -p "$D"; cd "$D"

fetch() {
  [ -f "$2" ] || curl -fsSL "$1" -o "$2" || { echo "ОШИБКА загрузки $1"; exit 1; }
}
fetch https://nginx.org/download/nginx-1.30.7.tar.gz nginx-1.30.7.tar.gz
fetch https://github.com/google/ngx_brotli/archive/refs/heads/master.tar.gz ngx_brotli.tar.gz
fetch https://github.com/google/brotli/archive/refs/tags/v1.1.0.tar.gz brotli.tar.gz
fetch https://github.com/wandenberg/nginx-push-stream-module/archive/refs/heads/master.tar.gz push-stream.tar.gz
fetch https://github.com/evanmiller/mod_zip/archive/refs/heads/master.tar.gz mod_zip.tar.gz

rm -rf nginx-1.30.7 ngx_brotli-master brotli-1.1.0 nginx-push-stream-module-master mod_zip-master
tar xzf nginx-1.30.7.tar.gz
tar xzf ngx_brotli.tar.gz
tar xzf brotli.tar.gz
tar xzf push-stream.tar.gz
tar xzf mod_zip.tar.gz

mkdir -p ngx_brotli-master/deps
rm -rf ngx_brotli-master/deps/brotli
mv brotli-1.1.0 ngx_brotli-master/deps/brotli

getent group nginx >/dev/null || groupadd -r nginx
getent passwd nginx >/dev/null || useradd -r -g nginx -d /var/cache/nginx -s /sbin/nologin nginx
mkdir -p /var/cache/nginx/client_temp /var/cache/nginx/proxy_temp /var/cache/nginx/fastcgi_temp /var/cache/nginx/uwsgi_temp /var/cache/nginx/scgi_temp

cd nginx-1.30.7
./configure \
  --prefix=/etc/nginx \
  --sbin-path=/usr/sbin/nginx \
  --conf-path=/etc/nginx/nginx.conf \
  --error-log-path=/var/log/nginx/error.log \
  --http-log-path=/var/log/nginx/access.log \
  --pid-path=/var/run/nginx.pid \
  --lock-path=/var/run/nginx.lock \
  --http-client-body-temp-path=/var/cache/nginx/client_temp \
  --http-proxy-temp-path=/var/cache/nginx/proxy_temp \
  --http-fastcgi-temp-path=/var/cache/nginx/fastcgi_temp \
  --http-uwsgi-temp-path=/var/cache/nginx/uwsgi_temp \
  --http-scgi-temp-path=/var/cache/nginx/scgi_temp \
  --user=nginx --group=nginx \
  --with-openssl=/opt/openssl11 --with-openssl-opt=enable-tls1_3 \
  --with-http_ssl_module --with-http_realip_module --with-http_addition_module \
  --with-http_sub_module --with-http_dav_module --with-http_flv_module \
  --with-http_mp4_module --with-http_gunzip_module --with-http_gzip_static_module \
  --with-http_random_index_module --with-http_secure_link_module \
  --with-http_stub_status_module --with-http_auth_request_module --with-http_v2_module \
  --with-mail --with-mail_ssl_module --with-file-aio \
  --with-cc-opt='-O2 -g' \
  --with-ld-opt='-Wl,-rpath,/opt/openssl11/lib' \
  --add-module="$D/nginx-push-stream-module-master" \
  --add-module="$D/mod_zip-master" \
  --add-module="$D/ngx_brotli-master" \
  2>&1 | tail -15
[ -f Makefile ] || { echo "CONFIGURE_FAIL"; exit 1; }
make -j2 2>&1 | tail -12
[ -x objs/nginx ] || { echo "BUILD_FAIL"; exit 1; }
echo "=== СБОРКА OK ==="
./objs/nginx -V 2>&1 | tr ' ' '\n' | grep -E "nginx version|brotli|http_v2|push|zip|openssl" | head -10
echo "=== $(date) готово ==="
