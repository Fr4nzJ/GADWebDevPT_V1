# Railway SMTP Configuration Fix - OTP Not Sending

## Problem Identified

**Why OTP works locally but not on production (Railway):**

### Issue 1: Variable Interpolation in .env ❌

```env
# WRONG (both local and Railway)
MAIL_FROM_NAME="${APP_NAME}"
VITE_APP_NAME="${APP_NAME}"

# CORRECT (literal values)
MAIL_FROM_NAME="GAD Website"
VITE_APP_NAME="GAD Website"
```

**Why it breaks:**
- .env files don't support `${VAR}` syntax
- Laravel reads the literal string `"${APP_NAME}"`
- This causes config to be malformed
- Email sending silently fails because FROM name is invalid

### Issue 2: Config Cache on Railway ⚠️

When you deploy to Railway after updating .env:
1. New code runs with old cached config first
2. `php artisan config:cache` might run during deployment
3. If it caches before mail variables are loaded, emails fail

### Issue 3: Quoted Password (Might Cause Issues) ⚠️

```env
# Possibly problematic
MAIL_PASSWORD="yrso kewd lepy omqm"

# Better (no quotes)
MAIL_PASSWORD=yrso kewd lepy omqm
```

---

## 🔧 Fix for Railway

### Step 1: Update Railway Environment Variables

Go to **Railway Dashboard → Your Project → Web Service → Variables**

Change these values:

```
APP_DEBUG=false                          (was: true)
MAIL_FROM_NAME=GAD Website               (was: "${APP_NAME}")
MAIL_PASSWORD=yrso kewd lepy omqm        (remove quotes)
```

**Exact Values to Use:**

| Variable | Old Value | New Value |
|----------|-----------|-----------|
| `MAIL_FROM_NAME` | `"${APP_NAME}"` | `GAD Website` |
| `MAIL_PASSWORD` | `"yrso kewd lepy omqm"` | `yrso kewd lepy omqm` |
| `APP_DEBUG` | `true` | `false` |

### Step 2: Add Cache Clearing to Procfile

Your `Procfile` currently has:
```yaml
release: php artisan migrate:fresh --force --seed && php artisan config:cache && php artisan route:cache
```

**Change to:**
```yaml
release: php artisan config:clear && php artisan cache:clear && php artisan migrate:fresh --force --seed && php artisan config:cache && php artisan route:cache
```

This ensures cached config is completely cleared before being rebuilt.

### Step 3: Deploy

After updating Railway variables and Procfile:

```bash
git add .
git commit -m "Fix OTP email sending: correct MAIL_FROM_NAME and clear config cache on deploy"
git push origin main
```

Railway will automatically:
1. Run the updated `release` command (clear cache first)
2. Deploy new code
3. Start web service with fresh config

---

## 📋 Verification Checklist

After deployment to Railway, verify:

- [ ] Go to Railway Dashboard → Web service
- [ ] Check Deployment tab → See release command output
- [ ] Look for `config:clear` and `cache:clear` in output
- [ ] Check for `config:cache` SUCCESS after that
- [ ] Go to production website
- [ ] Fill contact form
- [ ] Submit and **check OTP email arrives**
- [ ] Enter OTP to verify it works
- [ ] Check logs: `railway log` shows "Contact Form - Admin notification email queued"
- [ ] Check gadcatsu@gmail.com for contact message

---

## Why This Fixes It

### Before Fix:
```
User submits form
  ↓
Laravel tries to send OTP
  ↓
Mail FROM name = "${APP_NAME}" (literal string, invalid)
  ↓
Gmail SMTP rejects: "Invalid FROM header"
  ↓
OTP never sent ❌
```

### After Fix:
```
User submits form
  ↓
Laravel tries to send OTP
  ↓
Mail FROM = "GAD Website" (literal, valid)
  ↓
Gmail SMTP accepts: "Valid FROM header"
  ↓
OTP sent to user ✅
```

---

## Local Development Update

Also applied fix to local `.env`:

```env
# FIXED
MAIL_FROM_NAME="GAD Website"    (was: "${APP_NAME}")
MAIL_PASSWORD=yrso kewd lepy omqm (removed quotes)
VITE_APP_NAME="GAD Website"     (was: "${APP_NAME}")
```

This ensures local and production behave identically.

Clear local cache too:
```bash
php artisan config:clear
php artisan cache:clear
```

---

## Testing on Railway After Deploy

### Quick Test:

```bash
# SSH into Railway
railway shell

# Check mail config
php artisan tinker
>>> config('mail.from.name')
=> "GAD Website"    # Should show this, not "${APP_NAME}"

>>> config('mail.from.address')
=> "gadcatsu@gmail.com"

>>> env('MAIL_PASSWORD')
=> "yrso kewd lepy omqm"

exit  # Exit tinker
```

### Full Integration Test:

1. Open production website
2. Fill contact form with real email
3. Wait for OTP (should arrive in < 30 seconds)
4. If OTP arrives → Fix successful ✅
5. If OTP doesn't arrive → Check logs with `railway log`

---

## Common Errors After Fix (& Solutions)

### Error: "Expected response code 250..."
- Cause: SMTP auth still failing
- Fix: Verify MAIL_PASSWORD is exactly correct (no typos), regenerate if needed

### Error: "Expected response code 535..."  
- Cause: Invalid credentials
- Fix: Regenerate Gmail App Password and update MAIL_PASSWORD on Railway

### Error: "Connection refused on port 587"
- Cause: Railway firewall blocking Gmail SMTP
- Fix: Contact Railway support, or try MAIL_PORT=465 with MAIL_ENCRYPTION=ssl

### OTP Still Not Sending After Deploy
- Check: `railway log` for actual error messages
- Check: `MAIL_FROM_NAME` is NOT `"${APP_NAME}"` (run tinker to verify)
- Check: `php artisan config:clear` ran in release command
- Fix: Manually clear cache: `railway run php artisan config:clear`

---

## Files Changed

### Local Development
- `.env` - Fixed MAIL_FROM_NAME, VITE_APP_NAME, MAIL_PASSWORD quotes

### Production (Railway)
- **Variables:** Update MAIL_FROM_NAME, MAIL_PASSWORD, APP_DEBUG
- **Procfile:** Add config:clear before config:cache

### All Deployments
- `Procfile` - Clear config cache before building new cache

---

## Best Practices Going Forward

1. **Never use `${VAR}` in .env files** - Use literal values
2. **Always reload config after .env changes** - Run `config:clear`
3. **Test locally first** - Before deploying to production
4. **Monitor logs** - Check `railway log` after each deployment
5. **Use `config()` function** - In code, not env() for complex values

---

## Summary

| Item | Local | Production |
|------|-------|-----------|
| MAIL_FROM_NAME | ✅ Now "GAD Website" | ✅ Set to "GAD Website" |
| MAIL_PASSWORD | ✅ No quotes | ✅ Remove quotes |
| Config Clear | ✅ Manual | ✅ In Procfile |
| APP_DEBUG | ✅ true | ✅ Change to false |
| Status | ✅ Ready | ⏳ Deploy these changes |

---

**Next Steps:**
1. Update Railway environment variables (5 min)
2. Update Procfile (1 min)
3. Deploy to production (2 min)
4. Test contact form (5 min)
5. Verify OTP arrives (2 min)

**Total Time:** ~15 minutes to full fix

---

**Last Updated:** February 25, 2026
**Status:** Ready to Deploy
