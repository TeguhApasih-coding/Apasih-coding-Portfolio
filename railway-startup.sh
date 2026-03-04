#!/bin/bash

echo "========================================="
echo "🚀 STARTING APPLICATION"
echo "========================================="

# Jalankan migration
php artisan migrate --force

# Cache config untuk performa
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Pastikan folder images memiliki permission yang benar
chmod -R 755 public/images

echo "✅ Setup complete"
echo "Starting Laravel application..."

php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
