web: vendor/bin/heroku-php-apache2 public/
worker: php artisan queue:work --sleep=3 --tries=3 --timeout=300
release: php artisan config:clear && php artisan cache:clear && php artisan migrate:fresh --force --seed && php artisan config:cache && php artisan route:cache
