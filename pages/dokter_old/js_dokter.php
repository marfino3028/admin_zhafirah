<?php
date_default_timezone_set("Asia/Jakarta");
if (isset($_POST)) {
    $jenis_query = $_POST['jenis_query'];
    function getAllDiagnosa()
    {
        include "../../3rdparty/engine.php";
        $query = $db->query("select kode_icd, nama_diagnosa, nama_icd from tbl_icd where nama_diagnosa <> 'null' order by nama_diagnosa asc limit 200");
        $jumlahData = count($query);
        $respon = [
            "jumlahData" => $jumlahData,
            "list" => $query
        ];
        return json_encode($respon);
    }

    function getFilterDiagnosa($cariDiagnosa)
    {
        include "../../3rdparty/engine.php";
        $query = $db->query("SELECT kode_icd, nama_diagnosa, nama_icd 
                     FROM tbl_icd 
                     WHERE nama_diagnosa LIKE '%$cariDiagnosa%' 
                        OR nama_icd LIKE '%$cariDiagnosa%' 
                        OR kode_icd LIKE '%$cariDiagnosa%' 
                     ORDER BY nama_diagnosa ASC");
        $jumlahData = count($query);
        $respon = [
            "jumlahData" => $jumlahData,
            "list" => $query
        ];
        return json_encode($respon);
    }

    if ($jenis_query == "All Diagnosis") {
        echo getAllDiagnosa();
    } else if ($jenis_query == "Filter Diagnosis") {
        $cariDiagnosa = $_POST['cariDiagnosa'];
        echo getFilterDiagnosa($cariDiagnosa);
    }
}
