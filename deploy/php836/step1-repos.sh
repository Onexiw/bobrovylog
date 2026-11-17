#!/bin/bash
set -u
BACKUP=/root/backup-php-build-20261117
mkdir -p "$BACKUP"
cp -a /etc/yum.repos.d /root/backup-php-build-20261117/yum.repos.d.bak 2>/dev/null || true

cat > /etc/yum.repos.d/vault-centos7-local.repo <<'EOF'
[vault-base]
name=CentOS 7.9 Base (vault)
baseurl=https://vault.centos.org/7.9.2009/os/$basearch/
enabled=0
gpgcheck=0

[vault-updates]
name=CentOS 7.9 Updates (vault)
baseurl=https://vault.centos.org/7.9.2009/updates/$basearch/
enabled=0
gpgcheck=0

[vault-extras]
name=CentOS 7.9 Extras (vault)
baseurl=https://vault.centos.org/7.9.2009/extras/$basearch/
enabled=0
gpgcheck=0
EOF

cat > /etc/yum.repos.d/epel-archive-local.repo <<'EOF'
[epel-archive]
name=EPEL 7 Archive
baseurl=https://archives.fedoraproject.org/pub/archive/epel/7/$basearch/
enabled=0
gpgcheck=0
EOF

echo "=== доступность зеркал ==="
timeout 20 curl -sSI -o /dev/null -w "vault.centos.org: %{http_code}\n" "https://vault.centos.org/7.9.2009/os/x86_64/repodata/repomd.xml" || echo "vault недоступен"
timeout 20 curl -sSI -o /dev/null -w "archives.fedoraproject.org: %{http_code}\n" "https://archives.fedoraproject.org/pub/archive/epel/7/x86_64/repodata/repomd.xml" || echo "epel недоступен"

echo "=== ставим зависимости сборки ==="
yum -y --disablerepo='*' --enablerepo=vault-base,vault-updates,vault-extras,epel-archive,remi,remi-safe \
  --setopt=remi.baseurl=http://rpms.remirepo.net/enterprise/7/remi/x86_64/ \
  --setopt=remi-safe.baseurl=http://rpms.remirepo.net/enterprise/7/safe/x86_64/ \
  install autoconf bison re2c gcc-c++ patch libxml2-devel 2>&1 | tail -15

echo "=== проверка ==="
for t in autoconf bison re2c gcc g++; do printf "%-10s %s\n" "$t" "$(command -v $t || echo НЕТ)"; done
autoconf --version 2>/dev/null | head -1
re2c --version 2>/dev/null | head -1
