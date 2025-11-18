<?php
	session_start();
	include "../../3rdparty/engine.php";
	echo "<pre>";
	print_r($_POST);
	ini_set("display_errors", 0);
	date_default_timezone_set("Asia/Jakarta");
	
	if ($_SESSION['rg_user'] != '') {
	    
		$insert = $db->query("delete from  tbl_paketmcu_header where md5(id)='".$_GET['id']."'", 0);
		$insert = $db->query("delete from tbl_paketmcu_detail where md5(paketmcu_id)='".$_GET['id']."'", 0);

		header("location:../../index.php?mod=mcu&submod=paket");
	}
?>?>