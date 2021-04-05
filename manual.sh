#!/bin/bash

yum update -y
yum install -y epel-release
yum install -y vim git htop

yum install -y yum-utils \
  device-mapper-persistent-data \
  lvm2
yum-config-manager \
    --add-repo \
    https://download.docker.com/linux/centos/docker-ce.repo
yum install -y docker-ce

systemctl start docker
systemctl enable docker

docker network create \
--driver=bridge \
--subnet=10.0.0.0/24 \
--gateway=10.0.0.1 \
tomato

docker run -d \
--name=nginx \
--net=tomato \
--ip=10.0.0.2 \
-p 80:80 \
-v /usr/share/zoneinfo/Asia/Tokyo:/etc/localtime:ro \
-v /opt/tomato/config/nginx:/etc/nginx/conf.d \
-v /opt/tomato/src:/var/www/html \
nginx:latest

docker run -d \
--name=mariadb \
--net=tomato \
--ip=10.0.0.3 \
-v /usr/share/zoneinfo/Asia/Tokyo:/etc/localtime:ro \
-v /opt/tomato/config/mariadb:/etc/mysql \
-e MYSQL_ROOT_PASSWORD=123456 \
mariadb:latest \
--character-set-server=utf8mb4 \
--collation-server=utf8mb4_unicode_ci

docker exec -it mariadb mysql -uroot -p123456
grant all privileges on *.* to 'root'@'%' identified by '123456' with grant option;
show grants for root;
exit

docker run -d \
--name php \
--net=tomato \
--ip=10.0.0.4 \
-v /usr/share/zoneinfo/Asia/Tokyo:/etc/localtime:ro \
-v /opt/tomato/config/php:/usr/local/etc/php/conf.d \
-v /opt/tomato/src:/var/www/html \
php:fpm

echo '' >> /etc/rc.local 
echo 'mount -t vboxsf -o gid=33,uid=33 tomato /opt/tomato' >> /etc/rc.local 
chmod +x /etc/rc.d/rc.local

echo 'docker start mariadb' >> /etc/rc.local
echo 'docker start php' >> /etc/rc.local
echo 'docker start nginx' >> /etc/rc.local

docker exec -it php bash
  curl -sS https://getcomposer.org/installer | php
  mv composer.phar /usr/local/bin/composer