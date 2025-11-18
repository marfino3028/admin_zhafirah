<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$kategori = $db->query("select id, kategori from tbl_coa_category where id='".$_POST['kategori_barang']."'");
		$golongan = $db->query("select kd_gol, golongan from tbl_gol_obt where kd_gol='".$_POST['golongan']."'");
		$comodity = $db->query("select kd_comodity, comodity from tbl_comodity where kd_comodity='".$_POST['comodity']."'");
		$ppn = $db->query("select nilai from tbl_config where kode='PPN' and tahun='".date("Y")."'");
		$_POST['nilai_hna'] = $_POST['hna'] + ($_POST['hna'] * $ppn[0]['nilai'] / 100);
		echo '<pre>';
		print_r($_POST);
		print_r($golongan);
		print_r($comodity);
		print_r($kategori);
		print_r($ppn);
		$insert = $db->query("insert into tbl_logistik (kode, nama, satuan_besar, satuan_terkecil, hna, hna_ppn, ppn, kategori_id, kategori_nama, golongan_kode, golongan_nama, comodity_kode, comodity_nama, status_aktif, status_stock) values ('".$_POST['kode']."', '".$_POST['nama']."', '".$_POST['satuan_besar']."', '".$_POST['satuan']."', '".$_POST['hna']."', '".$_POST['nilai_hna']."', '".$ppn[0]['nilai']."', '".$_POST['kategori_barang']."', '".$kategori[0]['kategori']."', '".$_POST['golongan']."', '".$golongan[0]['golongan']."', '".$_POST['comodity']."', '".$comodity[0]['comodity']."', '".$_POST['aktif']."', '".$_POST['tipe_stok']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=logistik");
?>