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
		$insert = $db->query("update tbl_logistik set nama='".$_POST['nama']."', satuan_besar='".$_POST['satuan_besar']."', satuan_terkecil='".$_POST['satuan']."', hna='".$_POST['hna']."', hna_ppn='".$_POST['nilai_hna']."', ppn='".$ppn[0]['nilai']."', kategori_id='".$_POST['kategori_barang']."', kategori_nama='".$kategori[0]['kategori']."', golongan_kode='".$_POST['golongan']."', golongan_nama='".$golongan[0]['golongan']."', comodity_kode='".$_POST['comodity']."', comodity_nama='".$comodity[0]['comodity']."', status_aktif='".$_POST['aktif']."', status_stock='".$_POST['tipe_stok']."' where md5(id)='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=logistik");
?>