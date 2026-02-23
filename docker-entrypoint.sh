#!/bin/sh
set -e

# Use .env.docker in Docker environment if .env doesn't exist
# This ensures Docker environment variables take precedence
if [ ! -f /app/.env ] && [ -f /app/.env.docker ]; then
    echo "Creating .env from .env.docker for Docker environment..."
    cp /app/.env.docker /app/.env
fi

# Wait for database to be ready (if DATABASE_HOST is set)
if [ ! -z "$DB_HOST" ] && [ ! -z "$DB_PORT" ]; then
    echo "Waiting for database at $DB_HOST:$DB_PORT..."
    while ! nc -z "$DB_HOST" "$DB_PORT"; do
        sleep 1
    done
    echo "Database is ready!"
fi

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

# Run migrations
if [ "$RUN_MIGRATIONS" != "false" ]; then
    echo "Running database migrations..."
    php artisan migrate --force
fi

# Run seeders if requested
if [ "$RUN_SEEDERS" = "true" ]; then
    echo "Running database seeders..."
    php artisan db:seed --force
fi

# Cache configuration
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Execute the main command
exec "$@"
