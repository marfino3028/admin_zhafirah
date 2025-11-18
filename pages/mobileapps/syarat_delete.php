<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$delete = $db->query("update tbl_syarat set status_delete='D' where id='".$_GET['id']."'", 0);
	}
	header("location:../../index.php?mod=mobileapps&submod=syarat");
?>