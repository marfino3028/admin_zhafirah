
<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 1);
	$term = $_GET['term'];
	$data = $db->query("select * from tbl_pasien 
	where 
		nomr = '".$term."' 
		OR nm_pasien like '%".$term."%'
	
	 and status_delete='UD'
		limit 10
	 ", 0);
	$array = array();
    if($data)
	for ($i = 0; $i < count($data); $i++) { 
		$array[$i]["itemName"] = $data[$i]["nomr"] . " - " . $data[$i]["nm_pasien"];
		$array[$i]["id"] = $data[$i]["nomr"];
	}
	echo json_encode($array);
