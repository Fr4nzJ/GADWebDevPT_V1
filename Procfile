web: vendor/bin/heroku-php-apache2 public/
worker: php artisan queue:work --sleep=3 --tries=3 --timeout=300
release: php artisan migrate:fresh --force --seed && php artisan view:clear && php artisan config:cache && php artisan route:cache
