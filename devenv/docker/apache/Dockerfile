FROM php:7.3.4-apache

RUN apt-get update

RUN apt-get install libicu-dev git -y

RUN apt-get install libpng-dev libzip-dev -y

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable apache modules
RUN a2enmod rewrite headers

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install intl
RUN apt-get install libjpeg-dev -y
RUN apt-get install libfreetype6-dev -y
RUN apt-get install libpng-dev -y
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install exif
RUN docker-php-ext-install zip

ADD https://nodejs.org/dist/v12.16.3/node-v12.16.3-linux-x64.tar.xz /tmp
RUN cd /tmp && tar xf node-v12.16.3-linux-x64.tar.xz && mv node-v12.16.3-linux-x64 /opt/nodejs
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd

RUN apt-get install -y libmcrypt-dev && pecl install mcrypt-1.0.3 && docker-php-ext-enable mcrypt

ENV PATH $PATH:/opt/nodejs/bin

# Copy vhost config
RUN rm -rf /etc/apache2/sites-enabled/*
COPY ./apache/vhost.conf /etc/apache2/sites-enabled/batdongsan.conf
