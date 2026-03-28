FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    nginx \
    nodejs \
    npm \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql

# composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Laravelコードコピー
COPY ./src .

# nginx設定コピー
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# composer install
RUN composer install --no-dev --optimize-autoloader

# vite build
RUN npm install
RUN npm run build

# Laravel権限
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 80

CMD php artisan key:generate --force \
    && php artisan config:cache \
    && php artisan migrate --force \
    && service nginx start \
    && php-fpm