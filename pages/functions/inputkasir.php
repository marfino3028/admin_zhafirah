
<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 1);
	$term = $_GET['term'];
	$data = $db->query("
	select a.no_daftar, b.nm_pasien as nama_pasien from tbl_pendaftaran a
	left join tbl_pasien b on b.nomr=a.nomr 
	where( b.nm_pasien like '%".$term."%' or a.no_daftar = '".$term."')
	 and a.status_delete='UD'
	 and b.status_delete='UD'
	 and  a.status_pasien='OPEN'
		limit 10
	 ", 0);
	$array = array();
    if ($data) {
        for ($i = 0; $i < count($data); $i++) {
            $array[$i]["itemName"] = $data[$i]["no_daftar"] . " - " . $data[$i]["nama_pasien"];
            $array[$i]["id"]       = $data[$i]["no_daftar"];
        }

        $databaru = count($data);

        $data = $db->query("
	select a.no_daftar, b.nm_pasien as nama_pasien from tbl_pendaftaran_jamsostek a
	left join tbl_pasien b on b.nomr=a.nomr 
	where( b.nm_pasien like '%" . $term . "%' or a.no_daftar = '" . $term . "')
	 and a.status_delete='UD'
	 and b.status_delete='UD'
	 and  a.status_pasien='OPEN'
		limit 10
	 ", 0);
        if($data)
        for ($i = $databaru; $i < count($data); $i++) {
            $array[$i]["itemName"] = $data[$i]["no_daftar"] . " - " . $data[$i]["nama_pasien"];
            $array[$i]["id"]       = $data[$i]["no_daftar"];
        }
    }
	echo json_encode($array);