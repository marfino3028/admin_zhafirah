<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$t1 = explode("/", $_POST['tgl_lahir']);
		$tanggal = $t1[2].'-'.$t1[0].'-'.$t1[1];

		$insert = $db->query("insert into  tbl_karyawan (nomr_karyawan, nm_karyawan, unit) values ('".$_POST['nomr']."', '".$_POST['nama']."', '".$_POST['unit']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=karyawan");
?>