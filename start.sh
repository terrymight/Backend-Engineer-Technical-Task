#!/bin/sh
set -e

echo "Clearing Laravel caches..."
php artisan optimize:clear

echo "Running database migrations..."
php artisan migrate --force --no-interaction

echo "Installing Passport keys..."
php artisan passport:install --force --no-interaction

echo "Ensuring Passport personal access client exists..."
php artisan passport:client \
  --personal \
  --provider=users \
  --name="Personal Access Client" \
  --no-interaction || true

echo "Starting PHP-FPM..."
php-fpm &

echo "Starting Nginx..."
nginx -g "daemon off;"
