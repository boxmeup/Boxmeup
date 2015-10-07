FROM php:5.6-apache

COPY config/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY config/php/php.ini /usr/local/etc/php/

RUN docker-php-ext-install \
    pdo_mysql

COPY . /var/www/html/

RUN a2enmod rewrite

EXPOSE 80
