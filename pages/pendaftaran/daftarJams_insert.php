<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		if ($_POST['idmr'] == "") {
			echo '<script language="javascript">alert("Silahkan Gunakan NoMR yang Lain"); back(-1);</script>';
		}
		else {
			$biayaAdmin = $db->queryItem("select nilai from tbl_config where kode='JAMADM' and tahun='".date("Y")."'");
			$insert = $db->query("insert into  tbl_pendaftaran_jamsostek (no_daftar, nomr, kd_poli, status_pasien, tgl_daftar, kode_perusahaan, nama_perusahaan, biayaAdmin, kode_dokter, idNomr) values ('".$_POST['no_daftar']."', '".$_POST['nomr']."', '".$_POST['kd_poli']."', 'OPEN', '".date("Y-m-d")."', 'J01', 'JAMSOSTEK', '".$biayaAdmin."', '".$_POST['kd_dokter']."', '".$_POST['idmr']."')", 0);
			header("location:../../index.php?mod=pendaftaran&submod=index_jams");
		}
	}
?>