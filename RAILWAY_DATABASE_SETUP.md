# Railway Database & Email Configuration Guide

## The Issue

Your app is looking for PostgreSQL on `127.0.0.1` (localhost) but Railway's PostgreSQL is at `postgres.railway.internal`. This means **Railway's environment variables aren't set**.

**Solution**: Add environment variables to Railway's Web Service.

---

## Step 1: Find Your Railway PostgreSQL Connection Info

### Option A: Railway Dashboard (Easy)

1. Go to: **Railway Dashboard** → Find your project
2. Click on the **PostgreSQL** service (blue icon)
3. Click the **Connect** tab
4. You'll see something like:

```
Postgres Connection String:
postgresql://postgres:PASSWORD123@postgres.railway.internal:5432/railway

Host: postgres.railway.internal
Port: 5432
User: postgres
Password: PASSWORD123
Database: railway
```

**Copy these values** - you'll need them below.

### Option B: Railway CLI

```bash
npm install -g @railway/cli
railway login
railway service postgresql
# Look for host, port, user, password, database
```

---

## Step 2: Add Variables to Your Web Service

### On Railway Dashboard:

1. Go to **Your Web Service** (green icon with your app name)
2. Click the **Variables** section (⚙️ icon)
3. **CLEAR ALL existing variables** (if any)
4. **ADD THESE VARIABLES** exactly as shown:

```
DB_CONNECTION=pgsql
DB_HOST=postgres.railway.internal
DB_PORT=5432
DB_DATABASE=railway
DB_USERNAME=postgres
DB_PASSWORD=PASSWORD123

DATABASE_URL=postgresql://postgres:PASSWORD123@postgres.railway.internal:5432/railway

APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:Do4qlk5Y5Iri3N9SVYykjJ6YyGPztLCpWAJZGRtOogU=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-gmail@gmail.com
MAIL_PASSWORD=your-16-char-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-gmail@gmail.com
```

**Replace:**
- `PASSWORD123` with your actual PostgreSQL password from Step 1
- `your-gmail@gmail.com` with your Gmail address
- `your-16-char-app-password` with your Gmail App Password

---

## Step 3: Deploy

1. Click **Redeploy** button in Railway dashboard
2. Wait for deployment to complete (2-3 minutes)
3. Check the logs for any errors

---

## Step 4: Test

Visit: `https://castugenderanddevelopment.up.railway.app/contact`

✅ Should work now!

---

## If You Still Get an Error

### "could not find driver"

This means Railway doesn't have PHP's PostgreSQL extension. But it should - Railway's PHP buildpack includes it.

**Try:**
1. Delete your app service entirely
2. Create a new deployment from scratch
3. Railway will auto-provision with correct extensions

### "could not connect to server"

Make sure:
- `DB_HOST` = `postgres.railway.internal` (not localhost or 127.0.0.1)
- `DB_PASSWORD` matches PostgreSQL password exactly
- `DB_DATABASE` matches PostgreSQL database name

### Variables not updating

Railway caches for a few minutes. Wait 5 minutes after adding variables, then test.

---

## Quick Copy-Paste Template

Fill in your PostgreSQL details from Step 1, then copy-paste these variables:

```
DB_CONNECTION=pgsql
DB_HOST=postgres.railway.internal
DB_PORT=5432
DB_DATABASE=[FROM STEP 1]
DB_USERNAME=postgres
DB_PASSWORD=[FROM STEP 1]
DATABASE_URL=postgresql://postgres:[PASSWORD]@postgres.railway.internal:5432/[DATABASE]
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:Do4qlk5Y5Iri3N9SVYykjJ6YyGPztLCpWAJZGRtOogU=
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=[YOUR GMAIL]
MAIL_PASSWORD=[16 CHAR APP PASSWORD]
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=[YOUR GMAIL]
```

---

## Getting Gmail App Password

If you don't have one:

1. Go to: https://myaccount.google.com/apppasswords
2. If "App passwords" isn't available:
   - Go to: https://myaccount.google.com/security
   - Enable 2-Step Verification first
   - Then return to App passwords
3. Select: **Mail** and **Windows Computer**
4. Copy the 16-character password shown
5. Use it as `MAIL_PASSWORD`

---

## Commands to Verify Setup

After deployment, run in Railway:

```bash
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan tinker
>>> env('DB_HOST')
"postgres.railway.internal"
>>> env('DB_USERNAME')
"postgres"
>>> \DB::connection()->getPdo()
PDOStatement { ... }  # If this works, database connected!
```

---

## Troubleshooting Summary

| Error | Solution |
|-------|----------|
| "could not find driver" | Redeploy or recreate service |
| "SQLSTATE[08006]" (connection timeout) | Check DB_HOST, DB_PORT, DB_PASSWORD |
| "SQLSTATE[3D000]" (database doesn't exist) | Check DB_DATABASE matches |
| "could not connect to server at 127.0.0.1" | Your env vars aren't overriding .env - add them to Railway |

---

## Next Steps

1. ✅ Copy PostgreSQL info from Railway Dashboard
2. ✅ Add variables to Web Service on Railway
3. ✅ Click Redeploy
4. ✅ Test the contact form

**The contact form should work after this!** 🚀
