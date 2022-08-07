FROM php:7.0-fpm
RUN docker-php-ext-install pdo_mysql \
&& curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/5.3.6.tar.gz \
&& tar xfz /tmp/redis.tar.gz \
&& rm -r /tmp/redis.tar.gz \
&& mkdir -p /usr/src/php/ext \
&& mv phpredis-5.3.6 /usr/src/php/ext/redis \
&& docker-php-ext-install redis