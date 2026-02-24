# ⚡ Quick Start: Deploy to Railway in 5 Steps

**Total time: ~35 minutes**

---

## 🟦 Step 1: Install PostgreSQL (5 minutes)

### Windows
1. Download: https://www.postgresql.org/download/windows
2. Run installer, use default settings
3. Remember password when prompted
4. Installation path: `C:\Program Files\PostgreSQL\15`

### Verify Installation
```bash
psql --version
# Output: psql (PostgreSQL) 15.x.x
```

---

## 🟩 Step 2: Generate Gmail App Password (3 minutes)

1. Go to: https://myaccount.google.com/apppasswords
2. If not available, enable 2-Step Verification first: https://myaccount.google.com/security
3. Select: **Mail** and **Windows Computer**
4. Copy the 16-character password shown
5. Example: `abcd efgh ijkl mnop`

---

## 🟨 Step 3: Test Locally (10 minutes)

### Create Local Database
```bash
# Open PowerShell in your project folder
cd e:\xampp\htdocs\GADWebDevPT_V1

# Run migrations
php artisan migrate

# You should see: Successfully published 8 migrations
```

### Update .env with Gmail Password
```
# Open .env file, find MAIL_PASSWORD=
# Paste the 16-character password:
MAIL_PASSWORD=abcd efgh ijkl mnop
```

### Start Server & Test
```bash
php artisan serve
# Visit: http://127.0.0.1:8000/contact
# Fill form → Should receive OTP email → Enter OTP → Success!
```

---

## 🟪 Step 4: Push to GitHub (2 minutes)

```bash
git add .
git commit -m "Configure PostgreSQL and Gmail for Railway"
git push origin main
```

---

## 🔵 Step 5: Deploy to Railway (15 minutes)

### Option A: Railway Dashboard (Simplest)

1. Go to: https://railway.app
2. Login with GitHub
3. Click **"New Project"** → **"Deploy from GitHub repo"**
4. Select your repository
5. Click **Infrastructure** → **PostgreSQL** (Railway adds it automatically)
6. Copy these variables from your `.env`:
   ```
   APP_KEY=base64:xxx... (from php artisan key:generate)
   MAIL_USERNAME=your-gmail@gmail.com
   MAIL_PASSWORD=abcd efgh ijkl mnop (Gmail App Password)
   ```
7. Click **"Deploy"**

### Option B: Railway CLI

```bash
npm install -g @railway/cli
railway login
railway init
railway up
```

---

## ✅ Verify Deployment

Visit: `https://your-app.railway.app/contact`

You should see:
- ✅ Contact form loads
- ✅ No errors in browser
- ✅ Submit test email
- ✅ Receive OTP email
- ✅ Verification works
- ✅ Success message

---

## 🆘 If Something Goes Wrong

### Error: Password authentication failed
```
Fix: Check DB_PASSWORD in .env is empty (PostgreSQL default)
```

### Error: SMTP authentication failed
```
Fix: Verify MAIL_PASSWORD is 16-character Gmail App Password (not Gmail password)
```

### Error: Could not connect to database
```
Fix: In Railway dashboard, verify PostgreSQL service is running
```

### Error: 500 error on /contact
```
Fix: Check Railway logs → railway logs --follow
```

---

## 📋 Environment Variables for Railway

Copy all these into Railway dashboard:

```
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:...copy from local php artisan key:generate
DB_CONNECTION=pgsql
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-gmail@gmail.com
MAIL_PASSWORD=abcd efgh ijkl mnop
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-gmail@gmail.com
MAIL_FROM_NAME="CatSu GAD"
```

---

## 🎉 Done!

Your app is now live on Railway with:
- ✅ PostgreSQL database
- ✅ Gmail email working
- ✅ OTP verification active
- ✅ Automatic migrations
- ✅ Production-ready

**Next: Test at https://your-app.railway.app**

---

**Need more help?** See detailed guides:
- 📖 `RAILWAY_DEPLOYMENT_GUIDE.md`
- 📖 `LOCAL_DEVELOPMENT_SETUP.md`
- 📖 `DEPLOYMENT_CHECKLIST.md`
