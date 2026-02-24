# 🚀 Railway Deployment Guide - PostgreSQL + Gmail API

## Overview

This guide covers deploying the CatSu GAD website to **Railway.app** with:
- ✅ PostgreSQL database (Railway-native)
- ✅ Gmail SMTP for email
- ✅ Automatic migrations on deployment
- ✅ Automatic cache optimization

---

## ⚙️ Prerequisites

1. **Railway Account**: https://railway.app
2. **GitHub Repository**: Your code must be in a GitHub repo (public or private)
3. **Gmail Account**: For email functionality
4. **Local PostgreSQL** (optional): For local testing before deployment

---

## 📋 Step 1: Set Up Gmail API Credentials

### Get Gmail App Password

Gmail now requires "App Passwords" instead of your regular password for third-party apps.

**Steps**:

1. Enable 2-Step Verification on your Gmail account
   - https://myaccount.google.com/security

2. Generate App Password
   - Go to: https://myaccount.google.com/apppasswords
   - Select "Mail" and "Windows Computer" (or your device)
   - Google generates a 16-character password
   - Copy this password - you'll need it for Railway

**Example App Password**: `abcd efgh ijkl mnop` (16 characters with spaces)

---

## 🛤️ Step 2: Configure Local Environment (Optional but Recommended)

Test locally with PostgreSQL before deploying to Railway.

### For Windows (Local PostgreSQL)

1. **Install PostgreSQL**
   - Download: https://www.postgresql.org/download/windows/
   - During install, remember the password for `postgres` user
   - Default port: 5432

2. **Update `.env` file** (already done):
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=gad_db
   DB_USERNAME=postgres
   DB_PASSWORD=your-postgres-password
   ```

3. **Update Gmail credentials in `.env`**:
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=abcd efgh ijkl mnop
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your-email@gmail.com
   ```

4. **Test locally**:
   ```bash
   php artisan migrate
   php artisan serve
   ```

---

## 🚂 Step 3: Deploy to Railway

### Method A: Using Railway CLI (Recommended)

```bash
# 1. Install Railway CLI
npm i -g @railway/cli

# 2. Login to Railway
railway login

# 3. Create new project (or link existing)
railway init

# 4. Follow prompts:
# - Choose "Laravel"
# - Choose "Create new PostgreSQL database"
# - Deploy!

# 5. Set environment variables
railway variables set \
  APP_KEY="base64:your-app-key" \
  APP_URL="https://your-app.railway.app" \
  MAIL_USERNAME="your-email@gmail.com" \
  MAIL_PASSWORD="your-app-password"

# 6. Deploy
railway up
```

### Method B: Using Railway Dashboard

**Step 3.1**: Connect GitHub to Railway
1. Go to https://railway.app/dashboard
2. Click "New Project"
3. Click "Deploy from GitHub"
4. Select your repository

**Step 3.2**: Configure PostgreSQL
1. After project creation, click "+ Add Service"
2. Select "PostgreSQL"
3. Railway auto-creates database variables
4. No action needed - Railway handles setup

**Step 3.3**: Set Environment Variables
1. Go to your project settings
2. Click "Variables" tab
3. Add these variables:

| Variable | Value | Source |
|----------|-------|--------|
| `APP_ENV` | `production` | Type it |
| `APP_DEBUG` | `false` | Type it |
| `APP_KEY` | `base64:Your-Generated-Key` | From `php artisan key:generate` |
| `APP_URL` | `https://your-app.railway.app` | Will be assigned by Railway |
| `MAIL_MAILER` | `smtp` | Type it |
| `MAIL_HOST` | `smtp.gmail.com` | Type it |
| `MAIL_PORT` | `587` | Type it |
| `MAIL_USERNAME` | `your-email@gmail.com` | Your Gmail |
| `MAIL_PASSWORD` | `abcd efgh ijkl mnop` | Gmail App Password |
| `MAIL_ENCRYPTION` | `tls` | Type it |
| `MAIL_FROM_ADDRESS` | `your-email@gmail.com` | Your Gmail |

**Step 3.4**: Deploy
1. Click "Deploy" button
2. Railway automatically runs:
   - `php artisan migrate --force`
   - `php artisan config:cache`
   - `php artisan route:cache`
3. Watch the deployment logs

---

## ✅ Verify Deployment

### Check if deployed successfully

```bash
# View deployment logs
railway logs

# Check database migrations
railway logs --service postgres

# Check application status
railway open
```

### Test the application

1. Visit your app URL: `https://your-app.railway.app`
2. Go to contact page: `https://your-app.railway.app/contact`
3. Submit a test message
4. Check email for OTP code
5. Verify in database that message was saved

