<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
	    $propinsi = $db->query("select name from tbl_daerah_prop where id='".$_POST['propinsi']."'");
	    $kabupaten = $db->query("select name from tbl_daerah_kab where id='".$_POST['kotamadya']."'");
	    $kecamatan = $db->query("select name from tbl_daerah_kec where id='".$_POST['kecamatan']."'");
	    $kelurahan = $db->query("select id, name from tbl_daerah_kel where id='".$_POST['kelurahan']."'");
		$update = $db->query("update tbl_rujukan set nama='".$_POST['nama']."', kode='".$_POST['kode']."', alamat='".$_POST['alamat']."', prop_kode='".$_POST['propinsi']."', prop_nama='".$propinsi[0]['name']."', kab_kode='".$_POST['kotamadya']."', kab_nama='".$kabupaten[0]['name']."', kec_kode='".$_POST['kecamatan']."', kec_nama='".$kecamatan[0]['name']."', kel_kode='".$_POST['kelurahan']."', kel_nama='".$kelurahan[0]['name']."', telp='".$_POST['telp']."', jenis='".$_POST['jenis']."', tipe='".$_POST['tipe']."' where md5(id)='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=rs_rujukan");
?>