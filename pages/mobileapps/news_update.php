<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_news set title_news='".$_POST['title_news']."', news='".$_POST['news']."', tgl_publish='".$_POST['tgl_publish']."', status='".$_POST['status']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=mobileapps&submod=news");
?>