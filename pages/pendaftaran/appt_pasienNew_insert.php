<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
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

		$perusahaan = $db->queryItem("select nama_perusahaan from tbl_perusahaan where id='".$_POST['kode_perusahaan']."'");
		$poli = $db->queryItem("select nama_poli from tbl_poli where kd_poli='".$_POST['kd_poli']."'");
		$dokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$_POST['kd_dokter']."'");
		$mesin = $db->query("select id, merk_mesin from tbl_mesinHD where id='".$_POST['mesin_hd']."'");
		//echo '<pre>';
		//print_r($_POST);
		//print_r($pasien);
		$insert = $db->query("insert into  tbl_perjanjian (no_perjanjian, nomr, kd_poli, nama_poli, kode_perusahaan, nama_perusahaan, status_pasien, kode_dokter, nama_dokter, tgl_daftar, biayaAdmin, tgl_update, status_delete, status_hub, nomr_hub, kelas_id, ruang_id, bed_id, nama_bed, yang_berobat, tgl_insert, status_dokter, nama, nik, tempat_lahir, tanggal_lahir, alamat, jenis_kelamin, email, hp, user_input, mesinHD_id, mesinHD_nama, shift) values ('".$_POST['no_daftar']."', 'OTC', '".$_POST['kd_poli']."', '".$poli."', '".$_POST['kode_perusahaan']."', '".$perusahaan."', 'OPEN', '".$_POST['kd_dokter']."', '$dokter', '".$_POST['tgl_appt']."', 0, '".date("Y-m-d H:i:s")."', 'UD', '".$_POST['hub']."', '".$_POST['hub_nomr']."', '".$bed[0]['kelas_id']."', '".$bed[0]['kelas_ruang_id']."', '".$bed[0]['id']."', '".$bed[0]['nama']."', '".$_POST['keluarga']."', '".date("Y-m-d H:i:s")."', '".$_POST['kd_oncall']."', '".$_POST['nama']."', '".$_POST['nik']."', '".$_POST['tempat_lahir']."', '".$_POST['tanggal_lahir']."', '".$_POST['alamat']."', '".$_POST['jk']."', '".$_POST['email']."', '".$_POST['hp']."', '".$_SESSION['rg_nama']."', '".$mesin[0]['id']."', '".$mesin[0]['merk_mesin']."', '".$_POST['shift_hd']."')", 0);
		//input resep baru

		//input resep baru
		$date_n = $_POST['tgl_appt'];  
		$tgl_kirim_y = date('Y', strtotime($date_n . ' - 1 days')); 
		$tgl_kirim_m = date('m', strtotime($date_n . ' - 1 days')); 
		$tgl_kirim_d = date('d', strtotime($date_n . ' - 1 days')); 
		$tgl_kirim_j = date('H'); 
		$tgl_kirim_i = date('i'); 

		$token = $db->query("select nilai from tbl_config where kode='WA-API'");
		//$token[0]['nilai'] = 'zjP-C@9s!n+mi29G+xnd';
          	$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://api.fonnte.com/send',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => array(
			'target' => $_POST['hp'],
			'schedule' => mktime($tgl_kirim_j, $tgl_kirim_i, null, $tgl_kirim_m, $tgl_kirim_d, $tgl_kirim_y), 
			'message' => '*Dear '.$_POST['nama'].'*,
    		
Berikut ini Sebagai Pengingat Perjanjian untuk Pendaftaran Anda di Klinik Dialisacare.

Kode Booking : '.$_POST['no_daftar'].'
Tanggal Perjanjian : '.date("d F Y", strtotime($_POST['tgl_appt'])).'
Atas Nama : '.$_POST['nama'].'
Alamat : '.$_POST['alamat'].'
Tempat & Tgl Lahir : '.$_POST['tempat_lahir'].', '.date("d F Y", strtotime($_POST['tanggal_lahir'])).'
Tujuan / Layanan : '.$poli.'


Terima kasih', 
			'countryCode' => '62', //optional
			),
			  CURLOPT_HTTPHEADER => array(
				'Authorization: '.$token[0]['nilai'] //change TOKEN to your actual token - ML6#M4X3fxTZWFwBFUZ@
			  ),
			));
			
			$response = curl_exec($curl);
			curl_close($curl);

		header("location:../../index.php?mod=pendaftaran&submod=appt");
	}
?>