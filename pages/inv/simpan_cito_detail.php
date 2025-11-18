<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_obat where kode_obat='".$_POST['obat']."'", 0);

		$tgl = date('Y-m-d');
		
		$insert = $db->query("insert into tbl_cito_detail (citoID, no_cito, kode_obat, nama_obat, qty, harga_satuan, harga_beli) values ('".$_POST['citoID']."', '".$_POST['no_cito']."', '".$_POST['obat']."', '".$data[0]['nama_obat']."', '".$_POST['qty']."', '".$_POST['harga_satuan']."', '".$_POST['harga_beli']."')", 0);
		$id = mysql_insert_id();
		
		$jmlRequest = $db->queryItem("select sum(qty) from tbl_cito_detail where no_cito='".$_POST['no_cito']."' and status_delete='UD'");
		$jmlHarga = $db->queryItem("select sum(qty*harga_beli) from tbl_cito_detail where no_cito='".$_POST['no_cito']."' and status_delete='UD'");
		$update = $db->query("update tbl_cito set qty_obat='$jmlRequest', total_harga_beli='$jmlHarga' where no_cito='".$_POST['no_cito']."'");
		
		header("location:../../index.php?mod=inv&submod=cito_detail&id=".$_POST['citoID']);
	}
?>