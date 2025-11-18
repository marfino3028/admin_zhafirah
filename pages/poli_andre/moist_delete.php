<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		$deletemoist = $db->query("update tbl_moist set status_delete='D' where id='".$_GET['id']."'");
		$deletemoistDetail = $db->query("update tbl_moist_detail set status_delete='D' where moistID='".$_GET['id']."'");
	}
	header("location:../../index.php?mod=poli&submod=moist");
?>