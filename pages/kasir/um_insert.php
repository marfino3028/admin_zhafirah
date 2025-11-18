<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
      	$daftar = explode("###", $_POST['nodaftar']);
      	$nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$_POST['nomr']."'");
      	//$pasien = $db->query("select ");
		$insert = $db->query("insert into  tbl_um (no_um, nomr, nama, tgl_input_um, total_harga_um, no_daftar, metode, nomor, bank) values ('".$_POST['no_daftar']."', '".$_POST['nomr']."', '".$nama."', '".date("Y-m-d")."', '".$_POST['nilai']."', '".$_POST['nodaftar']."', '".$_POST['metode']."', '".$_POST['nocc']."', '".$_POST['Nama_Bank']."')", 0);
		$id = mysql_insert_id();
		header("location:../../index.php?mod=kasir&submod=input_um_tindakan&id=".md5($id));
	}
?>