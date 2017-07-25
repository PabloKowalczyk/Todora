#!/usr/bin/env bash

PHP_VERSION="7.1";

rm -f "/etc/php/$PHP_VERSION/cli/php.ini";
cp /vagrant/vagrant/php/cli/php.ini "/etc/php/$PHP_VERSION/cli/php.ini";

rm -f "/etc/php/$PHP_VERSION/fpm/php.ini";
cp /vagrant/vagrant/php/fpm/php.ini "/etc/php/$PHP_VERSION/fpm/php.ini";

rm -f "/etc/php/$PHP_VERSION/fpm/pool.d/www.conf";
cp /vagrant/vagrant/php/fpm/pool.d/www.conf "/etc/php/$PHP_VERSION/fpm/pool.d/www.conf";

rm -f "/etc/php/$PHP_VERSION/fpm/pool.d/stage.conf";
cp /vagrant/vagrant/php/fpm/pool.d/stage.conf "/etc/php/$PHP_VERSION/fpm/pool.d/stage.conf";

service php7.1-fpm restart;
