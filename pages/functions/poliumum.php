
<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 1);
	$term = $_GET['term'];
	$data = $db->query("
	select a.kode_tarif, a.nama_pelayanan from tbl_tarif as a
	left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan 
	where 
	 (a.nama_pelayanan like '%".$term."%' or a.kode_tarif = '".$term."')
	 and a.kode_jns_tarif='1'
	 and a.status_delete='UD'
		order by b.kode_kat_pelayanan
		limit 10
	 ", 0);
	$array = array();
    if($data)
	for ($i = 0; $i < count($data); $i++) { 
		$array[$i]["itemName"] = $data[$i]["kode_tarif"] . " - " . $data[$i]["nama_pelayanan"];
		$array[$i]["id"] = $data[$i]["kode_tarif"];
	}
	echo json_encode($array);
