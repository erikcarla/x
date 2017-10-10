FROM php:7.0.24-fpm


RUN apt-get update && apt-get install -y libmcrypt-dev mysql-client git \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin/ --filename=composer \
    && docker-php-ext-install mcrypt pdo_mysql

WORKDIR /var/www
