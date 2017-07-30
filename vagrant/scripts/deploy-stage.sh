#!/usr/bin/env bash

DEPLOY_TARGET="/var/www/stage.todora.dev";

sudo mkdir -p "$DEPLOY_TARGET" &&
echo "- directory '$DEPLOY_TARGET' created for deploy." &&

sudo chown ubuntu:ubuntu "$DEPLOY_TARGET" &&
echo "- change directory '$DEPLOY_TARGET' owner to ubuntu:ubuntu."

rsync -az \
    --exclude="vendor" \
    --exclude="ubuntu-zesty-17.04-cloudimg-console.log" \
    --exclude="vagrant" \
    --exclude="web/bundles" \
    --exclude="var/sessions/dev" \
    /vagrant/ \
    /var/www/stage.todora.dev &&
echo "- rsync completed" &&

(cd "$DEPLOY_TARGET" && composer install -a --no-dev --no-scripts -n -q) &&
echo "- composer dependencies installed.";

(cp -f /vagrant/vagrant/scripts/.env "$DEPLOY_TARGET/.env") &&
echo "- copied .env file";

(cd "$DEPLOY_TARGET" && bin/console cache:clear -q --no-warmup) &&
echo "- cache cleared.";

(cd "$DEPLOY_TARGET" && bin/console doctrine:cache:clear-metadata -q) &&
echo "- doctrine metadata cache cleared.";

(cd "$DEPLOY_TARGET" && bin/console cache:warmup -q) &&
echo "- cache warmed up.";

sudo service php7.1-fpm reload &&
echo "- reloaded 'php7.1-fpm' service.";

echo "Deploy successful.";
