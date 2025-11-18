<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$total = $_POST['harga_beli'] * $_POST['qty'];
		$nama_obat = $db->queryItem("select nama_obat from tbl_obat where kode_obat='".$_POST['obat']."'");
		if ($_POST['bulan'] < 10) $tss = $_POST['tahun'].'0'.$_POST['bulan'];
		else $tss = $_POST['tahun'].$_POST['bulan'];
		$insert = $db->query("insert into  tbl_opname_apotik_detail (opn_apotikID, no_opn_apotik, kode_obat, nama_obat, qty, bulan, tahun, ts_mmyy) values ('".$_POST['opn_apotikID']."', '".$_POST['no_opn_apotik']."', '".$_POST['obat']."', '$nama_obat', '".$_POST['qty']."', '".$_POST['bulan']."', '".$_POST['tahun']."', '".$tss."')", 0);

		$jmlRequest = $db->queryItem("select sum(qty) from tbl_opname_apotik_detail where no_opn_apotik='".$_POST['no_opn_apotik']."'");
		$jmlObat = $db->queryItem("select count(id) from tbl_opname_apotik_detail where no_opn_apotik='".$_POST['no_opn_apotik']."'");
		$update = $db->query("update tbl_opname_apotik set jml_obat='$jmlObat', qty_obat='$jmlRequest' where no_opn_apotik='".$_POST['no_opn_apotik']."'", 0);
		
		header("location:../../index.php?mod=inv&submod=input_stock_opnameApotik_detail&id=".$_POST['opn_apotikID']);
	}
?>