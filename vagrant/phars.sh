#!/usr/bin/env bash

COMPOSER_VERSION="1.6.2";
BIN_DIR="/home/vagrant/bin";
COMPOSER_FILE="$BIN_DIR/composer";

mkdir -p "$BIN_DIR" &&

wget -q -O "$COMPOSER_FILE" "https://getcomposer.org/download/$COMPOSER_VERSION/composer.phar" &&

chmod +x "$COMPOSER_FILE";

composer self-update  --no-progress;
