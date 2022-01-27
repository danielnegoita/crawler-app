FROM php:8.0.15-fpm

ENV COMPOSER_MEMORY_LIMIT -1

RUN apt-get update && apt-get install -y \
    openssl \
    acl \
    git \
    unzip \
    zip \
    cron

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

# Cron
COPY ./cron/crontab /etc/cron.d/crawler-cron
COPY ./cron/script.sh /srv/app/bin/script.sh

RUN chmod +x /srv/app/bin/script.sh
RUN chmod 0644 /etc/cron.d/crawler-cron

RUN touch /var/log/cron.log

WORKDIR /srv/app

# Run crom the command on container startup
CMD cron && tail -f /var/log/cron.log