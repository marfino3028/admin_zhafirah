<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
	    //echo '<pre>';
    	//print_r($_POST);
    	//echo $_POST['']
		$data_dokter = $db->query("select * from tbl_dokter_draft where md5(id)='".$_GET['id']."'");	    
		$insert = $db->query("insert into tbl_dokter (nama_dokter, kode_dokter, tarif_dokter, spesialis, kd_poli, npwp, noktp, tmpt_lahir, tgl_lahir, jk, dokumen, no_sip, tgl_sip, no_str, tgl_str, no_kre, tgl_kre, bank, bank_c, bank_an, norek, professional_fee, tarif_jamsostek, hp) values ('".$data_dokter[0]['nama_dokter']."', '".$data_dokter[0]['kode_dokter']."', '".$data_dokter[0]['tarif_dokter']."', '".$data_dokter[0]['spesialis']."', '".$data_dokter[0]['kd_poli']."', '".$data_dokter[0]['npwp']."', '".$data_dokter[0]['noktp']."', '".$data_dokter[0]['tmpt_lahir']."', '".$data_dokter[0]['tgl_lahir']."', '".$data_dokter[0]['jk']."', '".$data_dokter[0]['dokumen']."', '".$data_dokter[0]['no_sip']."', '".$data_dokter[0]['tgl_sip']."', '".$data_dokter[0]['no_str']."', '".$data_dokter[0]['tgl_str']."', '".$data_dokter[0]['no_kre']."', '".$data_dokter[0]['tgl_kre']."', '".$data_dokter[0]['bank']."', '".$data_dokter[0]['bank_c']."', '".$data_dokter[0]['bank_an']."', '".$data_dokter[0]['norek']."', '".$data_dokter[0]['professional_fee']."', '".$data_dokter[0]['jamsostek']."', '".$data_dokter[0]['hp']."')", 0);
		
		//input di tabel user
		$insert = $db->query("insert into tbl_user (userid, nip, sandi, nama, code, telp, force_ganti, email, jenis_akun) values ('" . $data_dokter[0]['kode_dokter'] . "', '" . $data_dokter[0]['no_sip'] . "', '" . md5('DialisaCare@2024') . "', '" . $data_dokter[0]['nama_dokter'] . "', '" . $data_dokter[0]['kode_dokter'] . "', '" . $data_dokter[0]['hp'] . "', '2', '" . $data_dokter[0]['email'] . "', 'DOKTER')", 0);
		$update_dokter = $db->query("update tbl_dokter_draft set status_publish='PUBLISH' where md5(id)='".$_GET['id']."'");	    
		
		//Kirim WA Ke Dokter
		$kodeWA = $db->query("select nilai from tbl_config where kode='WA-API'");
		$telp = $data_dokter[0]['hp'];
        $curl = curl_init();

		$pesan = '*Dear '.$data_dokter[0]['nama_dokter'].'*,
    		
Anda telah didaftarkan di Klinik Dialisacare.
Berikut Informasi yang bisa Anda gunakan untuk masuk ke Aplikasi Klinik Dialisacare.

Nama Anda : '.$data_dokter[0]['nama_dokter'].'
User ID : '.$data_dokter[0]['kode_dokter'].'
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

        curl_close($curl);
		
	}
	header("location:../../index.php?mod=master&submod=dokter");
?>