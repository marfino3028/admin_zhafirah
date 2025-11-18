<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_bhp set nm_bhp='".$_POST['nm_bhp']."', des_bhp='".$_POST['des_bhp']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=farmasi&submod=bhp");
?>