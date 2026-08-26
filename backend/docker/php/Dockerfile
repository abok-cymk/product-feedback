FROM php:8.4-fpm

WORKDIR /var/www

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libpq-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-install \
        pdo_pgsql \
        zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./

RUN composer install \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader

COPY . .

RUN chown -R www-data:www-data /var/www