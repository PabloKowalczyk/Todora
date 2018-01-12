#!/usr/bin/env bash

export DEBIAN_FRONTEND=noninteractive;

curl -sL https://deb.nodesource.com/setup_9.x | sudo -E bash - > /dev/null
apt-get -qq install -y nodejs > /dev/null

npm install -sg yarn > /dev/null
