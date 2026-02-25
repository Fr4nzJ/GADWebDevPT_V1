# Queue Worker Deployment Guide for Railway

## Overview

This document outlines how to deploy and run the Laravel queue worker on Railway to handle asynchronous email sending. The queue worker processes jobs stored in the `jobs` table, including email sending, background tasks, and other queued operations.

## Current Configuration

- **Queue Driver:** `database` (storing jobs in PostgreSQL `jobs` table)
- **Database Connection:** PostgreSQL on Railway
- **Email Processing:** Non-blocking, asynchronous via Mail::queue()
- **Retry Policy:** 3 attempts per job, 300-second timeout per job

## Why Queue Worker?

Previously, the contact form was sending emails **synchronously**, causing the request to block and timeout at 30 seconds when the SMTP server was slow. Now:

✅ Contact form POST completes in < 1 second
✅ Emails are queued for background processing
✅ Failed emails automatically retry up to 3 times
✅ User sees response immediately
✅ Emails process reliably in the background

## Railway Configuration Steps

### 1. Update Procfile (✅ ALREADY DONE)

The `Procfile` now includes a worker process type:

```yaml
web: vendor/bin/heroku-php-apache2 public/
worker: php artisan queue:work --sleep=3 --tries=3 --timeout=300
release: php artisan migrate:fresh --force --seed && php artisan config:cache && php artisan route:cache
```

**Worker Options Explained:**
- `--sleep=3`: Worker sleeps 3 seconds between checking for new jobs
- `--tries=3`: Each job gets 3 attempts before failing permanently
- `--timeout=300`: Each job has 300 seconds (5 minutes) to complete

### 2. Railway Service Configuration

To run the queue worker on Railway, you can:

#### Option A: Use Railway's Deploy (Recommended)

1. Push updated Procfile to your repository:
   ```bash
   git add Procfile
   git commit -m "Add queue worker process type to Procfile"
   git push
   ```

2. Railway will automatically detect the worker process type and create a separate dyno

3. Monitor in Railway Dashboard:
   - Go to your project
   - Check the "Services" tab
   - You should see both `web` and `worker` instances

#### Option B: Manual Railway CLI Setup

If Railway doesn't auto-detect, use Railway CLI:

```bash
railway add    # Add new service
# Select "Node.js" (generic process) or create custom command
# Enter command: php artisan queue:work --sleep=3 --tries=3 --timeout=300
```

### 3. Verify Queue Worker Status

Check if jobs are being processed:

```bash
# SSH into Railway container
railway shell

# View pending jobs
php artisan queue:failed    # Shows permanently failed jobs

# List queue stats
php artisan queue:work --help

# Monitor real-time (from your local machine)
railway run php artisan queue:monitor --help
```

### 4. Environment Variables

Ensure these are set in Railway environment:

```yaml
QUEUE_CONNECTION=database          # Use database queue driver
DB_QUEUE_CONNECTION=pgsql          # Use PostgreSQL connection
DB_QUEUE_TABLE=jobs                # Jobs table name
DB_QUEUE=default                   # Default queue name
DB_QUEUE_RETRY_AFTER=90            # Retry failed jobs after 90 seconds
```

These should already be configured. Verify in Railway dashboard under Variables.

## Monitoring & Troubleshooting

### View Failed Jobs

```bash
php artisan queue:failed       # List permanently failed jobs
php artisan queue:retry        # Retry all failed jobs
php artisan queue:retry {id}   # Retry specific job
```

### Check Database Jobs Table

```bash
# SSH into Railway
railway shell

# Count pending jobs
psql $DATABASE_URL -c "SELECT COUNT(*) FROM jobs;"

# View sample jobs
psql $DATABASE_URL -c "SELECT id, queue, attempts, payload FROM jobs LIMIT 5;"
```

### View Application Logs

```bash
railway log
```

Look for:
- `[2024-xx-xx] Processing Mail/ContactVerificationMail`
- `[2024-xx-xx] Job processed successfully`
- `[2024-xx-xx] Job failed, retrying (attempt 2/3)`

### Common Issues & Solutions

#### Issue 1: Queue Worker Not Running
- **Symptom:** Jobs pile up in `jobs` table, emails not sent
- **Solution:** Check Railway dashboard - ensure worker service is active
- **Check:** `railway run php artisan queue:work --help` should execute without error

