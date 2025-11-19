<?php
require_once __DIR__ . '/../config/database.php';
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$page_title = "Tambah Data Paket Umroh";
$success_message = '';
$error_message = '';

// Fetch data for dropdowns
try {
    // Get hotels for Makkah
    $stmt_makkah = $pdo->query("SELECT id, nama_hotel FROM hotel WHERE lokasi = 'Makkah' ORDER BY nama_hotel");
    $hotels_makkah = $stmt_makkah->fetchAll(PDO::FETCH_ASSOC);
    
    // Get hotels for Madinah
    $stmt_madinah = $pdo->query("SELECT id, nama_hotel FROM hotel WHERE lokasi = 'Madinah' ORDER BY nama_hotel");
    $hotels_madinah = $stmt_madinah->fetchAll(PDO::FETCH_ASSOC);
    
    // Get hotels for Transit
    $stmt_transit = $pdo->query("SELECT id, nama_hotel FROM hotel WHERE lokasi = 'Transit' ORDER BY nama_hotel");
    $hotels_transit = $stmt_transit->fetchAll(PDO::FETCH_ASSOC);
    
    // Get airlines/maskapai
    $stmt_maskapai = $pdo->query("SELECT id, nama_maskapai FROM maskapai ORDER BY nama_maskapai");
    $maskapai_list = $stmt_maskapai->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $hotels_makkah = [];
    $hotels_madinah = [];
    $hotels_transit = [];
    $maskapai_list = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $kode_paket = $_POST['kode_paket'];
        $nama_paket = $_POST['nama_paket'];
        $tanggal_keberangkatan = $_POST['tanggal_keberangkatan'];
        $jumlah_hari = $_POST['jumlah_hari'] ?? 0;
        $status_paket = $_POST['status_paket'];
        $nama_maskapai = $_POST['nama_maskapai'] ?? null;
        $rute_penerbangan = $_POST['rute_penerbangan'] ?? '';
        $lokasi_keberangkatan = $_POST['lokasi_keberangkatan'] ?? '';
        $kuota_jamaah = $_POST['kuota_jamaah'] ?? 0;
        
        // Varian 1 data
        $jenis_paket_1 = $_POST['jenis_paket_1'] ?? '';
        $nama_hotel_mekkah_1 = $_POST['nama_hotel_mekkah_1'] ?? null;
        $nama_hotel_madinah_1 = $_POST['nama_hotel_madinah_1'] ?? null;
        $nama_hotel_transit_1 = $_POST['nama_hotel_transit_1'] ?? null;
        $harga_hpp_paket_1 = $_POST['harga_hpp_paket_1'] ?? 0;
        $harga_quad_1 = $_POST['harga_quad_1'] ?? 0;
        $harga_triple_1 = $_POST['harga_triple_1'] ?? 0;
        $harga_double_1 = $_POST['harga_double_1'] ?? 0;
        
        // Handle file upload
        $foto_paket_umroh = null;
        if (isset($_FILES['foto_paket_umroh']) && $_FILES['foto_paket_umroh']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../uploads/paket/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $foto_paket_umroh = 'paket_umroh_' . time() . '_' . basename($_FILES['foto_paket_umroh']['name']);
            move_uploaded_file($_FILES['foto_paket_umroh']['tmp_name'], $upload_dir . $foto_paket_umroh);
        }
        
        // Insert into database
        $stmt = $pdo->prepare("
            INSERT INTO paket_umroh (
                kode_paket, nama_paket, tanggal_keberangkatan, 
                jumlah_hari, status_paket, nama_maskapai,
                rute_penerbangan, lokasi_keberangkatan, kuota_jamaah,
                jenis_paket_1,
                nama_hotel_mekkah_1, nama_hotel_madinah_1, nama_hotel_transit_1,
                harga_hpp_paket_1, harga_quad_1, harga_triple_1, harga_double_1,
                foto_paket_umroh, created_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        
        $stmt->execute([
            $kode_paket, $nama_paket, $tanggal_keberangkatan,
            $jumlah_hari, $status_paket, $nama_maskapai,
            $rute_penerbangan, $lokasi_keberangkatan, $kuota_jamaah,
            $jenis_paket_1,
            $nama_hotel_mekkah_1, $nama_hotel_madinah_1, $nama_hotel_transit_1,
            $harga_hpp_paket_1, $harga_quad_1, $harga_triple_1, $harga_double_1,
            $foto_paket_umroh
        ]);
        
        $success_message = "Data paket umroh berhasil ditambahkan!";
        
        // Redirect to list page
        header('Location: paket-umroh-list.php?success=1');
        exit;
        
    } catch (Exception $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

// Generate automatic kode paket
try {
    $stmt = $pdo->query("SELECT kode_paket FROM paket_umroh ORDER BY id DESC LIMIT 1");
    $last_paket = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($last_paket && preg_match('/PU-(\d+)/', $last_paket['kode_paket'], $matches)) {
        $next_number = intval($matches[1]) + 1;
        $auto_kode = 'PU-' . $next_number;
    } else {
        $auto_kode = 'PU-1';
    }
} catch (Exception $e) {
    $auto_kode = 'PU-1';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?> - Zhafirah Umroh System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .upload-area {
            min-height: 250px;
            border: 2px dashed #dee2e6;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        .upload-area:hover {
            background-color: #f8f9fa;
            border-color: #0d6efd;
        }
        .upload-area img {
            max-height: 220px;
            border-radius: 0.375rem;
        }
        .variant-label {
            color: #dc3545;
            font-weight: 600;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">
                <i class="bi bi-building"></i> Zhafirah Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['name'] ?? 'demo') ?>
                            <span class="badge bg-success">Online</span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white min-vh-100 p-3">
                <h6 class="mb-4 fw-bold">Menu Dashboard</h6>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="dashboard.php" class="nav-link text-white">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                </ul>
                
                <h6 class="mt-4 mb-3 text-white-50 fw-bold">Menu Travel</h6>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="pendaftaran-list.php" class="nav-link text-white">
                            <i class="bi bi-file-text"></i> Data Pendaftaran
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="jamaah-list.php" class="nav-link text-white">
                            <i class="bi bi-people"></i> Data Jamaah
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="agent-list.php" class="nav-link text-white">
                            <i class="bi bi-person-badge"></i> Data Agent
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="karyawan-list.php" class="nav-link text-white">
                            <i class="bi bi-person"></i> Data Karyawan
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="paket-list.php" class="nav-link text-white">
                            <i class="bi bi-box"></i> Data Paket
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="paket-umroh-list.php" class="nav-link text-white bg-primary">
                            <i class="bi bi-suitcase"></i> Paket Umroh
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="paket-haji-list.php" class="nav-link text-white">
                            <i class="bi bi-luggage"></i> Paket Haji
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="keberangkatan-list.php" class="nav-link text-white">
                            <i class="bi bi-airplane"></i> Data Keberangkatan
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="pembayaran-list.php" class="nav-link text-white">
                            <i class="bi bi-credit-card"></i> Data Pembayaran
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="pengeluaran-list.php" class="nav-link text-white">
                            <i class="bi bi-cash-stack"></i> Data Pengeluaran
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="laporan-list.php" class="nav-link text-white">
                            <i class="bi bi-bar-chart"></i> Data Laporan
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="dokumen-list.php" class="nav-link text-white">
                            <i class="bi bi-file-earmark"></i> Data Dokumen
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="paket-umroh-list.php">Data Paket Umroh</a></li>
                        <li class="breadcrumb-item active">Tambah Data Paket Umroh</li>
                    </ol>
                </nav>

                <?php if ($success_message): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle"></i> <?= $success_message ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if ($error_message): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="bi bi-exclamation-triangle"></i> <?= $error_message ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <!-- Left Column - Form -->
                    <div class="col-md-8">
                        <form action="" method="post" enctype="multipart/form-data" id="mainForm">
                            <!-- Data Paket Umroh -->
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Data Paket Umroh</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="kode_paket" class="form-label">Kode Paket <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control bg-light" id="kode_paket" name="kode_paket" 
                                                   value="<?= htmlspecialchars($auto_kode) ?>" readonly required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="nama_paket" class="form-label">Nama Paket <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nama_paket" name="nama_paket" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tanggal_keberangkatan" class="form-label">Tanggal Keberangkatan <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="tanggal_keberangkatan" name="tanggal_keberangkatan" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="jumlah_hari" class="form-label">Jumlah Hari (Hari) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="jumlah_hari" name="jumlah_hari" 
                                                   placeholder="0" min="0" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="status_paket" class="form-label">Status Paket <span class="text-danger">*</span></label>
                                            <select class="form-select" id="status_paket" name="status_paket" required>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="nama_maskapai" class="form-label">Nama Maskapai <span class="text-danger">*</span></label>
                                            <select class="form-select" id="nama_maskapai" name="nama_maskapai" required>
                                                <option value="">Pilih Nama Maskapai</option>
                                                <?php foreach ($maskapai_list as $maskapai): ?>
                                                    <option value="<?= $maskapai['id'] ?>"><?= htmlspecialchars($maskapai['nama_maskapai']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="rute_penerbangan" class="form-label">Rute Penerbangan <span class="text-danger">*</span></label>
                                            <select class="form-select" id="rute_penerbangan" name="rute_penerbangan" required>
                                                <option value="Direct">Direct</option>
                                                <option value="Transit">Transit</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="lokasi_keberangkatan" class="form-label">Lokasi Keberangkatan <span class="text-danger">*</span></label>
                                            <select class="form-select" id="lokasi_keberangkatan" name="lokasi_keberangkatan" required>
                                                <option value="Jakarta">Jakarta</option>
                                                <option value="Surabaya">Surabaya</option>
                                                <option value="Medan">Medan</option>
                                                <option value="Makassar">Makassar</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kuota_jamaah" class="form-label">Kuota Jamaah (Pax) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="kuota_jamaah" name="kuota_jamaah" 
                                               placeholder="0" min="0" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Jenis Paket 1 (Varian-1) -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="jenis_paket_1" class="form-label">
                                            Jenis Paket 1 <span class="variant-label">(Varian-1)</span> <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="jenis_paket_1" name="jenis_paket_1" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="nama_hotel_mekkah_1" class="form-label">
                                                Nama Hotel Mekkah <span class="variant-label">(Varian-1)</span> <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select" id="nama_hotel_mekkah_1" name="nama_hotel_mekkah_1" required>
                                                <option value="">Pilih Hotel Mekkah</option>
                                                <?php foreach ($hotels_makkah as $hotel): ?>
                                                    <option value="<?= $hotel['id'] ?>"><?= htmlspecialchars($hotel['nama_hotel']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="nama_hotel_madinah_1" class="form-label">
                                                Nama Hotel Madinah <span class="variant-label">(Varian-1)</span> <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select" id="nama_hotel_madinah_1" name="nama_hotel_madinah_1" required>
                                                <option value="">Pilih Hotel Madinah</option>
                                                <?php foreach ($hotels_madinah as $hotel): ?>
                                                    <option value="<?= $hotel['id'] ?>"><?= htmlspecialchars($hotel['nama_hotel']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="nama_hotel_transit_1" class="form-label">
                                                Nama Hotel Transit <span class="variant-label">(Varian-1)</span>
                                            </label>
                                            <select class="form-select" id="nama_hotel_transit_1" name="nama_hotel_transit_1">
                                                <option value="">Pilih Hotel Transit</option>
                                                <?php foreach ($hotels_transit as $hotel): ?>
                                                    <option value="<?= $hotel['id'] ?>"><?= htmlspecialchars($hotel['nama_hotel']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="harga_hpp_paket_1" class="form-label">
                                            Harga HPP Paket <span class="variant-label">(Varian-1)</span>
                                        </label>
                                        <input type="number" class="form-control" id="harga_hpp_paket_1" name="harga_hpp_paket_1" 
                                               placeholder="0" min="0">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="harga_quad_1" class="form-label">
                                                Harga Paket (Quad) <span class="variant-label">(Varian-1)</span> <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control" id="harga_quad_1" name="harga_quad_1" 
                                                   placeholder="0" min="0" required>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="harga_triple_1" class="form-label">
                                                Harga Triple <span class="variant-label">(Varian-1)</span> <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control" id="harga_triple_1" name="harga_triple_1" 
                                                   placeholder="0" min="0" required>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="harga_double_1" class="form-label">
                                                Harga Double <span class="variant-label">(Varian-1)</span> <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control" id="harga_double_1" name="harga_double_1" 
                                                   placeholder="0" min="0" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="submitBtn" class="d-none"></button>
                        </form>
                    </div>

                    <!-- Right Column - Photo Upload -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <label class="form-label d-flex align-items-center justify-content-center">
                                    Foto Paket Umroh
                                    <i class="bi bi-info-circle ms-2 text-primary" data-bs-toggle="tooltip" 
                                       title="Upload foto paket umroh dengan format JPG/PNG, maksimal 2MB"></i>
                                </label>
                                <div class="upload-area p-4" onclick="document.getElementById('foto_paket_umroh').click()">
                                    <input type="file" class="d-none" id="foto_paket_umroh" name="foto_paket_umroh" 
                                           accept="image/*" form="mainForm" onchange="previewImage(this, 'preview_foto_paket_umroh')">
                                    <i class="bi bi-cloud-arrow-up text-primary" style="font-size: 4rem;"></i>
                                    <p class="mt-3 mb-0">Click to upload</p>
                                    <small class="text-muted">or drag and drop</small>
                                    <div id="preview_foto_paket_umroh" class="mt-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview image upload
        function previewImage(input, previewId) {
            const file = input.files[0];
            const preview = document.getElementById(previewId);
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded mt-2" style="max-height: 220px;">`;
                }
                reader.readAsDataURL(file);
            }
        }

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Format currency for price inputs
        const priceInputs = ['harga_hpp_paket_1', 'harga_quad_1', 'harga_triple_1', 'harga_double_1'];
        
        priceInputs.forEach(function(inputId) {
            const input = document.getElementById(inputId);
            
            input.addEventListener('blur', function() {
                if (this.value) {
                    this.value = parseInt(this.value).toLocaleString('id-ID');
                }
            });
            
            input.addEventListener('focus', function() {
                this.value = this.value.replace(/\./g, '');
            });
        });

        // Before submit, convert formatted numbers back to plain numbers
        document.querySelector('form').addEventListener('submit', function(e) {
            priceInputs.forEach(function(inputId) {
                const input = document.getElementById(inputId);
                input.value = input.value.replace(/\./g, '');
            });
        });
    </script>
</body>
</html>
