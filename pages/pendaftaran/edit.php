<?php
// Periksa apakah ID booking ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID Pendaftaran tidak valid.";
    exit;
}

$booking_id = $_GET['id'];

// Ambil data booking yang akan diedit
$booking_data = $db->query("
    SELECT 
        b.id as booking_id,
        b.user_id,
        b.package_id,
        u.full_name,
        u.nik,
        p.package_type
    FROM bookings b
    JOIN users u ON b.user_id = u.id
    JOIN packages p ON b.package_id = p.id
    WHERE b.id = ?
", $booking_id);

if (!$booking_data) {
    echo "Data pendaftaran tidak ditemukan.";
    exit;
}
$booking = $booking_data[0];
$package_type = $booking['package_type'];

// Ambil daftar paket (umroh atau haji) yang masih tersedia
$packages = $db->query("
    SELECT 
        p.id, 
        p.name, 
        p.package_code, 
        p.quota,
        (SELECT COUNT(*) FROM bookings WHERE package_id = p.id AND status NOT IN ('cancelled', 'refunded')) as terisi
    FROM packages p
    WHERE p.package_type = ? AND p.status = 'active'
", $package_type);

$available_packages = [];
if ($packages) {
    foreach ($packages as $pkg) {
        // Kuota tersedia ATAU paket ini adalah paket yang sedang dipilih saat ini
        if (($pkg['terisi'] < $pkg['quota']) || ($pkg['id'] == $booking['package_id'])) {
            $available_packages[] = $pkg;
        }
    }
}

// Proses update data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_booking'])) {
    $new_package_id = $_POST['package_id'];
    $booking_status = $_POST['booking_status'];

    // Cek apakah user sudah terdaftar di paket baru (jika paketnya diubah)
    $is_package_changed = ($new_package_id != $booking['package_id']);
    $existing_booking = false;
    if ($is_package_changed) {
        $existing_booking = $db->query("SELECT id FROM bookings WHERE user_id = ? AND package_id = ?", $booking['user_id'], $new_package_id);
    }

    if ($existing_booking) {
        echo "<script>alert('Gagal: Jamaah sudah terdaftar pada paket baru yang dipilih.');</script>";
    } else {
        $update = $db->query(
            "UPDATE bookings SET package_id = ?, status = ? WHERE id = ?",
            $new_package_id, $booking_status, $booking_id
        );

        if ($update) {
            $redirect_url = "?mod=pendaftaran&submod=" . $package_type;
            echo "<script>alert('Data pendaftaran berhasil diperbarui.'); window.location.href='$redirect_url';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui data pendaftaran.');</script>";
        }
    }
}
?>

<style>
.form-section{background:white;border-radius:10px;padding:25px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.form-group{margin-bottom:20px}
.form-group label{display:block;margin-bottom:8px;font-weight:600;color:#2c3e50}
.form-group select, .form-group input[type='text']{width:100%;padding:12px;border:1px solid #ddd;border-radius:5px;font-size:14px;background:#f8f9fa;}
.btn-submit{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:15px 30px;border-radius:8px;font-weight:600;cursor:pointer;transition:all .3s}
</style>

<div class="form-section">
    <h3>Edit Pendaftaran <?= ucfirst($package_type) ?></h3>
    <hr>
    <form method="POST" action="">
        <input type="hidden" name="update_booking" value="1">

        <div class="form-group">
            <label>Jamaah</label>
            <input type="text" value="<?= htmlspecialchars($booking['nik'] . " - " . $booking['full_name']) ?>" disabled>
        </div>

        <div class="form-group">
            <label>Pilih Paket Keberangkatan Baru</label>
            <select name="package_id" required>
                <option value="">-- Pilih Paket --</option>
                <?php if ($available_packages) { foreach ($available_packages as $pkg) { 
                    $sisa_kuota = $pkg['quota'] - $pkg['terisi'];
                    $selected = ($pkg['id'] == $booking['package_id']) ? 'selected' : '';
                ?>
                    <option value="<?= $pkg['id'] ?>" <?= $selected ?>>
                        <?= htmlspecialchars($pkg['package_code'] . " - " . $pkg['name'] . " (Sisa Kuota: " . $sisa_kuota . ")") ?>
                    </option>
                <?php }} else { ?>
                    <option value="" disabled>Tidak ada paket yang tersedia</option>
                <?php } ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Status Pendaftaran</label>
            <select name="booking_status" required>
                <option value="pending" <?= ($booking['booking_status'] ?? '') == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="confirmed" <?= ($booking['booking_status'] ?? '') == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                <option value="paid" <?= ($booking['booking_status'] ?? '') == 'paid' ? 'selected' : '' ?>>Paid</option>
                <option value="cancelled" <?= ($booking['booking_status'] ?? '') == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
        </div>
        
        <button type="submit" class="btn-submit">Update Pendaftaran</button>
        <a href="?mod=pendaftaran&submod=<?= $package_type ?>" style="margin-left: 10px;">Batal</a>
    </form>
</div>