---

## 🔧 Post-Deployment Configuration

### 1. Monitor Deployment

```bash
# Stream real-time logs
railway logs --follow

# View deployment status
railway status
```

### 2. Manage Database

```bash
# Connect to PostgreSQL
railway run psql

# Inside PostgreSQL shell:
\dt  # List all tables
\d contacts  # Show contacts table schema
SELECT COUNT(*) FROM contacts;  # Count messages
```

### 3. Access Application Shell

```bash
# SSH into container
railway shell

# Run artisan commands
php artisan tinker
```

---

## 🐛 Troubleshooting

### Issue: Database migration fails
```
SQLSTATE[08001] could not connect to server
```
**Solution**: 
- Railway PostgreSQL takes time to start
- Migrations will auto-retry
- Check logs: `railway logs`

### Issue: Gmail emails not sending
```
SMTP Connection rejected
```
**Solution**:
- Verify App Password (16 characters)
- Ensure 2FA enabled on Gmail
- Check MAIL_USERNAME is correct email
- Verify MAIL_PASSWORD is the 16-char app password, not Gmail password

### Issue: Static files not loading
**Solution**:
```bash
railway run php artisan storage:link
railway run php artisan optimize
```

### Issue: Cache issues after deployment
**Solution**: Railway auto-clears cache, but if needed:
```bash
railway run php artisan cache:clear
railway run php artisan config:cache
railway run php artisan route:cache
```

---

## 📊 Deployment Checklist

Before you click deploy:

- [ ] GitHub repository created
- [ ] `.env` configured correctly (locally tested)
- [ ] `KEY` generated: `php artisan key:generate`
- [ ] Gmail account has 2FA enabled
- [ ] Gmail App Password generated (16 characters)
- [ ] PostgreSQL container ready
- [ ] Procfile updated (includes cache commands)
- [ ] All files committed to GitHub
- [ ] `.env.production` has PostgreSQL settings

---

## 🔒 Security Best Practices

### On Railway Dashboard

1. **Keep secrets secure**
   - Never commit `.env` to GitHub
   - Use Railway's Variables, not hardcoding

2. **Monitor logs**
   - Check for errors daily
   - Set up alerts for failures

3. **Backup database**
   - Export PostgreSQL daily
   - Keep backups in secure location

4. **Rotate secrets**
   - Change MAIL_PASSWORD quarterly
   - Regenerate APP_KEY if compromised

### Environment Variables

Railway stores all sensitive data securely:
- ✅ MAIL_PASSWORD encrypted at rest
- ✅ DB_PASSWORD encrypted at rest
- ✅ Only visible to project members
- ✅ Never logged in plain text

---

## 📈 Scaling & Monitoring

### Database Scaling

If you need more database resources:
1. Go to PostgreSQL service settings
2. Upgrade plan (e.g., Starter → Standard)
3. Minimal downtime, automatic migration

### Application Scaling

If traffic increases:
1. Go to application settings
2. Increase replicas manually or set auto-scaling
3. Railway load-balances automatically

### Monitoring

Use Railway's built-in monitoring:
- CPU usage
- Memory usage
- Response times
- Error rates

---

## 🔗 Useful Links

| Resource | URL |
|----------|-----|
| Railway Docs | https://docs.railway.app |
| Railway CLI | https://docs.railway.app/cli/commands |
| Gmail App Passwords | https://myaccount.google.com/apppasswords |
| Laravel PostgreSQL | https://laravel.com/docs/database |
| PostgreSQL Download | https://www.postgresql.org/download |

---

## 📞 Support

**Railway Support**: https://railway.app/support
**Laravel Support**: https://laravel.com/docs/database

---

## 🎯 What Happens on Each Deploy

Railway automatically executes (from your Procfile):

```
1. Build phase
   └─ composer install
   └─ npm install (if needed)
   
2. Release phase
   └─ php artisan migrate --force
   └─ php artisan config:cache
   └─ php artisan route:cache
   
3. Start phase
   └─ bash start.sh
   └─ Apache starts
```

---

## ✅ Your deployment is ready!

Once deployed, your application will:
- ✅ Accept contact form submissions
- ✅ Send OTP verification emails via Gmail
- ✅ Store verified contacts in PostgreSQL
- ✅ Auto-scale as needed
- ✅ Run migrations automatically on updates

**Time to deploy**: ~5 minutes ⚡

---

**Updated**: February 24, 2026  
**Last Tested**: Railway.app (current)  
**Status**: ✅ Production Ready
