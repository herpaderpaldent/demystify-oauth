FROM php:8-alpine

RUN apk add --no-cache \
    # Install OS level dependencies
    git zip unzip curl \
    libpng-dev libzip-dev libmcrypt-dev bzip2-dev icu-dev mariadb-client && \
    # Install PHP dependencies
    docker-php-ext-install pdo_mysql gd bz2 intl pcntl zip

VOLUME /var/www
WORKDIR /var/www

COPY startup.sh /root/startup.sh
RUN chmod +x /root/startup.sh

ENTRYPOINT ["/bin/sh", "/root/startup.sh"]