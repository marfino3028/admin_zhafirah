<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
	    //echo '<pre>';
    	//print_r($_POST);
    	//echo $_POST['']
    		if ($_FILES['dokumen']['name'] != "") {
			$path = $_FILES['dokumen']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$nama_file = 'PhotoDokter-'.date("d F Y H:i:s").'.'.$ext;
			@copy($_FILES['dokumen']['tmp_name'], '../../dokumen/'.$nama_file);
		}
		else {
			$nama_file = "";
		}
	    
		$insert = $db->query("insert into tbl_dokter_draft (nama_dokter, kode_dokter, tarif_dokter, spesialis, kd_poli, npwp, noktp, tmpt_lahir, tgl_lahir, jk, dokumen, no_sip, tgl_sip, no_str, tgl_str, no_kre, tgl_kre, bank, bank_c, bank_an, norek, professional_fee, tarif_jamsostek, hp) values ('".$_POST['nama_dokter']."', '".$_POST['kode_dokter']."', '".$_POST['tarif_dokter']."', '".$_POST['spesialis']."', '".$_POST['kd_poli']."', '".$_POST['npwp']."', '".$_POST['noktp']."', '".$_POST['tmpt_lahir']."', '".$_POST['tgl_lahir']."', '".$_POST['jk']."', '$nama_file', '".$_POST['no_sip']."', '".$_POST['tgl_sip']."', '".$_POST['no_str']."', '".$_POST['tgl_str']."', '".$_POST['no_kre']."', '".$_POST['tgl_kre']."', '".$_POST['bank']."', '".$_POST['bank_c']."', '".$_POST['bank_an']."', '".$_POST['norek']."', '".$_POST['professional_fee']."', '".$_POST['jamsostek']."', '".$_POST['hp']."')", 0);
		
		/*//input di tabel user
		$insert = $db->query("insert into tbl_user (userid, nip, sandi, nama, code, telp, force_ganti, email, jenis_akun) values ('" . $_POST['kode_dokter'] . "', '" . $_POST['no_sip'] . "', '" . md5('DialisaCare@2024') . "', '" . $_POST['nama_dokter'] . "', '" . $_POST['kode_dokter'] . "', '" . $_POST['hp'] . "', '2', '" . $_POST['email'] . "', 'DOKTER')", 0);
		
		//Kirim WA Ke Dokter
		$kodeWA = $db->query("select nilai from tbl_config where kode='WA-API'");
		$telp = $_POST['hp'];
        $curl = curl_init();

		$pesan = '*Dear '.$_POST['nama_dokter'].'*,
    		
Anda telah didaftarkan di Klinik Dialisacare.
Berikut Informasi yang bisa Anda gunakan untuk masuk ke Aplikasi Klinik Dialisacare.

Nama Anda : '.$_POST['nama_dokter'].'
User ID : '.$_POST['kode_dokter'].'
Password : DialisaCare@2024
URL Aplikasi : http://103.157.26.142/

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
        'target' => $telp,
        'message' => $pesan, 
        'countryCode' => '62', //optional
        ),
          CURLOPT_HTTPHEADER => array(
            'Authorization: '.$kodeWA[0]['nilai'] //change TOKEN to your actual token
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);*/
		
	}
	header("location:../../index.php?mod=master&submod=dokter");
?>