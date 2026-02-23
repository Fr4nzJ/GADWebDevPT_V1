# Docker Setup Guide for GAD Website

## Quick Start

### Prerequisites
- Docker Desktop installed and running
- Docker Compose installed

### Startup (First Time)

1. **Copy environment file:**
   ```bash
   cp .env.docker .env
   ```

2. **Build and start containers:**
   ```bash
   docker-compose up -d
   ```

3. **Verify services are running:**
   ```bash
   docker-compose ps
   ```

   You should see:
   - gadwebdev_app (PHP-FPM)
   - gadwebdev_postgres (PostgreSQL)
   - gadwebdev_redis (Redis)
   - gadwebdev_mailhog (Mail testing)
   - gadwebdev_nginx (Web server)

4. **Access the application:**
   - Website: http://localhost
   - Mailhog (email testing): http://localhost:8025

### Daily Development Commands

#### Run artisan commands:
```bash
docker-compose exec app php artisan migrate
docker-compose exec app php artisan tinker
docker-compose exec app php artisan make:migration create_table_name
```

#### Run npm commands:
```bash
docker-compose exec app npm run build
docker-compose exec app npm run dev
# OR use the Node service
docker-compose --profile dev up -d
```

#### View logs:
```bash
docker-compose logs -f app
docker-compose logs -f nginx
docker-compose logs -f postgres
```

#### Database access:
```bash
# Using docker-compose
docker-compose exec postgres psql -U postgres -d gadwebdev_local

# Using psql (if installed)
psql -h localhost -U postgres -d gadwebdev_local
```

#### Clear application cache:
```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

#### Run tests:
```bash
docker-compose exec app php artisan test
```

### Stopping & Cleanup

**Stop containers (keep data):**
```bash
docker-compose down
```

**Stop and remove everything (including data):**
```bash
docker-compose down -v
```

**Rebuild containers:**
```bash
docker-compose down -v
docker-compose build --no-cache
docker-compose up -d
```

### Troubleshooting

#### Port already in use
If port 80, 5432, or 6379 is already in use:

Edit `docker-compose.yml` and change the port mapping:
```yaml
ports:
  - "8080:80"      # Change 80 to 8080 for Nginx
  - "5433:5432"    # Change 5432 to 5433 for PostgreSQL
  - "6380:6379"    # Change 6379 to 6380 for Redis
```

#### Application won't start
1. Check logs: `docker-compose logs app`
2. Verify .env file has DATABASE_HOST=postgres
3. Ensure APP_KEY is set in .env

#### Database connection error
1. Wait 30 seconds for PostgreSQL to be ready
2. Check: `docker-compose exec postgres psql -U postgres -c "SELECT 1"`
3. Verify DB_HOST=postgres in .env

#### Permission issues on Linux
```bash
# Run as user, not root
sudo usermod -aG docker $USER
newgrp docker
```

#### Clear Docker cache completly:
```bash
docker-compose down -v
docker system prune -a
docker-compose up -d
```

### Docker Services Overview

| Service  | Container | Purpose | Port |
|----------|-----------|---------|------|
| app      | PHP-FPM   | Application runtime | 9000 |
| postgres | PostgreSQL 15 | Primary database | 5432 |
| redis    | Redis 7   | Cache & sessions | 6379 |
| mailhog  | Mailhog   | Email testing | 1025, 8025 |
| nginx    | Nginx     | Web server & reverse proxy | 80, 443 |
| node     | Node 18   | (Optional) Frontend build tool | 5173 |

### Environment Variables

**Key variables for Docker:**
- `DB_HOST=postgres` - Must be container name, not localhost
- `REDIS_HOST=redis` - Must be container name, not localhost
- `MAIL_HOST=mailhog` - For email testing
- `RUN_MIGRATIONS=true` - Auto-run migrations on startup
- `RUN_SEEDERS=false` - Set to true to seed on startup

### Performance Tips

1. **Mount optimization (Mac/Windows):**
   - Place project in native filesystem
   - Avoid mounted node_modules and vendor

2. **Resource limits:**
   Edit `docker-compose.yml`:
   ```yaml
   services:
     app:
       deploy:
         resources:
           limits:
             cpus: '1'
             memory: 512M
   ```

3. **Enable BuildKit for faster builds:**
   ```bash
   export DOCKER_BUILDKIT=1
   docker-compose build
   ```

### Production Deployment

For deploying Docker to production:

1. **Use a Docker registry:**
   ```bash
   docker build -t your-registry/gadwebdev:latest .
   docker push your-registry/gadwebdev:latest
   ```

2. **Use docker-compose for production:**
   - Create `docker-compose.prod.yml`
   - Remove volumes mounts
   - Set `APP_DEBUG=false`
   - Use proper environment variables

3. **Deploy to Render.com with Docker:**
   - Push image to Docker Hub or GitHub Container Registry
   - Reference image in render.yaml:
     ```yaml
     services:
       - type: web
         image: your-registry/gadwebdev:latest
     ```

### Additional Resources

- [Docker Documentation](https://docs.docker.com/)
- [Docker Compose Documentation](https://docs.docker.com/compose/)
- [Laravel Docker Guide](https://laravel.com/docs/deployment#docker)
- [Nginx Documentation](https://nginx.org/en/docs/)
