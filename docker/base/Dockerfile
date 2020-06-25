FROM php:7.3.4-apache-stretch

# update os
RUN apt-get update \
    && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev

# setup before install nodejs
RUN curl -sL https://deb.nodesource.com/setup_11.x | bash -

# install nodejs
RUN apt-get install -y nodejs

RUN docker-php-ext-configure pdo_mysql \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-configure opcache \
    && docker-php-ext-install opcache \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# install php-redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# install GD and mcrypt
RUN apt-get install -y \
    webp \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    && pecl install mcrypt-1.0.2 \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# cached dependencies
ENV WORKDIR /var/www/html

WORKDIR $WORKDIR

# install BE libs
COPY composer.* $WORKDIR/
COPY database $WORKDIR/database

RUN chmod 775 $WORKDIR/composer.phar \
    && $WORKDIR/composer.phar install --no-dev --no-scripts \
    && rm $WORKDIR/composer.phar

# install FE libs
COPY package.* $WORKDIR/
RUN npm install