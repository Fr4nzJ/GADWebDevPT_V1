# Build stage
FROM php:8.2-fpm-alpine as builder

# Install system dependencies
RUN apk add --no-cache \
    build-base \
    postgresql-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    unzip \
    git \
    curl \
    npm

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) \
    gd \
    pdo \
    pdo_pgsql \
    bcmath \
    ctype \
    fileinfo \
    json \
    mbstring \
    openssl \
    tokenizer

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

# Install Node dependencies and build frontend assets
RUN npm ci && npm run build

# Runtime stage
FROM php:8.2-fpm-alpine

# Install runtime dependencies only
RUN apk add --no-cache \
    postgresql-libs \
    libpng \
    libjpeg-turbo \
    freetype \
    curl

# Install PHP extensions (runtime)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) \
    gd \
    pdo \
    pdo_pgsql \
    bcmath \
    ctype \
    fileinfo \
    json \
    mbstring \
    openssl \
    tokenizer

# Set working directory
WORKDIR /app

# Copy application from builder stage
COPY --from=builder /app .

# Create storage directories and set permissions
RUN mkdir -p storage/logs bootstrap/cache
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache
RUN chmod -R 755 /app/storage /app/bootstrap/cache

# Set up PHP configuration for production
RUN echo "date.timezone=UTC" > /usr/local/etc/php/conf.d/timezone.ini
RUN echo "log_errors = On" >> /usr/local/etc/php/conf.d/timezone.ini
RUN echo "error_log = /dev/stderr" >> /usr/local/etc/php/conf.d/timezone.ini

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
