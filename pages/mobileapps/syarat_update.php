<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_syarat set no='".$_POST['no']."', content='".$_POST['content']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=mobileapps&submod=syarat");
?>