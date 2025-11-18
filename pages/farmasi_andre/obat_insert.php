<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$t1 = explode("/", $_POST['tgl_lahir']);
		$tanggal = $t1[2].'-'.$t1[0].'-'.$t1[1];
		$vendorid = $db->queryItem("select nama_vendor from tbl_vendor where kode_vendor='".$_POST['vendor']."'");
		$suplierid = $db->queryItem("select nama_suplier from tbl_suplier where kode_suplier='".$_POST['suplier']."'");
		//$insert = $db->query("insert into tbl_obat (kode_obat, nama_obat, jenis, satuan_terkecil, stock_awal, stock_akhir, stock_min, vendor_id, vendor, suplier_id, suplier, harga_beli, harga_jual, expire_date) values ('".$_POST['kode_obat']."', '".$_POST['nama_obat']."', '".$_POST['jenis']."', '".$_POST['satuan']."', '".$_POST['stock_awal']."', '".$_POST['stock_akhir']."', '".$_POST['stock_min']."', '".$_POST['vendor']."', '".$vendorid."', '".$_POST['suplier']."', '".$suplierid."', '".$_POST['harga_beli']."', '".$_POST['harga_jual']."', '".$tanggal."')", 0);
		$insert = $db->query("insert into tbl_obat (kode_obat, nama_obat, jenis, satuan_terkecil, stock_akhir, stock_min, vendor_id, vendor, suplier_id, suplier, harga_beli, harga_jual, expire_date, jml_per_box, harga_per_box, stock_min_gudang, stock_min_apotik) values ('".$_POST['kode_obat']."', '".$_POST['nama_obat']."', '".$_POST['jenis']."', '".$_POST['satuan']."', '".$_POST['stock_akhir']."', '".$_POST['stock_min']."', '".$_POST['vendor']."', '".$vendorid."', '".$_POST['suplier']."', '".$suplierid."', '".$_POST['harga_beli']."', '".$_POST['harga_jual']."', '".$tanggal."', '".$_POST['jml_per_box']."', '".$_POST['harga_per_box']."', '".$_POST['stock_min_gudang']."', '".$_POST['stock_min_apotik']."')", 0);
		$id = mysql_insert_id();
		$update = $db->query("update tbl_obat set kode_obat='$id' where id='$id'");
	}
	header("location:../../index.php?mod=farmasi&submod=obat");
?>