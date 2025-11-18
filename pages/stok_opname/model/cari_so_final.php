<?php
include __DIR__ . "/../../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    date_default_timezone_set("Asia/Jakarta");
    $kd_wh = isset($_POST['kd_wh']) ? trim($_POST['kd_wh']) : '';
    $jenis = isset($_POST['jenis']) ? trim($_POST['jenis']) : '';
    $instatus_so = isset($_POST['instatus_so']) ? trim($_POST['instatus_so']) : '';
    $kode_obat = isset($_POST['kode_obat']) ? trim($_POST['kode_obat']) : '';
    $nama_obat = isset($_POST['nama_obat']) ? trim($_POST['nama_obat']) : '';
    header("Location: ../../../stok_opname.php?page=final&kd_wh=" . urlencode($kd_wh) .
        "&jenis=" . urlencode($jenis) .
        "&instatus_so=" . urlencode($instatus_so) .
        "&kode_obat=" . urlencode($kode_obat) .
        "&nama_obat=" . urlencode($nama_obat));
    exit;
}
