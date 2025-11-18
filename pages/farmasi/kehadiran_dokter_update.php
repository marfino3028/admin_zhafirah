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

		$insert = $db->query("update tbl_kehadiran_dokter set tgl_hadir='".$date1."', kode_dokter='".$_POST['dokter']."', nama_dokter='$nama', waktu_hadir='".$_POST['waktu']."', biaya='$biaya' where id='".$_POST['id']."'", 0);
		header("location:../../index.php?mod=farmasi&submod=kehadiran_dokter");
	}
?>