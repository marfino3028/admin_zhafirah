<?php
// Ambil daftar jamaah (users)
$users = $db->query("SELECT id, full_name, nik FROM users ORDER BY full_name ASC");

// Ambil daftar paket umroh yang masih aktif dan belum penuh
$packages = $db->query("
    SELECT 
        p.id, 
        p.name, 
        p.package_code, 
        p.quota,
        (SELECT COUNT(*) FROM bookings WHERE package_id = p.id AND status NOT IN ('cancelled', 'refunded')) as terisi
    FROM packages p
    WHERE p.package_type = 'umroh' AND p.status = 'active'
");

// Filter paket yang kuotanya masih tersedia
$available_packages = [];
if ($packages) {
    foreach ($packages as $pkg) {
        if ($pkg['terisi'] < $pkg['quota']) {
            $available_packages[] = $pkg;
        }
    }
}


// Proses simpan data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_booking'])) {
    $user_id = $_POST['user_id'];
    $package_id = $_POST['package_id'];
    $booking_date = date("Y-m-d"); // Tanggal hari ini
    $status = 'confirmed'; // Status default
    
    // Generate Booking Code
    // Format: ZUM-YYYYMMDD-USERID-PACKAGEID
    $booking_code = "ZUM-" . date("Ymd") . "-" . $user_id . "-" . $package_id;

    // Cek apakah user sudah terdaftar di paket yang sama
    $existing_booking = $db->query("SELECT id FROM bookings WHERE user_id = ? AND package_id = ?", $user_id, $package_id);

    if ($existing_booking) {
        echo "<script>alert('Gagal: Jamaah sudah terdaftar pada paket ini.');</script>";
    } else {
        $insert = $db->query(
            "INSERT INTO bookings (user_id, package_id, booking_code, booking_date, status) VALUES (?, ?, ?, ?, ?)",
            $user_id, $package_id, $booking_code, $booking_date, $status
        );

        if ($insert) {
            echo "<script>alert('Pendaftaran baru berhasil ditambahkan.'); window.location.href='?page=pendaftaran/umroh';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan pendaftaran baru.');</script>";
        }
    }
}
?>

<style>
.form-section{background:white;border-radius:10px;padding:25px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.form-group{margin-bottom:20px}
.form-group label{display:block;margin-bottom:8px;font-weight:600;color:#2c3e50}
.form-group select{width:100%;padding:12px;border:1px solid #ddd;border-radius:5px;font-size:14px}
.btn-submit{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:15px 30px;border-radius:8px;font-weight:600;cursor:pointer;transition:all .3s}
</style>

<div class="form-section">
    <h3>Tambah Pendaftaran Umroh</h3>
    <hr>
    <form method="POST" action="">
        <input type="hidden" name="add_booking" value="1">

        <div class="form-group">
            <label>Pilih Jamaah</label>
            <select name="user_id" required>
                <option value="">-- Cari NIK / Nama Jamaah --</option>
                <?php if ($users) { foreach ($users as $user) { ?>
                    <option value="<?= $user['id'] ?>">
                        <?= htmlspecialchars($user['nik'] . " - " . $user['full_name']) ?>
                    </option>
                <?php }} ?>
            </select>
        </div>

        <div class="form-group">
            <label>Pilih Paket Keberangkatan</label>
            <select name="package_id" required>
                <option value="">-- Pilih Paket --</option>
                <?php if ($available_packages) { foreach ($available_packages as $pkg) { 
                    $sisa_kuota = $pkg['quota'] - $pkg['terisi'];
                ?>
                    <option value="<?= $pkg['id'] ?>">
                        <?= htmlspecialchars($pkg['package_code'] . " - " . $pkg['name'] . " (Sisa Kuota: " . $sisa_kuota . ")") ?>
                    </option>
                <?php }} else { ?>
                    <option value="" disabled>Tidak ada paket yang tersedia</option>
                <?php } ?>
            </select>
        </div>
        
        <button type="submit" class="btn-submit">Simpan Pendaftaran</button>
        <a href="?page=pendaftaran/umroh" style="margin-left: 10px;">Batal</a>
    </form>
</div>
