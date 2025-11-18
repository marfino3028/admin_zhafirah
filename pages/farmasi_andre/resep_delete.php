<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$delete = $db->query("update tbl_resep set status_delete='D' where id='".$_GET['id']."'");
	}
	header("location:../../index.php?mod=farmasi&submod=input_resep");
?>