<?php
// Script untuk menyalin files dari storage/app/public ke public/storage
// Jalankan script ini melalui browser ketika ada file baru yang perlu disinkronkan

// Hanya bisa dijalankan dengan password
$password = 'boasfarconvert123';

// Cek password
if (!isset($_GET['key']) || $_GET['key'] !== $password) {
    http_response_code(403);
    die('Akses Ditolak');
}

// Path
$source = __DIR__ . '/../storage/app/public';
$destination = __DIR__ . '/storage';

// Buat directory jika belum ada
if (!file_exists($destination)) {
    mkdir($destination, 0755, true);
}

// Fungsi untuk menyalin direktori
function copyDirectory($source, $destination) {
    $success = true;
    $errors = [];
    $files_copied = 0;
    
    // Buat directory tujuan jika belum ada
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }
    
    // Handle jika source tidak ada
    if (!is_dir($source)) {
        return [
            'success' => false,
            'errors' => ["Source directory does not exist: $source"],
            'files_copied' => 0
        ];
    }

    // Open source directory
    $dir = opendir($source);
    
    // Copy semua file
    while (($file = readdir($dir)) !== false) {
        if ($file == '.' || $file == '..') {
            continue;
        }
        
        $srcPath = $source . DIRECTORY_SEPARATOR . $file;
        $destPath = $destination . DIRECTORY_SEPARATOR . $file;
        
        if (is_dir($srcPath)) {
            // Rekursif untuk subdirektori
            $result = copyDirectory($srcPath, $destPath);
            if (!$result['success']) {
                $success = false;
                $errors = array_merge($errors, $result['errors']);
            }
            $files_copied += $result['files_copied'];
        } else {
            try {
                if (copy($srcPath, $destPath)) {
                    chmod($destPath, fileperms($srcPath));
                    $files_copied++;
                } else {
                    $success = false;
                    $errors[] = "Failed to copy file: $srcPath";
                }
            } catch (Exception $e) {
                $success = false;
                $errors[] = "Error copying file $srcPath: " . $e->getMessage();
            }
        }
    }
    
    closedir($dir);
    
    return [
        'success' => $success,
        'errors' => $errors,
        'files_copied' => $files_copied
    ];
}

// Jalankan sinkronisasi
$result = copyDirectory($source, $destination);

// Output hasil
echo "<h1>Storage Sync Result</h1>";

if ($result['success']) {
    echo "<p style='color:green'>Success! {$result['files_copied']} files copied.</p>";
} else {
    echo "<p style='color:red'>Errors occurred during synchronization:</p>";
    echo "<ul>";
    foreach ($result['errors'] as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo "<p>{$result['files_copied']} files were successfully copied.</p>";
}

// Tampilkan struktur folder
echo "<h2>Struktur Folder Public/Storage:</h2>";
function displayDirectoryStructure($dir, $indent = 0) {
    if (!is_dir($dir)) {
        echo "<p style='color:red'>Directory not found: $dir</p>";
        return;
    }
    
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;
        
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        echo str_repeat('&nbsp;&nbsp;', $indent) . "- ";
        
        if (is_dir($path)) {
            echo "<strong>$file/</strong><br>";
            displayDirectoryStructure($path, $indent + 1);
        } else {
            echo "$file<br>";
        }
    }
}

displayDirectoryStructure($destination);
?> 