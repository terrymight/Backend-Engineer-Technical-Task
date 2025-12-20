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

echo "Fixing Passport key permissions..."
chown www-data:www-data storage/oauth-private.key storage/oauth-public.key
chmod 600 storage/oauth-private.key
chmod 600 storage/oauth-public.key

echo "Starting PHP-FPM..."
php-fpm &

echo "Starting Nginx..."
nginx -g "daemon off;"
1