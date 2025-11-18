<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$update_ro = $db->query("update tbl_ro set status_ro='A' where md5(no_ro)='".$_GET['id']."'");
		header("location:../../index.php?mod=inv&submod=ro");
	}
?>