FROM php:7.4-fpm-alpine

RUN apt update -y && apt upgrade -y
RUN docker-php-ext-install nd_mysqli pdo pdo_mysql && docker-php-ext-enable nd_mysqli

WORKDIR /usr/src/myapp 

CMD ['php-fpm']