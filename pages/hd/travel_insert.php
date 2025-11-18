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

			$nama_file = 'TRAVELHD-'.date("d_F_Y_H_i_s").'.'.$ext;
			@copy($_FILES['dokumen']['tmp_name'], '../../dokumen/'.$nama_file);
		}
		else {
			$nama_file = "";
		}

        $daftar = $db->query("select no_daftar, nomr from tbl_pendaftaran where md5(no_daftar)='".$_POST['id']."'");
        $pasien = $db->query("select nomr, nm_pasien from tbl_pasien where nomr='".$daftar[0]['nomr']."'");
        $dokter = $db->query("select kode_dokter, nama_dokter from tbl_dokter where kode_dokter='".$_POST['dokter_perujuk']."'");
		$perusahaan = $db->query("select nama_perusahaan, telp from tbl_perusahaan where kode_perusahaan='".$_POST['klinik_provider']."'");
		$travel = $db->query("select * from tbl_travel where md5(no_daftar)='".$_POST['id']."'", 0);
		//print_r($pasien);
		
		if ($travel[0]['id'] == "") {
		    $insert = $db->query("insert into tbl_travel (no_travel, nomr, nama, no_daftar) values ('".$_POST['no_resep']."', '".$pasien[0]['nomr']."', '".$pasien[0]['nm_pasien']."', '".$daftar[0]['no_daftar']."')", 0);
		    $travelID = mysql_insert_id();
		}
		else {
		    $travelID = $travel[0]['id'];
		}
		
		//Masukkan detail dari travel
		$insert = $db->query("insert into tbl_travel_detail (travel_id, no_travel, tgl_berangkat, klinik_provider_kode, klinik_provider, tgl_hd, dokter_kode, dokter_nama, dokumen) values ('$travelID', '".$_POST['no_resep']."', '".$_POST['tgl_lahir']."', '".$_POST['klinik_provider']."', '".$perusahaan[0]['nama_perusahaan']."','".$_POST['mulai']."','".$dokter[0]['kode_dokter']."','".$dokter[0]['nama_dokter']."', '$nama_file')", 1);
		
		//Masukkan notifikasi
        $curl = curl_init();

		$pesan = '*Dear '.$perusahaan[0]['nama_perusahaan'].'*,
    		
Berikut ini adalah notifikasi Travel HD untuk Klinik Anda

Nomor Travel HD : '.$travel[0]['no_travel'].'
NOMR : '.$pasien[0]['nomr'].'
Nama Pasien : '.$pasien[0]['nm_pasien'].'
Tanggal Keberangkatan : '.$_POST['tgl_lahir'].'
Tanggal HD : '.$_POST['mulai'].'
Dokter Perujuk : '.$dokter[0]['nama_dokter'].'

Terima kasih';

		print_r($pesan);
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
        'target' => $perusahaan[0]['telp'],
        'message' => $pesan, 
        'countryCode' => '62', //optional
        ),
          CURLOPT_HTTPHEADER => array(
            'Authorization: zjP-C@9s!n+mi29G+xnd' //change TOKEN to your actual token
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
		
		header("location:../../index.php?mod=hd&submod=travel&id=".$_POST['id']);

	}
?>