
<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 1);
	$term = $_GET['term'];
	$data = $db->query("select b.no_daftar, a.nomr, CONCAT(a.nm_pasien, ' - ', b.yang_berobat, ' | ', b.tgl_daftar) AS nm_pasien from tbl_pasien as a

		INNER JOIN tbl_pendaftaran as b ON b.nomr = a.nomr
		where 
			(a.nomr = '".$term."' OR a.nm_pasien like '%".$term."%')
			and b.status_pasien='OPEN'
			and b.status_delete='UD'
		limit 10
	 ", 0);
	$array = array();
    if ($data)
        for ($i = 0; $i < count($data); $i++) {
            $array[$i]["itemName"] = $data[$i]["nomr"] . " - " . $data[$i]["nm_pasien"];
            $array[$i]["id"] = $data[$i]['no_daftar'].'###'.$data[$i]["nomr"];
        }
	echo json_encode($array);
