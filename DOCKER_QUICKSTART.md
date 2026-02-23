# Docker Quick Start

## 🚀 Get Started in 3 Steps

### 1. Initial Setup (First Time Only)
```bash
# Copy Docker environment template
cp .env.docker .env

# Build and start all containers
docker-compose up -d

# Wait ~30 seconds for services to be ready
docker-compose ps
```

### 2. Access the Application
- **Website**: http://localhost
- **Admin Dashboard**: http://localhost/admin
- **Email Testing**: http://localhost:8025

### 3. Start Coding
```bash
# Code changes appear instantly in the running container
# Edit files normally in your IDE
```

---

## 📋 Common Commands

### Daily Development
```bash
# Start services
docker-compose up -d

# View live logs
docker-compose logs -f app

# Run Laravel commands
docker-compose exec app php artisan migrate
docker-compose exec app php artisan tinker

# Stop services
docker-compose down
```

### Database Operations
```bash
# Connect to PostgreSQL
docker-compose exec postgres psql -U postgres -d gadwebdev_local

# Reset database
docker-compose exec app php artisan migrate:fresh --seed

# View database in GUI
# Use DBeaver or pgAdmin connecting to localhost:5432
```

### Frontend Development
```bash
# Enable Node service for Vite dev server
docker-compose --profile dev up -d

# View Vite at http://localhost:5173
docker-compose logs -f node
```

### Testing
```bash
# Run tests
docker-compose exec app php artisan test

# Run specific test file
docker-compose exec app php artisan test tests/Feature/ProgramTest.php
```

### Troubleshooting
```bash
# Rebuild containers (fresh start)
docker-compose down -v
docker-compose build
docker-compose up -d

# Check container status
docker-compose ps

# View PHP errors
docker-compose logs app | grep -i error

# Shell access
docker-compose exec app sh
```

---

## 🔧 Environment Setup

### .env File Defaults (from .env.docker)
- **APP_ENV**: `local` (development)
- **APP_DEBUG**: `true` (show errors)
- **DB_HOST**: `postgres` (inside Docker network)
- **DB_PORT**: `5432`
- **DB_DATABASE**: `gadwebdev_local`
- **CACHE_DRIVER**: `redis`
- **MAIL_HOST**: `mailhog` (testing)

### No Changes Needed
Just copy `.env.docker` to `.env` - everything is pre-configured!

---

## 📦 What's Included

| Service | Version | Purpose |
|---------|---------|---------|
| PHP | 8.2 Alpine | Application runtime |
| PostgreSQL | 15 Alpine | Database |
| Redis | 7 Alpine | Cache & sessions |
| Nginx | Alpine | Web server |
| Mailhog | Latest | Email testing |
| Node | 18 Alpine | (Optional) Asset building |

---

## 🎯 Next Steps

1. **Start containers**
   ```bash
   docker-compose up -d
   ```

2. **Verify all services**
   ```bash
   docker-compose ps   # Should show 5 containers running
   ```

3. **Open in browser**
   ```
   http://localhost
   ```

4. **Check email sent during signup**
   ```
   http://localhost:8025
   ```

5. **Start developing!**
   - Edit files in your IDE
   - Changes appear instantly
   - Logs available via `docker-compose logs -f`

---

## 💡 Pro Tips

- **Fast iteration**: Code changes appear in container instantly (no rebuild needed)
- **Full database access**: Connect to localhost:5432 with your database GUI tool
- **Email testing**: Send emails to mailhog at localhost:8025
- **Cache clearing**: `docker-compose exec app php artisan cache:clear`
- **Fresh start**: `docker-compose down -v && docker-compose up -d`

---

## 🐛 Need Help?

Best command for debugging:
```bash
docker-compose logs app
```

This shows everything happening in the application container.

---

## 📖 Full Documentation

- See [DOCKER_SETUP.md](./DOCKER_SETUP.md) for detailed commands
- See [DOCKER_ARCHITECTURE.md](./DOCKER_ARCHITECTURE.md) for technical overview
- Use `make help` to see all available commands (if Makefile available)
