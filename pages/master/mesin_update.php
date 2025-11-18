<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_mesinHD set 
		merk_mesin ='".$_POST['merk_mesin']."', 
		no_seri='".$_POST['no_seri']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=mesinHD");
?>