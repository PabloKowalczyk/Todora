#!/usr/bin/env bash

rm -f ~/.rnd;

mkdir -p /etc/nginx/ssl;

openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/nginx/ssl/todora.dev.key \
    -out /etc/nginx/ssl/todora.dev.crt \
    -subj "/C=PL/ST=Masovian/L=Warsaw/O=PK Ltd/OU=IT Department/CN=todora.dev" > /dev/null 2>&1 &&

echo "- SSL cert generated for dev env.";

openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/nginx/ssl/stage.todora.dev.key \
    -out /etc/nginx/ssl/stage.todora.dev.crt \
    -subj "/C=PL/ST=Masovian/L=Warsaw/O=PK Ltd/OU=IT Department/CN=stage.todora.dev" > /dev/null 2>&1 &&

echo "- SSL cert generated for prod env.";
