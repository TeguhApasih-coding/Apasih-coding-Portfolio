#!/bin/bash

# ============================================
# RAILWAY STARTUP SCRIPT
# ============================================
# Script ini akan dijalankan setiap kali aplikasi di-start
# di environment Railway

echo "========================================="
echo "🚀 RAILWAY STARTUP SCRIPT"
echo "========================================="
echo "Timestamp: $(date)"
echo "Current directory: $(pwd)"
echo ""

# ============================================
# STEP 1: Setup Storage Link
# ============================================
echo "📁 STEP 1: Setting up storage link..."
echo "-----------------------------------------"

# Cek apakah file storage-link.php ada
if [ -f "storage-link.php" ]; then
    echo "Found storage-link.php, executing..."
    php storage-link.php
else
    echo "storage-link.php not found, using artisan storage:link"
    
    # Coba dengan artisan storage:link
    php artisan storage:link
    
    # Jika gagal, buat manual
    if [ $? -ne 0 ]; then
        echo "Artisan storage:link failed, creating symlink manually..."
        
        TARGET="/app/storage/app/public"
        LINK="/app/public/storage"
        
        # Hapus jika sudah ada
        if [ -L "$LINK" ]; then
            unlink "$LINK"
        elif [ -d "$LINK" ]; then
            rm -rf "$LINK"
        fi
        
        # Buat symlink
        ln -s "$TARGET" "$LINK"
        
        if [ $? -eq 0 ]; then
            echo "✅ Manual symlink created successfully"
        else
            echo "❌ Failed to create symlink"
            
            # Fallback: copy folder
            echo "Using fallback: copying files..."
            mkdir -p "$LINK"
            cp -r "$TARGET"/. "$LINK/"
            echo "✅ Files copied as fallback"
        fi
    fi
fi

echo ""

# ============================================
# STEP 2: Run Database Migrations
# ============================================
echo "🗄️  STEP 2: Running database migrations..."
echo "-----------------------------------------"
php artisan migrate --force
echo ""

# ============================================
# STEP 3: Clear and Cache Configurations
# ============================================
echo "⚙️  STEP 3: Caching configurations..."
echo "-----------------------------------------"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
echo ""

# ============================================
# STEP 4: Check Storage Permissions
# ============================================
echo "🔐 STEP 4: Setting storage permissions..."
echo "-----------------------------------------"
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod -R 775 public/storage
echo "✅ Permissions set"
echo ""

# ============================================
# STEP 5: Verify Setup
# ============================================
echo "🔍 STEP 5: Verifying setup..."
echo "-----------------------------------------"

# Cek storage link
if [ -L "public/storage" ]; then
    echo "✅ Storage link: OK (symlink)"
    ls -la public/storage | head -3
elif [ -d "public/storage" ]; then
    echo "⚠️  Storage link: OK (directory copy)"
    ls -la public/storage | head -3
else
    echo "❌ Storage link: NOT FOUND"
fi

# Cek environment
echo ""
echo "🌍 Environment: $APP_ENV"
echo "🔗 App URL: $APP_URL"

echo ""
echo "========================================="
echo "✅ STARTUP COMPLETE"
echo "========================================="

# ============================================
# STEP 6: Start the Application
# ============================================
echo ""
echo "🚀 Starting Laravel application..."
echo "========================================="

# Jalankan aplikasi (sesuai dengan port Railway)
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
