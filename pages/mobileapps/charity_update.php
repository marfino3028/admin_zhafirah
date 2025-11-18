<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_charity set title_charity='".$_POST['title_charity']."', charity='".$_POST['charity']."', tgl_publish='".$_POST['tgl_publish']."', status='".$_POST['status']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=mobileapps&submod=charity");
?>