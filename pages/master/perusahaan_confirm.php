<?php
	ini_set("display_errors", 0);
	session_start();
	include "../../3rdparty/engine.php";
	date_default_timezone_set('Asia/Jakarta');

	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_perusahaan_draft where md5(id)='".$_GET['id']."'", 0);
		//print_r($data);
		$insert = $db->query("insert into tbl_perusahaan (kode_perusahaan, nama_perusahaan, alamat_perusahaan, kota, kd_pos, telp, fax, kd_gt, nm_gt, group_aim, link_map, dokumen, bank_name, norek_provider, bank_cab, rek_nama, pic_contact, no_ijin, harga_up, piutang_kd_coa, piutang_nm_coa, pendapatan_kd_coa, pendapatan_nm_coa) values ('".$data[0]['kode_perusahaan']."', '".$data[0]['nama_perusahaan']."', '".$data[0]['alamat_perusahaan']."', '".$data[0]['kota']."', '".$data[0]['kd_pos']."', '".$data[0]['telp']."', '".$data[0]['fax']."', '".$data[0]['kd_gt']."', '".$data[0]['nm_gt']."', '".$data[0]['group_aim']."', '".$data[0]['link_map']."', '".$data[0]['dokumen']."', '".$data[0]['bank_name']."', '".$data[0]['norek_provider']."', '".$data[0]['bank_cab']."', '".$data[0]['rek_nama']."', '".$data[0]['pic_contact']."', '".$data[0]['no_ijin']."', '".$data[0]['harga_up']."', '".$data[0]['piutang_kd_coa']."', '".$data[0]['piutang_nm_coa']."', '".$data[0]['pendapatan_kd_coa']."', '".$data[0]['pendapatan_nm_coa']."')");
		$data_update = $db->query("update tbl_perusahaan_draft set status_publish='PUBLISH' where md5(id)='".$_GET['id']."'", 0);
		$data = $db->query("select * from tbl_perusahaan_draft where md5(id)='".$_GET['id']."'", 0);

		$access_token = 'aa9c607342df5b98f3662f3f3217f2f4c9ec3808';
		$long_url = 'http://103.157.26.142/';
		$curlBitly = curl_init();
		curl_setopt_array($curlBitly, array(
			CURLOPT_URL => 'https://api-ssl.bitly.com/v4/shorten',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode(array("long_url" => $long_url)),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Authorization: Bearer ' . $access_token
			),
		));

		$response = curl_exec($curlBitly);

		curl_close($curlBitly);
		$response_data = json_decode($response, true);
		if (isset($response_data['link'])) {
			$short_url = $response_data['link'];
		} else {
			echo 'Error shortening the URL. Response: ' . $response;
		}

		$berlaku = $db->query("select * from tbl_type_subs where nilai='".$data[0]['type_subscribe']."'");
		$hariini = date("Y-m-d");
		$masaberlaku = date('Y-m-d', strtotime($hariini. ' + '.$berlaku[0]['berlaku'].' day'));
		//Masukkan kedalam tabel user
		$insert = $db->query("insert into tbl_user (userid, nip, sandi, nama, code, telp, hingga, jenis_akun, penjamin_user, penjamin_nama, penjamin_password) values ('P".substr($data[0]['kode_perusahaan'], -4)."', '".$data[0]['kode_perusahaan']."', '".md5('Dialisacare2025')."', '".$data[0]['pic_contact']."', 'PENJAMIN', '".$data[0]['telp']."', '".$masaberlaku."', 'PENJAMIN', 'P".substr($data[0]['kode_perusahaan'], -4)."', '".$data[0]['pic_contact']."', '".md5('Dialisacare2025')."')", 0);

		//$kodeWA = $db->query("select nilai from tbl_config where kode='WA-API'");
		$kodeWA = $db->query("select nilai from tbl_config where kode='WA-API'");
		//Kirim WA
		$telp = $data[0]['telp'];
        	$curl = curl_init();

		$pesan = '*Dear '.$data[0]['pic_contact'].'*,
    		
Perusahaan / Klinik Adan telah didaftarkan di Klinik Dialisacare.
Berikut Informasi yang bisa Anda gunakan untuk masuk ke Aplikasi Klinik Dialisacare.

Nama Perusahaan / Klinik : '.$data[0]['nama_perusahaan'].'
Alamat : '.$data[0]['alamat_perusahaan'].'
PIC : '.$data[0]['pic_contact'].'
No. Ijin : '.$data[0]['no_ijin'].'
UserID : P'.substr($data[0]['kode_perusahaan'], -4).'
Password : Dialisacare2025
Link : '.$short_url.'

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
	header("location:../../index.php?mod=master&submod=perusahaan");
?>