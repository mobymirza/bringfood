FROM php:8.2-fpm-alpine
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN docker-php-ext-install pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www/html
WORKDIR /var/www/html
RUN composer install --no-scripts
