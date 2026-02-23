#!/bin/bash

# Exit on error
set -e

echo "=== Installing Composer Dependencies ==="
composer install --no-interaction --no-dev --prefer-dist

echo "=== Installing NPM Dependencies ==="
npm install

echo "=== Building Assets ==="
npm run build

echo "=== Generating APP_KEY ==="
php artisan key:generate --force

echo "=== Running Migrations ==="
php artisan migrate --force

echo "=== Seeding Database ==="
php artisan db:seed --force

echo "=== Creating Storage Link ==="
php artisan storage:link

echo "=== Caching Configuration ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Build Complete ==="
