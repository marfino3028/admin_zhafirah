<?php
require_once __DIR__ . '/../config/database.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$page_title = "Tambah Data Pendaftaran Haji";
$success_message = '';
$error_message = '';

// Generate automatic kode jamaah
try {
    $stmt = $pdo->query("SELECT kode_jamaah FROM jamaah ORDER BY id DESC LIMIT 1");
    $last_jamaah = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($last_jamaah && preg_match('/J-(\d+)/', $last_jamaah['kode_jamaah'], $matches)) {
        $next_number = intval($matches[1]) + 1;
        $auto_kode = 'J-' . $next_number;
    } else {
        $auto_kode = 'J-1';
    }
} catch (Exception $e) {
    $auto_kode = 'J-1';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $kode_jamaah = $_POST['kode_jamaah'];
        $nik_jamaah = $_POST['nik_jamaah'];
        $nama_jamaah = $_POST['nama_jamaah'];
        $kontak_jamaah = $_POST['kontak_jamaah'];
        $email_jamaah = $_POST['email_jamaah'] ?? '';
        $kota_kabupaten = $_POST['kota_kabupaten'] ?? '';
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $alamat_jamaah = $_POST['alamat_jamaah'] ?? '';
        $catatan_jamaah = $_POST['catatan_jamaah'] ?? '';
        
        // Handle file upload
        $foto_jamaah = null;
        if (isset($_FILES['foto_jamaah']) && $_FILES['foto_jamaah']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../uploads/jamaah/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $foto_jamaah = 'jamaah_' . time() . '_' . basename($_FILES['foto_jamaah']['name']);
            move_uploaded_file($_FILES['foto_jamaah']['tmp_name'], $upload_dir . $foto_jamaah);
        }
        
        // Insert into database
        $stmt = $pdo->prepare("
            INSERT INTO jamaah (
                kode_jamaah, nik_jamaah, nama_jamaah,
                kontak_jamaah, email_jamaah, kota_kabupaten,
                jenis_kelamin, tempat_lahir, tanggal_lahir,
                alamat_jamaah, catatan_jamaah, foto_jamaah,
                created_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        
        $stmt->execute([
            $kode_jamaah, $nik_jamaah, $nama_jamaah,
            $kontak_jamaah, $email_jamaah, $kota_kabupaten,
            $jenis_kelamin, $tempat_lahir, $tanggal_lahir,
            $alamat_jamaah, $catatan_jamaah, $foto_jamaah
        ]);
        
        $success_message = "Data jamaah berhasil ditambahkan!";
        header('Location: pendaftaran-haji-list.php?success=1');
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
        .upload-area {
            min-height: 300px;
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
            max-height: 250px;
            border-radius: 0.375rem;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">
                <i class="bi bi-building"></i> Zhafirah Admin
            </a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        <i class="bi bi-person-circle"></i> demo
                        <span class="badge bg-success">Online</span>
                    </span>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item"><a href="pendaftaran-haji-list.php">Data Pendaftaran Haji</a></li>
                <li class="breadcrumb-item active">Tambah Data Pendaftaran Haji</li>
            </ol>
        </nav>

        <div class="mb-4">
            <a href="pendaftaran-haji-list.php" class="btn btn-warning">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('submitBtn').click()">
                <i class="bi bi-save"></i> Tambah Pendaftaran Haji
            </button>
        </div>

        <?php if ($error_message): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle"></i> <?= $error_message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-8">
                <form action="" method="post" enctype="multipart/form-data" id="mainForm">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Data Pribadi Jamaah</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Kode Jamaah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control bg-light" name="kode_jamaah" 
                                       value="<?= htmlspecialchars($auto_kode) ?>" readonly required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK Jamaah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nik_jamaah" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Jamaah (KTP) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_jamaah" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kontak Jamaah <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="kontak_jamaah" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Jamaah</label>
                                    <input type="email" class="form-control" name="email_jamaah">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kota / Kabupaten</label>
                                <input type="text" class="form-control" name="kota_kabupaten">
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-select" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tempat_lahir" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_lahir" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Jamaah</label>
                                <textarea class="form-control" name="alamat_jamaah" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan Jamaah</label>
                                <textarea class="form-control" name="catatan_jamaah" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="submitBtn" class="d-none"></button>
                </form>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <label class="form-label d-flex align-items-center justify-content-center">
                            Foto Jamaah
                            <i class="bi bi-info-circle ms-2 text-primary" data-bs-toggle="tooltip" 
                               title="Upload foto jamaah dengan format JPG/PNG, maksimal 2MB"></i>
                        </label>
                        <div class="upload-area p-4" onclick="document.getElementById('foto_jamaah').click()">
                            <input type="file" class="d-none" id="foto_jamaah" name="foto_jamaah" 
                                   accept="image/*" form="mainForm" onchange="previewImage(this)">
                            <i class="bi bi-cloud-arrow-up text-primary" style="font-size: 5rem;"></i>
                            <p class="mt-3 mb-0 fw-bold">Click to upload</p>
                            <small class="text-muted">or drag and drop</small>
                            <div id="preview_foto_jamaah" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(input) {
            const file = input.files[0];
            const preview = document.getElementById('preview_foto_jamaah');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded mt-2" style="max-height: 250px;">`;
                }
                reader.readAsDataURL(file);
            }
        }

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
</body>
</html>
