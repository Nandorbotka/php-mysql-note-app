FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY ./public /var/www/html
COPY ./config /var/www/config
