<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_comodity (kd_comodity, comodity) values ('".$_POST['kd_comodity']."', '".$_POST['comodity']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=comodity");
?>