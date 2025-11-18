<?php
	session_start();
	include "../../3rdparty/engine.php";
	echo "<pre>";
	print_r($_POST);
	ini_set("display_errors", 0);
	date_default_timezone_set("Asia/Jakarta");
	
	if ($_SESSION['rg_user'] != '') {
		$coa = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='".$_POST['coa']."'");
		$coa_beban = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='".$_POST['coa_beban']."'");
		$insert = $db->query("update tbl_paketmcu_header set nama='".$_POST['nama']."', coa_kode='".$_POST['coa']."', coa_nama='".$coa[0]['nm_coa']."', coa_beban_kode='".$_POST['coa_beban']."', coa_beban_nama='".$coa_beban[0]['nm_coa']."', grup='".$_POST['grup']."', mulai='".$_POST['mulai']."', sampai='".$_POST['sampai']."', user_insert='".$_SESSION['rg_nama']."' where md5(id)='".$_POST['id']."'", 0);

		header("location:../../index.php?mod=mcu&submod=paket");
	}
?>?>