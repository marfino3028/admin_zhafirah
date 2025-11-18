<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	date_default_timezone_set('Asia/Jakarta');
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_pasien where nomr='".$_POST['nomr']."'");
		if ($data[0]['umur'] == "")  $data[0]['umur'] = 0;
		$insert = $db->query("insert into  tbl_pasien_mutasi (nomr, nm_pasien, nm_keluarga, umur, jk, tmpt_lahir, tgl_lahir, pekerjaan, alamat_pasien, kelurahan, kecamatan, kotamadya, propinsi, prop_kode, kab_kode, kec_kode, kel_kode, kode_pos_pasien, telp_pasien, agama, no_ktp, nm_penjamin, alamat_penjamin, rujukan, hubungan, email, idmember, status_membership, tgl_berlaku, tgLdaftar, jenis_pendaftaran, type_pasien, status_delete, tgl_insert, status_pasien, nomr_id, no_polis, nip, no_peserta, user_change, tgl_change, rujukan_mutasi, type_pasian_mutasi) values ('".$data[0]['nomr']."', '".$data[0]['nm_pasien']."', '".$data[0]['nm_keluarga']."', '".$data[0]['umur']."', '".$data[0]['jk']."', '".$data[0]['tmpt_lahir']."', '".$data[0]['tgl_lahir']."', '".$data[0]['pekerjaan']."', '".$data[0]['alamat_pasien']."', '".$data[0]['kelurahan']."', '".$data[0]['kecamatan']."', '".$data[0]['kotamadya']."', '".$data[0]['propinsi']."', '".$data[0]['prop_kode']."', '".$data[0]['kab_kode']."', '".$data[0]['kec_kode']."', '".$data[0]['kel_kode']."', '".$data[0]['kode_pos_pasien']."', '".$data[0]['telp_pasien']."', '".$data[0]['agama']."', '".$data[0]['no_ktp']."', '".$data[0]['nm_penjamin']."', '".$data[0]['alamat_penjamin']."', '".$data[0]['rujukan']."', '".$data[0]['hubungan']."', '".$data[0]['email']."', '".$data[0]['idmember']."', '".$data[0]['status_membership']."', '".$data[0]['tgl_berlaku']."', '".$data[0]['tgLdaftar']."', '".$data[0]['jenis_pendaftaran']."', '".$data[0]['type_pasien']."', '".$data[0]['status_delete']."', '".$data[0]['tgl_insert']."', '".$data[0]['status_pasien']."', '".$data[0]['nomr_id']."', '".$data[0]['no_polis']."', '".$data[0]['nip']."', '".$data[0]['no_peserta']."', '".$_SESSION['rg_user']."', '".date("Y-m-d H:i:s")."', '".$_POST['rujukan']."', '".$_POST['type_pasien']."')", 0);
		//$update = $db->query("update tbl_pasien set rujukan='".$_POST['rujukan']."', type_pasien='".$_POST['type_pasien']."' where nomr='".$_POST['nomr']."'");
	}
	header("location:../../index.php?mod=master&submod=pasien");
?>