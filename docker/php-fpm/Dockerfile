FROM php:7.0.24-fpm


RUN apt-get update && apt-get install -y libmcrypt-dev mysql-client git   \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin/ --filename=composer \
    && docker-php-ext-install mcrypt pdo_mysql \
    && docker-php-ext-configure gd \
    && docker-php-ext-install gd

WORKDIR /var/www

RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www
