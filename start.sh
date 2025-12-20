#!/bin/sh
set -e

echo "Fixing storage permissions..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "Clearing Laravel caches..."
php artisan optimize:clear

echo "Running migrations..."
php artisan migrate --force --no-interaction

echo "Installing Passport keys..."
php artisan passport:install --force --no-interaction

echo "Verifying Passport keys..."
ls -l storage/oauth-*.key

echo "Starting PHP-FPM..."
php-fpm &

echo "Starting Nginx..."
nginx -g "daemon off;"
