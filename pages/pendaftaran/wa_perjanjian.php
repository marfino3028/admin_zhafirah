<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	//print_r($_SESSION);
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_perjanjian where md5(id)='".$_GET['id']."'", 1);
      	if ($data[0]['hp'] == "") {
          echo '<script language="javascript">
                  alert("Mohon maaf nomor HP pasien belum ada, jadi tidak bisa mengirimkan bukti pembayaran melalui WhatsApp");
                  window. location = "../../index.php?mod=pendaftaran&submod=appt";
              </script>';
        }
      	else {
			$daftar = $db->query("select * from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
			$telp = $data[0]['hp'];
			$pic = $data[0]['nama'];
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
			'target' => "$telp",
			'message' => '*Dear '.$pic.'*,
    		
Berikut ini Sebagai Pengingat Perjanjian untuk Pendaftaran Anda di Klinik Semesta Medika.

Tanggal Daftar : '.date("d F Y", strtotime($data[0]['tgl_daftar'])).'
Atas Nama : '.$data[0]['nama'].'
Alamat : '.$data[0]['alamat'].'
Tempat & Tgl Lahir : '.$data[0]['tempat_lahir'].', '.date("d F Y", strtotime($data[0]['tanggal_lahir'])).'

Terima kasih', 
			'countryCode' => '62', //optional
			),
			  CURLOPT_HTTPHEADER => array(
				'Authorization: '.$token[0]['nilai'] //change TOKEN to your actual token - ML6#M4X3fxTZWFwBFUZ@
			  ),
			));
			
			$response = curl_exec($curl);
			curl_close($curl);

            echo '<script language="javascript">
                    alert("Pengingat dikirim melalui WhatsApp atas Nama '.$data[0]['nama'].'");
                    window. location = "../../index.php?mod=pendaftaran&submod=appt";
                </script>';
        }
	}

?>