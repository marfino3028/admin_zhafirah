<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$t1 = explode("/", $_POST['tgl_lahir']);
		$tanggal = $t1[2].'-'.$t1[0].'-'.$t1[1];
		$vendorid = $db->queryItem("select nama_vendor from tbl_vendor where kode_vendor='".$_POST['vendor']."'");
		$suplierid = $db->queryItem("select nama_suplier from tbl_suplier where kode_suplier='".$_POST['suplier']."'");
		$satuan = $db->queryItem("select nama from tbl_satuan where kode='".$_POST['satuan']."'");
		$insert = $db->query("update tbl_obat set kode_obat='".$_POST['kode_obat']."', nama_obat='".$_POST['nama_obat']."', jenis='".$_POST['jenis']."', satuan_terkecil='".$satuan."', stock_awal='".$_POST['stock_awal']."', stock_akhir='".$_POST['stock_akhir']."', stock_awal='".$_POST['stock_awal']."', vendor_id='".$_POST['vendor']."', vendor='".$vendorid."', suplier_id='".$_POST['suplier']."', vendor='".$suplierid."', harga_beli='".$_POST['harga_beli']."', harga_jual='".$_POST['harga_jual']."', expire_date='".$tanggal."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=farmasi&submod=obat");
?>