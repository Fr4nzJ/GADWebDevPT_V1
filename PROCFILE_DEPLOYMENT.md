# Procfile-Based Deployment Guide

This application is configured for deployment using a `Procfile`, which is supported by platforms like:
- **Heroku**
- **DigitalOcean App Platform**
- **Railway.app**
- **Render.com**
- **Dokku**

## Quick Start

### Understanding the Procfile

```procfile
web: vendor/bin/heroku-php-apache2 public/
release: php artisan migrate --force
```

- **web**: The main web server process using Apache with PHP
- **release**: Runs database migrations before each deployment

## Environment Configuration

### Production Environment Variables

Copy `.env.production` as your template and set these required variables:

```bash
# Application
APP_KEY=base64:your-generated-key-here
APP_URL=https://your-domain.com
APP_ENV=production
APP_DEBUG=false

# Database (PostgreSQL recommended for production)
DB_HOST=your-db-host
DB_PORT=5432
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-secure-password

# Mail Configuration
MAIL_HOST=your-mail-service
MAIL_PORT=587
MAIL_USERNAME=your-email@example.com
MAIL_PASSWORD=your-email-password
MAIL_FROM_ADDRESS=no-reply@yourdomain.com
```

## Deployment Steps

### 1. Heroku

```bash
# Install Heroku CLI
# https://devcenter.heroku.com/articles/heroku-cli

# Login to Heroku
heroku login

# Create a new app
heroku create your-app-name

# Add PostgreSQL add-on
heroku addons:create heroku-postgresql:standard-0

# Set environment variables
heroku config:set APP_KEY=base64:your-key
heroku config:set APP_URL=https://your-app-name.herokuapp.com
heroku config:set DB_HOST=your-db-host
# ... set other variables

# Deploy from Git
git push heroku main

# View logs
heroku logs --tail
```

### 2. Railway.app

```bash
# Install Railway CLI
# https://railway.app/docs/cli/install

# Login to Railway
railway login

# Initialize project
railway init

# Add PostgreSQL service
railway add --plugin postgresql

# Set environment variables in Railway dashboard or via CLI
railway variables set APP_KEY=base64:your-key

# Deploy
git push

# View logs
railway logs
```

### 3. Render.com

```bash
# Push to GitHub (Render deploys from Git)
git push origin main

# In Render Dashboard:
# 1. Create new Web Service
# 2. Connect GitHub repository
# 3. Set Runtime: PHP 8.2
# 4. Add PostgreSQL database
# 5. Configure environment variables
# 6. Deploy
```

### 4. DigitalOcean App Platform

```bash
# In DigitalOcean Console:
# 1. Create App
# 2. Connect GitHub repository
# 3. Configure as PHP (from Procfile)
# 4. Add managed database (PostgreSQL)
# 5. Set environment variables
# 6. Deploy
```

## Build Process

The `build.sh` script automatically runs and:

1. Installs PHP dependencies with Composer
2. Installs Node.js dependencies
3. Builds frontend assets with Vite
4. Caches Laravel configuration, routes, and views
5. Creates storage symlink

The `Procfile` `release` process runs migrations:

```bash
php artisan migrate --force
```

## Post-Deployment

After deployment, you may need to seed the database (one-time):

```bash
# For Heroku
heroku run "php artisan db:seed"

# For Railway
railway run "php artisan db:seed"

# For Render - via SSH or console
```

## Troubleshooting

### "No web process running"
Ensure `Procfile` is in the root directory and committed to Git.

### Migration failures
Check database credentials and ensure database exists with proper permissions.

### Asset loading fails
Verify `APP_URL` is set correctly and matches your deployment domain.

### Mail not sending
Check `MAIL_HOST`, `MAIL_PORT`, and credentials are correct.

## Local Development

For local development, use the included scripts:

```bash
# Install dependencies
composer install
npm install

# Build assets
npm run build

# Start development server
php artisan serve

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed
```

## Production Considerations

1. **Set `APP_DEBUG=false`** in production
2. **Use strong password** for database
3. **Enable HTTPS** on deployment platform
4. **Set up automated backups** for database
5. **Monitor application logs** regularly
6. **Keep dependencies updated** with security patches

## Support

For platform-specific help:
- **Heroku**: [devcenter.heroku.com](https://devcenter.heroku.com)
- **Railway**: [railway.app/docs](https://railway.app/docs)
- **Render**: [render.com/docs](https://render.com/docs)
- **DigitalOcean**: [docs.digitalocean.com](https://docs.digitalocean.com)
