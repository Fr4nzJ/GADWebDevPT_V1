# Railway.com Deployment Guide

## Overview

Railway is a modern cloud platform that simplifies deployment. This guide walks you through deploying your GAD Website Laravel application to Railway.com.

## Prerequisites

- Railway.com account (free tier available at https://railway.app)
- GitHub account with your repository
- Project code pushed to GitHub

## Step 1: Create Railway Account & Project

### 1.1 Sign up for Railway.com
1. Visit https://railway.app
2. Click "Start Free" or "Sign Up"
3. Choose GitHub authentication (recommended)
4. Authorize Railway to access your GitHub account

### 1.2 Create a New Project
1. In Railway Dashboard, click "New Project"
2. Select "Deploy from GitHub repo"
3. Search for your repository: `GADWebDevPT_V1`
4. Click "Deploy Now"

Railway will automatically detect your Laravel application!

## Step 2: Configure PostgreSQL Database

### 2.1 Add PostgreSQL Service
1. In your Railway project dashboard
2. Click "Add Services"
3. Select "Database"
4. Click "PostgreSQL"
5. Railway creates a PostgreSQL instance automatically

### 2.2 Configure Database Variables
Railway automatically creates these environment variables:
- `DATABASE_URL` (auto-generated connection string)
- `PGHOST` (database host)
- `PGPORT` (database port - usually 5432)
- `PGDATABASE` (database name)
- `PGUSER` (username)
- `PGPASSWORD` (password)

Laravel will use these automatically with the connection string format.

## Step 3: Set Environment Variables

### 3.1 Access Variables in Railway Dashboard
1. Click on your Web Service (the one with PHP app)
2. Go to "Variables" tab
3. Add variables from `.env.railway`:

**Required Variables:**
```
APP_ENV=production
APP_DEBUG=false
APP_NAME=GAD Website
```

### 3.2 Generate & Set APP_KEY
Run this locally and copy the output:
```bash
php artisan key:generate --show --no-interaction
```

In Railway Variables, add:
```
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
```

### 3.3 Set Application URL
1. Wait for deployment to complete (see next step)
2. Railway generates a domain like: `gadwebdev-production.railway.app`
3. Add to Variables:
```
APP_URL=https://gadwebdev-production.railway.app
```

### 3.4 Optional: Email Configuration
If using email service:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
```

### 3.5 Session & Cache Configuration
```
SESSION_DRIVER=database
CACHE_DRIVER=database
QUEUE_CONNECTION=database
LOG_CHANNEL=stderr
```

## Step 4: Configure Build & Deploy

### 4.1 Build Command
Railway will auto-detect your Dockerfile. If you want custom build:

1. Go to Web Service → "Settings" → "Build" section
2. Set Build Command:
```bash
composer install --no-dev --optimize-autoloader && npm ci && npm run build && php artisan config:cache && php artisan route:cache
```

### 4.2 Start Command
Set Start Command:
```bash
php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

Or use Procfile (Railway auto-reads this):
```
web: php artisan serve --host=0.0.0.0 --port=$PORT
release: php artisan migrate --force
```

## Step 5: First Deployment

### 5.1 Trigger Deployment
1. Push code to GitHub:
```bash
git push origin main
```

2. Railway automatically triggers build and deployment
3. Monitor progress in "Deployments" tab

### 5.2 View Deployment Status
- **Building**: Composer, npm packages installing
- **Deploying**: Application starting
- **Success**: Green checkmark, app running
- **Failed**: Red X, check logs for errors

### 5.3 View Application
Once deployed:
- Click "Deployments" → successful deployment
- Click "View Logs" to see application output
- Copy your Railway domain URL
- Access: `https://your-app.railway.app`

## Step 6: Post-Deployment Tasks

### 6.1 Run Migrations
Option 1: Automatic (if using release command in Procfile)
```
release: php artisan migrate --force
```

Option 2: Manual via SSH
1. In Railway, go to Web Service
2. Click "Terminal" tab
3. Run:
```bash
php artisan migrate --force
php artisan db:seed --force  # Optional: seed demo data
```

### 6.2 Test Application
1. Visit your Railway domain
2. Check admin login works
3. Verify database connection (view programs, reports)
4. Test form submissions

### 6.3 View Logs
```bash
# Real-time logs in Railway dashboard
# Deployments → Your deployment → View Logs

# Or via Railway CLI
railway logs -f
```

## Step 7: Custom Domain (Optional)

### 7.1 Connect Your Domain
1. In Railway Project Settings
2. Go to "Custom Domain"
3. Add your domain: `gadwebdev.example.com`
4. Update DNS records with Railway's instructions:
   ```
   CNAME: railway-provided-domain
   ```
5. Wait 24-48 hours for DNS propagation

### 7.2 SSL/TLS
Railway automatically provides free SSL certificates for all domains!

## Updating Your Application

### 8.1 Push Updates
```bash
# Make changes locally
git add .
git commit -m "Update features"
git push origin main
```

### 8.2 Automatic Deployment
Railway automatically redeploys when code is pushed to GitHub.

### 8.3 Monitor Deployment
1. Go to "Deployments" tab
2. Latest deployment shows building status
3. Once green, new code is live

## Rollback to Previous Deployment

If something goes wrong:

1. Go to "Deployments" tab
2. Find the working deployment
3. Click "Rollback"
4. Previous version is live within seconds

## Environmental Variables Reference

### Required
```
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:...
APP_URL=https://your-domain.com
LOG_CHANNEL=stderr
```

### Database (Auto-configured)
```
DB_CONNECTION=pgsql
DB_HOST=${PGHOST}
DB_PORT=${PGPORT}
DB_DATABASE=${PGDATABASE}
DB_USERNAME=${PGUSER}
DB_PASSWORD=${PGPASSWORD}
```

### Optional
```
CACHE_DRIVER=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database
MAIL_MAILER=smtp
MAIL_HOST=...
MAIL_FROM_ADDRESS=...
```

## Troubleshooting

### Application won't start

#### Check Logs
1. Go to Deployments → Latest deployment
2. Click "View Logs"
3. Look for error messages

#### Common issues:
- **Missing APP_KEY**: Set in Variables, must start with `base64:`
- **Database connection failed**: Check PostgreSQL service is added
- **File permissions**: Laravel storage needs write permissions
- **Out of memory**: Restart or upgrade plan

#### Solution:
```bash
# Via Railway Terminal
php artisan tinker
# Check database connection
DB::connection()->select('SELECT 1')
```

### Build fails

**Check build logs:**
1. Deployments → Failed deployment → "Build Logs"
2. Look for error messages
3. Common fixes:
   - Ensure `composer.json` exists
   - Check `package.json` syntax
   - Verify PHP extensions in Dockerfile

### Application crashes after deploy

Check startup command:
1. Project Settings → Build & Deploy
2. Verify start command runs without errors
3. Check environment variables are set

## Performance Optimization

### 1. Enable Caching
```
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
(Done automatically in railway-build.sh)

### 2. Database Optimization
Create indexes on frequently queried columns:
```php
php artisan tinker
// Create index
DB::statement('CREATE INDEX idx_column ON table(column);')
```

### 3. Upgrade Plan if Needed
- Free tier: 100 hours/month shared resources
- Pay-as-you-go: More stable, better performance
- Check usage in Settings → Billing

## Monitoring & Maintenance

### View Usage
1. Project Settings → "Billing"
2. See compute hours used
3. View CPU, memory, network usage

### Set Up Alerts (Optional)
1. Project Settings → "Alerts"
2. Create alert for high resource usage
3. Get email notifications

### Regular Maintenance
```bash
# Clear expired sessions (weekly)
php artisan session:table
php artisan migrate

# Database backups (Railway auto-backs up)
# View in: Services → PostgreSQL → Backups

# Check health
php artisan health:check
```

## Scaling

### Vertical Scaling (More resources)
1. Click Web Service
2. "Instance Size"
3. Select larger plan
4. Application restarts automatically

### Horizontal Scaling (Multiple instances)
1. Railway charges per instance
2. Good for high traffic
3. Set in Project Settings

## CI/CD Integration

### Automatic Deployments
Railway deploys automatically on GitHub push if:
1. GitHub repo connected ✓
2. Deployment trigger set to "Main branch"
3. Build succeeds

### Manual Deployment
```bash
# Using Railway CLI
railway deploy
```

## Backup & Recovery

### PostgreSQL Backups
1. Services → PostgreSQL → "Backups"
2. View auto backups (daily, weekly, monthly)
3. Click backup to restore

### Application Data Backup
1. Production storage files in `/storage`
2. Add backup to project notes
3. Export database via pgAdmin

## Cost Estimation (Railway.com)

- **Free tier**: $5 credit/month (great for testing)
- **Typical small app**: $5-20/month
  - Web server: ~$5 (24/7)
  - PostgreSQL: ~$5-15 (depending on usage)
- **Pay as you go**: You pay for what you use

## Security Best Practices

1. ✅ Keep `.env` file secure (never commit)
2. ✅ Use strong APP_KEY (generated by framework)
3. ✅ Enable HTTPS (automatic via Railway)
4. ✅ Regularly update dependencies:
   ```bash
   composer update
   npm update
   ```
5. ✅ Monitor logs for suspicious activity
6. ✅ Keep session lifetime reasonable
7. ✅ Use environment variables for secrets

## Quick Reference Commands

```bash
# Login to Railway
railway login

# Link local project to Railway
railway link

# Deploy manually
railway deploy

# View logs
railway logs -f

# Connect to database
railway connect --postgres

# Open dashboard
railway open

# See environment variables
railway variables

# Run artisan command
railway shell php artisan migrate
```

## Getting Help

- **Railway Docs**: https://docs.railway.app
- **Railway Community**: https://discord.gg/railway
- **Laravel Docs**: https://laravel.com/docs
- **Project Issues**: https://github.com/Fr4nzJ/GADWebDevPT_V1/issues

## Next Steps

1. ✅ Create Railway account
2. ✅ Connect GitHub repository
3. ✅ Add PostgreSQL database
4. ✅ Set environment variables
5. ✅ Trigger first deployment
6. ✅ Run migrations
7. ✅ Test application
8. ✅ Set up custom domain (optional)

---

**Your application is now running on Railway.com!** 🚀

For questions about Railway.com features, see [RAILWAY_CHECKLIST.md](./RAILWAY_CHECKLIST.md).
