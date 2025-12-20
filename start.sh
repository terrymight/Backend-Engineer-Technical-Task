#!/bin/sh

echo "Clearing config cache..."
php artisan optimize:clear

echo "Running migrations..."
php artisan migrate --force

echo "Installing Passport keys..."
php artisan passport:install --force --no-interaction

echo "Starting passport..."
php artisan passport:client --personal --provider=users
