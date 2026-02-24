# 💻 Local Development Setup - PostgreSQL + Gmail API

## Quick Start (5 minutes)

Setup your local environment to match Railway deployment setup.

---

## 📋 Prerequisites

- PHP 8.1+ (from XAMPP)
- Composer installed
- PostgreSQL installed locally
- Gmail account with 2FA enabled

---

## Step 1: Install PostgreSQL Locally

### Windows

1. **Download PostgreSQL**
   - https://www.postgresql.org/download/windows/
   - Version 15 or 16 recommended

2. **Install**
   - Run installer
   - Remember the `postgres` password you set
   - Default port: 5432
   - Default locale: UTF-8

3. **Verify Installation**
   ```bash
   psql --version
   # Output: psql (PostgreSQL) 15.x
   ```

### macOS

```bash
# Using Homebrew
brew install postgresql@15
brew services start postgresql@15

# Verify
psql --version
```

### Linux (Ubuntu)

```bash
sudo apt-get install postgresql postgresql-contrib
sudo systemctl start postgresql

# Verify
psql --version
```

---

## Step 2: Create Database

### Via Command Line

```bash
# Connect to PostgreSQL
psql -U postgres

# Inside PostgreSQL shell:
CREATE DATABASE gad_db;
CREATE USER gad_user WITH PASSWORD 'your-secure-password';
ALTER ROLE gad_user SET client_encoding TO 'utf8';
ALTER ROLE gad_user SET default_transaction_isolation TO 'read committed';
ALTER ROLE gad_user SET default_transaction_deferrable TO on;
ALTER ROLE gad_user SET timezone TO 'UTC';
GRANT ALL PRIVILEGES ON DATABASE gad_db TO gad_user;
\q
```

### Via pgAdmin (GUI)

1. Open pgAdmin (installed with PostgreSQL)
2. Right-click "Databases" → "Create" → "Database"
3. Name: `gad_db`
4. Owner: Create new user `gad_user` with password
5. Save

---

## Step 3: Configure .env (Already Updated)

Your `.env` should now have:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=gad_db
DB_USERNAME=gad_user
DB_PASSWORD=your-secure-password
```

**File**: `e:\xampp\htdocs\GADWebDevPT_V1\.env`

If not, update manually with these values.

---

## Step 4: Configure Gmail

### Get Gmail App Password

1. Open https://myaccount.google.com/security

2. Enable 2-Step Verification (if not already enabled)

3. Go to https://myaccount.google.com/apppasswords
   - Select: Mail
   - Device: Windows Computer (or your device)
   - Google generates: 16-character password

4. Copy the password (includes spaces): `abcd efgh ijkl mnop`

### Update .env

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=abcd efgh ijkl mnop
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="CatSu GAD"
```

**Note**: Use the 16-character App Password, NOT your Gmail password.

---

## Step 5: Run Migrations

### First Time Setup

```bash
cd e:\xampp\htdocs\GADWebDevPT_V1

# Clear any previous cache
php artisan optimize:clear

# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed

# Cache configuration
php artisan config:cache
```

### Output Should Show

```
✓ 0001_01_01_000000_create_users_table.php
✓ 0001_01_01_000001_create_cache_table.php
✓ 0001_01_01_000002_create_jobs_table.php
✓ 2026_02_20_000000_create_events_table.php
✓ 2026_02_20_000002_create_news_table.php
✓ 2026_02_20_000003_add_role_and_status_to_users_table.php
✓ 2026_02_20_000004_create_reports_table.php
✓ 2026_02_20_000005_create_programs_table.php
✓ 2026_02_20_060122_add_images_to_events_table.php
✓ 2026_02_24_000010_create_contacts_table.php
```

---

## Step 6: Start Development Server

```bash
# Using Laravel's built-in server
php artisan serve

# Server runs at: http://127.0.0.1:8000
```

Or use XAMPP:

```bash
# Start Apache from XAMPP Control Panel
# Visit: http://localhost/GADWebDevPT_V1/public
```

---

## Step 7: Test Email

### Via Tinker

```bash
php artisan tinker

# Test email sending
Mail::to('test@example.com')->send(
    new \App\Mail\ContactVerificationMail(
        'John Doe',
        'john@example.com',
        '123456',
        'Test Subject'
    )
);

# Exit tinker
exit
```

Check your Gmail for the test email.

### Via Web Form

1. Go to http://localhost/contact
2. Fill out contact form
3. Submit
4. Check your Gmail inbox for OTP email
5. Enter OTP on verification page
6. Verify in database

---

## 🛠️ Useful Development Commands

### Database

```bash
# Run all migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Rollback all migrations
php artisan migrate:reset

# Run specific migration
php artisan migrate --path=database/migrations/2026_02_24_000010_create_contacts_table.php

# Access database shell
psql -U gad_user -d gad_db
```

