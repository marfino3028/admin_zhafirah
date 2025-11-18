<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_sbu set nama='".$_POST['nama']."', kode='".$_POST['kode']."', alamat='".$_POST['alamat']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=sbu");
?>