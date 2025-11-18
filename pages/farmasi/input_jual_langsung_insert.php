<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into  tbl_penjualan_obat (no_penjualan, nama, telp, tgl_input, total_harga, oleh) values ('".$_POST['no_resep']."', '".$_POST['nama']."', '".$_POST['telp']."', '".date("Y-m-d")."', '0', '".$_SESSION['rg_user']."')", 0);
		$id = mysql_insert_id();
		header("location:../../index.php?mod=farmasi&submod=input_jual_langsung_obat&id=$id");
	}
?>