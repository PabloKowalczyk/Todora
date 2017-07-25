#!/usr/bin/env bash

export DEBIAN_FRONTEND=noninteractive;

apt-get install ruby ruby-dev -y > /dev/null;

gem install compass > /dev/null;
