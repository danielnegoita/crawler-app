FROM php:8.0.15-fpm

ENV COMPOSER_MEMORY_LIMIT -1

RUN apt-get update && apt-get install -y \
    openssl \
    acl \
    git \
    unzip \
    zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

RUN apt-get update && apt-get install -y libzip-dev libicu-dev g++ libcurl4-gnutls-dev \
    && docker-php-ext-install pdo pdo_mysql curl zip intl bcmath

RUN apt-get update && apt-get install -y  libmcrypt-dev libmcrypt4 \
    && pecl install mcrypt-1.0.4 \
    && docker-php-ext-enable mcrypt

RUN apt-get update && apt-get install -y libmagickwand-dev imagemagick \
    && pecl install imagick \
    && docker-php-ext-enable imagick

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

WORKDIR /srv/app

RUN mkdir -p var/ var/cache var/log \
    && chown -R www-data var