<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Haromain - Travel Management System</title>
    
    <!-- CSS -->
    <link href="vendor/theme/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="vendor/theme/js/jquery.min.js"></script>
    <script src="vendor/theme/js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="vendor/theme/alert/sweetalert2.all.min.js"></script>
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f6fa;
            color: #2c3e50;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: #2c3e50;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s;
        }
        .sidebar::-webkit-scrollbar { width: 5px; }
        .sidebar::-webkit-scrollbar-track { background: #34495e; }
        .sidebar::-webkit-scrollbar-thumb { background: #4a5f7f; border-radius: 10px; }
        
        .sidebar-header {
            padding: 25px 20px;
            background: #34495e;
            text-align: center;
            border-bottom: 2px solid #4a5f7f;
        }
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .sidebar-logo img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
        }
        .sidebar-logo-text h3 {
            color: white;
            font-size: 14px;
            font-weight: 700;
            margin: 0;
            text-transform: uppercase;
        }
        .sidebar-logo-text p {
            color: #95a5a6;
            font-size: 11px;
            margin: 0;
        }
        
        .menu-section-title {
            color: #95a5a6;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 20px 20px 10px;
            letter-spacing: 1px;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar-menu > li {
            position: relative;
        }
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 14px;
        }
        .sidebar-menu a:hover {
            background: #34495e;
            color: white;
            padding-left: 25px;
        }
        .sidebar-menu a.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-left: 4px solid #fff;
        }
        .sidebar-menu a i {
            width: 25px;
            font-size: 16px;
            margin-right: 12px;
        }
        
        /* Topbar */
        .topbar {
            position: fixed;
            left: 280px;
            top: 0;
            right: 0;
            height: 70px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            z-index: 999;
        }
        .topbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .topbar-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }
        .notification-badge {
            position: relative;
            cursor: pointer;
        }
        .notification-badge i {
            font-size: 20px;
            color: #7f8c8d;
        }
        .notification-badge .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #e74c3c;
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 6px;
            border-radius: 10px;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
        }
        .user-details {
            display: flex;
            flex-direction: column;
        }
        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: #2c3e50;
        }
        .user-status {
            font-size: 12px;
            color: #27ae60;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .user-status::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #27ae60;
            display: inline-block;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            margin-top: 70px;
            padding: 30px;
            min-height: calc(100vh - 70px);
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            background: white;
            margin-left: 280px;
            margin-top: 30px;
            border-top: 1px solid #ecf0f1;
        }
        .footer p {
            color: #7f8c8d;
            font-size: 13px;
            margin: 0;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div style="text-align: center;">
                <div style="background: white; width: 150px; margin: 0 auto 15px; padding: 10px; border-radius: 10px;">
                    <img src="images/logo-kaaba.png" alt="Logo" style="width: 40px; height: 40px;" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 100\'%3E%3Crect fill=\'%23667eea\' width=\'100\' height=\'100\'/%3E%3Ctext x=\'50\' y=\'50\' font-size=\'40\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\'%3EWH%3C/text%3E%3C/svg%3E'">
                    <img src="images/logo-book.png" alt="Logo" style="width: 40px; height: 40px; margin-left: 10px;" onerror="this.style.display='none'">
                </div>
                <h4 style="color: white; font-size: 13px; margin: 0; font-weight: 700;">DEMO TRAVEL</h4>
                <h4 style="color: white; font-size: 13px; margin: 5px 0; font-weight: 700;">WISATA HAROMAIN</h4>
                <p style="color: #c4803f; font-size: 13px; margin: 0; font-weight: 600;">TOUR & TRAVEL</p>
                <p style="color: #95a5a6; font-size: 11px; margin: 5px 0 0;">Travel Management System</p>
            </div>
        </div>

        <div class="menu-section-title">Menu Dashboard</div>
        <ul class="sidebar-menu">
            <li>
                <a href="index.php" class="<?php echo (!isset($_GET['mod']) ? 'active' : ''); ?>">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
        </ul>

        <div class="menu-section-title">Menu Travel</div>
        <ul class="sidebar-menu">
            <li>
                <a href="?mod=pendaftaran&submod=umroh" class="<?php echo ($_GET['mod']=='pendaftaran' && $_GET['submod']=='umroh' ? 'active' : ''); ?>">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Pendaftaran Umroh</span>
                </a>
            </li>
            <li>
                <a href="?mod=pendaftaran&submod=haji" class="<?php echo ($_GET['mod']=='pendaftaran' && $_GET['submod']=='haji' ? 'active' : ''); ?>">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Pendaftaran Haji</span>
                </a>
            </li>
            <li>
                <a href="?mod=jamaah&submod=list" class="<?php echo ($_GET['mod']=='jamaah' && $_GET['submod']=='list' ? 'active' : ''); ?>">
                    <i class="fas fa-users"></i>
                    <span>Data Jamaah</span>
                </a>
            </li>
            <li>
                <a href="?mod=agent&submod=list" class="<?php echo ($_GET['mod']=='agent' && $_GET['submod']=='list' ? 'active' : ''); ?>">
                    <i class="fas fa-user-tie"></i>
                    <span>Data Agent</span>
                </a>
            </li>
            <li>
                <a href="?mod=karyawan&submod=list" class="<?php echo ($_GET['mod']=='karyawan' && $_GET['submod']=='list' ? 'active' : ''); ?>">
                    <i class="fas fa-user-friends"></i>
                    <span>Data Karyawan</span>
                </a>
            </li>
            <li>
                <a href="?mod=paket&submod=umroh" class="<?php echo ($_GET['mod']=='paket' && $_GET['submod']=='umroh' ? 'active' : ''); ?>">
                    <i class="fas fa-box"></i>
                    <span>Paket Umroh</span>
                </a>
            </li>
            <li>
                <a href="?mod=paket&submod=haji" class="<?php echo ($_GET['mod']=='paket' && $_GET['submod']=='haji' ? 'active' : ''); ?>">
                    <i class="fas fa-box"></i>
                    <span>Paket Haji</span>
                </a>
            </li>
            <li>
                <a href="?mod=paket&submod=keberangkatan_umroh" class="<?php echo ($_GET['mod']=='paket' && $_GET['submod']=='keberangkatan_umroh' ? 'active' : ''); ?>">
                    <i class="fas fa-plane-departure"></i>
                    <span>Keberangkatan Umroh</span>
                </a>
            </li>
            <li>
                <a href="?mod=paket&submod=keberangkatan_haji" class="<?php echo ($_GET['mod']=='paket' && $_GET['submod']=='keberangkatan_haji' ? 'active' : ''); ?>">
                    <i class="fas fa-plane-departure"></i>
                    <span>Keberangkatan Haji</span>
                </a>
            </li>
            <li>
                <a href="?mod=pembayaran&submod=umroh" class="<?php echo ($_GET['mod']=='pembayaran' && $_GET['submod']=='umroh' ? 'active' : ''); ?>">
                    <i class="fas fa-credit-card"></i>
                    <span>Pembayaran Umroh</span>
                </a>
            </li>
            <li>
                <a href="?mod=pembayaran&submod=haji" class="<?php echo ($_GET['mod']=='pembayaran' && $_GET['submod']=='haji' ? 'active' : ''); ?>">
                    <i class="fas fa-credit-card"></i>
                    <span>Pembayaran Haji</span>
                </a>
            </li>
            <li>
                <a href="?mod=pengeluaran&submod=umum" class="<?php echo ($_GET['mod']=='pengeluaran' && $_GET['submod']=='umum' ? 'active' : ''); ?>">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Pengeluaran Umum</span>
                </a>
            </li>
            <li>
                <a href="?mod=pengeluaran&submod=umroh" class="<?php echo ($_GET['mod']=='pengeluaran' && $_GET['submod']=='umroh' ? 'active' : ''); ?>">
                    <i class="fas fa-wallet"></i>
                    <span>Pengeluaran Umroh</span>
                </a>
            </li>
            <li>
                <a href="?mod=pengeluaran&submod=haji" class="<?php echo ($_GET['mod']=='pengeluaran' && $_GET['submod']=='haji' ? 'active' : ''); ?>">
                    <i class="fas fa-wallet"></i>
                    <span>Pengeluaran Haji</span>
                </a>
            </li>
            <li>
                <a href="?mod=pemasukan&submod=umum" class="<?php echo ($_GET['mod']=='pemasukan' && $_GET['submod']=='umum' ? 'active' : ''); ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>Pemasukan Umum</span>
                </a>
            </li>
            <li>
                <a href="?mod=laporan&submod=list">
                    <i class="fas fa-file-alt"></i>
                    <span>Data Laporan</span>
                </a>
            </li>
            <li>
                <a href="?mod=dokumen&submod=surat_rekomendasi" class="<?php echo ($_GET['mod']=='dokumen' && $_GET['submod']=='surat_rekomendasi' ? 'active' : ''); ?>">
                    <i class="fas fa-file-alt"></i>
                    <span>Surat Rekomendasi</span>
                </a>
            </li>
            <li>
                <a href="?mod=dokumen&submod=izin_cuti" class="<?php echo ($_GET['mod']=='dokumen' && $_GET['submod']=='izin_cuti' ? 'active' : ''); ?>">
                    <i class="fas fa-file-alt"></i>
                    <span>Surat Izin Cuti</span>
                </a>
            </li>
            <li>
                <a href="?mod=maskapai&submod=list" class="<?php echo ($_GET['mod']=='maskapai' && $_GET['submod']=='list' ? 'active' : ''); ?>">
                    <i class="fas fa-plane"></i>
                    <span>Data Maskapai</span>
                </a>
            </li>
            <li>
                <a href="?mod=hotel&submod=list" class="<?php echo ($_GET['mod']=='hotel' && $_GET['submod']=='list' ? 'active' : ''); ?>">
                    <i class="fas fa-hotel"></i>
                    <span>Data Hotel</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Topbar -->
    <div class="topbar">
        <div class="topbar-left">
            <button class="btn btn-link" id="sidebarToggle" style="display: none;">
                <i class="fas fa-bars"></i>
            </button>
            <div class="topbar-title">Home</div>
        </div>
        <div class="topbar-right">
            <div class="notification-badge">
                <i class="fas fa-bell"></i>
                <span class="badge">0</span>
            </div>
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo strtoupper(substr($_SESSION['rg_nama'], 0, 1)); ?>
                </div>
                <div class="user-details">
                    <div class="user-name">demo</div>
                    <div class="user-status">Online</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
