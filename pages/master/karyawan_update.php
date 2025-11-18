<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_karyawan set nm_karyawan='".$_POST['nama']."', unit='".$_POST['unit']."'  where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=karyawan");
?>