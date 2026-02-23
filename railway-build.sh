#!/bin/bash
set -e

echo "[Railway Build] Starting Laravel application build..."

# Composer install
echo "[Build] Installing PHP dependencies with Composer..."
if [ -f "composer.json" ]; then
    composer install --no-dev --optimize-autoloader --no-interaction --no-progress
else
    echo "[Build] composer.json not found, skipping composer install"
fi

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "[Build] Generating APP_KEY..."
    php artisan key:generate --force
fi

# NPM build (if needed)
echo "[Build] Building frontend assets..."
if [ -f "package.json" ]; then
    npm ci --prefer-offline --no-audit
    npm run build
else
    echo "[Build] package.json not found, skipping npm build"
fi

# Cache Laravel configuration
echo "[Build] Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "[Railway Build] Build completed successfully!"
