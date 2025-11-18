
<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 1);
	$term = $_GET['term'];
	$data = $db->query("select kode_supplier, nama_supplier from tbl_penerimaan where nama_supplier like '%".$term."%' and status_update='UPDATE'", 0);
	$array = array();
    if($data)
	for ($i = 0; $i < count($data); $i++) {
		$array[$i]["itemName"] = $data[$i]["kode_supplier"] . " - " . $data[$i]["nama_supplier"];
		$array[$i]["id"] = $data[$i]["kode_supplier"];
	}
	echo json_encode($array);
