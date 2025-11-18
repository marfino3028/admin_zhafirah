<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_pesanan_obat where md5(id)='".$_POST['id']."'");
		$deleteheader = $db->query("update tbl_pesanan_obat set nama='".$_POST['nama']."', pembayaran='".$_POST['metode']."', pengiriman_by='".$_POST['kirim_oleh']."', pengiriman_alamat='".$_POST['alamat']."', ongkir='".$_POST['ongkir']."', total=total_harga+".$_POST['ongkir']." where md5(id)='".$_POST['id']."'");
	}
	header("location:../../index.php?mod=pesanan&submod=obat");
?>