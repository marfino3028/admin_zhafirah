<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_comodity set 
		kd_comodity='".$_POST['kd_comodity']."', 
		comodity='".$_POST['comodity']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=comodity");
?>