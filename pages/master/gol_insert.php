<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_gol_obt (kd_gol, golongan, jenis_item, is_mims) values ('".$_POST['kd_gol']."', '".$_POST['golongan']."', '".$_POST['jenis_item']."', '".$_POST['is_mims']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=gol_obt");
?>