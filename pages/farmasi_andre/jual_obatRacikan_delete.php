<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$delete = $db->query("delete from tbl_penjualan_obat_detail where id='".$_GET['id']."'", 0);
		//$total = $db->queryItem("select sum(total) from tbl_penjualan_obat_detail where status_delete='UD' and jenis='NR' and penjualan_id='".$_GET['subid']."'");
		//$update = $db->query("update  tbl_penjualan_obat set total_harga='$total' where id='".$_GET['subid']."'");
	}
	header("location:../../index.php?mod=farmasi&submod=input_jual_langsung_obat&id=".$_GET['subid']);
?>