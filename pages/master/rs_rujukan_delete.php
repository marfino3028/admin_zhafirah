<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$delete = $db->query("delete from tbl_rujukan where md5(id)='".$_GET['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=rs_rujukan");
?>