#!/bin/sh

# Ensure the port is set (Render provides this, but we default to 10000)
export PORT=${PORT:-10000}

echo "🚀 Starting application setup..."

# 1. Wait for database to be ready
if [ -n "$DB_HOST" ]; then
    echo "🔍 Checking database connection at $DB_HOST..."
    # A simple loop to wait for the database
    until nc -z -v -w30 $DB_HOST ${DB_PORT:-5432}; do
        echo "⏳ Waiting for database ($DB_HOST)..."
        sleep 2
    done
    echo "✅ Database is up and reachable."
fi

# 2. Optimization: Cache configuration, routes, and views
echo "📦 Caching configuration and routes..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Handle Migrations
echo "🏃 Running migrations..."
php artisan migrate --force --no-interaction || echo "⚠️ Migration failed or skipped. Continuing..."

# 4. Starting the Server
echo "🌐 Starting FrankenPHP on port $PORT..."
# FrankenPHP handles the application serving efficiently
exec frankenphp php-server --listen :$PORT
