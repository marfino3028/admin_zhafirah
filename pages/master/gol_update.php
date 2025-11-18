<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_gol_obt set 
		kd_gol='".$_POST['kd_gol']."', 
		golongan='".$_POST['golongan']."', 
		jenis_item='".$_POST['jenis_item']."',
		is_mims='".$_POST['is_mims']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=gol_obt");
?>