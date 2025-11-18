<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_sbu (nama, kode, alamat) values ('".$_POST['nama']."', '".$_POST['kode']."', '".$_POST['alamat']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=sbu");
?>