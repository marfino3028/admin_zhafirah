<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_config set deskripsi='".$_POST['desc']."', kode='".$_POST['kode']."', tahun='".$_POST['tahun']."', nilai='".$_POST['nilai']."'  where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=konfigurasi");
?>