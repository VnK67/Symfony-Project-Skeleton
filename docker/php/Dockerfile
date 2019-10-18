FROM php:7.3

RUN apt-get update && apt-get install -y \
    vim \
    git \
    zip \
    libicu-dev \
    zsh \
    libzip-dev \
    g++ \
    libpng-dev libjpeg-dev libfreetype6-dev

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer global require hirak/prestissimo

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install intl
RUN docker-php-ext-install zip
RUN docker-php-ext-install gd

ENV COMPOSER_ALLOW_SUPERUSER = 1
COPY php.ini $PHP_INI_DIR/conf.d/php.ini

WORKDIR /var/www/html
CMD bin/console server:run *:8000