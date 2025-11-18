<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$obat = $db->query("select * from tbl_logistik where md5(id)='".$_POST['id']."'");

		$insert = $db->query("insert into tbl_logistik_satuan (logistik_id, logistik_nama, isi_besar, satuan_besar, isi_kecil, satuan_kecil) values ('".$obat[0]['id']."', '".$obat[0]['nama']."', '".$_POST['isi_besar']."', '".$_POST['satuan_besar']."', '".$_POST['harga_beli']."', '".$_POST['satuan']."')", 1);
	}
	header("location:../../index.php?mod=master&submod=logistik_satuan&id=".$_POST['id']);
?>