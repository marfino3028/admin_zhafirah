<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_vendor (nama_vendor, kode_vendor, alamat_vendor, contact_vendor) values ('".$_POST['nama_vendor']."', '".$_POST['kode_vendor']."', '".$_POST['alamat_vendor']."', '".$_POST['contact_vendor']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=vendor");
?>