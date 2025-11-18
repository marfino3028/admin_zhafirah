<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$t1 = explode("/", $_POST['mulai']);
		$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1];

		$nama = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$_POST['dokter']."'");
		if ($_POST['waktu'] == 'F') $biaya = 100000;
		elseif ($_POST['waktu'] == 'H') $biaya = 50000;

		$insert = $db->query("insert into  tbl_kehadiran_dokter (tgl_hadir, kode_dokter, nama_dokter, waktu_hadir, biaya, tgl_insert, oleh) values ('".$date1."', '".$_POST['dokter']."', '$nama', '".$_POST['waktu']."', '$biaya', '".date("Y-m-d")."', '".$_SESSION['rg_user']."')", 0);
		header("location:../../index.php?mod=farmasi&submod=kehadiran_dokter");
	}
?>