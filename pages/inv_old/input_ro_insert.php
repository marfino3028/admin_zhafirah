<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$_POST['nomr']."'");
		$insert = $db->query("insert into tbl_ro (no_ro, tgl_input_ro, unit, input_by) values ('".$_POST['no_ro']."', '".date("Y-m-d")."', '".$_POST['unit']."', '".$_SESSION['rg_user']."')", 0);
		$id = mysql_insert_id();
		header("location:../../index.php?mod=inv&submod=input_ro_detail&id=$id");
	}
?>