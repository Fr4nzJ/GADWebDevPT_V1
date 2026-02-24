# 🚀 Complete Deployment Checklist & Quick Reference

## 📋 Pre-Deployment Checklist

Use this checklist before deploying to Railway.

---

## ✅ Step 1: Local Configuration

- [ ] `.env` updated with PostgreSQL:
  ```
  DB_CONNECTION=pgsql
  DB_HOST=127.0.0.1
  DB_PORT=5432
  DB_USERNAME=postgres
  ```

- [ ] `.env` updated with Gmail:
  ```
  MAIL_MAILER=smtp
  MAIL_HOST=smtp.gmail.com
  MAIL_USERNAME=your-email@gmail.com
  MAIL_PASSWORD=your-app-password
  ```

- [ ] Procfile updated with cache commands:
  ```
  release: php artisan migrate --force && php artisan config:cache && php artisan route:cache
  ```

---

## ✅ Step 2: PostgreSQL Setup (Local Testing)

- [ ] PostgreSQL installed on local machine
- [ ] Database created: `gad_db`
- [ ] User created: `gad_user` with password
- [ ] Connection verified: `psql -U gad_user -d gad_db`

---

## ✅ Step 3: Gmail Setup

### For Gmail SMTP

- [ ] Gmail account has 2-Step Verification enabled
  - Go to: https://myaccount.google.com/security
  
- [ ] Generated Gmail App Password (16 characters)
  - Go to: https://myaccount.google.com/apppasswords
  - Select: Mail + Windows Computer (or your device)
  - Copy: The 16-character password
  
- [ ] Added to `.env` as `MAIL_PASSWORD`
  - Note: Includes spaces, e.g., `abcd efgh ijkl mnop`

---

## ✅ Step 4: Local Testing

### Database Migrations

```bash
cd e:\xampp\htdocs\GADWebDevPT_V1
php artisan migrate
```

- [ ] All migrations ran successfully
- [ ] No errors in console output
- [ ] Database tables created (check `psql`)

### Email Testing

```bash
php artisan tinker
Mail::to('your-email@gmail.com')->send(
    new \App\Mail\ContactVerificationMail('Test', 'your-email@gmail.com', '123456', 'Test')
)
```

- [ ] Email received in inbox
- [ ] Email formatting looks good
- [ ] OTP code visible in email

### Web Form Testing

1. Start server: `php artisan serve`
2. Visit: http://127.0.0.1:8000/contact
3. Fill out form with test data:
   - Name: Test User
   - Email: your-email@gmail.com
   - Subject: Test Subject
   - Message: This is a test message at least 10 characters

- [ ] Form submits without errors
- [ ] Redirected to verification page
- [ ] Email received with OTP
- [ ] OTP page has countdown timer
- [ ] Enter OTP code successfully
- [ ] Redirected back to contact page with success message
- [ ] Message appears in database:
  ```bash
  psql -U gad_user -d gad_db
  SELECT * FROM contacts WHERE email = 'your-email@gmail.com';
  ```

---

## ✅ Step 5: GitHub Preparation

- [ ] All code committed locally:
  ```bash
  cd e:\xampp\htdocs\GADWebDevPT_V1
  git status  # Should be clean
  git add .
  git commit -m "Configure PostgreSQL and Gmail API for Railway deployment"
  ```

- [ ] Pushed to GitHub:
  ```bash
  git push origin main
  ```

- [ ] `.gitignore` includes `.env` (check):
  ```bash
  cat .gitignore | grep "^\.env"
  # Should show: .env
  ```

- [ ] `.env.production` and `.env.example` are committed:
  ```bash
  git log --oneline | grep -i "env\|config"
  ```

---

## ✅ Step 6: Railway Account Setup

- [ ] Railway account created: https://railway.app
- [ ] GitHub connected to Railway
- [ ] New project created in Railway

---

## ✅ Step 7: Railway Environment Variables

In Railway dashboard, add these variables:

