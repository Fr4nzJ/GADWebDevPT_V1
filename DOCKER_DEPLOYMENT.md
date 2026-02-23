# Docker Deployment Guide

## Overview

This project includes Docker configuration for deployments to various platforms:

- **Local Development**: `docker-compose.yml`
- **Local Staging**: `docker-compose.prod.yml`
- **Render.com**: Native PHP or Docker option
- **AWS ECS/Fargate**: ECR registry required
- **Kubernetes**: `kubectl` and cluster required
- **Docker Swarm**: `docker stack` commands

---

## Deployment Options

### Option 1: Render.com (Recommended)

#### A. Using Native Render Runtime (Current Setup)

Your project is already configured with `render.yaml` for native PHP support.

```bash
# Push code to GitHub
git push origin main

# Render automatically deploys when you push
```

#### B. Using Docker on Render.com

Create Docker image and push to registry:

```bash
# Build image
docker build -t gadwebdev:latest .

# Push to Docker Hub (free tier available)
docker tag gadwebdev:latest your-username/gadwebdev:latest
docker push your-username/gadwebdev:latest

# In render.yaml, reference Docker image:
services:
  - type: web
    image: docker.io/your-username/gadwebdev:latest
    envVars:
      - key: APP_ENV
        value: production
```

---

### Option 2: AWS Deployment

#### Using AWS ECR (Elastic Container Registry)

```bash
# 1. Create ECR repository
aws ecr create-repository --repository-name gadwebdev

# 2. Get login credentials
aws ecr get-login-password --region us-east-1 | \
  docker login --username AWS --password-stdin \
  123456789012.dkr.ecr.us-east-1.amazonaws.com

# 3. Tag image
docker tag gadwebdev:latest \
  123456789012.dkr.ecr.us-east-1.amazonaws.com/gadwebdev:latest

# 4. Push to ECR
docker push 123456789012.dkr.ecr.us-east-1.amazonaws.com/gadwebdev:latest

# 5. Deploy to ECS/Fargate using AWS Console or CLI
aws ecs create-service \
  --cluster gadwebdev-cluster \
  --service-name gadwebdev \
  --task-definition gadwebdev \
  --launch-type FARGATE
```

---

### Option 3: Kubernetes Deployment

#### Prerequisites
- Kubernetes cluster running
- `kubectl` configured
- Docker image pushed to registry

#### Create Kubernetes manifests:

**kubernetes/namespace.yml**
```yaml
apiVersion: v1
kind: Namespace
metadata:
  name: gadwebdev
```

**kubernetes/deployment.yml**
```yaml
apiVersion: apps/v1
kind: Deployment
metadata:
  name: gadwebdev
  namespace: gadwebdev
spec:
  replicas: 2
  selector:
    matchLabels:
      app: gadwebdev
  template:
    metadata:
      labels:
        app: gadwebdev
    spec:
      containers:
      - name: app
        image: your-registry/gadwebdev:latest
        ports:
        - containerPort: 9000
        env:
        - name: APP_ENV
          value: "production"
        - name: DB_HOST
          value: "postgres-service"
        livenessProbe:
          httpGet:
            path: /
            port: 9000
          initialDelaySeconds: 10
          periodSeconds: 10
        readinessProbe:
          httpGet:
            path: /
            port: 9000
          initialDelaySeconds: 5
          periodSeconds: 5
```

**kubernetes/service.yml**
```yaml
apiVersion: v1
kind: Service
metadata:
  name: gadwebdev-service
  namespace: gadwebdev
spec:
  selector:
    app: gadwebdev
  ports:
  - protocol: TCP
    port: 80
    targetPort: 9000
  type: LoadBalancer
```

#### Deploy:
```bash
kubectl apply -f kubernetes/namespace.yml
kubectl apply -f kubernetes/deployment.yml
kubectl apply -f kubernetes/service.yml

# Check status
kubectl get pods -n gadwebdev
kubectl logs -n gadwebdev -l app=gadwebdev -f
```

---

### Option 4: Docker Swarm

#### Prerequisites
- Docker Swarm initialized
- Nodes joined to swarm
- Image pushed to registry accessible by all nodes

#### Deploy stack:

```bash
# Create stack from docker-compose.yml
docker stack deploy -c docker-compose.yml gadwebdev

# Check services
docker service ls

# View logs
docker service logs gadwebdev_app

# Scale service
docker service scale gadwebdev_app=3

# Update image
docker service update --image your-registry/gadwebdev:new-version gadwebdev_app

# Remove stack
docker stack rm gadwebdev
```

---

### Option 5: GitHub Container Registry

#### Setup:
```bash
# Authenticate with GitHub
echo ${{ secrets.GITHUB_TOKEN }} | docker login ghcr.io -u USERNAME --password-stdin

# Tag image
docker tag gadwebdev:latest ghcr.io/your-username/gadwebdev:latest

# Push
docker push ghcr.io/your-username/gadwebdev:latest

# Pull from other systems
docker pull ghcr.io/your-username/gadwebdev:latest
```

---

### Option 6: Docker Hub

#### Setup:
```bash
# Create account at hub.docker.com

# Login
docker login

# Tag image
docker tag gadwebdev:latest your-username/gadwebdev:latest

# Push
docker push your-username/gadwebdev:latest

# Public image, anyone can pull
docker pull your-username/gadwebdev:latest
```

---

## Production Checklist

### Before Deploying

