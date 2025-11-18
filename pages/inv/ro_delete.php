<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$ro = $db->queryItem("select no_ro from tbl_ro where id='".$_GET['id']."'");
		$ro = $db->queryItem("select no_ro from tbl_ro where id='".$_GET['id']."'");
		$delete = $db->query("delete from tbl_ro where id='".$_GET['id']."'", 0);
		$update_ro = $db->query("update tbl_ro set status_po='NOT' where no_ro='$ro'");
		$rod = $db->query("select id from tbl_ro where no_ro='".$ro."'");
		for ($i = 0; $i < count($rod); $i++) {
			$update = $db->query("update tbl_ro_detail set qty_po='0', harga_po='0' where id='".$rod[0]['id']."'");
		}

		header("location:../../index.php?mod=inv&submod=ro");
	}
?>