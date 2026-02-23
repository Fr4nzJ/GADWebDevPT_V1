# Docker Architecture Overview

## Project Structure

```
.
├── Dockerfile                 # Multi-stage build for production image
├── docker-compose.yml         # Development environment
├── docker-compose.prod.yml    # Production environment
├── docker-entrypoint.sh       # Container startup script
├── .dockerignore             # Files excluded from Docker build
├── docker/
│   └── nginx.conf            # Nginx reverse proxy configuration
├── .env.docker               # Docker-specific environment template
├── Makefile                  # Convenient docker commands
│
├── app/                      # Laravel application code
├── resources/                # Views, CSS, JavaScript
├── config/                   # Configuration files
├── database/                 # Migrations and seeders
├── routes/                   # Application routes
├── storage/                  # Logs, cache, uploads
├── public/                   # Web root
└── vendor/                   # Composer packages

```

## Docker Services Architecture

### Development Environment (docker-compose.yml)

```
┌─────────────────────────────────────────────────────┐
│                    User / Browser                    │
└────────────────────────┬────────────────────────────┘
                         │ HTTP
                         ▼
        ┌────────────────────────────────┐
        │      Nginx (nginx:alpine)      │
        │  - Reverse Proxy               │
        │  - Static file serving         │
        │  - Port: 80                    │
        └────────┬───────────────────────┘
                 │ FastCGI Protocol
                 ▼
        ┌────────────────────────────────┐
        │  PHP-FPM (php:8.2-fpm-alpine)  │
        │  - Application runtime         │
        │  - Runs 9 worker processes     │
        │  - Port: 9000                  │
        └────────┬───────────────────────┘
                 │
        ┌────────┴─────────┬──────────────┬──────────────┐
        │                  │              │              │
        ▼                  ▼              ▼              ▼
  ┌──────────┐     ┌───────────┐  ┌────────────┐  ┌───────────┐
  │PostgreSQL│     │  Redis    │  │  Mailhog   │  │   Node    │
  │ Database │     │  Cache    │  │   (SMTP)   │  │(Optional) │
  │ Port:5432│     │Port:6379  │  │Port:1025   │  │Port:5173  │
  └──────────┘     └───────────┘  └────────────┘  └───────────┘
```

### Production Environment (docker-compose.prod.yml)

Simplified version without local database (uses external PostgreSQL):
- Removes PostgreSQL container
- Connects to external database via environment variables
- Includes Redis for caching
- Optimized Nginx configuration

## File Descriptions

### Dockerfile

**Multi-stage build for optimized production images:**

1. **Builder Stage**: 
   - Installs build tools (npm, composer)
   - Compiles all dependencies
   - Builds frontend assets
   - ~1GB uncompressed

2. **Runtime Stage**:
   - Only includes runtime dependencies
   - No build tools or node_modules
   - Copies compiled application from builder
   - ~350MB final image size

**Benefits**: Smaller images, faster deployment, security (no build tools in prod)

### docker-compose.yml

**Development environment with all services:**
- Multi-container setup with volume mounts
- Real-time code changes (live reload)
- Full debugging capabilities
- Database, cache, and email services included
- Optional Node.js service for frontend building

**Key Features**:
- `volumes`: Mount local files for development
- `depends_on`: Start services in correct order
- `environment`: Local development settings
- `ports`: Expose services for testing
- `healthcheck`: Monitor container health
- `networks`: Service-to-service communication

### docker-entrypoint.sh

**Container initialization script:**
1. Waits for database connectivity
2. Generates `APP_KEY` if not set
3. Runs database migrations
4. Caches configuration
5. Starts PHP-FPM

**Controls**:
- `DB_HOST`, `DB_PORT`: Database connectivity check
- `RUN_MIGRATIONS=true|false`: Auto-migrate on startup
- `RUN_SEEDERS=true|false`: Auto-seed on startup

### docker/nginx.conf

**Nginx reverse proxy configuration:**
- FastCGI gateway to PHP-FPM
- Static file caching
- Security headers
- Compression (gzip)
- Error handling

**Route handling**:
- Static files (.css, .js, images) → cached locally
- PHP files → forwarded to PHP-FPM
- Unknown routes → `/index.php` (Laravel routing)

### .dockerignore

**Excludes from Docker build context:**
- `.git/` directory (large, not needed)
- `node_modules/` (rebuilt in container)
- `vendor/` (rebuilt in container)
- Tests and documentation (not needed in production)

**Effect**: Reduces build context size, speeds up builds

## Environment Configuration

### Development (.env.docker)

```
APP_ENV=local              # Laravel environment
APP_DEBUG=true             # Show errors
DB_HOST=postgres           # Container name (DNS resolution)
CACHE_DRIVER=redis         # Redis for development
SESSION_DRIVER=redis       # Redis sessions
MAIL_MAILER=smtp           # Mailhog for testing
RUN_MIGRATIONS=true        # Auto-migrate on startup
```

### Production (.env with variables)

```
APP_ENV=production         # Production mode
APP_DEBUG=false            # Hide errors
DB_HOST=${DB_HOST}         # External database
CACHE_DRIVER=redis         # Redis for caching
LOG_CHANNEL=stderr         # Log to container output
```

## Container Networking

### DNS Resolution

Containers can communicate using **service names**:
- `postgres` → service app can reach PostgreSQL as `postgres:5432`
- `redis` → service app can reach Redis as `redis:6379`
- `mailhog` → service app can reach Mailhog as `mailhog:1025`

