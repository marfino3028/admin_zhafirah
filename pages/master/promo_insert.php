<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_promo (nm_promo, discount) values ('".$_POST['nm_promo']."', '".$_POST['discount']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=promo");
?>