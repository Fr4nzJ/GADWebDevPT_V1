#!/bin/bash

# Build script for Procfile-based deployment
# This script runs during the build phase (buildpack phase)
# Only includes dependency installation and asset building
# Caching commands are moved to start.sh (runtime phase)

set -e

echo "=== Installing Composer Dependencies ==="
composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader

echo "=== Installing NPM Dependencies ==="
npm install --production

echo "=== Building Frontend Assets ==="
npm run build

echo "=== Creating Storage Directories ==="
mkdir -p storage/framework/{sessions,views,cache,testing} storage/logs bootstrap/cache
chmod -R a+rw storage

echo "=== Build Phase Complete ==="
