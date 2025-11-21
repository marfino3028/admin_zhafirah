<?php
session_start();

// Cek session - support both rg_user (dari login.php) dan id_user
if (!isset($_SESSION['rg_user']) && !isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}

// Include database connection DULU (sudah ada $db di dalamnya)
require_once '3rdparty/engine.php';

// Make $db available globally
global $db;

// Baru include header (yang butuh $_SESSION)
include 'header.php';

// Get page parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'depan';

// Security: prevent directory traversal
$page = str_replace(['../', '..\\'], '', $page);
$page = preg_replace('/[^a-zA-Z0-9_\/]/', '', $page);

// No routing aliases needed - direct file paths

// Build file path
$file_path = 'pages/' . $page . '.php';

// Try to load the page
if (file_exists($file_path)) {
    include $file_path;
} else {
    echo '<div class="alert alert-danger">';
    echo '<i class="fas fa-exclamation-triangle"></i> ';
    echo 'Halaman tidak ditemukan: ' . htmlspecialchars($page);
    echo '<br><small>Path: ' . htmlspecialchars($file_path) . '</small>';
    echo '</div>';
    
    // Debug info (comment out in production)
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
        echo '<div class="alert alert-info">';
        echo '<strong>Debug Info:</strong><br>';
        echo 'Original page param: ' . htmlspecialchars($_GET['page'] ?? 'depan') . '<br>';
        echo 'Processed page: ' . htmlspecialchars($page) . '<br>';
        echo 'Looking for file: ' . htmlspecialchars($file_path);
        echo '</div>';
    }
}

include 'footer.php';
?>
