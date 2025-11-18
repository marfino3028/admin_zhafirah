<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$sub = $db->queryItem("select nama_poli from tbl_poli where kd_poli='".$_POST['poli']."'");
		$dkt = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$_POST['dokter']."'");
		//print_r($dkt);
		$insert = $db->query("insert into tbl_jadwal (kd_poli, nama_poli, kode_dokter, nama_dokter, hari, mulai, selesai, janji, keterangan) values ('".$_POST['poli']."', '".$sub."', '".$_POST['dokter']."', '".$dkt."', '".$_POST['tanggal']."', '".$_POST['mulai2']."', '".$_POST['selesai2']."', '".$_POST['janji']."', '".$_POST['keterangan']."')",0);
		//print_r($_POST);
	}
	header("location:../../index.php?mod=master&submod=jadwal");
?>