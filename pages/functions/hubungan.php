
<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 1);
	$term = $_GET['term'];
	$data = $db->query("
	select nomr, nm_pasien from tbl_pasien
	where( 
	 nm_pasien like '%".$term."%' or nomr = '".$term."')
	 and status_delete='UD'
	 and nm_pasien <> '' 
	 order by nm_pasien
		limit 10
	 ", 0);
	$array = array();
    if($data)
	for ($i = 0; $i < count($data); $i++) { 
		$array[$i]["itemName"] = $data[$i]["nomr"] . " - " . $data[$i]["nm_pasien"];
		$array[$i]["id"] = $data[$i]["nomr"];
	}
	echo json_encode($array);
