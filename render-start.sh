#!/bin/sh

# Ensure the port is set
export PORT=${PORT:-10000}

echo "🚀 Starting Production Boot Sequence..."

# 1. Enforce Production Safety
export APP_DEBUG=false
export APP_ENV=production

# 2. Database Health Check (with Timeout & Fallback)
if [ -n "$DATABASE_URL" ]; then
    echo "🔍 Checking database connectivity..."
    # PHP-based parser and health check to avoid netcat/sed fragility
    php -r "
        \$url = parse_url(getenv('DATABASE_URL'));
        if (!\$url) {
            echo \"❌ Invalid DATABASE_URL format\n\";
            exit(0); 
        }
        
        \$host = \$url['host'];
        \$port = \$url['port'] ?? 5432;
        \$max_attempts = 15;
        \$timeout = 2;

        echo \"⏳ Waiting for database (\$host:\$port)...\n\";
        
        for (\$i = 1; \$i <= \$max_attempts; \$i++) {
            \$fp = @fsockopen(\$host, \$port, \$errno, \$errstr, \$timeout);
            if (\$fp) {
                fclose(\$fp);
                echo \"✅ Database is reachable!\n\";
                exit(0);
            }
            echo \"⏳ Attempt \$i/\$max_attempts failed. Retrying in 2s...\n\";
            sleep(2);
        }
        
        echo \"⚠️ Database health check timed out after 30s. Falling back to application boot...\n\";
        exit(0);
    "
fi

# 3. Optimize Laravel for Production
echo "🧹 Optimizing Laravel configuration and routes..."
# Use optimize:clear to ensure fresh cache then cache everything
php artisan optimize

# 4. Handle Migrations
echo "🏃 Running migrations..."
php artisan migrate --force --no-interaction || echo "⚠️ Migration issue detected. Continuing startup..."

# 5. Determine Execution Mode (Web vs Worker)
if [ "$RUN_MODE" = "worker" ]; then
    echo "👷 Starting Laravel Queue Worker..."
    exec php artisan queue:work --verbose --tries=3 --timeout=90
else
    echo "🌐 Starting FrankenPHP on port $PORT..."
    # exec ensures the server receives termination signals correctly
    exec frankenphp php-server --listen :$PORT
fi
