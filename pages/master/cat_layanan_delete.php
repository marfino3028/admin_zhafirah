<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$delete = $db->query("update  tbl_kat_pelayanan set status_delete='D' where id='".$_GET['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=category_layanan");
?>