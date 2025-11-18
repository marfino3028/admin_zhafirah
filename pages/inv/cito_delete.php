<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$update_ro = $db->query("update tbl_cito set status_delete='D' where id='".$_GET['id']."'");

		header("location:../../index.php?mod=inv&submod=cito");
	}
?>