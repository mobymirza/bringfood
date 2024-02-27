FROM php:8.2-fpm-alpine
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www/html
RUN composer -vvv --version
RUN docker-php-ext-install  \
pdo pdo_mysqlRUN docker-php-ext-install pdo pdo_mysql
