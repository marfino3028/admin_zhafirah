<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_image set image_name='".$_POST['image_name']."', status='".$_POST['status']."' where id='".$_POST['id']."'", 1);
	}
	//header("location:../../index.php?mod=mobileapps&submod=slider");
?>