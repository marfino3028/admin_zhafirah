<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_tarif_group (nama) values ('".$_POST['nama']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=gt");
?>