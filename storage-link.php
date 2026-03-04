<?php

/**
 * File: storage-link.php
 * Location: root directory (sejajar dengan artisan)
 * Function: Membuat symlink storage untuk Railway
 * 
 * Cara menjalankan:
 * php storage-link.php
 */

echo "===== STORAGE LINK CREATOR FOR RAILWAY =====\n\n";

// Path target (folder storage yang sebenarnya)
$target = __DIR__ . '/storage/app/public';
// Path link (yang akan diakses melalui web)
$link = __DIR__ . '/public/storage';

echo "Target path: " . $target . "\n";
echo "Link path: " . $link . "\n\n";

// Cek apakah target folder exists
if (!is_dir($target)) {
    echo "ERROR: Target folder does not exist!\n";
    echo "Creating target folder...\n";
    
    // Buat folder target jika belum ada
    if (!is_dir(__DIR__ . '/storage/app')) {
        mkdir(__DIR__ . '/storage/app', 0755, true);
    }
    
    if (!is_dir($target)) {
        mkdir($target, 0755, true);
        echo "Target folder created.\n";
    }
}

// Cek apakah link sudah ada
if (file_exists($link)) {
    echo "Link path already exists.\n";
    
    if (is_link($link)) {
        // Jika sudah symlink, hapus dulu
        $target_exists = file_exists(readlink($link));
        echo "Current symlink points to: " . readlink($link) . "\n";
        echo "Target exists: " . ($target_exists ? 'YES' : 'NO') . "\n";
        
        if ($target_exists && readlink($link) === $target) {
            echo "Symlink already exists and points to correct target.\n";
            echo "No action needed.\n";
            exit(0);
        }
        
        echo "Removing old symlink...\n";
        unlink($link);
    } else {
        // Jika bukan symlink (misalnya folder biasa), rename dulu
        $backup_name = $link . '_backup_' . date('Ymd_His');
        echo "Path exists but is not a symlink. Renaming to: " . $backup_name . "\n";
        rename($link, $backup_name);
    }
}

// Buat symlink baru
echo "\nCreating new symlink...\n";

if (symlink($target, $link)) {
    echo "✅ SUCCESS: Storage link created successfully!\n";
} else {
    echo "❌ ERROR: Failed to create symlink using symlink() function.\n";
    
    // Coba metode alternatif dengan exec()
    if (function_exists('exec')) {
        echo "Trying alternative method using exec()...\n";
        
        $command = 'ln -s ' . escapeshellarg($target) . ' ' . escapeshellarg($link);
        exec($command, $output, $return_var);
        
        if ($return_var === 0) {
            echo "✅ SUCCESS: Storage link created using exec()!\n";
        } else {
            echo "❌ ERROR: Also failed using exec(). Return code: " . $return_var . "\n";
            echo "Output: " . implode("\n", $output) . "\n";
            
            // Metode terakhir: copy folder sebagai fallback
            echo "\nTrying fallback method: copying files...\n";
            
            if (!is_dir($link)) {
                mkdir($link, 0755, true);
            }
            
            // Function to copy directory recursively
            function copyDir($src, $dst) {
                $dir = opendir($src);
                @mkdir($dst, 0755, true);
                
                while(false !== ($file = readdir($dir))) {
                    if (($file != '.') && ($file != '..')) {
                        if (is_dir($src . '/' . $file)) {
                            copyDir($src . '/' . $file, $dst . '/' . $file);
                        } else {
                            copy($src . '/' . $file, $dst . '/' . $file);
                        }
                    }
                }
                closedir($dir);
            }
            
            copyDir($target, $link);
            echo "✅ SUCCESS: Files copied to public/storage as fallback.\n";
            echo "⚠️  NOTE: This is not a symlink, changes in storage won't auto-reflect.\n";
        }
    } else {
        echo "❌ ERROR: exec() function is disabled.\n";
    }
}

// Verifikasi hasil
echo "\n===== VERIFICATION =====\n";

if (file_exists($link)) {
    echo "✅ Link path exists.\n";
    
    if (is_link($link)) {
        echo "✅ It is a valid symlink.\n";
        echo "   Points to: " . readlink($link) . "\n";
    } else {
        echo "⚠️  It is NOT a symlink (regular file/directory).\n";
    }
    
    // Cek isi directory
    $files = scandir($link);
    $file_count = count($files) - 2; // Kurangi . dan ..
    echo "📁 Directory contains: " . $file_count . " items\n";
    
    if ($file_count > 0) {
        echo "   Sample: " . implode(', ', array_slice(array_diff($files, ['.', '..']), 0, 5)) . "\n";
    }
} else {
    echo "❌ ERROR: Link path does not exist after creation attempts.\n";
}

echo "\n===== DONE =====\n";
