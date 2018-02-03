#!/usr/bin/env bash

(cd /vagrant && composer install -o -q -n --prefer-dist);
(cd /vagrant && composer bin all install -a -q -n --prefer-dist);
(cd /vagrant && composer todora:migrate:dev -q -n);