| Variable | Value | Notes |
|----------|-------|-------|
| `APP_ENV` | `production` | Required |
| `APP_DEBUG` | `false` | Required |
| `APP_KEY` | `base64:xxx...` | From `php artisan key:generate` |
| `APP_URL` | (will be assigned) | Auto-filled by Railway |
| `MAIL_MAILER` | `smtp` | Required |
| `MAIL_HOST` | `smtp.gmail.com` | Required |
| `MAIL_PORT` | `587` | Required |
| `MAIL_USERNAME` | Your Gmail | Your actual Gmail address |
| `MAIL_PASSWORD` | App password | 16-character Gmail App Password |
| `MAIL_ENCRYPTION` | `tls` | Required |
| `MAIL_FROM_ADDRESS` | Your Gmail | Same as MAIL_USERNAME |
| `MAIL_FROM_NAME` | `CatSu GAD` | Display name |

- [ ] All variables added to Railway dashboard
- [ ] Double-checked for typos
- [ ] MAIL_PASSWORD is the 16-character App Password (not Gmail password)

---

## ✅ Step 8: Railway PostgreSQL Service

- [ ] PostgreSQL service created in Railway
- [ ] Database name noted: `postgres` (or custom)
- [ ] Railway variables include:
  - `DATABASE_URL` or auto-populated DB_* variables
  - Railway auto-configures, no manual setup needed

---

## ✅ Step 9: Deployment

### Initial Deploy

- [ ] All changes pushed to GitHub
- [ ] Click "Deploy" in Railway dashboard
- [ ] Watch deployment logs for:
  - `php artisan migrate --force` (migrations running)
  - `php artisan config:cache` (config cached)
  - `php artisan route:cache` (routes cached)
  - `Apache started successfully`

### Verify Deployment

```bash
# Watch real-time logs
railway logs --follow

# Check for errors
railway logs | grep -i "error\|failed"
```

- [ ] All deployment steps completed successfully
- [ ] No error messages in logs
- [ ] Web process shows as "running"

---

## ✅ Step 10: Post-Deployment Testing

### Visit Application

- [ ] Application loads: https://your-app.railway.app
- [ ] Contact form displays: https://your-app.railway.app/contact
- [ ] No 500 or 404 errors

### Test Contact Form on Production

1. Fill form with test data (use your email)
2. Submit form
3. Check email for OTP
4. Enter OTP on verification page
5. See success message

- [ ] Form submits successfully
- [ ] Email received with OTP
- [ ] OTP verification works
- [ ] Success message displayed
- [ ] Message stored in production database

### Check Production Database

```bash
railway run psql
SELECT * FROM contacts WHERE is_verified = true;
\q
```

- [ ] Contact message visible in database
- [ ] `is_verified` column shows `true`
- [ ] All fields populated correctly

---

## 🔧 Troubleshooting Checklist

### Application won't start

- [ ] Check logs: `railway logs`
- [ ] Verify `APP_KEY` is set (base64:...)
- [ ] Verify PostgreSQL service is running
- [ ] Check all database variables are set

### Database migrations failed

- [ ] Check logs: `railway logs`
- [ ] Verify PostgreSQL password in environment
- [ ] Verify database name is correct
- [ ] Try: `railway run php artisan migrate --step`

### Email not sending

- [ ] Verify MAIL_USERNAME and MAIL_PASSWORD
- [ ] Confirm 2FA enabled on Gmail
- [ ] Confirm App Password (not Gmail password)
- [ ] Check logs for SMTP errors
- [ ] Try: `railway run php artisan tinker` → test send

### Static files not loading (CSS/JS/Images)

```bash
railway run php artisan storage:link
railway run php artisan optimize
```

---

## 📊 Configuration File Summary

| File | Status | Purpose |
|------|--------|---------|
| `.env` | ✅ Updated | Local development config |
| `.env.example` | ✅ Updated | Template for new environments |
| `.env.production` | ✅ Present | Production template (Railway) |
| `Procfile` | ✅ Updated | Railway deployment commands |
| `start.sh` | ✅ Present | Runtime initialization script |
| `config/database.php` | ✅ Unchanged | Supports PostgreSQL automatically |

