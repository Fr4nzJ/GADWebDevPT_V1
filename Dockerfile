# Build stage
FROM php:8.2-fpm-alpine as builder

# Install system dependencies (including zlib-dev for GD)
RUN apk add --no-cache \
    build-base \
    postgresql-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zlib-dev \
    zip \
    unzip \
    git \
    curl \
    npm

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd pdo_pgsql bcmath
RUN docker-php-ext-enable ctype fileinfo mbstring

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --no-scripts --no-autoloader

# Copy application files
COPY . .

# Generate composer autoloader
RUN composer dump-autoload --optimize

# Set up PHP configuration for production
RUN echo "date.timezone=UTC" > /usr/local/etc/php/conf.d/timezone.ini && \
    echo "log_errors = On" >> /usr/local/etc/php/conf.d/timezone.ini && \
    echo "error_log = /dev/stderr" >> /usr/local/etc/php/conf.d/timezone.ini

# Install Node dependencies and build frontend assets
RUN npm ci && npm run build

# Runtime stage
FROM php:8.2-fpm-alpine

# Install minimal runtime dependencies
RUN apk add --no-cache \
    postgresql-libs \
    libpng \
    libjpeg-turbo \
    freetype \
    zlib \
    curl

# Copy already-compiled PHP extensions from builder
COPY --from=builder /usr/local/lib/php/extensions /usr/local/lib/php/extensions
COPY --from=builder /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d

# Set working directory
WORKDIR /app

# Copy application from builder stage
COPY --from=builder /app .

# Create storage directories and set permissions
RUN mkdir -p storage/logs bootstrap/cache
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache
RUN chmod -R 755 /app/storage /app/bootstrap/cache

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose port
EXPOSE 9000

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:9000/ || exit 1

# Set entrypoint
ENTRYPOINT ["docker-entrypoint.sh"]

# Start PHP-FPM
CMD ["php-fpm"]
