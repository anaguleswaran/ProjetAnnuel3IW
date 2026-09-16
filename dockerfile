FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    nodejs \
    npm

RUN docker-php-ext-install pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY budgie.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/projet-annuel/Budgie

COPY . .

RUN composer install

RUN npm install && npm run build

RUN a2enmod rewrite
# RUN a2enmod ssl rewrite

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80