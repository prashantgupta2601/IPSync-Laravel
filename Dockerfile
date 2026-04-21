# --- Stage 1: Build Frontend Assets ---
FROM node:20-alpine AS assets-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Stage 2: Production PHP Environment ---
FROM dunglas/frankenphp:1.4-php8.2-alpine

# Set environment variables
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    APP_ENV=production \
    APP_DEBUG=false

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    bash \
    git \
    unzip \
    libzip-dev \
    postgresql-dev \
    libpq-dev \
    icu-dev \
    libxml2-dev

RUN docker-php-ext-install \
    zip \
    pdo \
    pdo_pgsql \
    intl \
    bcmath \
    opcache

# Copy composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application files
COPY . .
# Copy built assets from Stage 1
COPY --from=assets-builder /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Setup storage and cache permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Prepare the startup script
RUN chmod +x render-start.sh

# Expose the Render port
EXPOSE 10000

# Start command
CMD ["./render-start.sh"]