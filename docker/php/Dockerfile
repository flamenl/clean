FROM php:8.1-fpm

RUN apt-get update -y

RUN apt-get install -y make gcc g++ unzip git libjudy-dev libzip-dev libpng-dev libicu-dev libpq-dev

RUN pecl install xdebug

RUN docker-php-ext-install -j$(nproc) \
    bcmath \
    opcache \
    gd \
    intl \
    pdo_mysql \
    pdo_pgsql \
    zip

RUN docker-php-ext-enable opcache xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_MEMORY_LIMIT=-1

COPY . /app

COPY ./docker/php /usr/local/etc/php

WORKDIR /app
