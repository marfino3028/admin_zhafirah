<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$nama = $db->queryItem("select nama_suplier from tbl_suplier where kode_suplier='".$_POST['supplier']."'");
		$insert = $db->query("insert into tbl_cito (no_cito, tgl_input_cito, kode_suplier, nama_suplier, input_by) values ('".$_POST['no_cito']."', '".date("Y-m-d")."', '".$_POST['supplier']."', '$nama', '".$_SESSION['rg_user']."')", 0);
		$id = mysql_insert_id();
		header("location:../../index.php?mod=inv&submod=cito_detail&id=$id");
	}
?>