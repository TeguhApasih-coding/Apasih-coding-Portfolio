#!/bin/bash

echo "========================================="
echo "🚀 RAILWAY STARTUP SCRIPT - FIXED VERSION"
echo "========================================="
echo "Timestamp: $(date)"
echo ""

# ============================================
# STEP 1: Fix Storage Link
# ============================================
echo "📁 STEP 1: Fixing storage link..."
echo "-----------------------------------------"

# Hapus link yang salah jika ada
if [ -L "public/storage" ]; then
    CURRENT_TARGET=$(readlink public/storage)
    echo "Current symlink: public/storage -> $CURRENT_TARGET"
    
    if [ "$CURRENT_TARGET" != "/app/storage/app/public" ] && [ "$CURRENT_TARGET" != "$(pwd)/storage/app/public" ]; then
        echo "Removing incorrect symlink..."
        unlink public/storage
    else
        echo "Symlink is correct."
    fi
elif [ -d "public/storage" ] && [ ! -L "public/storage" ]; then
    echo "public/storage is a directory, renaming..."
    mv public/storage public/storage_backup_$(date +%Y%m%d_%H%M%S)
fi

# Jalankan storage link fixer
php storage-link.php

# ============================================
# STEP 2: Run Database Migrations
# ============================================
echo ""
echo "🗄️  STEP 2: Running database migrations..."
echo "-----------------------------------------"
php artisan migrate --force

# ============================================
# STEP 3: Cache Configurations
# ============================================
echo ""
echo "⚙️  STEP 3: Caching configurations..."
echo "-----------------------------------------"
php artisan config:cache
php artisan route:cache
php artisan view:cache

# ============================================
# STEP 4: Set Permissions
# ============================================
echo ""
echo "🔐 STEP 4: Setting permissions..."
echo "-----------------------------------------"
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod -R 775 public/storage 2>/dev/null || true

# ============================================
# STEP 5: Create Debug Info
# ============================================
echo ""
echo "🔍 STEP 5: Creating debug info..."
echo "-----------------------------------------"

# Buat file debug info
cat > public/storage-debug.json << EOF
{
  "timestamp": "$(date -Iseconds)",
  "storage_link": "$(ls -la public/storage 2>&1)",
  "storage_contents": $(php -r "print_r(json_encode(scandir('public/storage')));" 2>/dev/null || echo '"Error scanning"'),
  "thumbnails": $(php -r "print_r(json_encode(array_slice(scandir('public/storage/projects/thumbnails'), 0, 10)));" 2>/dev/null || echo '"No thumbnails"')
}
EOF

echo "Debug info saved to public/storage-debug.json"

# ============================================
# STEP 6: Start Application
# ============================================
echo ""
echo "========================================="
echo "✅ STARTUP COMPLETE"
echo "========================================="
echo ""
echo "🚀 Starting Laravel application..."

# Jalankan aplikasi
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