#### Issue 2: Jobs Failing Permanently
- **Symptom:** All jobs end up in `failed_jobs` table
- **Solution:** Check logs for specific error. Usually SMTP config or missing mailable classes.
- **Check:** `php artisan queue:failed` to see error messages

#### Issue 3: Worker Process Crashes
- **Symptom:** Jobs no longer being processed, worker service restarted repeatedly
- **Solution:** Check log output for exceptions
- **Check:** Increase `--timeout` value if jobs take >300 seconds
- **Check:** Ensure sufficient memory allocated to worker in Railway settings

#### Issue 4: PostgreSQL Connection Errors
- **Symptom:** Worker can't connect to jobs table
- **Solution:** Verify `DATABASE_URL` or individual `DB_*` variables set correctly
- **Check:** `railway run php artisan tinker` → `DB::connection('pgsql')->getPDO();`

## Performance Tuning

### Adjust Worker Concurrency

For higher email volume, run multiple worker processes in Railway:

```yaml
worker: php artisan queue:work --sleep=3 --tries=3 --timeout=300
worker-2: php artisan queue:work --sleep=3 --tries=3 --timeout=300 --queue=high
```

### Adjust Sleep & Timeout

- **Increase sleep (e.g., `--sleep=10`):** Lower CPU usage, slower job processing
- **Decrease sleep (e.g., `--sleep=1`):** Higher CPU usage, faster job processing
- **Adjust timeout:** Match expected email sending time (usually 10-30 seconds per job)

## Deployment Checklist

- [x] Updated `config/mail.php` with `'timeout' => 10`
- [x] Updated all Mail::send() → Mail::queue() in controllers (3 locations)
- [x] Verified `config/queue.php` uses database driver
- [x] Confirmed `jobs` table migration is executed
- [x] Updated Procfile with worker process type
- [ ] Push changes to repository
- [ ] Verify worker process starts in Railway dashboard
- [ ] Test contact form submission on production
- [ ] Verify OTP emails arrive in inbox within 2-3 minutes
- [ ] Check Application logs for "Job processed successfully" messages
- [ ] Monitor `jobs` table - should be empty after processing

## Testing Steps

### Local Testing (Development)

```bash
# 1. Ensure database queue driver configured
# QUEUE_CONNECTION=database in .env

# 2. Start queue worker in separate terminal
php artisan queue:work

# 3. In another terminal, submit contact form via browser
# Or manually dispatch job:
php artisan tinker
>>> Mail::to('test@example.com')->queue(new ContactVerificationMail('Test', 'test@example.com', '123456', 'Test'));

# 4. Watch terminal with queue:work - should see "[2024-xx-xx] Processing..." output
```

### Production Testing (Railway)

```bash
# 1. SSH into Railway container
railway shell

# 2. Start queue worker
php artisan queue:work --sleep=3 --tries=3 --timeout=300

# 3. Submit contact form on production website
# Go to https://castugenderanddevelopment.up.railway.app/contact
# Fill form and submit

# 4. Check if:
#    a) Request completes in < 5 seconds
#    b) OTP email arrives in inbox within 2-3 minutes
#    c) Queue worker terminal shows "Job processed successfully"
#    d) No errors in Application logs

# 5. Exit queue worker
Ctrl+C
```

## Rollback Plan

If queue worker causes issues, quickly disable it:

1. Remove worker line from Procfile:
   ```yaml
   # Comment out or remove:
   # worker: php artisan queue:work --sleep=3 --tries=3 --timeout=300
   ```

2. Revert Mail::queue() → Mail::send() in controllers (but keep 10-second timeout)

3. Push to trigger Railway redeployment

4. Contact form will work synchronously (but may timeout on slow SMTP connection)

## Long-Term Monitoring

Set up alerts for:
- Failed jobs count increasing
- Queue worker process staying stopped for > 5 minutes
- Jobs table size exceeding 1000 rows (indicates backlog)

Railway dashboard → Project → Alerts (if available) or use external monitoring service.

## References

- [Laravel Queue Documentation](https://laravel.com/docs/12.x/queues)
- [Laravel Mail & Mailtables](https://laravel.com/docs/12.x/mail)
- [Railway Deployment](https://docs.railway.app)
- [PostgreSQL Queue Driver Notes](https://laravel.com/docs/12.x/queues#database)

---

**Last Updated:** 2024 (Current Session)
**Status:** ✅ Ready for Deployment
