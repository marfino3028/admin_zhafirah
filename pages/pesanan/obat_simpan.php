<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Masukkan header dari pesanan obat
		$data = $db->query("select * from tbl_obat where md5(id)='".$_POST['id_obat']."'");
		$insert = $db->query("insert into tbl_pesanan_obat (tanggal_pesan) values ('".date("Y-m-d")."')", 0);
		$id = mysql_insert_id();
		$insert = $db->query("insert into tbl_pesanan_obat_detail (pesanan_id, kode_obat, nama_obat, satuan_besar, satuan_kecil, harga_beli, harga_jual, qty, total_jual, total_beli) values ('$id', '".$data[0]['kode_obat']."', '".$data[0]['nama_obat']."', '".$data[0]['satuan_besar']."', '".$data[0]['satuan_terkecil']."', '".$data[0]['harga_beli']."', '".$data[0]['harga_jual']."', '".$_POST['Qty']."', '".$data[0]['harga_jual']*$_POST['Qty']."', '".$data[0]['harga_beli']*$_POST['Qty']."')");
		$update = $db->query("update tbl_pesanan_obat set total_harga='".$data[0]['harga_jual']*$_POST['Qty']."' where id='$id'");
		//Masukkan notifikasi
		
		header("location:../../index.php?mod=pesanan&submod=obat_tambahan&id=".md5($id));

	}
?>