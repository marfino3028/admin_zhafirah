<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$perusahaan = $db->queryItem("select nama_perusahaan from tbl_perusahaan where id='".$_POST['kode_perusahaan']."'");
		$perusahaan_kode = $db->queryItem("select kode_perusahaan from tbl_perusahaan where id='".$_POST['kode_perusahaan']."'");
		//$update = $db->query("update tbl_pendaftaran set kd_poli='".$_POST['kd_poli']."', kode_perusahaan='".$perusahaan_kode."', nama_perusahaan='".$perusahaan."', kode_dokter='".$_POST['kd_dokter']."' where no_daftar='".$_POST['no_daftar']."'");
		if ($_POST['medis'] == 'SKS') {
			$update = $db->query("update tbl_pendaftaran set kd_poli='".$_POST['medis']."', kode_perusahaan='".$perusahaan_kode."', nama_perusahaan='".$perusahaan."', kode_dokter='".$_POST['kd_dokter']."' where no_daftar='".$_POST['no_daftar']."'");
		}
		else {
			$update = $db->query("update tbl_pendaftaran set kd_poli='".$_POST['kd_poli']."', kode_perusahaan='".$perusahaan_kode."', nama_perusahaan='".$perusahaan."', kode_dokter='".$_POST['kd_dokter']."' where no_daftar='".$_POST['no_daftar']."'");
		}
		header("location:../../index.php?mod=pendaftaran&submod=index");
	}
?>