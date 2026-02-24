web: vendor/bin/heroku-php-apache2 public/
release: php artisan migrate:fresh --force --seed && php artisan config:cache && php artisan route:cache
