FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
       libpq-dev \
        wget \
        zlib1g-dev \
        libmcrypt-dev \
        libzip-dev \
        openssl \
        git \
        zip \
        unzip \
    && docker-php-ext-install zip

RUN docker-php-ext-install pdo pdo_mysql
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /www
