<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	if ($_SESSION['rg_user'] != '') {
		$dt = $db->query("select nm_pasien from tbl_pasien where nomr='".$_POST['hub_nomr']."'");
		$insert = $db->query("update tbl_hubungan_keluarga set nama='".$_POST['nama']."', hubungan='".$_POST['nama_hub']."', nomr='".$_POST['hub_nomr']."', nomr_nama='".$dt[0]['nm_pasien']."' where id='".$_POST['id']."'", 0);
		header("location:../../index.php?mod=pendaftaran&submod=hubungan");
	}
?>