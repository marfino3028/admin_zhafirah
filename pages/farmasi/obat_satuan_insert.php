<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$obat = $db->query("select * from tbl_obat where md5(id)='".$_POST['id']."'");

		$insert = $db->query("insert into tbl_obat_satuan (obat_id, obat_nama, isi_besar, satuan_besar, isi_kecil, satuan_kecil) values ('".$obat[0]['kode_obat']."', '".$obat[0]['nama_obat']."', '".$_POST['isi_besar']."', '".$_POST['satuan_besar']."', '".$_POST['harga_beli']."', '".$_POST['satuan']."')", 0);
	}
	header("location:../../index.php?mod=farmasi&submod=obat_satuan&id=".$_POST['id']);
?>