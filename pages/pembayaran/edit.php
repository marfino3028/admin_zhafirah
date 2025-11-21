<?php
// Periksa apakah ID pembayaran ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID Pembayaran tidak valid.";
    exit;
}
$payment_id = $_GET['id'];

// Ambil data pembayaran yang ada
$payment = $db->query("
    SELECT 
        pay.*,
        p.package_type
    FROM payments pay
    JOIN bookings b ON pay.booking_id = b.id
    JOIN packages p ON b.package_id = p.id
    WHERE pay.id = ?
", $payment_id);

if (!$payment) {
    echo "Data pembayaran tidak ditemukan.";
    exit;
}
$payment = $payment[0]; // Ambil baris pertama
$page_title = ucfirst($payment['package_type']);

// Ambil daftar booking yang relevan untuk dropdown
$bookings = $db->query("
    SELECT 
        b.id, b.booking_code, u.full_name, p.name as package_name
    FROM bookings b
    JOIN users u ON b.user_id = u.id
    JOIN packages p ON b.package_id = p.id
    WHERE p.package_type = ? AND b.status IN ('confirmed', 'pending', 'paid')
    ORDER BY u.full_name ASC
", $payment['package_type']);


// Proses update data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_payment'])) {
    $booking_id = $_POST['booking_id'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $payment_date = $_POST['payment_date'];
    $reference_code = $_POST['reference_code'];
    $status = $_POST['status'];

    $update = $db->query(
        "UPDATE payments SET booking_id = ?, amount = ?, payment_method = ?, payment_date = ?, status = ?, reference_code = ? WHERE id = ?",
        $booking_id, $amount, $payment_method, $payment_date, $status, $reference_code, $payment_id
    );

    if ($update) {
        $redirect_url = "?mod=pembayaran&submod=" . $payment['package_type'];
        echo "<script>alert('Pembayaran berhasil diperbarui.'); window.location.href='$redirect_url';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui pembayaran.');</script>";
    }
}
?>

<style>
.form-section{background:white;border-radius:10px;padding:25px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.form-group{margin-bottom:20px}
.form-group label{display:block;margin-bottom:8px;font-weight:600;color:#2c3e50}
.form-group select, .form-group input{width:100%;padding:12px;border:1px solid #ddd;border-radius:5px;font-size:14px}
.btn-submit{background:linear-gradient(135deg,#f39c12 0%,#e74c3c 100%);color:white;border:none;padding:15px 30px;border-radius:8px;font-weight:600;cursor:pointer;transition:all .3s}
</style>

<div class="form-section">
    <h3>Edit Pembayaran <?= $page_title ?></h3>
    <hr>
    <form method="POST" action="">
        <input type="hidden" name="edit_payment" value="1">

        <div class="form-group">
            <label>Pilih Pendaftaran (Jamaah & Paket)</label>
            <select name="booking_id" required>
                <option value="">-- Pilih Kode Booking / Nama Jamaah --</option>
                <?php if ($bookings) { foreach ($bookings as $booking) { 
                    $selected = ($booking['id'] == $payment['booking_id']) ? 'selected' : '';
                ?>
                    <option value="<?= $booking['id'] ?>" <?= $selected ?>>
                        <?= htmlspecialchars($booking['booking_code'] . " - " . $booking['full_name'] . " (" . $booking['package_name'] . ")") ?>
                    </option>
                <?php }} ?>
            </select>
        </div>

        <div class="form-group">
            <label>Jumlah Pembayaran (Rp)</label>
            <input type="number" name="amount" value="<?= htmlspecialchars($payment['amount']) ?>" required>
        </div>

        <div class="form-group">
            <label>Metode Pembayaran</label>
            <select name="payment_method" required>
                <option value="transfer" <?= $payment['payment_method'] == 'transfer' ? 'selected' : '' ?>>Transfer Bank</option>
                <option value="cash" <?= $payment['payment_method'] == 'cash' ? 'selected' : '' ?>>Tunai (Cash)</option>
                <option value="debit" <?= $payment['payment_method'] == 'debit' ? 'selected' : '' ?>>Debit</option>
                <option value="credit_card" <?= $payment['payment_method'] == 'credit_card' ? 'selected' : '' ?>>Kartu Kredit</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Pembayaran</label>
            <input type="date" name="payment_date" value="<?= htmlspecialchars($payment['payment_date']) ?>" required>
        </div>
        
        <div class="form-group">
            <label>Kode Referensi / Bukti Transfer (Opsional)</label>
            <input type="text" name="reference_code" value="<?= htmlspecialchars($payment['reference_code']) ?>">
        </div>

        <div class="form-group">
            <label>Status Pembayaran</label>
            <select name="status" required>
                <option value="paid" <?= $payment['status'] == 'paid' ? 'selected' : '' ?>>Lunas (Paid)</option>
                <option value="pending" <?= $payment['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            </select>
        </div>
        
        <button type="submit" class="btn-submit">Update Pembayaran</button>
        <a href="?mod=pembayaran&submod=<?= $payment['package_type'] ?>" style="margin-left: 10px;">Batal</a>
    </form>
</div>
