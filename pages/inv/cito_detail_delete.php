<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_cito_detail where id='".$_GET['id']."'", 0);
		$delete = $db->query("delete from tbl_cito_detail where id='".$_GET['id']."'");
		
		$jmlRequest = $db->queryItem("select sum(qty) from tbl_cito_detail where no_cito='".$data[0]['no_cito']."'");
		$jmlHarga = $db->queryItem("select sum(qty*harga_beli) from tbl_cito_detail where no_cito='".$data[0]['no_cito']."'");
		$update = $db->query("update tbl_cito set qty_obat='$jmlRequest', total_harga_beli='$jmlHarga' where no_cito='".$data[0]['no_cito']."'", 0);

		header("location:../../index.php?mod=inv&submod=cito_detail&id=".$_GET['subid']);
	}
?>