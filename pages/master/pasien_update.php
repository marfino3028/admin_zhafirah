<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
	    $propinsi = $db->query("select name from tbl_daerah_prop where id='".$_POST['propinsi']."'");
	    $kabupaten = $db->query("select name from tbl_daerah_kab where id='".$_POST['kotamadya']."'");
	    $kecamatan = $db->query("select name from tbl_daerah_kec where id='".$_POST['kecamatan']."'");
	    $kelurahan = $db->query("select id, name from tbl_daerah_kel where id='".$_POST['kelurahan']."'");
	    
		$update = $db->query("update tbl_pasien set nm_pasien='".$_POST['nama']."', nm_keluarga='".$_POST['keluarga']."', tmpt_lahir='".$_POST['tmpt_lahir']."', tgl_lahir='".$_POST['tgl_kelahiran']."', pekerjaan='".$_POST['pekerjaan']."', alamat_pasien='".$_POST['alamat_pasien']."', kelurahan='".$kelurahan[0]['name']."', kecamatan='".$kecamatan[0]['name']."', kotamadya='".$kabupaten[0]['name']."', propinsi='".$propinsi[0]['name']."', kel_kode='".$_POST['kelurahan']."', kec_kode='".$_POST['kecamatan']."', kab_kode='".$_POST['kotamadya']."', prop_kode='".$_POST['propinsi']."', kode_pos_pasien='".$_POST['kode_pos_pasien']."', telp_pasien='".$_POST['telp_pasien']."', agama='".$_POST['agama']."', no_ktp='".$_POST['no_ktp']."', nm_penjamin='".$_POST['nm_penjamin']."', alamat_penjamin='".$_POST['alamat_penjamin']."', rujukan='".$_POST['rujukan']."', hubungan='".$_POST['hubungan']."', email='".$_POST['email']."', jk='".$_POST['jk']."', jenis_pendaftaran='".$_POST['jenis_pendaftaran']."', nomr='".$_POST['nomr']."', no_polis='".$_POST['no_polis']."', no_peserta='".$_POST['no_peserta']."', status_membership='".$_POST['status_membership']."', tgl_berlaku='".$_POST['tgl_berlaku']."', type_pasien='".$_POST['type_pasien']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=pasien");
?>