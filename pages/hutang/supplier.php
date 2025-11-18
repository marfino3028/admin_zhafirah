
<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	$term = $_GET['term'];
	$data = $db->query("select kode_supplier, nama_supplier, no_penerimaan from tbl_penerimaan where nama_supplier like '%".$term."%' and status_update='UPDATE' order by id desc", 0);
	$array = array();
    if($data)
	for ($i = 0; $i < count($data); $i++) {
		$array[$i]["itemName"] = $data[$i]["no_penerimaan"] . " - " . $data[$i]["nama_supplier"];
		$array[$i]["id"] = $data[$i]["no_penerimaan"];
	}
	echo json_encode($array);
?>