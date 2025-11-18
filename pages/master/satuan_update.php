<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_satuan set 
		nama='".$_POST['nama']."', 
		kode='".$_POST['kode']."'  where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=satuan");
?>