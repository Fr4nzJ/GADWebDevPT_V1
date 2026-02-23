#!/bin/bash

# Start script for Procfile-based deployment
# This script runs at runtime (after environment variables are loaded)
# Performs all optimization and caching before starting the web server

set -e

echo "=== Starting Application ==="

# Check if database is configured before attempting operations
if [ ! -z "$DB_HOST" ] && [ "$DB_HOST" != "your-database-host" ]; then
    echo "=== Running database migrations ==="
    php artisan migrate --force || (echo "Migration completed or skipped" && true)
    
    echo "=== Clearing previous caches ==="
    php artisan optimize:clear || true
else
    echo "=== Skipping database operations (database not configured) ==="
fi

echo "=== Caching Configuration ==="
php artisan config:cache

echo "=== Caching Routes ==="
php artisan route:cache

echo "=== Caching Views ==="
php artisan view:cache

echo "=== Caching Events ==="
php artisan event:cache

echo "=== Creating Storage Symlink ==="
php artisan storage:link || true

echo "=== All optimizations complete ==="
echo "=== Starting PHP Development Server ==="

# Use PHP's built-in server (works with Railway)
# Listen on the PORT environment variable (Railway sets this)
exec php -S 0.0.0.0:${PORT:-8000} -t public/
