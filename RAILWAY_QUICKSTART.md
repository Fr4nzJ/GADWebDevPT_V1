# Railway.com Quick Start

## 🚀 Deploy in 5 Minutes

### Step 1: Setup Railway (2 minutes)
```bash
# 1. Visit https://railway.app
# 2. Click "Start Free"  
# 3. Sign in with GitHub
# 4. Create New Project
# 5. Select "Deploy from GitHub repo"
# 6. Choose: Fr4nzJ/GADWebDevPT_V1
# 7. Click "Deploy Now"
```

### Step 2: Add Database (1 minute)
In Railway Dashboard:
```
1. Click "Add Service"
2. Select "Database" 
3. Click "PostgreSQL"
4. Done! (Railway auto-configures)
```

### Step 3: Set Environment Variables (2 minutes)
In Railway → Web Service → Variables:

```
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_HERE
APP_URL=https://your-railway-domain.railway.app
LOG_CHANNEL=stderr
SESSION_DRIVER=database
CACHE_DRIVER=database
```

**To get APP_KEY locally:**
```bash
php artisan key:generate --show --no-interaction
# Copy the output (starting with base64:)
```

**Database variables auto-populate** from PostgreSQL service ✓

### Step 4: Deploy (Automatic)
1. Your code deploys automatically
2. Monitor in "Deployments" tab
3. Wait for green checkmark

### Step 5: Access App
```
https://your-railway-domain.railway.app
```

---

## ✨ What Happens Automatically

- ✅ Detects Laravel framework
- ✅ Installs Composer dependencies
- ✅ Builds frontend assets (npm)
- ✅ Runs migrations (php artisan migrate --force)
- ✅ Caches configuration
- ✅ Starts PHP application
- ✅ Provides free SSL certificate

---

## 📋 Environment Variables Quick Reference

### Required
| Variable | Value |
|----------|-------|
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_KEY` | `base64:YOUR_KEY` |
| `APP_URL` | Your Railway domain |

### Auto-Populated (PostgreSQL)
| Variable | Auto | Purpose |
|----------|------|---------|
| `DB_HOST` | ✅ | Database host |
| `DB_PORT` | ✅ | Port (5432) |
| `DB_DATABASE` | ✅ | Database name |
| `DB_USERNAME` | ✅ | Username |
| `DB_PASSWORD` | ✅ | Password |

### Recommended
| Variable | Value |
|----------|-------|
| `LOG_CHANNEL` | `stderr` |
| `SESSION_DRIVER` | `database` |
| `CACHE_DRIVER` | `database` |

---

## 🧪 Verify Deployment

After deployment completes:

```bash
# 1. Visit your domain
https://your-railway-domain.railway.app

# 2. Check database connection
# Go to /programs page (should show database records)

# 3. Try admin login (if configured)
# admin@example.com / password

# 4. Check logs
# Click Deployments → View Logs
```

---

## 🆘 Common Issues & Fixes

### App won't start
```
→ Check variables set correctly
→ Verify APP_KEY starts with base64:
→ Check Deployments → View Logs for errors
```

### Database connection error
```
→ Ensure PostgreSQL service exists
→ Check Variables populated from service
→ Wait 30 seconds for PostgreSQL to start
```

### Build fails
```
→ Verify composer.json valid
→ Check package.json syntax
→ Review: Deployments → Build Logs
```

### Slow/timeout errors
```
→ Upgrade Railway plan
→ Check: Settings → Instance Size
→ Monitor: Billing → Resource Usage
```

---

## 📚 Next Steps

1. ✅ Deploy application
2. ✅ Set up custom domain (optional)
   ```
   Settings → Custom Domain
   ```
3. ✅ Enable email (configure SMTP)
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=your-smtp-host
   MAIL_USERNAME=your-email
   MAIL_PASSWORD=your-password
   ```
4. ✅ Monitor application regularly
   ```
   Deployments → View Logs
   ```
5. ✅ Keep dependencies updated
   ```
   git pull → git push → auto-deploy
   ```

---

## 📖 Full Documentation

For detailed setup, see:
- [RAILWAY_DEPLOYMENT.md](./RAILWAY_DEPLOYMENT.md) - Complete guide with all options
- [RAILWAY_CHECKLIST.md](./RAILWAY_CHECKLIST.md) - Pre/post deployment checklist

## 🎯 Key Railway URLs

- Dashboard: https://railway.app/dashboard
- Project: https://railway.app/project/YOUR_PROJECT_ID
- Documentation: https://docs.railway.app
- Help: https://discord.gg/railway

---

**Your app is now live on Railway! 🎉**

Next time you push to GitHub, Railway automatically redeploys.
