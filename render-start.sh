#!/bin/sh

# Ensure the port is set
export PORT=${PORT:-10000}

echo "🚀 Starting application setup..."

# 1. Extract DB details from DATABASE_URL if available
if [ -n "$DATABASE_URL" ]; then
    echo "🔍 Extracting database host for connectivity check..."
    # Simple extraction logic: host is between @ and : (or / if no port)
    DB_HOST=$(echo "$DATABASE_URL" | sed -e 's/.*@//' -e 's/:.*//' -e 's/\/.*//')
    DB_PORT=$(echo "$DATABASE_URL" | grep -o ':[0-9]*' | head -1 | sed 's/://')
    DB_PORT=${DB_PORT:-5432}
    
    if [ -n "$DB_HOST" ]; then
        echo "⏳ Waiting for database ($DB_HOST)..."
        until nc -z -v -w30 "$DB_HOST" "$DB_PORT"; do
            echo "⏳ Still waiting for database..."
            sleep 2
        done
        echo "✅ Database reachable!"
    fi
fi

# 2. Clear all Laravel caches to ensure fresh environment
echo "🧹 Clearing configuration and application cache..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 3. Handle Migrations
echo "🏃 Running migrations..."
php artisan migrate --force --no-interaction || echo "⚠️ Migration failed or skipped. Continuing..."

# 4. Starting the Server
echo "🌐 Starting Laravel on port $PORT..."
# Using artisan serve as requested
exec php artisan serve --host=0.0.0.0 --port=$PORT
