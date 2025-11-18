<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	if ($_SESSION['rg_user'] != '') {
		if ($_POST['hub'] == '') {
			$hubungan = $_POST['nama_hub'];
		}
		else {
			$hubungan = $_POST['hub'];
		}

		$dt = $db->query("select nm_pasien from tbl_pasien where nomr='".$_POST['hub_nomr']."'");
		$insert = $db->query("insert into tbl_hubungan_keluarga (nama, hubungan, nomr, nomr_nama) values ('".$_POST['nama']."', '".$hubungan."', '".$_POST['hub_nomr']."', '".$dt[0]['nm_pasien']."')", 0);
		header("location:../../index.php?mod=pendaftaran&submod=hubungan");
	}
?>