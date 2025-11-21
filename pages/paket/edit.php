<?php
// PENTING: Proses form HARUS di paling atas sebelum ada output HTML
$formSubmitted = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Gunakan $db yang sudah ada dari engine.php (dipanggil di default.php)
    global $db;

    try {
        $package_id = (int)$_POST['package_id'];
        
        // --- Ambil & sanitize input ---
        $package_code = filter_input(INPUT_POST, 'package_code', FILTER_SANITIZE_STRING);
        $package_name = trim(filter_input(INPUT_POST, 'package_name', FILTER_SANITIZE_STRING) ?? '');
        $package_type = filter_input(INPUT_POST, 'package_type', FILTER_SANITIZE_STRING) ?: 'umroh';
        $description = trim($_POST['description'] ?? '');
        $price = (float)($_POST['price'] ?? 0);
        $duration_days = (int)($_POST['duration_days'] ?? 0);
        $departure_date = trim($_POST['departure_date'] ?? '');
        $quota = (int)($_POST['quota'] ?? 0);
        $includes = trim($_POST['includes'] ?? '');
        $excludes = trim($_POST['excludes'] ?? '');
        $itinerary = trim($_POST['itinerary'] ?? '');
        $hotel_makkah = trim(filter_input(INPUT_POST, 'hotel_makkah', FILTER_SANITIZE_STRING) ?? '');
        $hotel_madinah = trim(filter_input(INPUT_POST, 'hotel_madinah', FILTER_SANITIZE_STRING) ?? '');
        $airline_id = $_POST['airline_id'] !== '' ? (int)$_POST['airline_id'] : null;
        $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING) ?: 'active';
        $featured = isset($_POST['featured']) ? 1 : 0;
        $currentDateTime = date('Y-m-d H:i:s');

        // --- Validasi dasar ---
        if ($package_name === '' || $departure_date === '' || $price <= 0 || $quota <= 0) {
            throw new Exception("Nama paket, tanggal keberangkatan, harga, dan kuota wajib diisi dan valid.");
        }

        // validasi tanggal sederhana (YYYY-MM-DD)
        $d = DateTime::createFromFormat('Y-m-d', $departure_date);
        if (!$d || $d->format('Y-m-d') !== $departure_date) {
            throw new Exception("Format tanggal keberangkatan tidak valid. Gunakan YYYY-MM-DD.");
        }

        // --- Update ke DB (pakai transaction) ---
        $db->beginTransaction();

        $stmt = $db->prepare("
            UPDATE packages SET
                package_code = ?, package_name = ?, package_type = ?, description = ?, price = ?, 
                duration_days = ?, departure_date = ?, quota = ?,
                includes = ?, excludes = ?, itinerary = ?, hotel_makkah = ?, hotel_madinah = ?,
                airline_id = ?, status = ?, featured = ?, updated_at = ?
            WHERE id = ?
        ");
        
        $params = [
            $package_code, $package_name, $package_type, $description, $price,
            $duration_days, $departure_date, $quota,
            $includes, $excludes, $itinerary, $hotel_makkah, $hotel_madinah,
            $airline_id, $status, $featured, $currentDateTime, $package_id
        ];

        $stmt->execute($params);
        $db->commit();

        // sukses: redirect ke paket/umroh
        $_SESSION['success_message'] = "Paket berhasil diperbarui!";
        header('Location: default.php?page=paket/umroh');
        exit;

    } catch (Throwable $t) {
        // rollback jika in transaction
        if (isset($db) && $db->inTransaction()) {
            $db->rollBack();
        }
        // log detail error (untuk dev)
        error_log("Paket update error: " . $t->getMessage() . " in " . $t->getFile() . ":" . $t->getLine());
        // tampilkan pesan aman ke user (form akan ditampilkan di bawah)
        $error_message = "Terjadi kesalahan saat memperbarui data paket. " . ($t instanceof Exception ? $t->getMessage() : "Silakan cek log.");
    }
    $formSubmitted = true;
}

// Periksa apakah ID ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID Paket tidak valid.</div>";
    exit;
}

$package_id = (int)$_GET['id'];

// Gunakan $db yang sudah ada dari engine.php
global $db;

// Ambil data paket dari database
$stmt = $db->prepare("SELECT * FROM packages WHERE id = ?");
$stmt->execute([$package_id]);
$package = $stmt->fetch();

if (!$package) {
    echo "<div class='alert alert-danger'>Data paket tidak ditemukan.</div>";
    exit;
}

// Ambil pesan dari session atau dari error handling di atas
if (!$formSubmitted) {
    $success_message = $_SESSION['success_message'] ?? '';
    $error_message = $_SESSION['error_message'] ?? '';
    unset($_SESSION['success_message'], $_SESSION['error_message']);
} else {
    // Error message sudah diset di block catch di atas
    $success_message = '';
    if (!isset($error_message)) {
        $error_message = '';
    }
}

// Ambil data maskapai untuk dropdown
$airlines = $db->query("SELECT id, nama_maskapai FROM tbl_maskapai ORDER BY nama_maskapai ASC");
?>

