FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git 

RUN docker-php-ext-install pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY budgie.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/projet-annuel/Budgie

COPY . .

RUN composer install

RUN a2enmod rewrite

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80