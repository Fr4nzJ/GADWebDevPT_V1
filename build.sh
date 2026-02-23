#!/bin/bash

# Build script for Procfile-based deployment
# This script runs before the application starts

set -e

echo "=== Installing Composer Dependencies ==="
composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader

echo "=== Installing NPM Dependencies ==="
npm install --production

echo "=== Building Frontend Assets ==="
npm run build

echo "=== Generating APP_KEY (if not set) ==="
php artisan key:generate --force || true

echo "=== Caching Configuration ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Creating Storage Symlink ==="
php artisan storage:link || true

echo "=== Build Complete ==="

echo "=== Build Complete ==="
