<?php
// Periksa apakah ID pembayaran ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID Pembayaran tidak valid.";
    exit;
}

$payment_id = $_GET['id'];

// Ambil tipe paket untuk redirect kembali
$payment_data = $db->query("
    SELECT p.package_type 
    FROM payments pay
    JOIN bookings b ON pay.booking_id = b.id
    JOIN packages p ON b.package_id = p.id
    WHERE pay.id = ?
", $payment_id);

if (!$payment_data) {
    echo "Data pembayaran tidak ditemukan.";
    exit;
}
$package_type = $payment_data[0]['package_type'];
$redirect_url = "?mod=pembayaran&submod=" . $package_type;

// Hapus data dari tabel payments
// Peringatan: Menghapus data secara permanen bisa berisiko.
// Opsi yang lebih baik adalah menggunakan soft delete (misal: UPDATE payments SET deleted_at = NOW() WHERE id = ?)
// Namun untuk saat ini, kita akan menghapusnya sesuai permintaan.
$delete = $db->query("DELETE FROM payments WHERE id = ?", $payment_id);

if ($delete) {
    echo "<script>alert('Data pembayaran telah dihapus.'); window.location.href='$redirect_url';</script>";
} else {
    echo "<script>alert('Gagal menghapus data pembayaran.'); window.location.href='$redirect_url';</script>";
}
?>
