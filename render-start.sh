#!/bin/sh

# Ensure the port is set
export PORT=${PORT:-10000}

echo "🚀 Starting Production Boot Sequence..."

# 1. Enforce Production Safety
export APP_DEBUG=false
export APP_ENV=production

# 2. Extract DB details from DATABASE_URL if available for health check
if [ -n "$DATABASE_URL" ]; then
    echo "🔍 Analyzing database connection..."
    # Robust extraction: remove protocol, then get part before path, then get host/port
    # Example: postgresql://user:pass@host:port/db
    DB_CLEAN=$(echo "$DATABASE_URL" | sed -e 's/.*@//' -e 's/\/.*//')
    DB_HOST=$(echo "$DB_CLEAN" | cut -d: -f1)
    DB_PORT=$(echo "$DB_CLEAN" | cut -d: -f2)
    DB_PORT=${DB_PORT:-5432}
    
    if [ -n "$DB_HOST" ]; then
        echo "⏳ Waiting for database ($DB_HOST:$DB_PORT)..."
        until nc -z -v -w30 "$DB_HOST" "$DB_PORT"; do
            echo "⏳ Still waiting for database..."
            sleep 2
        done
        echo "✅ Database reachable!"
    fi
fi

# 3. Optimize Laravel for Production
echo "🧹 Optimizing configuration and routes..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 4. Handle Migrations
echo "🏃 Running migrations..."
php artisan migrate --force --no-interaction || echo "⚠️ Migration issue detected. Continuing startup..."

# 5. Start FrankenPHP (Production App Server)
echo "🌐 Starting FrankenPHP on port $PORT..."
# exec ensures the server receives termination signals from Render
exec frankenphp php-server --listen :$PORT
