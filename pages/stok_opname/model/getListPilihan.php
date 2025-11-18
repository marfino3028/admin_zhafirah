<?php
include __DIR__ . "/../../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tgl = $_POST['tgl'];
    $kd_wh = $_POST['kd_wh'];

    $sql_wh = "SELECT d.jenis FROM tbl_so_detail d INNER JOIN tbl_so_header h ON d.id_header=h.id_so AND h.kd_wh = '$kd_wh' WHERE h.date_created = '$tgl' GROUP BY d.jenis ORDER BY d.jenis DESC";
    $result_wh = mysqli_query($conn, $sql_wh);

    $data = [];
    while ($row = mysqli_fetch_assoc($result_wh)) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}
