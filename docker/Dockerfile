FROM registry.gitlab.com/hoikientruc/bat_dong_san:base

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
    
COPY . .

# build FE
RUN npm run prod

# override config
COPY docker/conf/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/conf/apache2.conf /etc/apache2/apache2.conf
COPY docker/shell/start.sh /usr/local/bin/start
COPY docker/conf/php.ini /usr/local/etc/php/conf.d/php.ini

# set permission storage folder
RUN chmod 775 $WORKDIR/storage \
    && chmod 775 $WORKDIR/storage/logs \
    && chmod 775 $WORKDIR/storage/framework/sessions \
    && chmod 775 $WORKDIR/storage/framework/views

RUN chown -R www-data:www-data $WORKDIR \
    && chmod u+x /usr/local/bin/start \
    && a2enmod rewrite

CMD ["/usr/local/bin/start"]
