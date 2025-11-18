<?php
	session_start();
	date_default_timezone_set("Asia/Bangkok");
	echo '<pre>';
	print_r($_POST);
	print_r($_SESSION);
	echo date("d F Y H:i:s"); 

	include "../../3rdparty/engine.php";
	//echo '<pre>';
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_pemeriksaan");
		//print_r($data);
		for ($i = 0; $i < count($data); $i++) {
			$theID = 'id'.$data[$i]['id'];
			$theIDField = 'siap'.$data[$i]['id'];
			echo $_POST[$theIDField].'<br>';
		}
	}
?>