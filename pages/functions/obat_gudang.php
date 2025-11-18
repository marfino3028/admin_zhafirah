
<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 1);
	$term = $_GET['term'];
	$data = $db->query("
	select * from tbl_obat
	where 
		kode_obat = '".$term."' 
		OR nama_obat like '%".$term."%'
	
	 and status_delete='UD'
		limit 10
	 ", 0);
	$array = array();
	/*$array[0]['id'] = "MEDIS";
	$array[0]['itemName']= "Tindakan Medis";
	
	$array[1]['id'] = "ALKES";
	$array[1]['itemName']= "ALKES";
	
	$array[2]['id'] = "RACIK";
	$array[2]['itemName']= "RACIK";
	
	$array[3]['id'] = "NRACIK";
	$array[3]['itemName']= "Obat non racikan";*/
    if($data)
	for ($i = 0; $i < count($data); $i++) {
		$array[$i]["itemName"] = $data[$i]["kode_obat"] . " - " . $data[$i]["nama_obat"];
		$array[$i]["id"] = $data[$i]["kode_obat"];
	}
	echo json_encode($array);