<style>
.form-section {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.form-title {
    font-size: 20px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 20px;
    border-bottom: 2px solid #f39c12;
    padding-bottom: 10px;
}
.form-label {
    font-weight: 600;
    color: #34495e;
}
.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #dfe4ea;
    padding: 10px 15px;
}
.form-control:focus, .form-select:focus {
    border-color: #f39c12;
    box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
}
.btn-update {
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}
.btn-update:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(243, 156, 18, 0.4);
}
.btn-cancel {
    background: #95a5a6;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
}
.btn-cancel:hover {
    background: #7f8c8d;
    text-decoration: none;
}
.section-divider {
    border-top: 2px solid #ecf0f1;
    margin: 30px 0;
    padding-top: 20px;
}
.section-title {
    font-size: 16px;
    font-weight: 600;
    color: #f39c12;
    margin-bottom: 15px;
}
.form-check-input:checked {
    background-color: #f39c12;
    border-color: #f39c12;
}
</style>

<div class="form-section">
    <h3 class="form-title">✏️ Edit Data Paket Umroh</h3>

    <?php if ($success_message): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success_message) ?>
        </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error_message) ?>
        </div>
    <?php endif; ?>

    <form action="" method="post">
        <input type="hidden" name="package_id" value="<?= $package['id'] ?>">
        <input type="hidden" name="package_type" value="<?= htmlspecialchars($package['package_type']) ?>">
        
        <!-- Informasi Dasar Paket -->
        <div class="section-title">📋 Informasi Dasar Paket</div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="package_name" class="form-label">Nama Paket <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="package_name" name="package_name" required 
                       value="<?= htmlspecialchars($package['package_name']) ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="package_code" class="form-label">Kode Paket <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="package_code" name="package_code" required
                       value="<?= htmlspecialchars($package['package_code']) ?>">
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Paket</label>
            <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($package['description']) ?></textarea>
        </div>

        <!-- Detail Keberangkatan -->
        <div class="section-divider"></div>
        <div class="section-title">✈️ Detail Keberangkatan</div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="departure_date" class="form-label">Tanggal Keberangkatan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="departure_date" name="departure_date" required
                       value="<?= htmlspecialchars($package['departure_date']) ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="duration_days" class="form-label">Jumlah Hari <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="duration_days" name="duration_days" 
                       min="1" required value="<?= htmlspecialchars($package['duration_days']) ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="airline_id" class="form-label">Maskapai</label>
                <select class="form-select" id="airline_id" name="airline_id">
                    <option value="">Pilih Maskapai</option>
                    <?php foreach ($airlines as $airline): ?>
                        <option value="<?= $airline['id'] ?>" <?= $airline['id'] == $package['airline_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($airline['nama_maskapai']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Hotel -->
        <div class="section-divider"></div>
        <div class="section-title">🏨 Informasi Hotel</div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="hotel_makkah" class="form-label">Hotel Makkah</label>
                <input type="text" class="form-control" id="hotel_makkah" name="hotel_makkah" 
                       value="<?= htmlspecialchars($package['hotel_makkah']) ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="hotel_madinah" class="form-label">Hotel Madinah</label>
                <input type="text" class="form-control" id="hotel_madinah" name="hotel_madinah" 
                       value="<?= htmlspecialchars($package['hotel_madinah']) ?>">
            </div>
        </div>

        <!-- Harga & Kuota -->
        <div class="section-divider"></div>
        <div class="section-title">💰 Harga & Kuota</div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="price" class="form-label">Harga Paket (Rp) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="price" name="price" required min="0" 
                       value="<?= htmlspecialchars($package['price']) ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="quota" class="form-label">Kuota Jamaah <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="quota" name="quota" required min="1" 
                       value="<?= htmlspecialchars($package['quota']) ?>">
                <small class="text-muted">Kuota tersisa saat ini: <?= $package['remaining_quota'] ?></small>
            </div>
            <div class="col-md-4 mb-3">
                <label for="status" class="form-label">Status Paket</label>
                <select class="form-select" id="status" name="status">
                    <option value="active" <?= $package['status'] == 'active' ? 'selected' : '' ?>>Aktif</option>
                    <option value="inactive" <?= $package['status'] == 'inactive' ? 'selected' : '' ?>>Tidak Aktif</option>
                    <option value="full" <?= $package['status'] == 'full' ? 'selected' : '' ?>>Penuh</option>
                </select>
            </div>
        </div>

        <!-- Fasilitas Yang Termasuk -->
        <div class="section-divider"></div>
        <div class="section-title">✅ Fasilitas Yang Termasuk</div>
        <div class="mb-3">
            <label for="includes" class="form-label">Includes</label>
            <textarea class="form-control" id="includes" name="includes" rows="5"><?= htmlspecialchars($package['includes']) ?></textarea>
        </div>

        <!-- Fasilitas Yang Tidak Termasuk -->
        <div class="mb-3">
            <label for="excludes" class="form-label">Excludes</label>
            <textarea class="form-control" id="excludes" name="excludes" rows="4"><?= htmlspecialchars($package['excludes']) ?></textarea>
        </div>

        <!-- Itinerary -->
        <div class="section-divider"></div>
        <div class="section-title">📅 Itinerary Perjalanan</div>
        <div class="mb-3">
            <label for="itinerary" class="form-label">Itinerary</label>
            <textarea class="form-control" id="itinerary" name="itinerary" rows="8"><?= htmlspecialchars($package['itinerary']) ?></textarea>
        </div>

        <!-- Featured -->
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1" 
                       <?= $package['featured'] == 1 ? 'checked' : '' ?>>
                <label class="form-check-label" for="featured">
                    ⭐ Tampilkan sebagai Paket Unggulan/Featured
                </label>
            </div>
        </div>
        
        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="?page=paket/umroh" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-update">💾 Update Data Paket</button>
        </div>
    </form>
</div>
