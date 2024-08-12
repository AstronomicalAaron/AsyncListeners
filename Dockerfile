# Use the official PHP 8 image as the base
FROM php:8.2-apache

# Install necessary dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip

RUN docker-php-ext-install mysqli pdo pdo_mysql
#RUN docker-php-ext-enable xdebug

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ADD composer.json /var/www/html
ADD composer.lock /var/www/html

WORKDIR /var/www/html/

RUN composer install
