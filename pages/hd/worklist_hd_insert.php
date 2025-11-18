<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		if ($_POST['alergi_ya'] == 'on') $_POST['alergi'] = 'YA';
		else $_POST['alergi'] = 'TIDAK';

		if ($_POST['hcv_ya'] == 'on') $_POST['hcv'] = 'YA';
		else $_POST['hcv'] = 'TIDAK';

		if ($_POST['hiv_ya'] == 'on') $_POST['hiv'] = 'YA';
		else $_POST['hiv'] = 'TIDAK';

		if ($_POST['hbs_ag_ya'] == 'on') $_POST['hbs_ag'] = 'YA';
		else $_POST['hbs_ag'] = 'TIDAK';

		if ($_POST['hasil_lab_ya'] == 'on') $_POST['hasil_lab'] = 'YA';
		else $_POST['hasil_lab'] = 'TIDAK';

		$pasien = $db->query("select nm_pasien, nomr from tbl_pasien where md5(nomr)='".$_POST['id']."'");
		$daftar = $db->query("select no_daftar from tbl_pendaftaran where md5(no_daftar)='".$_POST['no_daftar']."'");
		$insert = $db->query("insert into  tbl_catatan_dktr_hd (nomr, nama, diag_etiologi, frekuensi, tgl_hd1, tgl_hd2, durasi_hd, tipe_mesin, akses_sirkulasi, lokasi, fistula, qb, qd, heparin_awal, heparin_m, pre, post, bb_kering, bb_pre, bb_post, dialisat, riwayat_td, alergi, hbs_ag, hcv, hiv, komplikasi_hd, diet, obat2, hasil_lab, no_daftar, user_insert, user_shift, tgl_data, mulai_hd) values ('".$pasien[0]['nomr']."', '".$pasien[0]['nm_pasien']."', '".$_POST['diag_etiologi']."', '".$_POST['frekuensi']."', '".$_POST['tgl_hd1']."', '".$_POST['tgl_hd2']."', '".$_POST['durasi_hd']."', '".$_POST['tipe_mesin']."', '".$_POST['akses_sirkulasi']."', '".$_POST['lokasi']."', '".$_POST['fistula']."', '".$_POST['qb']."', '".$_POST['qd']."', '".$_POST['heparin_awal']."', '".$_POST['heparin_m']."', '".$_POST['pre']."', '".$_POST['post']."', '".$_POST['bb_kering']."', '".$_POST['bb_pre']."', '".$_POST['bb_post']."', '".$_POST['dialisat']."', '".$_POST['riwayat_td']."', '".$_POST['alergi']."', '".$_POST['hbs_ag']."', '".$_POST['hcv']."', '".$_POST['hiv']."', '".$_POST['komplikasi_hd']."', '".$_POST['diet']."', '".$_POST['obat2']."', '".$_POST['hasil_lab']."', '".$daftar[0]['no_daftar']."', '".$_SESSION['rg_user']."', '".$_SESSION['rg_shift']."', '".date("Y-m-d")."', '".$_POST['mulai_hd']."')", 0);
		//$id = mysql_insert_id();
		header("location:../../index.php?mod=hd&submod=worklist&id=".$pasien[0]['nomr']."&ids=".$daftar[0]['no_daftar']);

	}
?>