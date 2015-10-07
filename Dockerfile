FROM php:5.6-apache

COPY config/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY config/php/php.ini /usr/local/etc/php/

RUN docker-php-ext-install pdo_mysql \
    && apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng12-dev \
        zlib1g-dev \
        git \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip

COPY . /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php && \
    php composer.phar install

RUN apt-get remove --purge -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng12-dev \
    zlib1g-dev \
    git

RUN a2enmod rewrite

EXPOSE 80
