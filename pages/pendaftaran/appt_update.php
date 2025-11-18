<?php
	session_start();
	include "../../3rdparty/engine.php";
	print_r($_POST);
	ini_set("display_errors", 0);
	date_default_timezone_set("Asia/Jakarta");
	
	if ($_SESSION['rg_user'] != '') {
	    
		if ($_POST['kd_dokter'] == 'ONCALL') {
		    $_POST['kd_dokter'] = $_POST['kd_dokter_oncall'];
		    $_POST['kd_oncall'] = 'ONCALL';
		}
		else {
		    $_POST['kd_oncall'] = 'NOT';
		}
		if ($_POST['nomr'] == "") $_POST['nomr'] = $_POST['nomr_lama'];
		
		$pasien = $db->query("select * from tbl_pasien where nomr='".$_POST['nomr']."'", 1);
		$perusahaan = $db->queryItem("select nama_perusahaan from tbl_perusahaan where id='".$_POST['kode_perusahaan']."'");
		$poli = $db->queryItem("select nama_poli from tbl_poli where kd_poli='".$_POST['kd_poli']."'");
		$dokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$_POST['kd_dokter']."'");
		//echo '<pre>';
		//print_r($_POST);
		//print_r($pasien);
		$insert = $db->query("update tbl_perjanjian set nomr='".$_POST['nomr']."', kd_poli='".$_POST['kd_poli']."', nama_poli='".$poli."', kode_perusahaan='".$_POST['kode_perusahaan']."', nama_perusahaan='".$perusahaan."', kode_dokter='".$_POST['kd_dokter']."', nama_dokter='$dokter', tgl_daftar='".$_POST['tgl_appt']."', status_hub='".$_POST['hub']."', nomr_hub='".$_POST['hub_nomr']."', kelas_id='".$bed[0]['kelas_id']."', ruang_id='".$bed[0]['kelas_ruang_id']."', bed_id='".$bed[0]['id']."', nama_bed='".$bed[0]['nama']."', yang_berobat='".$_POST['keluarga']."', status_dokter='".$_POST['kd_oncall']."', nama='".$pasien[0]['nm_pasien']."', nik='".$pasien[0]['no_ktp']."', tempat_lahir='".$pasien[0]['tmpt_lahir']."', tanggal_lahir='".$pasien[0]['tgl_lahir']."', alamat='".$pasien[0]['alamat_pasien']."', jenis_kelamin='".$pasien[0]['jk']."', email='".$pasien[0]['email']."', hp='".$pasien[0]['telp_pasien']."', user_input='".$_SESSION['rg_nama']."' where md5(id)='".$_POST['id']."'", 1);
		//input resep baru

		header("location:../../index.php?mod=pendaftaran&submod=appt");
	}
?>