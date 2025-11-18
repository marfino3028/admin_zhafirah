<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$_POST['nomr']."'");
		$insert = $db->query("insert into  tbl_opname_apotik (no_opn_apotik, tgl_input_opn_apotik, unit, input_by) values ('".$_POST['no_opn_apotik']."', '".date("Y-m-d")."', '".$_POST['unit']."', '".$_SESSION['rg_user']."')", 0);
		$id = mysql_insert_id();
		header("location:../../index.php?mod=inv&submod=input_stock_opnameApotik_detail&id=$id");
	}
?>