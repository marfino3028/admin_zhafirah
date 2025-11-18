<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_suplier set 
		nama_suplier='".$_POST['nama_suplier']."', 
		kode_suplier='".$_POST['kode_suplier']."', 
		alamat_suplier='".$_POST['alamat_suplier']."',
		contact_suplier='".$_POST['contact_suplier']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=suplier");
?>