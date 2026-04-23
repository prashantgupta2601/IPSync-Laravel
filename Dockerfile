# --- Stage 1: Build Frontend Assets (Vite) ---
FROM node:20-alpine AS assets-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Stage 2: Production PHP Runtime ---
FROM dunglas/frankenphp:1.4-php8.2-alpine

# Enforce production environment
ENV APP_ENV=production \
    APP_DEBUG=false \
    COMPOSER_ALLOW_SUPERUSER=1 \
    NODE_ENV=production

# Install system dependencies and build tools
RUN apk add --no-cache \
    bash \
    git \
    unzip \
    libzip-dev \
    postgresql-dev \
    libpq-dev \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    $PHPIZE_DEPS

# Install required PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    zip \
    pdo \
    pdo_pgsql \
    intl \
    mbstring \
    bcmath \
    opcache \
    exif \
    fileinfo \
    gd \
    pcntl \
    posix

# Install Redis extension via PECL
RUN pecl install redis && docker-php-ext-enable redis

# OPcache Production Tuning
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

# Pull official composer binary
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy application source
COPY . .

# Copy compiled assets from Stage 1
COPY --from=assets-builder /app/public/build ./public/build

# Install dependencies and optimize autoloader
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

# Secure permissions for internal directories
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Prepare startup orchestration
RUN chmod +x render-start.sh

# Render standard port exposure
EXPOSE 10000

# Execute startup script
CMD ["./render-start.sh"]