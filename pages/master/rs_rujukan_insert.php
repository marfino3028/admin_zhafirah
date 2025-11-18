<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
	    $propinsi = $db->query("select name from tbl_daerah_prop where id='".$_POST['propinsi']."'");
	    $kabupaten = $db->query("select name from tbl_daerah_kab where id='".$_POST['kotamadya']."'");
	    $kecamatan = $db->query("select name from tbl_daerah_kec where id='".$_POST['kecamatan']."'");
	    $kelurahan = $db->query("select id, name from tbl_daerah_kel where id='".$_POST['kelurahan']."'");
		$insert = $db->query("insert into tbl_rujukan (nama, kode, alamat, prop_kode, prop_nama, kab_kode, kab_nama, kec_kode, kec_nama, kel_kode, kel_nama, telp, jenis, tipe) values ('".$_POST['nama']."', '".$_POST['kode']."', '".$_POST['alamat']."', '".$_POST['propinsi']."', '".$propinsi[0]['name']."', '".$_POST['kotamadya']."', '".$kabupaten[0]['name']."', '".$_POST['kecamatan']."', '".$kecamatan[0]['name']."', '".$_POST['kelurahan']."', '".$kelurahan[0]['name']."', '".$_POST['telp']."', '".$_POST['jenis']."', '".$_POST['tipe']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=rs_rujukan");
?>