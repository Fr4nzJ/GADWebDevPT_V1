#!/bin/bash

# Start script for Procfile-based deployment
# This script runs at runtime (after environment variables are loaded)
# Performs all optimization and caching before starting the web server

set -e

echo "=== Starting Application ==="
echo "=== Clearing previous caches ==="
php artisan optimize:clear || true

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
echo "=== Starting Apache with PHP ==="

# Execute the main web server process
exec vendor/bin/heroku-php-apache2 public/
