#!/usr/bin/env bash

(cd /vagrant && composer install -o -q -n --prefer-dist);
(cd /vagrant && composer bin all install -a -q -n --prefer-dist);
(cd /vagrant && bin/console doctrine:database:create -e dev --if-not-exists -q -n);
(cd /vagrant && bin/console doctrine:schema:create -e dev -n -q);
