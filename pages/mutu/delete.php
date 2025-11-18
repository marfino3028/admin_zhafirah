<?php
	session_start();
	include "../../3rdparty/engine.php";
	//echo '<pre>';
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$delete = $db->query("delete from tbl_indikator where md5(id)='".$_GET['id']."'");
		header("location:../../index.php?mod=mutu&submod=index");

	}
?>