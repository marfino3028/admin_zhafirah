<?php
	session_start();
	include "../../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		//$nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$_POST['nomr']."'");
		$insert = $db->query("insert into tbl_ro_to_gudang (no_ro_gudang, tgl_input_ro_gudang, unit, unit_diminta, input_by, jenis) values ('".$_POST['no_ro']."', '".date("Y-m-d")."', '".$_POST['unit']."', '".$_POST['unit_diminta']."', '".$_SESSION['rg_user']."', '".$_POST['jenis']."')", 0);
		$id = mysql_insert_id();
		$idr = md5($id);
		header("location:../../../index.php?mod=inv&submod=input_ApotikGudang_detail&id=$idr");
	}
?>