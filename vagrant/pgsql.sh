#!/usr/bin/env bash

DB_USER="todora_dev";
DB_PASS="todora_dev_password";

export DEBIAN_FRONTEND=noninteractive;

apt-get install postgresql postgresql-contrib -y > /dev/null;

USER_EXIST=$(sudo -u postgres psql -A -t -c "SELECT 1 FROM pg_roles WHERE rolname LIKE '$DB_USER'");

if [ "$USER_EXIST" == "1" ]; then
    echo "- database user '$DB_USER' already exist.";
else
	sudo -u postgres psql -c "CREATE USER $DB_USER LOGIN SUPERUSER PASSWORD '$DB_PASS'" > /dev/null &&
	sudo -u postgres psql -c "CREATE DATABASE $DB_USER" > /dev/null &&
	sudo -u postgres psql -c "GRANT ALL PRIVILEGES ON DATABASE $DB_USER TO $DB_USER" > /dev/null &&

	echo "- user '$DB_USER' created with password '$DB_PASS'."
fi