This is **not working on host** - must use `localhost` or `127.0.0.1`

### Port Mapping

```
Host Port : Container Port
80:80                    # Nginx (host → container)
5432:5432                # PostgreSQL (host → container)
6379:6379                # Redis (host → container)
1025:1025                # Mailhog SMTP (host → container)
8025:8025                # Mailhog web UI (host → container)
```

## Build Process

### Development Build

```bash
docker-compose build
```

1. Reads Dockerfile
2. Builds image from `php:8.2-fpm-alpine`
3. Installs PHP extensions
4. Installs Composer packages
5. Installs npm packages
6. Creates docker image: ~800MB

### Production Build

```bash
docker build -t gadwebdev:latest .
```

Final image size: ~350MB (smaller due to multi-stage build)

## Startup Sequence

1. **Start containers** with `docker-compose up -d`
2. **Entrypoint runs**:
   - Waits for PostgreSQL readiness
   - Generates APP_KEY if needed
   - Runs migrations
   - Caches configuration
3. **PHP-FPM starts** (9 worker processes)
4. **Nginx starts** and proxies requests to PHP-FPM
5. **Application ready** at http://localhost

**First startup**: ~30-60 seconds (includes migrations)
**Subsequent startups**: ~5-10 seconds

## Performance Optimization

### Volume Mounts (Development)

```yaml
volumes:
  - ./:/app                        # Code sync (slow on Mac/Windows)
  - /app/node_modules              # Don't sync, use container's
  - /app/vendor                    # Don't sync, use container's
```

**Why**:
- Code changes visible in containers
- `node_modules` and `vendor` are large, avoid host syncing
- Improves performance on Mac/Windows

### Image Optimization

**Multi-stage build**:
- Builder stage creates 1GB intermediate image
- Runtime stage copies only needed files (~350MB)
- Unused build tools not included

**Alpine Linux**:
- Small base image (~20MB)
- Reduced attack surface
- Smaller deployment packages

### Cache Optimization

```bash
export DOCKER_BUILDKIT=1
docker-compose build
```

BuildKit caching:
- Caches layer results
- Reuses unchanged layers
- Faster rebuilds

## Deployment Scenarios

### Local Development

```bash
docker-compose up -d
# Edit code locally, containers pick up changes
```

### Staging (Docker Compose)

```bash
docker-compose -f docker-compose.prod.yml up -d
# Tests production environment locally
```

### Production (Kubernetes/Docker Swarm/Render)

```bash
docker build -t registry.example.com/gadwebdev:latest .
docker push registry.example.com/gadwebdev:latest
# Deploy image from registry
```

### Render.com Deployment

In `render.yaml`:
```yaml
services:
  - type: web
    image: registry.example.com/gadwebdev:${GIT_COMMIT_SHA}  # Reference built image
    envVars:
      - key: APP_ENV
        value: production
```

## Troubleshooting Guide

### Container won't start

**Check logs**:
```bash
docker-compose logs app
```

**Common issues**:
- Missing `.env` file
- Database not ready yet
- Permission denied on volumes
- Port already in use

### Application errors

**Check application logs**:
```bash
docker-compose logs app
docker-compose exec app tail -f storage/logs/laravel.log
```

### Database connection failed

**Verify connectivity**:
```bash
docker-compose exec app ping postgres
docker-compose exec app nc -zv postgres 5432
```

### Slow performance (Mac/Windows)

**Reduce volume mount overhead**:
- Use named volumes for vendor, node_modules
- Consider Docker Desktop settings: CPU, memory limits

### Out of disk space

**Clean up Docker**:
```bash
docker system prune -a --volumes
```

## Security Considerations

### Production Hardening

1. **Environment Variables**: Never commit `.env` with real values
2. **Image Scanning**: `docker scan gadwebdev:latest`
3. **Read-only filesystem**: Add `read_only: true` to services
4. **User**: Run as non-root user instead of `www-data`
5. **Secrets Management**: Use Docker Secrets or external secret providers

### Network Security

1. **No external port exposure** for databases
2. **Nginx only public interface**
3. **Internal Docker network** for inter-service communication
4. **SSL/TLS certificates** via reverse proxy (Traefik, Let's Encrypt)

## Advanced Topics

### Custom Build Arguments

```dockerfile
ARG PHP_VERSION=8.2
FROM php:${PHP_VERSION}-fpm-alpine
```

Build with: `docker build --build-arg PHP_VERSION=8.1 .`

### Docker Health Checks

Monitor container health:
```yaml
healthcheck:
  test: ["CMD", "wget", "--quiet", "--tries=1", "--spider", "http://localhost:9000/"]
  interval: 30s
  timeout: 3s
  retries: 3
  start_period: 5s
```

### Resource Limits

Prevent containers from consuming all resources:
```yaml
services:
  app:
    deploy:
      resources:
        limits:
          cpus: '1'
          memory: 512M
        reservations:
          cpus: '0.5'
          memory: 256M
```

## References

- [Docker Documentation](https://docs.docker.com/)
- [Docker Compose Specification](https://docs.docker.com/compose/compose-file/)
- [PHP Docker Official Images](https://hub.docker.com/_/php)
- [PostgreSQL Docker Official Image](https://hub.docker.com/_/postgres)
- [Nginx Docker Official Image](https://hub.docker.com/_/nginx)
