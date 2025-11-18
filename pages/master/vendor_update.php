<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_vendor set 
		nama_vendor='".$_POST['nama_vendor']."', 
		kode_vendor='".$_POST['kode_vendor']."', 
		alamat_vendor='".$_POST['alamat_vendor']."',
		contact_vendor='".$_POST['contact_vendor']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=vendor");
?>