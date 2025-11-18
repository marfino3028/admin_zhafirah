<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_opname_gudang_detail where id='".$_GET['id']."'", 0);
		$delete = $db->query("delete from tbl_opname_gudang_detail where id='".$_GET['id']."'");
		
		$jmlRequest = $db->queryItem("select sum(qty) from tbl_opname_gudang_detail where no_opn_gudang='".$data[0]['no_opn_gudang']."'");
		$jmlObat = $db->queryItem("select count(id) from tbl_opname_gudang_detail where no_opn_gudang='".$data[0]['no_opn_gudang']."'");
		$update = $db->query("update tbl_opname_gudang set jml_obat='$jmlObat', qty_obat='$jmlRequest' where no_opn_gudang='".$data[0]['no_opn_gudang']."'", 0);
		
		header("location:../../index.php?mod=inv&submod=input_stock_opnameGudang_detail&id=".$_GET['subid']);
	}
?>