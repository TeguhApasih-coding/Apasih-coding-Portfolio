<?php

/**
 * File: storage-link.php
 * Location: root directory
 * Function: Memperbaiki storage link untuk Railway
 */

echo "===== STORAGE LINK FIXER FOR RAILWAY =====\n\n";

$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

echo "Target path: " . $target . "\n";
echo "Link path: " . $link . "\n\n";

// Cek apakah target folder ada
if (!is_dir($target)) {
    echo "❌ Target folder does not exist. Creating...\n";
    mkdir($target, 0755, true);
    echo "✅ Target folder created.\n";
} else {
    echo "✅ Target folder exists.\n";
}

// Cek apakah link sudah ada
if (file_exists($link)) {
    echo "⚠️  Link path already exists.\n";
    
    if (is_link($link)) {
        // Jika symlink, cek targetnya
        $currentTarget = readlink($link);
        echo "   Current symlink points to: " . $currentTarget . "\n";
        
        if ($currentTarget === $target) {
            echo "✅ Symlink already points to correct target.\n";
        } else {
            echo "⚠️  Symlink points to wrong target. Fixing...\n";
            unlink($link);
            echo "   Old symlink removed.\n";
            
            if (symlink($target, $link)) {
                echo "✅ New symlink created successfully.\n";
            } else {
                echo "❌ Failed to create new symlink.\n";
            }
        }
    } else {
        // Jika bukan symlink (folder biasa atau file)
        echo "⚠️  Path exists but is not a symlink.\n";
        
        // Backup folder yang ada
        $backupPath = $link . '_backup_' . date('Ymd_His');
        echo "   Renaming to: " . $backupPath . "\n";
        
        if (rename($link, $backupPath)) {
            echo "   Backup created.\n";
            
            // Buat symlink baru
            if (symlink($target, $link)) {
                echo "✅ Symlink created successfully.\n";
            } else {
                echo "❌ Failed to create symlink.\n";
                
                // Restore backup jika gagal
                rename($backupPath, $link);
                echo "   Backup restored.\n";
            }
        } else {
            echo "❌ Failed to rename existing path.\n";
        }
    }
} else {
    // Link tidak ada, buat baru
    echo "Link path does not exist. Creating...\n";
    
    if (symlink($target, $link)) {
        echo "✅ Symlink created successfully.\n";
    } else {
        echo "❌ Failed to create symlink.\n";
        
        // Fallback: copy folder
        echo "   Using fallback: copying files...\n";
        
        // Hapus folder link jika ada
        if (is_dir($link)) {
            // Function to delete directory recursively
            function deleteDir($dir) {
                if (!is_dir($dir)) {
                    return;
                }
                $files = array_diff(scandir($dir), array('.', '..'));
                foreach ($files as $file) {
                    $path = $dir . '/' . $file;
                    is_dir($path) ? deleteDir($path) : unlink($path);
                }
                rmdir($dir);
            }
            deleteDir($link);
        }
        
        // Buat folder baru
        mkdir($link, 0755, true);
        
        // Function to copy directory recursively
        function copyDir($src, $dst) {
            if (!is_dir($src)) {
                return;
            }
            
            $dir = opendir($src);
            if (!$dir) {
                return;
            }
            
            // Buat folder tujuan jika belum ada
            if (!is_dir($dst)) {
                mkdir($dst, 0755, true);
            }
            
            // Copy semua file dan folder
            while (($file = readdir($dir)) !== false) {
                if ($file != '.' && $file != '..') {
                    $srcPath = $src . '/' . $file;
                    $dstPath = $dst . '/' . $file;
                    
                    if (is_dir($srcPath)) {
                        // Recursive copy untuk folder
                        copyDir($srcPath, $dstPath);
                    } else {
                        // Copy file
                        copy($srcPath, $dstPath);
                    }
                }
            }
            closedir($dir);
        }
        
        // Jalankan copy
        copyDir($target, $link);
        echo "✅ Files copied as fallback.\n";
        
        // Set permissions
        chmod($link, 0755);
    }
}

// Verifikasi hasil
echo "\n===== VERIFICATION =====\n";

if (file_exists($link)) {
    echo "✅ Link path exists.\n";
    
    if (is_link($link)) {
        echo "✅ It is a symlink.\n";
        echo "   Points to: " . readlink($link) . "\n";
    } else {
        echo "⚠️  It is NOT a symlink (regular directory).\n";
    }
    
    // Cek apakah bisa mengakses file
    $testFile = $link . '/.gitignore';
    if (file_exists($testFile)) {
        echo "✅ Can access files in storage.\n";
    } else {
        echo "⚠️  Cannot access .gitignore file.\n";
        
        // List files di folder public/storage
        if (is_dir($link)) {
            $files = scandir($link);
            $visibleFiles = array_diff($files, ['.', '..']);
            
            if (count($visibleFiles) > 0) {
                echo "   Files in link: " . implode(', ', array_slice($visibleFiles, 0, 5)) . "\n";
                
                // Cek folder projects
                if (is_dir($link . '/projects')) {
                    echo "   Found 'projects' folder.\n";
                    
                    // Cek folder thumbnails
                    if (is_dir($link . '/projects/thumbnails')) {
                        echo "   Found 'thumbnails' folder.\n";
                        
                        $thumbFiles = scandir($link . '/projects/thumbnails');
                        $thumbVisible = array_diff($thumbFiles, ['.', '..']);
                        echo "   Thumbnails count: " . count($thumbVisible) . "\n";
                        
                        if (count($thumbVisible) > 0) {
                            echo "   Sample thumbnails: " . implode(', ', array_slice($thumbVisible, 0, 3)) . "\n";
                        }
                    }
                }
            } else {
                echo "   Link directory is empty!\n";
            }
        }
    }
} else {
    echo "❌ Link path does not exist.\n";
}

// Cek file spesifik yang bermasalah
$specificFile = 'projects/thumbnails/ZtdS4gsrvXWHAUalTi5NetHNeGt1z7EPpjK1raX4.png';
$targetFile = $target . '/' . $specificFile;
$linkFile = $link . '/' . $specificFile;

echo "\n===== CHECKING SPECIFIC FILE =====\n";
echo "File: " . $specificFile . "\n";
echo "Target exists: " . (file_exists($targetFile) ? '✅ YES' : '❌ NO') . "\n";
echo "Link exists: " . (file_exists($linkFile) ? '✅ YES' : '❌ NO') . "\n";

if (file_exists($targetFile)) {
    echo "Target file size: " . filesize($targetFile) . " bytes\n";
    echo "Target file permissions: " . substr(sprintf('%o', fileperms($targetFile)), -4) . "\n";
}

if (file_exists($linkFile)) {
    echo "Link file size: " . filesize($linkFile) . " bytes\n";
    echo "Link file permissions: " . substr(sprintf('%o', fileperms($linkFile)), -4) . "\n";
}

echo "\n===== DONE =====\n";
