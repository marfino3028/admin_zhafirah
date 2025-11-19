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

// Page routing dengan alias
$routes = [
    // Routing untuk keberangkatan
    'keberangkatan_umroh/index' => 'paket/keberangkatan',
    'keberangkatan_umroh/create' => 'paket/add_umroh',
    'keberangkatan_haji/index' => 'paket/keberangkatan_haji',
    'keberangkatan_haji/create' => 'paket/add_haji',
    
    // Routing untuk paket
    'paket/index' => 'paket/umroh',
    'paket/create' => 'paket/create',
    
    // Routing untuk pendaftaran
    'pendaftaran/index' => 'pendaftaran/umroh',
    'pendaftaran/haji' => 'pendaftaran/haji',
    'pendaftaran/create' => 'pendaftaran/create',
    
    // Routing untuk pembayaran
    'pembayaran/index' => 'pembayaran/umroh',
    'pembayaran/haji' => 'pembayaran/haji',
    'pembayaran/detail_umroh' => 'pembayaran/detail_pembayaran_umroh',
    'pembayaran/detail_haji' => 'pembayaran/detail_pembayaran_haji',
    
    // Routing untuk pengeluaran
    'pengeluaran/index' => 'pengeluaran/umroh',
    'pengeluaran/haji' => 'pengeluaran/haji',
    'pengeluaran/umum' => 'pengeluaran/umum',
    
    // Routing untuk pemasukan
    'pemasukan/index' => 'pemasukan/umum',
    
    // Routing untuk manifest
    'manifest/index' => 'manifest/umroh',
    'manifest/form_umroh' => 'manifest/form_keberangkatan_umroh',
    
    // Routing untuk jamaah
    'jamaah/index' => 'jamaah/list',
    'jamaah/create' => 'jamaah/add',
    'jamaah/add_step2' => 'jamaah/add_step2',
    
    // Routing untuk master data
    'master/hotel' => 'hotel/list',
    'master/maskapai' => 'maskapai/list',
    'master/agent' => 'agent/list',
    'master/karyawan' => 'karyawan/list',
];

// Check if route exists in alias
if (isset($routes[$page])) {
    $page = $routes[$page];
}

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
