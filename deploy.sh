#!/bin/bash

# Auto-deployment script for EC2
# This script pulls latest code from GitHub and updates the application

echo "🚀 Starting auto-deployment..."

# Navigate to project directory
cd /var/www/laravel

# Pull latest changes from GitHub
echo "📥 Pulling latest code from GitHub..."
sudo git pull origin main

# Fix git permissions
sudo chown -R ec2-user:ec2-user /var/www/laravel/.git
sudo chmod -R 755 /var/www/laravel/.git
sudo chown -R ec2-user:ec2-user /var/www/laravel

# Set proper permissions FIRST (before running any artisan commands)
echo "🔐 Setting proper permissions first..."
sudo chown -R ec2-user:ec2-user /var/www/laravel
sudo chmod -R 755 /var/www/laravel
sudo chmod -R 777 /var/www/laravel/storage
sudo chmod -R 777 /var/www/laravel/bootstrap/cache
sudo chmod -R 777 /var/www/laravel/storage/framework
sudo chmod -R 777 /var/www/laravel/storage/logs
sudo chmod -R 777 /var/www/laravel/storage/framework/views
sudo chmod -R 777 /var/www/laravel/storage/framework/sessions
sudo chmod -R 777 /var/www/laravel/storage/framework/cache

# Create cache directory structure
sudo mkdir -p /var/www/laravel/storage/framework/cache/data
sudo mkdir -p /var/www/laravel/storage/framework/cache/sessions

# Fix specific log file
sudo rm -f /var/www/laravel/storage/logs/laravel.log
sudo touch /var/www/laravel/storage/logs/laravel.log
sudo chown ec2-user:ec2-user /var/www/laravel/storage/logs/laravel.log
sudo chmod 777 /var/www/laravel/storage/logs/laravel.log

# Ensure cache directories have proper structure and permissions
sudo mkdir -p /var/www/laravel/storage/framework/cache/data/2b/51
sudo mkdir -p /var/www/laravel/storage/framework/cache/data/21/8d

# Install/update composer dependencies
echo "📦 Installing composer dependencies..."
composer install --no-dev --optimize-autoloader

# Install/update npm dependencies and build assets
echo "🔨 Building frontend assets..."
sudo chown -R ec2-user:ec2-user /var/www/laravel/node_modules
sudo npm install
sudo npm run build

# Clear Laravel caches (now with correct permissions)
echo "🧹 Clearing Laravel caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Set proper permissions for web server
echo "🔐 Setting proper permissions for nginx..."
sudo chown -R nginx:nginx /var/www/laravel
sudo chmod -R 755 /var/www/laravel
sudo chmod -R 777 /var/www/laravel/storage
sudo chmod -R 777 /var/www/laravel/bootstrap/cache
sudo chmod -R 777 /var/www/laravel/storage/framework
sudo chmod -R 777 /var/www/laravel/storage/logs
sudo chmod -R 777 /var/www/laravel/storage/framework/views
sudo chmod -R 777 /var/www/laravel/storage/framework/sessions
sudo chmod -R 777 /var/www/laravel/storage/framework/cache

# Create cache directory structure
sudo mkdir -p /var/www/laravel/storage/framework/cache/data
sudo mkdir -p /var/www/laravel/storage/framework/cache/sessions

# Fix specific log file
sudo rm -f /var/www/laravel/storage/logs/laravel.log
sudo touch /var/www/laravel/storage/logs/laravel.log
sudo chown nginx:nginx /var/www/laravel/storage/logs/laravel.log
sudo chmod 777 /var/www/laravel/storage/logs/laravel.log

# Ensure cache directories have proper structure and permissions
sudo mkdir -p /var/www/laravel/storage/framework/cache/data/2b/51
sudo mkdir -p /var/www/laravel/storage/framework/cache/data/21/8d

# Restart services if needed
echo "🔄 Restarting services..."
sudo systemctl restart nginx
sudo systemctl restart php-fpm

echo "✅ Deployment completed successfully!"