### Database Inspection (psql)

```bash
psql -U gad_user -d gad_db

# Inside psql:
\dt                  # List all tables
\d contacts          # Show contacts table schema
SELECT * FROM contacts;  # View all contacts
SELECT COUNT(*) FROM contacts WHERE is_verified = true;  # Count verified
```

### Cache & Optimization

```bash
# Clear all cache
php artisan optimize:clear

# Rebuild cache
php artisan optimize
php artisan config:cache
php artisan route:cache
```

### Artisan Tinker (PHP Shell)

```bash
php artisan tinker

# Try these:
Contact::count()
Contact::verified()->count()
Contact::latest()->first()
Mail::to('test@example.com')->send(new \App\Mail\ContactVerificationMail(...))
```

---

## 🐛 Troubleshooting Local Setup

### PostgreSQL Connection Refused

```
SQLSTATE[HY000] [7] could not find a usable socket directory
```

**Solution**:
```bash
# Check if PostgreSQL is running
sudo systemctl status postgresql  # Linux
brew services list  # macOS
# Windows: Check Services in Task Manager
```

### Migration Fails

```
SQLSTATE[42P01]: Undefined table: 7
```

**Solution**:
```bash
php artisan migrate:rollback
php artisan migrate
```

### Gmail not sending

```
Expected response code 250 but got code "535"
```

**Solution**:
- Verify Gmail 2FA is enabled
- Generate NEW App Password (old ones expire)
- Check MAIL_PASSWORD is the 16-character version, not Gmail password
- No extra spaces in password

### Port 8000 already in use

```bash
# Use different port
php artisan serve --port=8001
```

---

## 📊 Verify Setup

### Check Database

```bash
psql -U gad_user -d gad_db -c "SELECT version();"
# Output shows PostgreSQL version
```

### Check Migrations

```bash
php artisan migrate:status

# Output:
# Ran migrations:
# ✓ 2026_02_24_000010_create_contacts_table.php
```

### Check Email

```bash
# Send test email
php artisan mail:send App\Mail\ContactVerificationMail --to=test@example.com
```

### Check Application

```bash
# Start server
php artisan serve

# Visit: http://127.0.0.1:8000/contact
# Form should load without errors
```

---

## 📝 .env Checklist

Verify all these are set correctly:

```env
✅ APP_ENV=local
✅ APP_DEBUG=true
✅ DB_CONNECTION=pgsql
✅ DB_HOST=127.0.0.1
✅ DB_PORT=5432
✅ DB_DATABASE=gad_db
✅ DB_USERNAME=gad_user
✅ DB_PASSWORD=your-password
✅ MAIL_MAILER=smtp
✅ MAIL_HOST=smtp.gmail.com
✅ MAIL_PORT=587
✅ MAIL_USERNAME=your-gmail@gmail.com
✅ MAIL_PASSWORD=your-app-password (16 chars)
✅ MAIL_ENCRYPTION=tls
```

---

## 📚 Local vs Production Differences

| Setting | Local | Production (Railway) |
|---------|-------|----------------------|
| Database | PostgreSQL local | PostgreSQL on Railway |
| Mail | Gmail SMTP | Gmail SMTP |
| APP_ENV | `local` | `production` |
| APP_DEBUG | `true` | `false` |
| Cache | Database | Database |

Both configurations are **identical** except for environment-specific settings.

---

## 🚀 Next Steps

After local development works:

1. **Make changes to your code**
2. **Test locally**: `php artisan serve`
3. **Commit to GitHub**: `git push origin main`
4. **Deploy to Railway**: (See `RAILWAY_DEPLOYMENT_GUIDE.md`)

---

## ⏱️ Typical Development Workflow

```bash
# Start of day
psql -U gad_user -d gad_db  # Check DB is working
php artisan serve            # Start server
# Visit http://127.0.0.1:8000

# During development
# Edit code, refresh browser
# Laravel's hot reload works automatically

# Before commit
php artisan migrate:status   # Verify no pending migrations
php artisan test            # Run tests
git add .
git commit -m "Add feature"
git push origin main

# Run on Railway automatically
# (See deployment logs)
```

---

## 📞 Help & Resources

| Issue | Solution |
|-------|----------|
| PostgreSQL won't start | Check Windows Services or run `sudo systemctl start postgresql` |
| Port 5432 in use | Change `DB_PORT` in `.env` to different port |
| Gmail password error | Generate NEW App Password, not Gmail password |
| Migrations won't run | Check DB connection: `php artisan tinker` then `DB::connection()->getPdo()` |
| Email not sending | Test with: `php artisan mail:send \App\Mail\ContactVerificationMail --to=test@gmail.com` |

---

**Setup Time**: ~10 minutes  
**Status**: ✅ Ready to develop locally

Once complete, your local setup matches Railway's production environment exactly!
