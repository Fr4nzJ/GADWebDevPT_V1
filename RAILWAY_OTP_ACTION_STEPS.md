# 🚀 Railway OTP Fix - Action Steps

## What Was Wrong

Your local `.env` had the **same variables bug** that broke production:

```env
# ❌ BROKEN (doesn't interpolate in .env)
MAIL_FROM_NAME="${APP_NAME}"
MAIL_PASSWORD="yrso kewd lepy omqm"  (unnecessary quotes)
```

## What Was Fixed Locally ✅

```env
# ✅ FIXED
MAIL_FROM_NAME="GAD Website"
MAIL_PASSWORD=yrso kewd lepy omqm
```

Now local OTP works properly AND matches production behavior.

---

## 🎯 Required Changes on Railway

### Step 1: Update 3 Environment Variables (5 minutes)

Go to: **Railway.app → Your Project → Web Service → Variables**

Change these values:

**1. MAIL_FROM_NAME**
- Current: `"${APP_NAME}"`
- Change to: `GAD Website`

**2. MAIL_PASSWORD** 
- Current: `"yrso kewd lepy omqm"` (with quotes)
- Change to: `yrso kewd lepy omqm` (no quotes)

**3. APP_DEBUG**
- Current: `"true"`
- Change to: `false`

✅ Click Save after each change

### Step 2: Update Procfile (1 minute)

In your repository, update `Procfile`:

```yaml
# BEFORE
release: php artisan migrate:fresh --force --seed && php artisan config:cache && php artisan route:cache

# AFTER  
release: php artisan config:clear && php artisan cache:clear && php artisan migrate:fresh --force --seed && php artisan config:cache && php artisan route:cache
```

Why: Ensures cache is cleared before rebuilding, preventing stale config.

### Step 3: Deploy (2 minutes)

```bash
git add Procfile
git commit -m "Fix OTP: correct MAIL_FROM_NAME and clear config cache"
git push origin main
```

Railway auto-deploys on push.

---

## ✅ Verification After Deploy

### Check 1: Deployment Logs

In Railway Dashboard:
- Click Deployment tab
- Look for successful release output
- Should show: `config:clear` and `cache:clear` completed

### Check 2: Test Contact Form

1. Go to: https://castugenderanddevelopment.up.railway.app/contact
2. Fill form with **your real email**
3. Submit
4. Check your email for OTP (should arrive in < 30 seconds)
5. If arrives: ✅ FIXED
6. If not arrives: Check logs with `railway log`

### Check 3: Production Logs

```bash
railway log | grep -i mail
# Should show successful OTP queue entries
```

---

## If OTP Still Doesn't Arrive

Run this diagnostic command (via Railway SSH):

```bash
railway shell
php artisan tinker
>>> config('mail.from.name')
=> "GAD Website"  ← Should see this
>>> env('MAIL_PASSWORD')
=> "yrso kewd lepy omqm"  ← Should see password  
>>> config('mail.mailers.smtp.host')
=> "smtp.gmail.com"
exit
```

If these don't match, cache wasn't cleared properly:
```bash
railway run php artisan config:clear && php artisan config:cache
```

---

## Timeline

| Step | Time | Status |
|------|------|--------|
| Local fix completed | ✅ Done | READY |
| Update Railway variables | 5 min | ⏳ TODO |
| Update Procfile | 1 min | ⏳ TODO |
| Deploy (git push) | 2 min | ⏳ TODO |
| Test OTP | 5 min | ⏳ TODO |

**Total Time to Fix:** ~15 minutes

---

## Why This Fixes It

### Root Cause
- .env doesn't support `${VAR}` syntax
- Laravel reads literal string `"${APP_NAME}"` as mail FROM name
- Gmail SMTP rejects invalid FROM header
- OTP fails silently

### Solution
- Use literal value: `MAIL_FROM_NAME="GAD Website"`
- Clear config cache so new value loads properly
- First deployment runs release command which clears cache
- Next OTP sends correctly

---

**Once all above done → OTP emails will arrive on production** ✅
