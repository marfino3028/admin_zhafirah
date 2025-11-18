<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$sub = $db->queryItem("select nama_poli from tbl_poli where kd_poli='".$_POST['poli']."'");
		$dkt = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$_POST['dokter']."'");
		//print_r($dkt);
		$update = $db->query("update tbl_jadwal set kd_poli='".$_POST['poli']."', nama_poli='".$sub."', kode_dokter='".$_POST['dokter']."', nama_dokter='".$dkt."', hari='".$_POST['tanggal']."', mulai='".$_POST['mulai2']."', selesai='".$_POST['selesai2']."', janji='".$_POST['janji']."', keterangan='".$_POST['keterangan']."' where md5(id)='".$_POST['id']."'", 0);
		//print_r($_POST);
	}
	header("location:../../index.php?mod=master&submod=jadwal");
?>