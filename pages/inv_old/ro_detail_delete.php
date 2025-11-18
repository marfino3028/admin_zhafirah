<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_ro_detail where id='".$_GET['id']."'", 0);
		$delete = $db->query("delete from tbl_ro_detail where id='".$_GET['id']."'");
		
		$jmlRequest = $db->queryItem("select sum(qty) from tbl_ro_detail where no_ro='".$data[0]['no_ro']."'");
		$update = $db->query("update tbl_ro set total_permintaan='$jmlRequest' where no_ro='".$data[0]['no_ro']."'", 0);

		header("location:../../index.php?mod=inv&submod=input_ro_detail&id=".$_GET['subid']);
	}
?>