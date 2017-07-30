#!/usr/bin/env bash

export DEBIAN_FRONTEND=noninteractive;

apt-get remove apache2 -y > /dev/null;
apt-get autoremove -y > /dev/null;

apt-get install nginx -y > /dev/null;

rm -f /etc/nginx/sites-enabled/default;

rm -f /etc/nginx/nginx.conf

cp /vagrant/vagrant/nginx/nginx.conf /etc/nginx/nginx.conf

cp /vagrant/vagrant/nginx/todora.dev /etc/nginx/sites-available
cp /vagrant/vagrant/nginx/stage.todora.dev /etc/nginx/sites-available

ln -fs /etc/nginx/sites-available/todora.dev /etc/nginx/sites-enabled/todora.dev
ln -fs /etc/nginx/sites-available/stage.todora.dev /etc/nginx/sites-enabled/stage.todora.dev

service nginx reload;
