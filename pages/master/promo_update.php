<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_promo set nm_promo='".$_POST['nm_promo']."', discount='".$_POST['discount']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=promo");
?>