<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data tindakan laboratorium
		$update = $db->query("update tbl_pendaftaran set status_mesin='CLOSED' where md5(no_daftar)='".$_GET['id']."'", 0);

		//update di perjanjian kalau ada bahwa ini sudah closed
		$update = $db->query("update tbl_perjanjian set status_pasien='CLOSED' where md5(no_daftar)='".$_GET['id']."'");
	}
	header("location:../../index.php?mod=hd&submod=hd");
?>