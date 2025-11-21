<?php
// Tentukan tipe paket berdasarkan URL
$type = isset($_GET['type']) && $_GET['type'] == 'haji' ? 'haji' : 'umroh';
$page_title = ucfirst($type);

// Ambil daftar booking yang relevan (umroh/haji) yang statusnya belum lunas
$bookings = $db->query("
    SELECT 
        b.id,
        b.booking_code,
        u.full_name,
        p.name as package_name
    FROM bookings b
    JOIN users u ON b.user_id = u.id
    JOIN packages p ON b.package_id = p.id
    WHERE p.package_type = ? AND b.status IN ('confirmed', 'pending')
    ORDER BY u.full_name ASC
", $type);

// Proses simpan data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_payment'])) {
    $booking_id = $_POST['booking_id'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $payment_date = $_POST['payment_date'];
    $reference_code = $_POST['reference_code'];
    $status = $_POST['status'];
    
    // Generate Transaction Code
    // Format: TRN-YYYYMMDD-BOOKINGID-RANDOM
    $transaction_code = "TRN-" . date("Ymd") . "-" . $booking_id . "-" . strtoupper(substr(md5(time()), 0, 6));

    $insert = $db->query(
        "INSERT INTO payments (booking_id, transaction_code, amount, payment_method, payment_date, status, reference_code) VALUES (?, ?, ?, ?, ?, ?, ?)",
        $booking_id, $transaction_code, $amount, $payment_method, $payment_date, $status, $reference_code
    );

    if ($insert) {
        // Optional: Update status booking jika pembayaran sudah 'paid'
        if ($status == 'paid') {
            // Logika untuk mengecek apakah total pembayaran sudah lunas bisa ditambahkan di sini
            // Untuk saat ini, kita update status booking menjadi 'paid' jika ada pembayaran lunas
            $db->query("UPDATE bookings SET status = 'paid' WHERE id = ?", $booking_id);
        }
        $redirect_url = "?mod=pembayaran&submod=" . $type;
        echo "<script>alert('Pembayaran baru berhasil ditambahkan.'); window.location.href='$redirect_url';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan pembayaran baru.');</script>";
    }
}
?>

<style>
.form-section{background:white;border-radius:10px;padding:25px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.form-group{margin-bottom:20px}
.form-group label{display:block;margin-bottom:8px;font-weight:600;color:#2c3e50}
.form-group select, .form-group input{width:100%;padding:12px;border:1px solid #ddd;border-radius:5px;font-size:14px}
.btn-submit{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:15px 30px;border-radius:8px;font-weight:600;cursor:pointer;transition:all .3s}
</style>

<div class="form-section">
    <h3>Tambah Pembayaran <?= $page_title ?></h3>
    <hr>
    <form method="POST" action="">
        <input type="hidden" name="add_payment" value="1">

        <div class="form-group">
            <label>Pilih Pendaftaran (Jamaah & Paket)</label>
            <select name="booking_id" required>
                <option value="">-- Pilih Kode Booking / Nama Jamaah --</option>
                <?php if ($bookings) { foreach ($bookings as $booking) { ?>
                    <option value="<?= $booking['id'] ?>">
                        <?= htmlspecialchars($booking['booking_code'] . " - " . $booking['full_name'] . " (" . $booking['package_name'] . ")") ?>
                    </option>
                <?php }} ?>
            </select>
        </div>

        <div class="form-group">
            <label>Jumlah Pembayaran (Rp)</label>
            <input type="number" name="amount" placeholder="Contoh: 5000000" required>
        </div>

        <div class="form-group">
            <label>Metode Pembayaran</label>
            <select name="payment_method" required>
                <option value="transfer">Transfer Bank</option>
                <option value="cash">Tunai (Cash)</option>
                <option value="debit">Debit</option>
                <option value="credit_card">Kartu Kredit</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Pembayaran</label>
            <input type="date" name="payment_date" value="<?= date('Y-m-d') ?>" required>
        </div>
        
        <div class="form-group">
            <label>Kode Referensi / Bukti Transfer (Opsional)</label>
            <input type="text" name="reference_code" placeholder="Contoh: TRF123XYZ">
        </div>

        <div class="form-group">
            <label>Status Pembayaran</label>
            <select name="status" required>
                <option value="paid">Lunas (Paid)</option>
                <option value="pending">Pending</option>
            </select>
        </div>
        
        <button type="submit" class="btn-submit">Simpan Pembayaran</button>
        <a href="?mod=pembayaran&submod=<?= $type ?>" style="margin-left: 10px;">Batal</a>
    </form>
</div>
