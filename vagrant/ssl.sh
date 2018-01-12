#!/usr/bin/env bash

rm -f ~/.rnd;

mkdir -p /etc/nginx/ssl;

openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/nginx/ssl/todora.local.key \
    -out /etc/nginx/ssl/todora.local.crt \
    -subj "/C=PL/ST=Masovian/L=Warsaw/O=PK Ltd/OU=IT Department/CN=todora.local" > /dev/null 2>&1 &&

echo "- SSL cert generated for dev env.";

openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/nginx/ssl/stage.todora.local.key \
    -out /etc/nginx/ssl/stage.todora.local.crt \
    -subj "/C=PL/ST=Masovian/L=Warsaw/O=PK Ltd/OU=IT Department/CN=stage.todora.local" > /dev/null 2>&1 &&

echo "- SSL cert generated for stage env.";
