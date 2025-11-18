<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into  tbl_config (deskripsi, kode, tahun, nilai) values ('".$_POST['desc']."', '".$_POST['kode']."', '".$_POST['tahun']."', '".$_POST['nilai']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=konfigurasi");
?>