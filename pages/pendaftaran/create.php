<?php
require_once __DIR__ . '/../config/database.php';
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$page_title = "Tambah Data Pendaftaran Haji";
$success_message = '';
$error_message = '';

// Fetch data for dropdowns
try {
    // Get keberangkatan haji
    $stmt_keberangkatan = $pdo->query("SELECT id, nama_keberangkatan FROM keberangkatan_haji WHERE status_keberangkatan = 'Active' ORDER BY nama_keberangkatan");
    $keberangkatan_list = $stmt_keberangkatan->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $keberangkatan_list = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Data Paspor Jamaah
        $nama_jamaah = $_POST['nama_jamaah'];
        $nomor_paspor = $_POST['nomor_paspor'];
        $kantor_imigrasi = $_POST['kantor_imigrasi'] ?? '';
        $paspor_aktif = $_POST['paspor_aktif'] ?? null;
        $paspor_expired = $_POST['paspor_expired'] ?? null;
        
        // Data Manifest Jamaah
        $nama_keberangkatan_haji = $_POST['nama_keberangkatan_haji'] ?? null;
        $tipe_kamar = $_POST['tipe_kamar'] ?? '';
        $harga_paket = $_POST['harga_paket'] ?? 0;
        $diskon_harga_paket = $_POST['diskon_harga_paket'] ?? 0;
        $total_harga_setelah_diskon = $_POST['total_harga_setelah_diskon'] ?? 0;
        $total_pembayaran_dp = $_POST['total_pembayaran_dp'] ?? 0;
        $metode_pembayaran = $_POST['metode_pembayaran'] ?? '';
        $total_sisa_pembayaran = $_POST['total_sisa_pembayaran'] ?? 0;
        
        // Proses Perlengkapan
        $proses_perlengkapan = isset($_POST['proses_perlengkapan']) ? 1 : 0;
        $perlengkapan = isset($_POST['perlengkapan']) ? 1 : 0;
        
        // Catatan Pendaftaran
        $catatan_pendaftaran = $_POST['catatan_pendaftaran'] ?? '';
        
        // Handle file uploads
        $upload_dir = '../uploads/pendaftaran_haji/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $foto_ktp = null;
        $foto_kk = null;
        $foto_paspor_1 = null;
        $foto_paspor_2 = null;
        
        if (isset($_FILES['foto_ktp']) && $_FILES['foto_ktp']['error'] === UPLOAD_ERR_OK) {
            $foto_ktp = 'ktp_' . time() . '_' . basename($_FILES['foto_ktp']['name']);
            move_uploaded_file($_FILES['foto_ktp']['tmp_name'], $upload_dir . $foto_ktp);
        }
        
        if (isset($_FILES['foto_kk']) && $_FILES['foto_kk']['error'] === UPLOAD_ERR_OK) {
            $foto_kk = 'kk_' . time() . '_' . basename($_FILES['foto_kk']['name']);
            move_uploaded_file($_FILES['foto_kk']['tmp_name'], $upload_dir . $foto_kk);
        }
        
        if (isset($_FILES['foto_paspor_1']) && $_FILES['foto_paspor_1']['error'] === UPLOAD_ERR_OK) {
            $foto_paspor_1 = 'paspor1_' . time() . '_' . basename($_FILES['foto_paspor_1']['name']);
            move_uploaded_file($_FILES['foto_paspor_1']['tmp_name'], $upload_dir . $foto_paspor_1);
        }
        
        if (isset($_FILES['foto_paspor_2']) && $_FILES['foto_paspor_2']['error'] === UPLOAD_ERR_OK) {
            $foto_paspor_2 = 'paspor2_' . time() . '_' . basename($_FILES['foto_paspor_2']['name']);
            move_uploaded_file($_FILES['foto_paspor_2']['tmp_name'], $upload_dir . $foto_paspor_2);
        }
        
        // Insert into database
        $stmt = $pdo->prepare("
            INSERT INTO pendaftaran_haji (
                nama_jamaah, nomor_paspor, kantor_imigrasi,
                paspor_aktif, paspor_expired,
                nama_keberangkatan_haji, tipe_kamar,
                harga_paket, diskon_harga_paket, total_harga_setelah_diskon,
                total_pembayaran_dp, metode_pembayaran, total_sisa_pembayaran,
                proses_perlengkapan, perlengkapan,
                catatan_pendaftaran,
                foto_ktp, foto_kk, foto_paspor_1, foto_paspor_2,
                created_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        
        $stmt->execute([
            $nama_jamaah, $nomor_paspor, $kantor_imigrasi,
            $paspor_aktif, $paspor_expired,
            $nama_keberangkatan_haji, $tipe_kamar,
            $harga_paket, $diskon_harga_paket, $total_harga_setelah_diskon,
            $total_pembayaran_dp, $metode_pembayaran, $total_sisa_pembayaran,
            $proses_perlengkapan, $perlengkapan,
            $catatan_pendaftaran,
            $foto_ktp, $foto_kk, $foto_paspor_1, $foto_paspor_2
        ]);
        
        $success_message = "Data pendaftaran haji berhasil ditambahkan!";
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
            min-height: 200px;
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
            max-height: 150px;
            border-radius: 0.375rem;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php"><i class="bi bi-building"></i> Zhafirah Admin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="bi bi-house-door"></i> Home</a></li>
                    <li class="nav-item"><span class="nav-link"><i class="bi bi-person-circle"></i> demo <span class="badge bg-success">Online</span></span></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-dark text-white min-vh-100 p-3">
                <h6 class="mb-4 fw-bold">Menu Dashboard</h6>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="dashboard.php" class="nav-link text-white"><i class="bi bi-house-door"></i> Home</a></li>
                </ul>
                <h6 class="mt-4 mb-3 text-white-50 fw-bold">Menu Travel</h6>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="pendaftaran-list.php" class="nav-link text-white"><i class="bi bi-file-text"></i> Data Pendaftaran</a></li>
                    <li class="nav-item mb-2"><a href="pendaftaran-haji-list.php" class="nav-link text-white bg-primary"><i class="bi bi-journal-check"></i> Pendaftaran Haji</a></li>
                    <li class="nav-item mb-2"><a href="jamaah-list.php" class="nav-link text-white"><i class="bi bi-people"></i> Data Jamaah</a></li>
                    <li class="nav-item mb-2"><a href="agent-list.php" class="nav-link text-white"><i class="bi bi-person-badge"></i> Data Agent</a></li>
                    <li class="nav-item mb-2"><a href="karyawan-list.php" class="nav-link text-white"><i class="bi bi-person"></i> Data Karyawan</a></li>
                    <li class="nav-item mb-2"><a href="paket-list.php" class="nav-link text-white"><i class="bi bi-box"></i> Data Paket</a></li>
                    <li class="nav-item mb-2"><a href="keberangkatan-list.php" class="nav-link text-white"><i class="bi bi-airplane"></i> Data Keberangkatan</a></li>
                    <li class="nav-item mb-2"><a href="pembayaran-list.php" class="nav-link text-white"><i class="bi bi-credit-card"></i> Data Pembayaran</a></li>
                    <li class="nav-item mb-2"><a href="laporan-list.php" class="nav-link text-white"><i class="bi bi-bar-chart"></i> Data Laporan</a></li>
                </ul>
            </div>

            <div class="col-md-10 p-4">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="pendaftaran-haji-list.php">Data Pendaftaran Haji</a></li>
                        <li class="breadcrumb-item active">Tambah Data Pendaftaran Haji</li>
                    </ol>
                </nav>

                <?php if ($success_message): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle"></i> <?= $success_message ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white"><h5 class="mb-0">Data Paspor Jamaah</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Nama Jamaah (PASPOR)</label>
                                    <input type="text" class="form-control" name="nama_jamaah" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Nomor Paspor</label>
                                    <input type="text" class="form-control" name="nomor_paspor" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kantor Imigrasi (Penerbit)</label>
                                    <input type="text" class="form-control" name="kantor_imigrasi">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Paspor Aktif</label>
                                    <input type="date" class="form-control" name="paspor_aktif">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Paspor Expired</label>
                                    <input type="date" class="form-control" name="paspor_expired">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white"><h5 class="mb-0">Data Manifest Jamaah</h5></div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Keberangkatan Haji <span class="text-danger">*</span></label>
                                    <select class="form-select" name="nama_keberangkatan_haji" required>
                                        <option value="">Pilih Nama Keberangkatan Haji</option>
                                        <?php foreach ($keberangkatan_list as $k): ?>
                                            <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['nama_keberangkatan']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Data Keberangkatan <span class="text-danger">*</span></label>
                                    <button type="button" class="btn btn-primary w-100"><i class="bi bi-plus-circle"></i> Tambah Keberangkatan</button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipe Kamar <span class="text-danger">*</span></label>
                                <select class="form-select" name="tipe_kamar" required>
                                    <option value="Quad">Quad</option>
                                    <option value="Triple">Triple</option>
                                    <option value="Double">Double</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Harga Paket <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="harga_paket" name="harga_paket" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Diskon Harga Paket</label>
                                    <input type="number" class="form-control" id="diskon_harga_paket" name="diskon_harga_paket">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Total Harga Setelah Diskon <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control bg-light" id="total_harga_setelah_diskon" name="total_harga_setelah_diskon" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Total Pembayaran DP <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="total_pembayaran_dp" name="total_pembayaran_dp" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                                    <select class="form-select" name="metode_pembayaran" required>
                                        <option value="Cash">Cash</option>
                                        <option value="Transfer">Transfer</option>
                                        <option value="Kredit">Kredit</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Total Sisa Pembayaran</label>
                                    <input type="number" class="form-control bg-light" id="total_sisa_pembayaran" name="total_sisa_pembayaran" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="proses_perlengkapan">
                                        <label class="form-check-label">Proses Perlengkapan</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="perlengkapan">
                                        <label class="form-check-label">Perlengkapan</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan Pendaftaran</label>
                                <textarea class="form-control" name="catatan_pendaftaran" rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <label class="form-label">Foto KTP Jamaah <i class="bi bi-info-circle text-primary"></i></label>
                                    <div class="upload-area p-4" onclick="document.getElementById('foto_ktp').click()">
                                        <input type="file" class="d-none" id="foto_ktp" name="foto_ktp" accept="image/*" onchange="previewImage(this, 'preview_ktp')">
                                        <i class="bi bi-cloud-arrow-up text-primary" style="font-size: 3rem;"></i>
                                        <p class="mt-2 mb-0">Click to upload</p>
                                        <div id="preview_ktp"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <label class="form-label">Foto KK Jamaah <i class="bi bi-info-circle text-primary"></i></label>
                                    <div class="upload-area p-4" onclick="document.getElementById('foto_kk').click()">
                                        <input type="file" class="d-none" id="foto_kk" name="foto_kk" accept="image/*" onchange="previewImage(this, 'preview_kk')">
                                        <i class="bi bi-cloud-arrow-up text-primary" style="font-size: 3rem;"></i>
                                        <p class="mt-2 mb-0">Click to upload</p>
                                        <div id="preview_kk"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <label class="form-label">Foto Paspor 1 Jamaah <i class="bi bi-info-circle text-primary"></i></label>
                                    <div class="upload-area p-4" onclick="document.getElementById('foto_paspor_1').click()">
                                        <input type="file" class="d-none" id="foto_paspor_1" name="foto_paspor_1" accept="image/*" onchange="previewImage(this, 'preview_p1')">
                                        <i class="bi bi-cloud-arrow-up text-primary" style="font-size: 3rem;"></i>
                                        <p class="mt-2 mb-0">Click to upload</p>
                                        <div id="preview_p1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <label class="form-label">Foto Paspor 2 Jamaah <i class="bi bi-info-circle text-primary"></i></label>
                                    <div class="upload-area p-4" onclick="document.getElementById('foto_paspor_2').click()">
                                        <input type="file" class="d-none" id="foto_paspor_2" name="foto_paspor_2" accept="image/*" onchange="previewImage(this, 'preview_p2')">
                                        <i class="bi bi-cloud-arrow-up text-primary" style="font-size: 3rem;"></i>
                                        <p class="mt-2 mb-0">Click to upload</p>
                                        <div id="preview_p2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mb-4">
                        <a href="pendaftaran-haji-list.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Batal</a>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(input, previewId) {
            const file = input.files[0];
            const preview = document.getElementById(previewId);
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded mt-2" style="max-height: 150px;">`;
                }
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('harga_paket').addEventListener('input', calculateTotal);
        document.getElementById('diskon_harga_paket').addEventListener('input', calculateTotal);
        document.getElementById('total_pembayaran_dp').addEventListener('input', calculateSisa);

        function calculateTotal() {
            const harga = parseFloat(document.getElementById('harga_paket').value) || 0;
            const diskon = parseFloat(document.getElementById('diskon_harga_paket').value) || 0;
            const total = harga - diskon;
            document.getElementById('total_harga_setelah_diskon').value = total;
            calculateSisa();
        }

        function calculateSisa() {
            const total = parseFloat(document.getElementById('total_harga_setelah_diskon').value) || 0;
            const dp = parseFloat(document.getElementById('total_pembayaran_dp').value) || 0;
            const sisa = total - dp;
            document.getElementById('total_sisa_pembayaran').value = sisa;
        }
    </script>
</body>
</html>
