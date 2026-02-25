# Railway Environment Variables Configuration

## Required Variables for Queue Worker

When deploying to Railway, ensure these environment variables are set in your Railway project dashboard:

### Queue Configuration

```
QUEUE_CONNECTION=database
DB_QUEUE_CONNECTION=pgsql
DB_QUEUE_TABLE=jobs
DB_QUEUE=default
DB_QUEUE_RETRY_AFTER=90
```

### How to Set in Railway Dashboard

1. Go to [Railway Dashboard](https://railway.app)
2. Select your project (GADWebDevPT_V1)
3. Click on the "Web" service (or main service)
4. Go to the "Variables" tab
5. Add each variable one by one:
   - Name: `QUEUE_CONNECTION` → Value: `database`
   - Name: `DB_QUEUE_CONNECTION` → Value: `pgsql`
   - (Other variables as listed above)
6. Click "Save"
7. Railway will automatically redeploy with new variables

### Verification Steps

After setting variables, SSH into Railway and verify:

```bash
# SSH into web service
railway shell

# Check environment variables
echo $QUEUE_CONNECTION  # Should output: database
echo $DB_QUEUE_CONNECTION  # Should output: pgsql

# Test queue connectivity
php artisan tinker
>>> config('queue.default')
=> "database"

>>> config('queue.connections.database.table')
=> "jobs"

>>> DB::table('jobs')->count()
=> 0   (or number of pending jobs)

exit  # Exit tinker
```

## Development vs Production Configuration

### Local Development (.env)
```
QUEUE_CONNECTION=sync
```
**Why:** Emails send immediately, useful for testing. No queue worker needed.

### Production Railway (Variables)
```
QUEUE_CONNECTION=database
```
**Why:** Emails queued in database, processed by worker process. Non-blocking.

## Current Status

| Environment | QUEUE_CONNECTION | Mail Delivery | Status |
|-------------|------------------|---------------|--------|
| Local Dev | sync | Immediate | ✓ Works |
| Railway Prod | ❌ Not Set (defaults to sync) | Immediate but Timeouts | ⚠️ Needs Update |
| Railway Prod (After Fix) | database | Queued + Async | ✓ Ready |

## Deployment Checklist

- [ ] Set `QUEUE_CONNECTION=database` in Railway Variables
- [ ] Set `DB_QUEUE_CONNECTION=pgsql` in Railway Variables
- [ ] Verify worker process appears in Railway Services dashboard
- [ ] SSH and confirm queue driver is database: `railway shell && php artisan tinker`
- [ ] Check that `jobs` table connection works: `DB::table('jobs')->count()`
- [ ] Push Procfile changes with worker process type
- [ ] Railway auto-detects and creates separate worker dyno
- [ ] Test contact form → expect < 5 second response
- [ ] Check logs → look for "[Worker]" process running
- [ ] Verify emails delivered within 2-3 minutes

## Next Steps

1. **Immediate (Now):** Update Railway Variables (2 mins)
2. **Then:** Push updated Procfile to GitHub (1 min)
3. **Then:** Monitor Railway logs for worker startup (2 mins)
4. **Then:** Test contact form on production (5 mins)
5. **Then:** Verify email delivery (2-3 mins for OTP email)

## Important Notes

⚠️ **CRITICAL:** Without setting `QUEUE_CONNECTION=database` in Railway, the system will:
- Continue using sync driver on production
- Keep experiences 30-second timeouts on contact form
- NOT process background jobs asynchronously
- Send emails synchronously (blocking requests)

✅ **AFTER Fix:** System will:
- Use async queue processing
- Complete contact form in < 1 second
- Process emails in background worker
- Scale better with multiple worker instances

---

**Last Updated:** 2024
**Next Action:** Set variables in Railway dashboard and redeploy
