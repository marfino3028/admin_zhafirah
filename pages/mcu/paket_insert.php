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
		$insert = $db->query("insert into tbl_paketmcu_header (nama, coa_kode, coa_nama, coa_beban_kode, coa_beban_nama, grup, mulai, sampai, user_insert) values ('".$_POST['nama']."', '".$_POST['coa']."', '".$coa[0]['nm_coa']."', '".$_POST['coa_beban']."', '".$coa_beban[0]['nm_coa']."', '".$_POST['grup']."', '".$_POST['mulai']."', '".$_POST['sampai']."', '".$_SESSION['rg_nama']."')", 0);
		$id = mysql_insert_id();

		header("location:../../index.php?mod=mcu&submod=paket_detail&id=".md5($id));
	}
?>?>