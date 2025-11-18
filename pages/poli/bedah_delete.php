<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		$deletebedah = $db->query("update tbl_bedah set status_delete='D' where id='".$_GET['id']."'");
		$deletebedahDetail = $db->query("update tbl_bedah_detail set status_delete='D' where bedahID='".$_GET['id']."'");
	}
	header("location:../../index.php?mod=poli&submod=bedah");
?>