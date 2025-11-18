<?php
session_start();
include "../../3rdparty/engine.php";
ini_set("display_errors", 0);
//print_r($_SESSION);
if ($_SESSION['rg_user'] != '') {
	$data = $db->query("select * from tbl_kasir where md5(no_kwitansi)='" . $_GET['id'] . "'");
	if ($data[0]['telp'] == "") {
		echo '<script language="javascript">
                  alert("Mohon maaf nomor HP pasien belum ada, jadi tidak bisa mengirimkan bukti pembayaran melalui WhatsApp");
                  window. location = "../../index.php?mod=kasir&submod=inputKasir";
              </script>';
	} else {
		$daftar = $db->query("select * from tbl_pendaftaran where no_daftar='" . $data[0]['no_daftar'] . "'");
		$telp = $data[0]['telp'];
		//$telp = '087884947802';

		$access_token = 'aa9c607342df5b98f3662f3f3217f2f4c9ec3808';
		$long_url = 'http://103.157.26.142/pages/kasir/print_pembayaran_pasien.php?id=' . md5($data[0]['no_kwitansi']);
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

		// $telp = '087884947802';
		$pic = $data[0]['nama'];
		$token = $db->query("select nilai from tbl_config where kode='WA-API'");
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
				'target' => "$telp",
				'message' => '*Dear ' . $pic . '*,
    		
Berikut ini adalah rincian Pembayaran Anda di Klinik Semesta Medika.

Tanggal Berobat : ' . date("d F Y", strtotime($daftar[0]['tgl_daftar'])) . '
Total yang sudah dibayar : Rp. ' . number_format($data[0]['total']) . '
Metode Pembayaran : ' . $data[0]['metode_payment'] . '

Untuk melihat detail dari kwitasi Anda, Silahkan klik URL berikut ini
URL : ' . $short_url . '

Terima kasih',
				'countryCode' => '62', //optional
			),
			CURLOPT_HTTPHEADER => array(
				'Authorization: ' . $token[0]['nilai'] //change TOKEN to your actual token - ML6#M4X3fxTZWFwBFUZ@
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);

		//Masukkan ke tabel pengiriman WA
		$message = '*Dear ' . $pic . '*,
    		
Berikut ini adalah rincian Pembayaran Anda di Klinik Semesta Medika.

Tanggal Berobat : ' . date("d F Y", strtotime($daftar[0]['tgl_daftar'])) . '
Total yang sudah dibayar : Rp. ' . number_format($data[0]['total']) . '
Metode Pembayaran : ' . $data[0]['metode_payment'] . '

Untuk melihat detail dari kwitasi Anda, Silahkan klik URL berikut ini
URL : https://demo.kliniku.id/klinik/pages/kasir/print_pembayaran_pasien.php?id=' . md5($data[0]['no_kwitansi']) . '

Terima kasih';
		$insert = $db->query("insert into tbl_notifikasi_wa (kepada_no, kepada_nama, isi) value ('$telp', '$pic', '$message')");
		echo '<script language="javascript">
                    alert("Bukti pembayaran sudah dikirim melalui WhatsApp atas Nama ' . $pic . '");
                    window. location = "../../index.php?mod=kasir&submod=inputKasir";
                </script>';
	}
}
