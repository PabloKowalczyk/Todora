FROM php:7.3-fpm-alpine

RUN apk add --no-cache \
        autoconf \
        g++ \
        make \
        shadow \
        icu \
        icu-dev \
        postgresql-libs \
        postgresql-dev \
        su-exec && \
    usermod --non-unique --uid 1000 www-data && \
    pecl install apcu-5.1.17 && \
    pecl install redis-5.0.2 && \
    docker-php-ext-enable \
        redis \
        apcu && \
    docker-php-ext-install -j$(nproc) \
        opcache \
        pdo_pgsql \
        intl && \
    apk del \
        shadow \
        icu-dev \
        autoconf \
        g++ \
        make \
        postgresql-dev

COPY --from=composer:1.9 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_HOME /var/www/.composer
