<?php
include __DIR__ . "/../../../koneksi.php";
function genOpname($kd_wh)
{
    include __DIR__ . "/../../../koneksi.php";
    date_default_timezone_set("Asia/Jakarta");
    $tgl = date('Y-m-d');
    $tgl_jam = date('Y-m-d H:i');

    $sql_cek = "SELECT * FROM tbl_so_header WHERE kd_wh = '$kd_wh' AND date_created = '$tgl'";
    $cek = mysqli_query($conn, $sql_cek);

    if (mysqli_num_rows($cek) == 0) {
        $sql_gen = "INSERT INTO tbl_so_header (kd_wh, date_created, datetime_created) VALUES ('$kd_wh', '$tgl', '$tgl_jam')";
        mysqli_query($conn, $sql_gen);
        $id_header = mysqli_insert_id($conn);

        $sql_master_obat = "SELECT * FROM tbl_obat WHERE status_delete = 'UD'";
        $result_obat = mysqli_query($conn, $sql_master_obat);
        while ($row = mysqli_fetch_assoc($result_obat)):
            $id = $row['id'];
            $kode_obat = $row['kode_obat'];
            $nama_obat = $row['nama_obat'];
            $jenis = $row['jenis'];
            $satuan_besar = $row['satuan_besar'];
            $satuan_terkecil = $row['satuan_terkecil'];
            $stock_awal = $row['stock_awal'];
            if ($kd_wh == '1') {
                $stock_sistem = $row['stock_akhir'];
            } else if ($kd_wh == '2') {
                $stock_sistem = $row['stock_akhir_apotik'];
            } else if ($kd_wh == '3') {
                $stock_sistem = $row['stock_akhir_keperawatan'];
            } else if ($kd_wh == '4') {
                $stock_sistem = $row['stock_akhir_fisio'];
            } else {
                $stock_sistem = '';
            }

            $sql_insert_detail = "INSERT INTO tbl_so_detail (id_header, id_obat, kode_obat, nama_obat, jenis, satuan_besar, satuan_terkecil,
             stock_sistem, status_so) VALUES ('$id_header', '$id', '$kode_obat', '$nama_obat', '$jenis', '$satuan_besar', '$satuan_terkecil', '$stock_sistem', '1')";
            mysqli_query($conn, $sql_insert_detail);

        endwhile;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kd = $_POST['kd'];
    $ceklist = isset($_POST['ceklist']) ? $_POST['ceklist'] : [];
    foreach ($kd as $i => $kd_wh) {
        $status_freeze = isset($ceklist[$i]) && $ceklist[$i] == 1 ? 1 : 0;

        $kd_wh = mysqli_real_escape_string($conn, $kd_wh);
        $sql_update = "UPDATE tbl_warehouse SET status_freeze = $status_freeze WHERE kd_wh = '$kd_wh'";
        mysqli_query($conn, $sql_update);
        if ($status_freeze == 1) {
            genOpname($kd_wh);
        }
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
}
