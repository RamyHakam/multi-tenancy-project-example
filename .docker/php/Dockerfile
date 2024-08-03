FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN apt-get update && apt-get install -y cron

COPY .docker/php/crontab /etc/cron.d/create-db-cron
COPY .docker/php/create-tenant-db.sh /usr/local/bin/create-tenant-db.sh
COPY docker-entrypoints/main-db-entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod 0644 /etc/cron.d/create-db-cron
RUN chmod +x /usr/local/bin/create-tenant-db.sh
RUN crontab /etc/cron.d/create-db-cron
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN touch /var/log/cron.log

CMD cron && tail -f /var/log/cron.log

WORKDIR /var/www/html/

EXPOSE 9000

ENTRYPOINT ["entrypoint.sh"]

