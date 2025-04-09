FROM php:8.4-fpm

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0"

RUN apt-get update && \
    apt-get install -y libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libpq-dev git unzip && \
    apt-get clean

RUN docker-php-ext-install opcache pdo pdo_pgsql zip

ADD ./.docker/php/opcache.ini "$PHP_INI_DIR/conf.d/opcache.ini"

WORKDIR /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN composer install --no-scripts --no-progress --prefer-dist

EXPOSE 9000

ENTRYPOINT ["php-fpm"]
