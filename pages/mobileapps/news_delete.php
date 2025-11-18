<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$delete = $db->query("update tbl_news set status='NON AKTIF' where id='".$_GET['id']."'", 0);
	}
	header("location:../../index.php?mod=mobileapps&submod=news");
?>