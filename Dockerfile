FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader

EXPOSE 10000

# ✅ SAFE START (no crash if migrate fails)
CMD php artisan migrate --force || true && php artisan serve --host=0.0.0.0 --port=10000