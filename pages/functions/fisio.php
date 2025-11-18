
<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 1);
	$term = $_GET['term'];
	$data = $db->query("
	select * from tbl_tarif where kode_jns_tarif='5' and nama_pelayanan like '%$term%' and status_delete='UD' order by kode_kat_pelayanan", 0);
	$array = array();
    if($data)
	for ($i = 0; $i < count($data); $i++) { 
		$array[$i]["itemName"] = $data[$i]["kode_tarif"] . " - " . $data[$i]["nama_pelayanan"];
		$array[$i]["id"] = $data[$i]["kode_tarif"];
	}
	echo json_encode($array);
