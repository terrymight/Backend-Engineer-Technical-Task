#!/bin/sh

echo "Clearing config cache..."
php artisan optimize:clear

echo "Running migrations..."
php artisan migrate --force

echo "Installing Passport keys..."
php artisan passport:install --force

echo "Starting PHP-FPM..."
php-fpm

echo "Starting passport..."
php artisan passport:client --personal --provider=users
