<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$t1 = explode("/", $_POST['tgl_lahir']);
		$tanggal = $t1[2].'-'.$t1[0].'-'.$t1[1];
		
		//if ($_POST['hub'] == 'PEGAWAI')	$_POST['peg_id'] = '0';
	    $propinsi = $db->query("select name from tbl_daerah_prop where id='".$_POST['propinsi']."'");
	    $kabupaten = $db->query("select name from tbl_daerah_kab where id='".$_POST['kotamadya']."'");
	    $kecamatan = $db->query("select name from tbl_daerah_kec where id='".$_POST['kecamatan']."'");
	    $kelurahan = $db->query("select id, name from tbl_daerah_kel where id='".$_POST['kelurahan']."'");
	    $idTerakhir = $db->query("select id from tbl_pasien order by id desc");
	    $idNya = $idTerakhir[0]['id'] + 1;
	    $_POST['umur'] = 0;
		$insert = $db->query("insert into  tbl_pasien (id, nomr, nm_pasien, nm_keluarga, umur, jk, tmpt_lahir, tgl_lahir, pekerjaan, alamat_pasien, kelurahan, kecamatan, kotamadya, propinsi, kel_kode, kec_kode, kab_kode, prop_kode, kode_pos_pasien, telp_pasien, agama, no_ktp, nm_penjamin, alamat_penjamin, rujukan, tgLdaftar, jenis_pendaftaran, status_pasien, no_polis, nip, no_peserta ) values ('$idNya', '".$_POST['nomr']."', '".$_POST['nama']."', '".$_POST['keluarga']."', '".$_POST['umur']."', '".$_POST['jk']."', '".$_POST['tmpt_lahir']."', '".$_POST['tgl_lahir']."', '".$_POST['pekerjaan']."', '".$_POST['alamat_pasien']."', '".$kelurahan[0]['name']."', '".$kecamatan[0]['name']."', '".$kabupaten[0]['name']."', '".$propinsi[0]['name']."', '".$_POST['kelurahan']."', '".$_POST['kecamatan']."', '".$_POST['kotamadya']."', '".$_POST['propinsi']."', '".$_POST['kode_pos_pasien']."', '".$_POST['telp_pasien']."', '".$_POST['agama']."', '".$_POST['no_ktp']."', '".$_POST['nm_penjamin']."', '".$_POST['alamat_penjamin']."', '".$_POST['rujukan']."', '".date("Y-m-d")."', '".$_POST['jenis_pendaftaran']."', 'NEW', '".$_POST['no_polis']."', '".$_POST['nip']."', '".$_POST['no_peserta']."')", 0);
		$update = $db->query("update tbl_perjanjian set nomr='".$_POST['nomr']."' where md5(id)='".$_POST['idOTC']."'");
	}
	header("location:../../index.php?mod=pendaftaran&submod=otc_daftar&id=".$_POST['idOTC']);
?>