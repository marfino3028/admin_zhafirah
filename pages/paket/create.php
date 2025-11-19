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
} catch (Exception $e) {
    $hotels_makkah = [];
    $hotels_madinah = [];
    $hotels_transit = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data - Varian 2
        $jenis_paket_2 = $_POST['jenis_paket_2'] ?? '';
        $nama_hotel_mekkah_2 = $_POST['nama_hotel_mekkah_2'] ?? null;
        $nama_hotel_madinah_2 = $_POST['nama_hotel_madinah_2'] ?? null;
        $nama_hotel_transit_2 = $_POST['nama_hotel_transit_2'] ?? null;
        $harga_hpp_paket_2 = $_POST['harga_hpp_paket_2'] ?? 0;
        $harga_quad_2 = $_POST['harga_quad_2'] ?? 0;
        $harga_triple_2 = $_POST['harga_triple_2'] ?? 0;
        $harga_double_2 = $_POST['harga_double_2'] ?? 0;
        
        // Include and Exclude
        $termasuk_paket = $_POST['termasuk_paket'] ?? '';
        $tidak_termasuk_paket = $_POST['tidak_termasuk_paket'] ?? '';
        $syarat_ketentuan = $_POST['syarat_ketentuan'] ?? '';
        $catatan_paket = $_POST['catatan_paket'] ?? '';
        
        // Insert into database
        $stmt = $pdo->prepare("
            INSERT INTO paket_umroh (
                jenis_paket_2,
                nama_hotel_mekkah_2, nama_hotel_madinah_2, nama_hotel_transit_2,
                harga_hpp_paket_2, harga_quad_2, harga_triple_2, harga_double_2,
                termasuk_paket, tidak_termasuk_paket, 
                syarat_ketentuan, catatan_paket,
                created_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        
        $stmt->execute([
            $jenis_paket_2,
            $nama_hotel_mekkah_2, $nama_hotel_madinah_2, $nama_hotel_transit_2,
            $harga_hpp_paket_2, $harga_quad_2, $harga_triple_2, $harga_double_2,
            $termasuk_paket, $tidak_termasuk_paket,
            $syarat_ketentuan, $catatan_paket
        ]);
        
        $success_message = "Data paket umroh berhasil ditambahkan!";
        
        // Redirect to list page
        header('Location: paket-umroh-list.php?success=1');
        exit;
        
    } catch (Exception $e) {
        $error_message = "Error: " . $e->getMessage();
    }
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
                            <i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['name'] ?? 'Admin') ?>
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
                <h5 class="mb-4">Menu Dashboard</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="dashboard.php" class="nav-link text-white">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                </ul>
                
                <h6 class="mt-4 mb-3 text-white-50">Menu Travel</h6>
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
                        <a href="paket-list.php" class="nav-link text-white bg-primary">
                            <i class="bi bi-box"></i> Data Paket
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="paket-umroh-list.php" class="nav-link text-white">
                            <i class="bi bi-suitcase"></i> Paket Umroh
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
                    <li class="nav-item mb-2">
                        <a href="maskapai-list.php" class="nav-link text-white">
                            <i class="bi bi-airplane-engines"></i> Data Maskapai
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

                <form action="" method="post">
                    <!-- Jenis Paket 2 (Varian-2) -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="jenis_paket_2" class="form-label">
                                    Jenis Paket 2 <span class="variant-label">(Varian-2)</span> <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="jenis_paket_2" name="jenis_paket_2" 
                                       placeholder="Contoh: Paket Umroh Executive" required>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="nama_hotel_mekkah_2" class="form-label">
                                        Nama Hotel Mekkah <span class="variant-label">(Varian-2)</span> <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" id="nama_hotel_mekkah_2" name="nama_hotel_mekkah_2" required>
                                        <option value="">Pilih Hotel Mekkah</option>
                                        <?php foreach ($hotels_makkah as $hotel): ?>
                                            <option value="<?= $hotel['id'] ?>"><?= htmlspecialchars($hotel['nama_hotel']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="nama_hotel_madinah_2" class="form-label">
                                        Nama Hotel Madinah <span class="variant-label">(Varian-2)</span> <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" id="nama_hotel_madinah_2" name="nama_hotel_madinah_2" required>
                                        <option value="">Pilih Hotel Madinah</option>
                                        <?php foreach ($hotels_madinah as $hotel): ?>
                                            <option value="<?= $hotel['id'] ?>"><?= htmlspecialchars($hotel['nama_hotel']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="nama_hotel_transit_2" class="form-label">
                                        Nama Hotel Transit <span class="variant-label">(Varian-2)</span>
                                    </label>
                                    <select class="form-select" id="nama_hotel_transit_2" name="nama_hotel_transit_2">
                                        <option value="">Pilih Hotel Transit</option>
                                        <?php foreach ($hotels_transit as $hotel): ?>
                                            <option value="<?= $hotel['id'] ?>"><?= htmlspecialchars($hotel['nama_hotel']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="harga_hpp_paket_2" class="form-label">
                                        Harga HPP Paket <span class="variant-label">(Varian-2)</span> <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="harga_hpp_paket_2" name="harga_hpp_paket_2" 
                                           placeholder="0" min="0" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <!-- Empty column for alignment -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="harga_quad_2" class="form-label">
                                        Harga Paket (Quad) <span class="variant-label">(Varian-2)</span> <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="harga_quad_2" name="harga_quad_2" 
                                           placeholder="0" min="0" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="harga_triple_2" class="form-label">
                                        Harga Triple <span class="variant-label">(Varian-2)</span> <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="harga_triple_2" name="harga_triple_2" 
                                           placeholder="0" min="0" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="harga_double_2" class="form-label">
                                        Harga Double <span class="variant-label">(Varian-2)</span> <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="harga_double_2" name="harga_double_2" 
                                           placeholder="0" min="0" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Termasuk Paket (Include) -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <label for="termasuk_paket" class="form-label">
                                Termasuk Paket <span class="text-warning">(Include)</span>
                            </label>
                            <textarea class="form-control" id="termasuk_paket" name="termasuk_paket" rows="6" 
                                      placeholder="Masukkan daftar yang termasuk dalam paket..."></textarea>
                        </div>
                    </div>

                    <!-- Tidak Termasuk Paket (Exclude) -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <label for="tidak_termasuk_paket" class="form-label">
                                Tidak Termasuk Paket <span class="text-warning">(Exclude)</span>
                            </label>
                            <textarea class="form-control" id="tidak_termasuk_paket" name="tidak_termasuk_paket" rows="6" 
                                      placeholder="Masukkan daftar yang tidak termasuk dalam paket..."></textarea>
                        </div>
                    </div>

                    <!-- Syarat dan Ketentuan (Term & Condition) -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <label for="syarat_ketentuan" class="form-label">
                                Syarat dan Ketentuan <span class="text-warning">(Term & Condition)</span>
                            </label>
                            <textarea class="form-control" id="syarat_ketentuan" name="syarat_ketentuan" rows="6" 
                                      placeholder="Masukkan syarat dan ketentuan paket..."></textarea>
                        </div>
                    </div>

                    <!-- Catatan Paket (Notes) -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <label for="catatan_paket" class="form-label">
                                Catatan Paket <span class="text-warning">(Notes)</span>
                            </label>
                            <textarea class="form-control" id="catatan_paket" name="catatan_paket" rows="6" 
                                      placeholder="Masukkan catatan tambahan..."></textarea>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-2 mb-4">
                        <a href="paket-umroh-list.php" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Format currency for price inputs
        const priceInputs = ['harga_hpp_paket_2', 'harga_quad_2', 'harga_triple_2', 'harga_double_2'];
        
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
