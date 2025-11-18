<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../../3rdparty/engine.php";
	//echo '<pre>';
	//print_r($_POST);
	ini_set("display_errors", 1);
	
	if ($_SESSION['rg_user'] != '') {
		if ($_FILES['dokumen']['name'] != "") {
			//print_r($_POST);
			$path = $_FILES['dokumen']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$nama_file = 'HPR-'.date("d_F_Y_H_i_s").'.'.$ext;
			@copy($_FILES['dokumen']['tmp_name'], '../../dokumen/'.$nama_file);
		}
		else {
			$nama_file = "";
		}

        $daftar = $db->query("select no_daftar, nomr from tbl_pendaftaran where md5(no_daftar)='".$_POST['ids']."'");
        $pasien = $db->query("select nomr, nm_pasien from tbl_pasien where nomr='".$daftar[0]['nomr']."'");
        $dokter = $db->query("select kode_dokter, nama_dokter from tbl_dokter where kode_dokter='".$_POST['dokter']."'");
		
		//Masukkan detail dari travel
		$insert = $db->query("insert into tbl_hd_phr (nomr, no_daftar, nama, kode_dokter, nama_dokter, tanggal, dokumen, user_insert) values ('".$pasien[0]['nomr']."', '".$daftar[0]['no_daftar']."', '".$pasien[0]['nm_pasien']."', '".$_POST['dokter']."','".$_POST['dokter']."','".$_POST['tgl_lahir']."','".$nama_file."', '".$_SESSION['rg_user']."')", 0);
		
		
		header("location:../../index.php?mod=hd&submod=worklist_phr&id=".$_POST['id']."&ids=".$_POST['ids']);

	}
?>