<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_mesinHD (merk_mesin,no_seri) values ('".$_POST['merk_mesin']."', '".$_POST['no_seri']."')");
	}
	header("location:../../index.php?mod=master&submod=mesinHD");
?>