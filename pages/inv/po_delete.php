<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$po = $db->queryItem("select no_po from tbl_po where id='".$_GET['id']."'");
		$po = $db->queryItem("select no_po from tbl_po where id='".$_GET['id']."'");
		$delete = $db->query("delete from tbl_po where id='".$_GET['id']."'", 1);
		$update_po = $db->query("update tbl_po set status_po='NOT' where no_po='$po'");
		$rod = $db->query("select id from tbl_po where no_po='".$po."'");
		for ($i = 0; $i < count($rod); $i++) {
			$update = $db->query("update tbl_po_detail set qty_po='0', harga_po='0' where id='".$rod[0]['id']."'");
		}

		//header("location:../../index.php?mod=inv&submod=po");
	}
?>