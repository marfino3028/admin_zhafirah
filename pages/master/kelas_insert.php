<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_kelas (kode, nama, tarif) values ('".$_POST['kode']."', '".$_POST['nama']."', '".$_POST['tarif']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=kelas");
?>