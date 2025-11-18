<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		$data = $db->query("select * from tbl_obat where kode_obat='".$_POST['obat']."'", 0);		
		$insert = $db->query("insert into tbl_opname_gudang_detail (opn_gudangID, no_opn_gudang, kode_obat, nama_obat, bulan, tahun, ts_mmyy, qty) values ('".$_POST['opn_gudangID']."', '".$_POST['no_opn_gudang']."', '".$_POST['obat']."', '".$data[0]['nama_obat']."', '".$_POST['bulan']."', '".$_POST['tahun']."', '".$_POST['bulan'].$_POST['tahun']."', '".$_POST['qty']."')", 0);
		
		//update stock 
		$qtys = $_POST['qty'];
		$update = $db->query("update tbl_obat set stock_akhir=stock_akhir+$qtys where kode_obat='".$_POST['obat']."'");
		
		$jmlRequest = $db->queryItem("select sum(qty) from tbl_opname_gudang_detail where opn_gudangID='".$_POST['opn_gudangID']."'");
		$jmlObat = $db->queryItem("select count(kode_obat) from tbl_opname_gudang_detail where opn_gudangID='".$_POST['opn_gudangID']."'");
		$update = $db->query("update tbl_opname_gudang set jml_obat='$jmlObat', qty_obat='$jmlRequest' where id='".$_POST['opn_gudangID']."'");
	}
	header("location:../../index.php?mod=inv&submod=input_stock_opnameGudang_detail&id=".$_POST['opn_gudangID']);
?>