---

## 📋 Command Reference

### Local Development

```bash
# Start development server
php artisan serve

# Run migrations
php artisan migrate

# Test email
php artisan tinker
Mail::to('test@gmail.com')->send(new \App\Mail\ContactVerificationMail(...))

# Clear cache
php artisan optimize:clear

# Optimize for production
php artisan optimize
```

### PostgreSQL (Local)

```bash
# Connect to database
psql -U gad_user -d gad_db

# Inside psql:
\dt                                    # List tables
SELECT * FROM contacts;                # View contacts
SELECT COUNT(*) FROM contacts;         # Count records
\d contacts                            # Show schema
\q                                     # Exit
```

### Railway CLI

```bash
# Install
npm i -g @railway/cli

# Login
railway login

# Check status
railway status

# View logs
railway logs
railway logs --follow  # Real-time

# Run command
railway run php artisan migrate

# Connect to database
railway run psql

# Access shell
railway shell
```

---

## 🆘 Getting Help

### If migrations fail:
→ See: `RAILWAY_DEPLOYMENT_GUIDE.md` (Troubleshooting section)

### If email won't send:
→ See: `LOCAL_DEVELOPMENT_SETUP.md` (Troubleshooting section)

### If database won't connect:
→ See: `RAILWAY_DEPLOYMENT_GUIDE.md` (Database Scaling section)

### For general Railway help:
→ Visit: https://docs.railway.app

---

## ✨ Success Indicators

You'll know everything is working when:

✅ **Local Development**
- PostgreSQL running on port 5432
- `php artisan migrate` completes successfully
- Contact form loads at `/contact`
- OTP email arrives immediately
- Verification works end-to-end

✅ **Production (Railway)**
- Application deployed without errors
- Contact form accessible at `/contact`
- OTP email sent via Gmail
- Message verified and stored in database
- All environment variables configured
- Zero 500 errors in logs

---

## 📈 Performance Targets

After deployment, verify:

| Metric | Target | How to Check |
|--------|--------|--------------|
| Page load | < 500ms | Browser DevTools |
| Email delivery | < 30s | Send test email |
| Contact form | < 200ms | Form submission time |
| OTP verification | 100% success | Test with correct/incorrect codes |
| Database queries | < 100ms | Check logs |

---

## 🎯 Final Verification

```bash
# Before deployment, run this checklist:

✅ PostgreSQL installed and running
✅ .env configured with all variables
✅ php artisan migrate runs without errors
✅ Email sends successfully
✅ Contact form works end-to-end
✅ All changes committed to GitHub
✅ Railway account setup with variables
✅ Procfile includes cache commands
✅ No .env committed (only .env.example)
✅ APP_KEY is set (base64:...)

# If all ✅, you're ready to deploy!
```

---

## 📞 Quick Links

| Resource | Link |
|----------|------|
| Railway Docs | https://docs.railway.app |
| Gmail App Passwords | https://myaccount.google.com/apppasswords |
| Laravel Docs | https://laravel.com/docs |
| PostgreSQL Download | https://www.postgresql.org/download |
| Our Railway Guide | `RAILWAY_DEPLOYMENT_GUIDE.md` |
| Our Local Guide | `LOCAL_DEVELOPMENT_SETUP.md` |

---

**Last Updated**: February 24, 2026  
**Status**: ✅ Ready for Deployment

**Estimated time to complete checklist**: 30 minutes  
**Estimated deployment time**: 5 minutes  
**Total time**: ~35 minutes

---

## 🚀 You're Ready!

Follow this checklist, and your application will be deployed to Railway in ~35 minutes with:
- ✅ PostgreSQL database
- ✅ Gmail email configured
- ✅ OTP verification working
- ✅ Automatic migrations
- ✅ Production-grade performance
- ✅ Zero downtime deployments

**Let's deploy! 🎉**
