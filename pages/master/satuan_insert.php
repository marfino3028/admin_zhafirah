<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_satuan (nama, kode) values ('".$_POST['nama']."', '".$_POST['kode']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=satuan");
?>