<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$t1 = explode("/", $_POST['tgl_lahir']);
		$tanggal = $_POST['tgl_lahir'];

		$t3 = explode("/", $_POST['tgl_berlaku']);
		$tgl_berlaku = $_POST['tgl_berlaku'];

		
		//if ($_POST['hub'] == 'PEGAWAI')	$_POST['peg_id'] = '0';
	    $propinsi = $db->query("select name from tbl_daerah_prop where id='".$_POST['propinsi']."'");
	    $kabupaten = $db->query("select name from tbl_daerah_kab where id='".$_POST['kotamadya']."'");
	    $kecamatan = $db->query("select name from tbl_daerah_kec where id='".$_POST['kecamatan']."'");
	    $kelurahan = $db->query("select id, name from tbl_daerah_kel where id='".$_POST['kelurahan']."'");
	    $idTerakhir = $db->query("select id from tbl_pasien order by id desc");
	    $idNya = $idTerakhir[0]['id'] + 1;
		$kodeWA = $db->query("select nilai from tbl_config where kode='WA-API'");
		
		$insert = $db->query("insert into  tbl_pasien (id, nomr, nm_pasien, nm_keluarga, jk, tmpt_lahir, tgl_lahir, pekerjaan, alamat_pasien, kelurahan, kecamatan, kotamadya, propinsi, kel_kode, kec_kode, kab_kode, prop_kode, kode_pos_pasien, telp_pasien, agama, no_ktp, nm_penjamin, alamat_penjamin, rujukan, hubungan, email, idmember, status_membership, tgl_berlaku, tgLdaftar, jenis_pendaftaran, type_pasien, status_pasien, no_polis, nip, no_peserta ) values ('$idNya', '".$_POST['nomr']."', '".$_POST['nama']."', '".$_POST['keluarga']."', '".$_POST['jk']."', '".$_POST['tmpt_lahir']."', '".$_POST['tgl_lahir']."', '".$_POST['pekerjaan']."', '".$_POST['alamat_pasien']."', '".$kelurahan[0]['name']."', '".$kecamatan[0]['name']."', '".$kabupaten[0]['name']."', '".$propinsi[0]['name']."', '".$_POST['kelurahan']."', '".$_POST['kecamatan']."', '".$_POST['kotamadya']."', '".$_POST['propinsi']."', '".$_POST['kode_pos_pasien']."', '".$_POST['telp_pasien']."', '".$_POST['agama']."', '".$_POST['no_ktp']."', '".$_POST['nm_penjamin']."', '".$_POST['alamat_penjamin']."', '".$_POST['rujukan']."', '".$_POST['hubungan']."', '".$_POST['email']."', '".$_POST['idmember']."', '".$_POST['status_membership']."', '$tgl_berlaku', '$tanggal', '".$_POST['jenis_pendaftaran']."', '".$_POST['type_pasien']."', 'NEW', '".$_POST['no_polis']."', '".$_POST['nip']."', '".$_POST['no_peserta']."')", 0);

		//Masukkan sebagai User di tabel user
		$insert = $db->query("insert into tbl_user (userid, nip, sandi, nama, code, telp, force_ganti, email) values ('".$_POST['nomr']."', '".$_POST['nomr']."', '".md5('DialisaCare@2024!')."', '".$_POST['nama']."', 'PASIEN', '".$_POST['telp_pasien']."', '2', '".$_POST['email']."')", 0);
		
		//Kirim WA
		$telp = $_POST['telp_pasien'];
        $curl = curl_init();

		$pesan = '*Dear '.$_POST['nama'].'*,
    		
Anda telah didaftarkan di Klinik Dialisacare.
Berikut Informasi yang bisa Anda gunakan untuk masuk ke Aplikasi Klinik Dialisacare.

User ID : '.$_POST['nomr'].'
Password : DialisaCare@2024!

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
	header("location:../../index.php?mod=master&submod=pasien");
?>