<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("update tbl_penerimaan set status_delete='D' where id='".$_GET['id']."'", 0);
		header("location:../../index.php?mod=inv&submod=penerimaan_obat");
	}
?>