<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$total = $_POST['harga_beli'] * $_POST['qty'];
		$nama_obat = $db->queryItem("select nama_obat from tbl_obat where kode_obat='".$_POST['code']."'");
		$insert = $db->query("insert into  tbl_penerimaan_detail (penerimaan_id, no_penerimaan, kode_obat, nama_obat, qty, harga_beli, total, margin_obat, harga_jual, expired_date) values ('".$_POST['penerimaan_id']."', '".$_POST['no_penerimaan']."', '".$_POST['code']."', '$nama_obat', '".$_POST['qty']."', '".$_POST['harga_beli']."', '$total', '".$_POST['margin_obat']."', '".$_POST['harga_jual']."', '".$_POST['expired']."')", 0);
		//echo "insert into  tbl_penerimaan_detail (penerimaan_id, no_penerimaan, kode_obat, nama_obat, qty, harga_beli, total, margin_obat, harga_jual, expired_date) values ('".$_POST['penerimaan_id']."', '".$_POST['no_penerimaan']."', '".$_POST['obat']."', '$nama_obat', '".$_POST['qty']."', '".$_POST['harga_beli']."', '$total', '".$_POST['margin_obat']."', '".$_POST['harga_jual']."', '".$_POST['expired']."')";

		//Update header dari penerimaan
		$total = $db->query("select sum(qty) jumlah from tbl_penerimaan_detail where no_penerimaan='".$_POST['no_penerimaan']."'");
		$update = $db->query("update tbl_penerimaan set jml_obat='".$total[0]['jumlah']."' where no_penerimaan='".$_POST['no_penerimaan']."'");
		header("location:../../index.php?mod=inv&submod=penerimaan_obat_input_detail&id=".md5($_POST['penerimaan_id']));
	}
?>