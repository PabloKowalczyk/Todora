#!/usr/bin/env bash

export DEBIAN_FRONTEND=noninteractive;

PHP_VERSION="7.1";

## Add Onrej PPA for php 5.6 - 7.2
add-apt-repository -y -u ppa:ondrej/php > /dev/null 2>&1;

apt-get install git \
    "php$PHP_VERSION" \
    "php$PHP_VERSION-zip" \
    "php$PHP_VERSION-mbstring" \
    "php$PHP_VERSION-opcache" \
    "php$PHP_VERSION-xml" \
    "php$PHP_VERSION-pgsql" \
    "php$PHP_VERSION-gd" \
    "php$PHP_VERSION-intl" \
    "php$PHP_VERSION-fpm" \
    php-apcu \
    htop \
    curl \
    build-essential \
    redis-server -y > /dev/null;
