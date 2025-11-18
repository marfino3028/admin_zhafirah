<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_suplier (nama_suplier, kode_suplier, alamat_suplier, contact_suplier) values ('".$_POST['nama_suplier']."', '".$_POST['kode_suplier']."', '".$_POST['alamat_suplier']."', '".$_POST['contact_suplier']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=suplier");
?>