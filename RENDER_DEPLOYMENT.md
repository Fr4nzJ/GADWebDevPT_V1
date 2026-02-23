# Render.com Deployment Guide

## Prerequisites

Before deploying to Render.com, ensure you have:

1. A Render.com account (free tier available)
2. Your project pushed to GitHub
3. Composer and npm installed locally

## Deployment Steps

### 1. Connect GitHub Repository

1. Go to [render.com](https://render.com/)
2. Click "New +" and select "Web Service"
3. Select "Build and deploy from a Git repository"
4. Connect your GitHub account and select this repository
5. Click "Next"

### 2. Configure Web Service

Fill in the following details:

- **Name**: `gadwebdev` (or your preferred name)
- **Region**: `Singapore` (or your preferred region)
- **Branch**: `main`
- **Runtime**: `PHP`
- **PHP Version**: `8.2`
- **Build Command**: (Already configured in render.yaml)
- **Start Command**: (Already configured in render.yaml)
- **Plan**: Select your preferred plan (Free tier available)

### 3. Add Environment Variables

Click "Add Environment Variable" and set:

```
APP_ENV=production
APP_DEBUG=false
APP_KEY=[Auto-generated during build]
APP_URL=https://your-app.onrender.com
DB_CONNECTION=pgsql
DB_HOST=[Auto-populated by Render]
DB_PORT=5432
DB_DATABASE=gadwebdev
DB_USERNAME=postgres
DB_PASSWORD=[Auto-populated by Render]
LOG_CHANNEL=stderr
CACHE_DRIVER=database
SESSION_DRIVER=database
QUEUE_DRIVER=database
```

### 4. Connect Database

1. Create a PostgreSQL database service
2. Render will automatically set DB_* environment variables
3. The database connection will be available during build

### 5. Deploy

1. Click "Create Web Service"
2. Render will automatically:
   - Install Composer dependencies
   - Install NPM packages
   - Build Vite assets
   - Generate APP_KEY (if not set)
   - Run migrations
   - Seed the database
   - Cache configuration

### 6. Post-Deployment

Once deployed:

1. Check the deployment logs
2. Visit your app at `https://your-app.onrender.com`
3. Default admin credentials (if seeded):
   - Email: admin@example.com
   - Password: password (as per database seeders)

## Files Modified for Deployment

- **render.yaml** - Main deployment configuration
- **Procfile** - Process definition
- **package.json** - Updated with build scripts
- **.env.example** - Updated for PostgreSQL
- **build.sh** - Build script
- **start.sh** - Start script
- **.renderignore** - Files to exclude from deployment

## Database Migrations

Migrations run automatically during the build process. If you need to:

1. **Restart the service**: Go to Dashboard → Web Service → Settings → Restart
2. **Run migrations again**: Use Render's Shell feature in the Dashboard
3. **Access PostgreSQL**: Use the database connection string in Render Dashboard

## Troubleshooting

### Build Fails
- Check build logs in Render Dashboard
- Ensure all dependencies are in composer.json and package.json
- Verify .env.example has correct database configuration

### Database Connection Issues
- Verify DB_HOST and credentials match Render-provided values
- Check if migrations are running successfully
- Use Render's database browser to verify tables exist

### Asset/CSS Not Loading
- Run `npm run build` locally to test
- Check if assets are properly cached
- Clear browser cache and Render cache

## Tips

1. Set up CI/CD by connecting GitHub - deploys automatically on push
2. Use Environment Groups for managing secrets
3. Monitor deployment with Render's built-in logging
4. Enable auto-deploy for continuous integration
5. Set up notifications for deployment status

## Database Backups

PostgreSQL on Render automatically backs up data. To restore:

1. Access Render Dashboard
2. Go to Database → Backups
3. Select and restore desired backup

## Performance Tips

1. Use the paid plan for better performance and uptime
2. Enable Render's Disk persistence if needed
3. Monitor metrics in Render Dashboard
4. Consider upgrading storage/memory as needed

## Additional Resources

- [Render Documentation](https://render.com/docs)
- [Laravel Documentation](https://laravel.com/docs)
- [PostgreSQL Documentation](https://www.postgresql.org/docs)
