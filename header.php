<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zhafirah Umroh - Admin Panel</title>
    
    <link href="vendor/theme/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <script src="vendor/theme/js/jquery.min.js"></script>
    <script src="vendor/theme/js/bootstrap.min.js"></script>
    <script src="vendor/theme/alert/sweetalert2.all.min.js"></script>
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f6fa; }
        
        /* Sidebar */
        .sidebar {
            position: fixed; left: 0; top: 0; width: 260px; height: 100vh;
            background: #2c3e50; overflow-y: auto; z-index: 1000; transition: 0.3s;
        }
        .sidebar::-webkit-scrollbar { width: 5px; }
        .sidebar::-webkit-scrollbar-thumb { background: #4a5f7f; border-radius: 10px; }
        
        .sidebar-header {
            padding: 20px; background: #34495e; text-align: center;
            border-bottom: 2px solid #4a5f7f;
        }
        .sidebar-header h4 { color: #ecf0f1; margin: 0; font-size: 20px; }
        .sidebar-header small { color: #95a5a6; font-size: 12px; }
        
        .sidebar-menu { list-style: none; padding: 0; margin: 0; }
        .sidebar-menu li { position: relative; }
        .sidebar-menu li a {
            display: block; padding: 12px 20px; color: #ecf0f1;
            text-decoration: none; transition: 0.3s;
        }
        .sidebar-menu li a:hover { background: #34495e; }
        .sidebar-menu li a i { margin-right: 10px; width: 20px; }
        
        .menu-section {
            padding: 15px 20px 8px; color: #95a5a6; font-size: 11px;
            font-weight: 600; text-transform: uppercase; letter-spacing: 1px;
        }
        
        .has-submenu > a::after {
            content: '\f107'; font-family: 'Font Awesome 5 Free'; font-weight: 900;
            float: right; transition: 0.3s;
        }
        .has-submenu.active > a::after { transform: rotate(180deg); }
        
        .submenu {
            display: none; list-style: none; background: #1a252f; padding: 0;
        }
        .submenu li a { padding-left: 50px; font-size: 14px; }
        .submenu li a:hover { background: #243342; }
        
        /* Content */
        .main-content {
            margin-left: 260px; padding: 20px; min-height: 100vh;
        }
        
        .topbar {
            background: #fff; padding: 15px 20px; margin: -20px -20px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex;
            justify-content: space-between; align-items: center;
        }
        .topbar h5 { margin: 0; color: #2c3e50; }
        .user-info { color: #7f8c8d; font-size: 14px; }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { width: 0; }
            .main-content { margin-left: 0; }
            .sidebar.active { width: 260px; }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>Zhafirah Umroh</h4>
            <small>Travel Management System</small>
        </div>
        
        <ul class="sidebar-menu">
            <li><a href="?page=depan"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            
            <li class="menu-section">TRANSAKSI</li>
            
            <li class="has-submenu">
                <a href="javascript:void(0)"><i class="fas fa-users"></i> Jamaah</a>
                <ul class="submenu">
                    <li><a href="?page=jamaah/index">Daftar Jamaah</a></li>
                    <li><a href="?page=jamaah/create">Tambah Jamaah</a></li>
                </ul>
            </li>
            
            <li class="has-submenu">
                <a href="javascript:void(0)"><i class="fas fa-box"></i> Paket Umroh</a>
                <ul class="submenu">
                    <li><a href="?page=paket/index">Daftar Paket</a></li>
                    <li><a href="?page=paket/create">Tambah Paket</a></li>
                </ul>
            </li>
            
            <li class="has-submenu">
                <a href="javascript:void(0)"><i class="fas fa-file-alt"></i> Pendaftaran</a>
                <ul class="submenu">
                    <li><a href="?page=pendaftaran/index">Daftar Pendaftaran</a></li>
                    <li><a href="?page=pendaftaran/create">Pendaftaran Baru</a></li>
                </ul>
            </li>
            
            <li class="has-submenu">
                <a href="javascript:void(0)"><i class="fas fa-money-bill"></i> Pembayaran</a>
                <ul class="submenu">
                    <li><a href="?page=pembayaran/index">Daftar Pembayaran</a></li>
                    <li><a href="?page=pembayaran/create">Input Pembayaran</a></li>
                    <li><a href="?page=pembayaran/laporan">Laporan</a></li>
                </ul>
            </li>
            
            <li class="has-submenu">
                <a href="javascript:void(0)"><i class="fas fa-receipt"></i> Pengeluaran</a>
                <ul class="submenu">
                    <li><a href="?page=pengeluaran/index">Daftar Pengeluaran</a></li>
                    <li><a href="?page=pengeluaran/create">Tambah Pengeluaran</a></li>
                </ul>
            </li>
            
            <li class="menu-section">OPERASIONAL</li>
            
            <li class="has-submenu">
                <a href="javascript:void(0)"><i class="fas fa-plane-departure"></i> Keberangkatan</a>
                <ul class="submenu">
                    <li><a href="?page=keberangkatan_umroh/index">Jadwal Keberangkatan</a></li>
                    <li><a href="?page=keberangkatan_umroh/create">Tambah Jadwal</a></li>
                </ul>
            </li>
            
            <li><a href="?page=manifest/index"><i class="fas fa-list-alt"></i> Manifest</a></li>
            
            <li class="menu-section">PENGATURAN</li>
            
            <li class="has-submenu">
                <a href="javascript:void(0)"><i class="fas fa-cog"></i> Master Data</a>
                <ul class="submenu">
                    <li><a href="?page=master/hotel">Hotel</a></li>
                    <li><a href="?page=master/maskapai">Maskapai</a></li>
                    <li><a href="?page=master/agent">Agent</a></li>
                    <li><a href="?page=master/user">User</a></li>
                </ul>
            </li>
            
            <li><a href="login.php?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar">
            <h5><?php echo isset($page_title) ? $page_title : 'Dashboard'; ?></h5>
            <div class="user-info">
                <i class="fas fa-user-circle"></i> 
                <?php echo $_SESSION['nama_user'] ?? 'Admin'; ?>
            </div>
        </div>
        
        <div class="content-wrapper">

<script>
// Submenu Toggle
$(document).ready(function() {
    $('.has-submenu > a').click(function(e) {
        e.preventDefault();
        $(this).parent().toggleClass('active');
        $(this).next('.submenu').slideToggle(300);
    });
    
    // Active menu
    var currentPage = '<?php echo $_GET['page'] ?? 'depan'; ?>';
    $('.sidebar-menu a[href*="' + currentPage + '"]').addClass('active');
    $('.sidebar-menu a[href*="' + currentPage + '"]').parents('.has-submenu').addClass('active');
    $('.sidebar-menu a[href*="' + currentPage + '"]').parents('.submenu').show();
});
</script>
