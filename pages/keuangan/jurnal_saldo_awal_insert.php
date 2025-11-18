<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		//echo '<pre>';
		//print_r($_POST);
		$data = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='".$_POST['kode_akun']."'");
		//print_r($data);
		$insert = $db->query("insert into tbl_jurnal_saldo_awal (kode_akun, nama_akun, nilai, tanggal, keterangan) values ('".$_POST['kode_akun']."', '".$data[0]['nm_coa']."', '".$_POST['nilai']."', '".$_POST['tanggal']."', '".$_POST['keterangan']."')");
		header("location:../../index.php?mod=keuangan&submod=jurnal_saldo_awal_list");
	}
?>