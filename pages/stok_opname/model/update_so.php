<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include __DIR__ . "/../../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $kodeWareHouse = isset($_POST['kodeWareHouse']) ? $_POST['kodeWareHouse'] : '';

    $kode_obat   = isset($_POST['kode_obat']) ? $_POST['kode_obat'] : array();
    $stock_fisik = isset($_POST['stock_fisik']) ? $_POST['stock_fisik'] : array();
    $selisih     = isset($_POST['selisih']) ? $_POST['selisih'] : array();
    $adjusment   = isset($_POST['adjusment']) ? $_POST['adjusment'] : array();
    $stock_akhir = isset($_POST['stock_akhir']) ? $_POST['stock_akhir'] : array();
    $keterangan  = isset($_POST['keterangan']) ? $_POST['keterangan'] : array();
    $status_so   = isset($_POST['status_so']) ? $_POST['status_so'] : array();

    foreach ($stock_fisik as $id_detail => $val_fisik) {
        $fisik  = mysqli_real_escape_string($conn, $val_fisik);
        $sel    = mysqli_real_escape_string($conn, isset($selisih[$id_detail]) ? $selisih[$id_detail] : '');
        $adj    = mysqli_real_escape_string($conn, isset($adjusment[$id_detail]) ? $adjusment[$id_detail] : '');
        $akhir  = mysqli_real_escape_string($conn, isset($stock_akhir[$id_detail]) ? $stock_akhir[$id_detail] : '');
        $ket    = mysqli_real_escape_string($conn, isset($keterangan[$id_detail]) ? $keterangan[$id_detail] : '');
        $sts    = mysqli_real_escape_string($conn, isset($status_so[$id_detail]) ? $status_so[$id_detail] : '');
        $kdobat = mysqli_real_escape_string($conn, isset($kode_obat[$id_detail]) ? $kode_obat[$id_detail] : '');

        $sql = "
            UPDATE tbl_so_detail 
            SET stock_fisik = '$fisik',
                selisih     = '$sel',
                adjusment   = '$adj',
                stock_akhir = '$akhir',
                keterangan  = '$ket',
                status_so   = '$sts'
            WHERE id_detail = '$id_detail'
        ";

        $q = mysqli_query($conn, $sql);
        if (!$q) {
            die("Error update id_detail $id_detail: " . mysqli_error($conn));
        }

        if ($sts == '3') {
            if ($kodeWareHouse == '1') {
                // gudang medis = stock_akhir
                mysqli_query($conn, "UPDATE tbl_obat SET stock_akhir = '$fisik' WHERE kode_obat = '$kdobat'");
            } else if ($kodeWareHouse == '2') {
                // apotek = stock_akhir_apotik
                mysqli_query($conn, "UPDATE tbl_obat SET stock_akhir_apotik = '$fisik' WHERE kode_obat = '$kdobat'");
            } else if ($kodeWareHouse == '3') {
                // keperawatan = stock_akhir_keperawatan
                mysqli_query($conn, "UPDATE tbl_obat SET stock_akhir_keperawatan = '$fisik' WHERE kode_obat = '$kdobat'");
            } else if ($kodeWareHouse == '4') {
                // fisioterapi = stock_akhir_fisio
                mysqli_query($conn, "UPDATE tbl_obat SET stock_akhir_fisio = '$fisik' WHERE kode_obat = '$kdobat'");
            }
        }
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>
