
##
## Application
##
FROM php:8-fpm-alpine as oauth

#COPY . /seatplus
#COPY --from=vendor /app/vendor/ /seatplus/vendor/
#COPY --from=frontend /app/public/js/ /seatplus/public/js/
#COPY --from=frontend /app/public/css/ /seatplus/public/css/
#COPY --from=frontend /app/mix-manifest.json /seatplus/mix-manifest.json

COPY startup.sh /root/startup.sh
RUN chmod +x /root/startup.sh

RUN apk add --no-cache \
    # Install OS level dependencies
    git zip unzip curl \
    libpng-dev libzip-dev libmcrypt-dev bzip2-dev icu-dev mariadb-client && \
    # Install PHP dependencies
    docker-php-ext-install pdo_mysql gd bz2 intl pcntl zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin \
    --filename=composer && hash -r

RUN apk add --update nodejs npm

#RUN chown -R www-data:www-data storage

VOLUME /var/www
WORKDIR /var/www

#RUN chown -R www-data:www-data storage

#
CMD ["php-fpm", "-F"]
#
ENTRYPOINT ["/bin/sh", "/root/startup.sh"]