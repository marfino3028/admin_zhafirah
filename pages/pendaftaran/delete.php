<?php
// Periksa apakah ID booking ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID Pendaftaran tidak valid.";
    exit;
}

$booking_id = $_GET['id'];

// Ambil tipe paket untuk redirect kembali
$booking_data = $db->query("SELECT p.package_type FROM bookings b JOIN packages p ON b.package_id = p.id WHERE b.id = ?", $booking_id);

if (!$booking_data) {
    echo "Data pendaftaran tidak ditemukan.";
    exit;
}
$package_type = $booking_data[0]['package_type'];
$redirect_url = "?mod=pendaftaran&submod=" . $package_type;

// Hapus data dari tabel bookings
// Sebaiknya, jangan benar-benar menghapus data. Cukup ubah statusnya menjadi 'cancelled'
// Ini untuk menjaga integritas data, terutama jika sudah ada pembayaran terkait.
// $delete = $db->query("DELETE FROM bookings WHERE id = ?", $booking_id);

// Opsi yang lebih aman: Ubah status menjadi 'cancelled'
$update = $db->query("UPDATE bookings SET status = 'cancelled' WHERE id = ?", $booking_id);


if ($update) {
    echo "<script>alert('Pendaftaran telah dibatalkan.'); window.location.href='$redirect_url';</script>";
} else {
    echo "<script>alert('Gagal membatalkan pendaftaran.'); window.location.href='$redirect_url';</script>";
}
?>
