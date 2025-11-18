<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_feedback (user, feedback, rating) values ('".$_POST['User']."', '".$_POST['isi']."', '".$_POST['rating']."')", 0);
	}
	header("location:../../index.php?mod=mobileapps&submod=feed");
?>