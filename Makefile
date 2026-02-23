.PHONY: help up down build logs logs-app logs-nginx logs-postgres restart clean purge shell db-shell artisan tinker test npm composer migrate seed

help:
	@echo "==================================="
	@echo "GAD Website Docker Commands"
	@echo "==================================="
	@echo ""
	@echo "Getting Started:"
	@echo "  make setup              - First time setup"
	@echo "  make up                 - Start all containers"
	@echo "  make down               - Stop containers"
	@echo ""
	@echo "Logs & Debug:"
	@echo "  make logs               - View all logs"
	@echo "  make logs-app           - View app logs"
	@echo "  make logs-nginx         - View nginx logs"
	@echo "  make logs-postgres      - View postgres logs"
	@echo ""
	@echo "Container Management:"
	@echo "  make restart            - Restart containers"
	@echo "  make build              - Rebuild containers"
	@echo "  make clean              - Stop and clean containers"
	@echo "  make purge              - Remove everything (data too)"
	@echo ""
	@echo "Development:"
	@echo "  make shell              - Shell into app container"
	@echo "  make tinker             - Start Laravel tinker"
	@echo "  make artisan CMD=...    - Run artisan command"
	@echo "  make migrate            - Run migrations"
	@echo "  make seed               - Run seeders"
	@echo ""
	@echo "Database:"
	@echo "  make db-shell           - PostgreSQL shell"
	@echo ""
	@echo "Testing & Build:"
	@echo "  make test               - Run tests"
	@echo "  make npm CMD=...        - Run npm commands"
	@echo "  make composer CMD=...   - Run composer commands"
	@echo ""

# Setup
setup:
	@echo "Setting up Docker environment..."
	cp .env.docker .env
	docker-compose build
	docker-compose up -d
	docker-compose exec -T app php artisan key:generate --force
	@echo "✅ Setup complete! Access at http://localhost"

# Container control
up:
	docker-compose up -d
	@echo "✅ Containers started"

down:
	docker-compose down
	@echo "✅ Containers stopped"

build:
	docker-compose build --no-cache
	@echo "✅ Containers rebuilt"

restart:
	docker-compose restart
	@echo "✅ Containers restarted"

clean:
	docker-compose down
	@echo "✅ Containers removed"

purge:
	docker-compose down -v
	@echo "✅ Everything removed (including data)"

# Logs
logs:
	docker-compose logs -f

logs-app:
	docker-compose logs -f app

logs-nginx:
	docker-compose logs -f nginx

logs-postgres:
	docker-compose logs -f postgres

# Shell access
shell:
	docker-compose exec app /bin/sh

tinker:
	docker-compose exec app php artisan tinker

# Artisan commands
artisan:
	docker-compose exec app php artisan $(CMD)

migrate:
	docker-compose exec app php artisan migrate

seed:
	docker-compose exec app php artisan db:seed

cache-clear:
	docker-compose exec app php artisan cache:clear
	docker-compose exec app php artisan config:clear
	docker-compose exec app php artisan route:clear
	docker-compose exec app php artisan view:clear

# Database
db-shell:
	docker-compose exec postgres psql -U postgres

# Package managers
npm:
	docker-compose exec app npm $(CMD)

composer:
	docker-compose exec app composer $(CMD)

# Testing
test:
	docker-compose exec app php artisan test

# Frontend dev (requires node profile)
dev:
	docker-compose --profile dev up -d
	@echo "✅ Node development server started on http://localhost:5173"
	docker-compose logs -f node

# Cleanup dangling images and volumes
system-prune:
	docker system prune -a
	@echo "✅ Docker cleanup complete"
