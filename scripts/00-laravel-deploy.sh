#!/usr/bin/env bash
echo "Running Laravel deployment script"
cd /var/www/html
php artisan migrate --force
php artisan config:clear
php artisan cache:clear
php artisan view:clear
echo "Deployment complete"