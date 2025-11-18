<?php
	session_start();
	include "../../3rdparty/engine.php";
	echo "<pre>";
	print_r($_POST);
	ini_set("display_errors", 0);
	date_default_timezone_set("Asia/Jakarta");
	
	if ($_SESSION['rg_user'] != '') {
	    
		$insert = $db->query("delete from tbl_modul_mcu where md5(id)='".$_GET['id']."'", 0);

		header("location:../../index.php?mod=mcu&submod=module");
	}
?>?>