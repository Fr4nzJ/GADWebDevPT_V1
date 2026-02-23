# Render.com Deployment Checklist

## Pre-Deployment

- [ ] All code committed to GitHub
- [ ] `.env.example` updated with correct database config
- [ ] `composer.json` contains all required packages
- [ ] `package.json` contains all required dependencies
- [ ] Local environment tested and working
- [ ] Database migrations tested locally
- [ ] Assets build successfully (`npm run build`)

## Configuration Files

- [x] `render.yaml` - Deployment configuration created
- [x] `Procfile` - Process definition created
- [x] `.env.example` - Updated for PostgreSQL
- [x] `build.sh` - Build script created
- [x] `start.sh` - Start script created
- [x] `.renderignore` - Ignore file created
- [x] `RENDER_DEPLOYMENT.md` - Documentation created

## Render.com Setup

- [ ] Render.com account created
- [ ] GitHub repository connected to Render
- [ ] Web Service created with correct settings
- [ ] PostgreSQL database added
- [ ] Environment variables configured:
  - [ ] APP_ENV=production
  - [ ] APP_DEBUG=false
  - [ ] APP_URL set correctly
  - [ ] LOG_CHANNEL=stderr
  - [ ] CACHE_DRIVER=database
  - [ ] SESSION_DRIVER=database
  - [ ] QUEUE_DRIVER=database
  - [ ] DB_* variables auto-populated

## Initial Deployment

- [ ] First deployment triggered
- [ ] Build completes without errors
- [ ] Migrations run successfully
- [ ] Database seeds applied
- [ ] Application accessible at provided URL

## Post-Deployment Testing

- [ ] Homepage loads correctly
- [ ] Login functionality works
- [ ] Admin dashboard accessible
- [ ] Database queries working
- [ ] Assets (CSS/JS) loading properly
- [ ] File uploads working (if applicable)
- [ ] Email functionality tested

## Monitoring

- [ ] Set up deployment notifications
- [ ] Enable auto-deploy on GitHub push
- [ ] Monitor application logs regularly
- [ ] Check database size and backups
- [ ] Monitor performance metrics

## Backup & Recovery

- [ ] Database backup configured
- [ ] Backup frequency verified
- [ ] Recovery procedure tested
- [ ] Documentation updated

## Security

- [ ] APP_DEBUG set to false
- [ ] APP_KEY generated and secure
- [ ] Database credentials from Render (auto-generated)
- [ ] HTTPS enabled on domain
- [ ] Security headers configured

## Notes

Use this space to track deployment details:

```
Date Deployed: _______________
URL: _______________
Render Region: _______________
Database Name: _______________
Issues Encountered: _______________
Resolution: _______________
```

## Troubleshooting Reference

If deployment fails:
1. Check Render.com Dashboard logs
2. Verify environment variables
3. Test locally with `php artisan serve`
4. Check `.env.example` format
5. Ensure all migrations are properly defined
6. Verify composer.json and package.json syntax
