<?php
// PENTING: Proses delete HARUS di paling atas sebelum ada output HTML
if (isset($_GET['id']) && isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $db = new PDO('mysql:host=127.0.0.1;dbname=zhafirah_local;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    try {
        $package_id = (int)$_GET['id'];
        
        // Cek apakah paket masih memiliki booking
        $stmt = $db->prepare("SELECT COUNT(*) as total FROM bookings WHERE package_id = ?");
        $stmt->execute([$package_id]);
        $result = $stmt->fetch();
        
        if ($result['total'] > 0) {
            throw new Exception("Paket tidak dapat dihapus karena masih memiliki {$result['total']} booking aktif.");
        }

        // Hapus paket
        $db->beginTransaction();
        $stmt = $db->prepare("DELETE FROM packages WHERE id = ?");
        $stmt->execute([$package_id]);
        $db->commit();

        // sukses: redirect ke paket/umroh menggunakan JavaScript
        $_SESSION['success_message'] = "Paket berhasil dihapus!";
        echo "<script>window.location.href='default.php?page=paket/umroh';</script>";
        exit;

    } catch (Throwable $t) {
        // rollback jika in transaction
        if (isset($db) && $db->inTransaction()) {
            $db->rollBack();
        }
        // log detail error (untuk dev)
        error_log("Paket delete error: " . $t->getMessage() . " in " . $t->getFile() . ":" . $t->getLine());
        // tampilkan pesan aman ke user
        $_SESSION['error_message'] = "Terjadi kesalahan saat menghapus data paket. " . ($t instanceof Exception ? $t->getMessage() : "Silakan cek log.");
        echo "<script>window.location.href='default.php?page=paket/umroh';</script>";
        exit;
    }
}

// Periksa apakah ID ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID Paket tidak valid.</div>";
    exit;
}

$package_id = (int)$_GET['id'];

// Inisialisasi koneksi database untuk form (jika belum ada dari POST)
if (!isset($db)) {
    $db = new PDO('mysql:host=127.0.0.1;dbname=zhafirah_local;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}

// Ambil data paket dari database
$stmt = $db->prepare("SELECT * FROM packages WHERE id = ?");
$stmt->execute([$package_id]);
$package = $stmt->fetch();

if (!$package) {
    echo "<div class='alert alert-danger'>Data paket tidak ditemukan.</div>";
    exit;
}

// Cek apakah ada booking untuk paket ini
$stmt = $db->prepare("SELECT COUNT(*) as total FROM bookings WHERE package_id = ?");
$stmt->execute([$package_id]);
$booking_count = $stmt->fetch()['total'];
?>

<style>
.delete-section {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    max-width: 600px;
    margin: 0 auto;
}
.delete-title {
    font-size: 20px;
    font-weight: 600;
    color: #e74c3c;
    margin-bottom: 20px;
    border-bottom: 2px solid #e74c3c;
    padding-bottom: 10px;
}
.package-info {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}
.package-info h4 {
    color: #2c3e50;
    margin-bottom: 15px;
    font-size: 18px;
}
.info-row {
    display: flex;
    padding: 8px 0;
    border-bottom: 1px solid #dee2e6;
}
.info-label {
    font-weight: 600;
    color: #34495e;
    width: 150px;
}
.info-value {
    color: #2c3e50;
    flex: 1;
}
.warning-box {
    background: #fff3cd;
    border: 1px solid #ffc107;
    color: #856404;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}
.danger-box {
    background: #f8d7da;
    border: 1px solid #e74c3c;
    color: #721c24;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}
.btn-delete-confirm {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-block;
}
.btn-delete-confirm:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
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
</style>

<div class="delete-section">
    <h3 class="delete-title">🗑️ Konfirmasi Penghapusan Paket</h3>

    <div class="package-info">
        <h4>Detail Paket yang akan dihapus:</h4>
        <div class="info-row">
            <div class="info-label">Kode Paket:</div>
            <div class="info-value"><strong><?= htmlspecialchars($package['package_code']) ?></strong></div>
        </div>
        <div class="info-row">
            <div class="info-label">Nama Paket:</div>
            <div class="info-value"><strong><?= htmlspecialchars($package['package_name']) ?></strong></div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal Berangkat:</div>
            <div class="info-value"><?= date('d F Y', strtotime($package['departure_date'])) ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Harga:</div>
            <div class="info-value">Rp <?= number_format($package['price'], 0, ',', '.') ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Kuota:</div>
            <div class="info-value"><?= $package['remaining_quota'] ?> / <?= $package['quota'] ?> tersisa</div>
        </div>
    </div>

    <?php if ($booking_count > 0): ?>
        <div class="danger-box">
            <strong>⚠️ PERINGATAN!</strong><br>
            Paket ini tidak dapat dihapus karena masih memiliki <strong><?= $booking_count ?> booking aktif</strong>.<br>
            Silakan hubungi administrator untuk menangani booking terlebih dahulu.
        </div>
        <div class="d-flex justify-content-center gap-2 mt-4">
            <a href="?page=paket/umroh" class="btn-cancel">← Kembali ke Daftar Paket</a>
        </div>
    <?php else: ?>
        <div class="warning-box">
            <strong>⚠️ Perhatian!</strong><br>
            Tindakan ini tidak dapat dibatalkan. Semua data paket akan dihapus secara permanen dari database.
        </div>

        <p style="text-align: center; color: #e74c3c; font-weight: 600; margin-bottom: 20px;">
            Apakah Anda yakin ingin menghapus paket ini?
        </p>

        <div class="d-flex justify-content-center gap-2 mt-4">
            <a href="?page=paket/umroh" class="btn-cancel">Batal</a>
            <a href="?page=paket/delete&id=<?= $package_id ?>&confirm=yes" class="btn-delete-confirm">Ya, Hapus Paket</a>
        </div>
    <?php endif; ?>
</div>
