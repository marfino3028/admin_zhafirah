<?php
include __DIR__ . "/../../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal_so = $_POST['tanggal_so'];
    $tanggal_so2 = $_POST['tanggal_so2'];

    $sql_wh = "SELECT h.*, w.nm_wh FROM tbl_so_header h INNER JOIN tbl_warehouse w ON h.kd_wh=w.kd_wh WHERE h.date_created BETWEEN '$tanggal_so' AND '$tanggal_so2'";
    $result_wh = mysqli_query($conn, $sql_wh);

    $data = [];
    while ($row = mysqli_fetch_assoc($result_wh)) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}
