#!/bin/bash

# Auto-deployment script for EC2
# This script pulls latest code from GitHub and updates the application

echo "🚀 Starting auto-deployment..."

# Navigate to project directory
cd /var/www/laravel

# Pull latest changes from GitHub
echo "📥 Pulling latest code from GitHub..."
git pull origin main

# Install/update composer dependencies
echo "📦 Installing composer dependencies..."
composer install --no-dev --optimize-autoloader

# Install/update npm dependencies and build assets
echo "🔨 Building frontend assets..."
npm install
npm run build

# Clear Laravel caches
echo "🧹 Clearing Laravel caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache

# Set proper permissions
echo "🔐 Setting proper permissions..."
sudo chown -R www-data:www-data /var/www/laravel
sudo chmod -R 755 /var/www/laravel/storage
sudo chmod -R 755 /var/www/laravel/bootstrap/cache
sudo touch /var/www/laravel/storage/logs/laravel.log
sudo chown apache:apache /var/www/laravel/storage/logs/laravel.log
sudo chmod 664 /var/www/laravel/storage/logs/laravel.log

# Restart services if needed
echo "🔄 Restarting services..."
sudo systemctl restart nginx
sudo systemctl restart php-fpm

echo "✅ Deployment completed successfully!"