- [ ] Update `APP_KEY` in production environment
- [ ] Set `APP_DEBUG=false`
- [ ] Configure production database credentials
- [ ] Set up Redis instance for caching
- [ ] Configure proper logging (LOG_CHANNEL=stderr)
- [ ] Enable HTTPS/SSL
- [ ] Set `CACHE_DRIVER=redis` for performance
- [ ] Configure email service (not Mailhog)
- [ ] Set up database backups
- [ ] Configure monitoring and alerts
- [ ] Enable health checks
- [ ] Set resource limits (CPU, memory)

### Scaling Considerations

```bash
# Scale horizontally (more containers)
docker service scale gadwebdev_app=5

# OR in Kubernetes
kubectl scale deployment gadwebdev --replicas=5

# Load balancing is automatic across containers
```

### Monitoring

```bash
# Container logs
docker logs <container-id> -f

# Container stats
docker stats <container-id>

# Application logs
docker exec <container-id> tail -f storage/logs/laravel.log

# Database logs
docker logs <postgres-container> -f
```

---

## Database Migration Strategy

### Automatic (Recommended)

Set `RUN_MIGRATIONS=true` in environment:
```bash
# Migrations run automatically on container startup
docker-compose up -d
```

### Manual

```bash
# Run migrations manually
docker-compose exec app php artisan migrate

# Rollback
docker-compose exec app php artisan migrate:rollback

# Refresh database
docker-compose exec app php artisan migrate:fresh --seed
```

### Blue-Green Deployment

For zero-downtime migrations:

```bash
# 1. Deploy new version (old version still running)
docker service update --image new-image gadwebdev_app

# 2. Run migrations manually
docker exec container php artisan migrate

# 3. Both versions running temporarily
# 4. Old version terminates after health check passes
```

---

## Backup Strategy

### Database Backups

```bash
# Backup PostgreSQL
docker-compose exec postgres pg_dump -U postgres gadwebdev_local > backup.sql

# Restore from backup
docker-compose exec -T postgres psql -U postgres gadwebdev_local < backup.sql

# Backup volume (storage)
docker run --rm -v gadwebdev_postgres_data:/data \
  -v $(pwd):/backup \
  alpine tar czf /backup/db-backup.tar.gz /data
```

### Application Backups

```bash
# Backup storage directory
tar -czf storage-backup.tar.gz storage/

# Restore
tar -xzf storage-backup.tar.gz
```

---

## Security Best Practices

### Image Security

```bash
# Scan image for vulnerabilities
docker scan gadwebdev:latest

# Use specific versions (not 'latest')
FROM php:8.2-fpm-alpine  # ✓ Good
FROM php:latest          # ✗ Bad

# Minimize image size
# Use Alpine Linux, multi-stage builds
```

### Runtime Security

```bash
# Don't run as root
RUN useradd -m www-data
USER www-data

# Read-only filesystem
docker run --read-only gadwebdev:latest

# Drop capabilities
docker run --cap-drop=ALL --cap-add=NET_BIND_SERVICE gadwebdev:latest

# Resource limits
docker run --memory=512m --cpus=1 gadwebdev:latest
```

### Secrets Management

```bash
# Use Docker Secrets (Swarm mode)
echo "password123" | docker secret create db_password -

# Reference in compose:
# environment:
#   DB_PASSWORD_FILE: /run/secrets/db_password

# OR use environment variable files
# docker run --env-file .env.prod gadwebdev:latest
```

---

## Troubleshooting Deployments

### Container won't start
```bash
# Check logs
docker logs <container-id>

# Check image size
docker images

# Inspect image
docker inspect <image-id>
```

### Slow performance
```bash
# Check resource usage
docker stats

# Check network
docker network ls
docker network inspect <network-id>

# Increase resources
docker update --memory=1g --cpus=2 <container-id>
```

### Database connection issues
```bash
# Verify connectivity
docker exec <app-container> nc -zv postgres 5432

# Check environment variables
docker inspect <container-id> | grep -i db_

# Test connection
docker exec <app-container> php artisan tinker
# In tinker: DB::connection()->select('SELECT 1')
```

---

## Continuous Deployment (CD)

### GitHub Actions CI/CD

See `.github/workflows/docker-build-test.yml` for automated:
1. Build on push
2. Run tests
3. Push to registry
4. Deploy to production

### Manual Deployment

```bash
# 1. Build
docker build -t gadwebdev:production .

# 2. Test locally
docker-compose -f docker-compose.prod.yml up

# 3. Tag and push
docker tag gadwebdev:production your-registry/gadwebdev:1.0
docker push your-registry/gadwebdev:1.0

# 4. Deploy to cluster
docker service update --image your-registry/gadwebdev:1.0 gadwebdev_app
```

---

## Debugging Tips

### Access container shell
```bash
docker exec -it <container-id> /bin/sh
```

### View environment
```bash
docker exec <container-id> env
```

### Run one-off command
```bash
docker run --rm <image> php artisan migrate
```

### Compare images
```bash
docker diff <container-id>  # Shows changes
```

---

## Performance Optimization

### Build optimization
```bash
# Use BuildKit for faster builds
DOCKER_BUILDKIT=1 docker build .

# Cache layers
# Put frequently changing commands near end of Dockerfile
```

### Runtime optimization
```yaml
# Resource allocation
deploy:
  resources:
    limits:
      cpus: '1'
      memory: 512M
    reservations:
      cpus: '0.5'
      memory: 256M
```

### Caching strategy
```bash
# Use Redis for all caching
CACHE_DRIVER=redis
SESSION_DRIVER=redis
```

---

For questions, see [DOCKER_ARCHITECTURE.md](./DOCKER_ARCHITECTURE.md) for detailed technical information.
