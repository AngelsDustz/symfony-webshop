FROM php:fpm-alpine

WORKDIR /var/www

RUN set -ex \
    && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql
