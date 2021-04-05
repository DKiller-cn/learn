# PHP学习笔记

[TOC]

## 环境搭建

[**VirtualBox**](https://www.virtualbox.org/) + [**CentOS7**](http://ftp.tsukuba.wide.ad.jp/Linux/centos/7.9.2009/isos/x86_64/) + [**Docker**](https://docs.docker.jp/engine/installation/linux/docker-ce/centos.html) + Nginx/MariaDB/PHP

- CentOS7：安装时使用桥接网卡。开发时改为 Host-only + NAT。

具体命令详见 [**manual.sh**](manual.sh) 。



## 本地域名

```shell
vim /etc/hosts
```

> 172.20.10.6 yujie.com



## 文件共享

安装 VirtualBox 增强功能以开启文件共享。

```shell
yum -y install kernel-devel kernel-headers gcc gcc-c++ bzip2
mkdir -p /media/cdrom
mount /dev/cdrom /media/cdrom
cd /media/cdrom
./VBoxLinuxAdditions.run
```

配置文件夹共享，共享文件夹名称 `tomato`，挂载点 `/opt/tomato` ，**不自动挂载**。

手动挂在加选项 [**设置 uid 和 gid 为 33 号**](https://superuser.com/questions/320415/mount-device-with-specific-user-rights)。

```shell
mount -t vboxsf -o gid=33,uid=33 tomato /opt/tomato
```

设置开机自动启动。

```shell
echo '' >> /etc/rc.local 
echo 'mount -t vboxsf -o gid=33,uid=33 tomato /opt/tomato' >> /etc/rc.local 
chmod +x /etc/rc.d/rc.local
```



## Composer

包仓库：https://packagist.org/

```shell
docker exec -it php bash
```

```shell
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```



## Laravel

推荐入门教程：https://learnku.com/courses/laravel-essential-training/8.x

推荐中文文档：https://learnku.com/docs/laravel/8.x



### 创建项目

```shell
docker exec -it php bash
```

```shell
composer create-project --prefer-dist laravel/laravel laravel
```



### Adminer

单文件数据库管理工具。

https://www.adminer.org/#download

需要安装数据库相关的PHP扩展。



### Dockerfile

写入需要的 PHP 扩展。执行 **build.sh** 。

配置相关扩展到 php.ini 文件。重建 PHP 容器。