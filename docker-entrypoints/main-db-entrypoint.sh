#!/bin/bash
sleep 10
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:fixtures:load --no-interaction

sleep 10
cron

php-fpm

exec "$@"
