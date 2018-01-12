#!/usr/bin/env bash

DEPLOY_TARGET="/var/www/stage.todora.local";

sudo mkdir -p "$DEPLOY_TARGET" &&
echo "- directory '$DEPLOY_TARGET' created for deploy." &&

sudo chown ubuntu:ubuntu "$DEPLOY_TARGET" &&
echo "- change directory '$DEPLOY_TARGET' owner to ubuntu:ubuntu." &&

rsync -az \
    --exclude="vendor" \
    --exclude="ubuntu-xenial-16.04-cloudimg-console.log" \
    --exclude="vagrant" \
    --exclude="public/bundles" \
    --exclude="public/src/.sass-cache" \
    --exclude="var/sessions/dev" \
    /vagrant/ \
    /var/www/stage.todora.local &&
echo "- rsync completed" &&

(cd "$DEPLOY_TARGET" && composer install -a --no-dev --no-scripts -n -q) &&
echo "- composer dependencies installed." &&

(cp -f /vagrant/vagrant/scripts/.env "$DEPLOY_TARGET/.env") &&
echo "- copied .env file" &&

(cd "$DEPLOY_TARGET" && bin/console cache:clear -q --no-warmup) &&
echo "- cache cleared." &&

(cd "$DEPLOY_TARGET" && bin/console doctrine:cache:clear-metadata -q) &&
echo "- doctrine metadata cache cleared." &&

(cd "$DEPLOY_TARGET" && bin/console cache:warmup -q) &&
echo "- cache warmed up." &&

(cd "$DEPLOY_TARGET/public/src" && npm i) &&
echo "- NPM packages installed." &&

(rm -rf "$DEPLOY_TARGET/public/build") &&
echo "- cleared build dir." &&

(cd "$DEPLOY_TARGET/public/src" && gulp build:prod --silent) &&
echo "- gulp build finished." &&

sudo service php7.1-fpm reload &&
echo "- reloaded 'php7.1-fpm' service." &&

echo "Deploy successful."
