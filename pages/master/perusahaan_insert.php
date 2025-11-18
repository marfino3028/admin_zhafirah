<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
      	echo '<pre>';
    	print_r($_POST);
    	if ($_FILES['dokumen']['name'] != "") {
			print_r($_POST);
			$path = $_FILES['dokumen']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$nama_file = 'News-Image-'.date("d F Y H:i:s").'.'.$ext;
			@copy($_FILES['dokumen']['tmp_name'], '../../dokumen/'.$nama_file);
		}
		else {
			$nama_file = "";
		}
	    $kodeWA = $db->query("select nilai from tbl_config where kode='WA-API'");
	    $sub = $db->queryItem("select nm_gt from tbl_tarif_group where kd_gt='".$_POST['gttarif']."'");
	    $coa_piutang = $db->query("select nm_coa from tbl_coa where kd_coa='".$_POST['piutang_kd_coa']."'");
	    $coa_pendapatan = $db->query("select nm_coa from tbl_coa where kd_coa='".$_POST['pendapatan_kd_coa']."'");
	    $insert = $db->query("insert into tbl_perusahaan_draft (nama_perusahaan, kode_perusahaan, alamat_perusahaan, kota, kd_pos ,telp , fax, kd_gt, nm_gt, group_aim, link_map, dokumen, bank_name, norek_provider, bank_cab, rek_nama, pic_contact, no_ijin, harga_up, piutang_kd_coa, piutang_nm_coa, pendapatan_kd_coa, pendapatan_nm_coa) values ('".$_POST['nama_perusahaan']."', '".$_POST['kode_perusahaan']."', '".$_POST['alamat_perusahaan']."', '".$_POST['kota']."', '".$_POST['kd_pos']."','".$_POST['telp']."','".$_POST['fax']."','".$_POST['gttarif']."', '".$sub."', '".$_POST['aim']."', '".$_POST['link_map']."', '$nama_file', '".$_POST['bank_name']."', '".$_POST['norek_provider']."', '".$_POST['bank_cab']."', '".$_POST['rek_nama']."', '".$_POST['pic_contact']."', '".$_POST['no_ijin']."', '".$_POST['harga_up']."', '".$_POST['piutang_kd_coa']."', '".$coa_piutang[0]['nm_coa']."', '".$_POST['pendapatan_kd_coa']."', '".$coa_pendapatan[0]['nm_coa']."')");

		//Kirim WA
		$telp = $_POST['telp'];
        $curl = curl_init();

		$pesan = '*Dear '.$_POST['nama_perusahaan'].'*,
    		
Pengajuan Klinik Provider anda sudah kami terima.
Silahkan untuk melakukan pembayaran subscribe Klinik Provider ke No Rekening dibawah ini:

No Rekenig : 123-345-567-89
Atas Nama : PT Abada Inti Medika
Bank : Mandiri

Jika sudah melakukan pembayaran silahkan melakukan Konfirmasi pembayaran melalui E-mail: info@dialisacare.com

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