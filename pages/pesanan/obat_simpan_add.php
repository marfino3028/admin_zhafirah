<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Masukkan header dari pesanan obat
		$id = $_POST['id'];
		$sub = $db->query("select * from tbl_pesanan_obat where md5(id)='$id'");
		$data = $db->query("select * from tbl_obat where md5(id)='".$_POST['id_obat']."'");
		
		$insert = $db->query("insert into tbl_pesanan_obat_detail (pesanan_id, kode_obat, nama_obat, satuan_besar, satuan_kecil, harga_beli, harga_jual, qty, total_jual, total_beli) values ('".$sub[0]['id']."', '".$data[0]['kode_obat']."', '".$data[0]['nama_obat']."', '".$data[0]['satuan_besar']."', '".$data[0]['satuan_terkecil']."', '".$data[0]['harga_beli']."', '".$data[0]['harga_jual']."', '".$_POST['Qty']."', '".$data[0]['harga_jual']*$_POST['Qty']."', '".$data[0]['harga_beli']*$_POST['Qty']."')");
		$detail = $db->query("select sum(total_jual) total from tbl_pesanan_obat_detail where md5(pesanan_id)='".$id."'");
		$update = $db->query("update tbl_pesanan_obat set total_harga='".$detail[0]['total']."' where md5(id)='$id'");
		//Masukkan notifikasi
		
		header("location:../../index.php?mod=pesanan&submod=obat_tambahan&id=".$id);

	}
?>