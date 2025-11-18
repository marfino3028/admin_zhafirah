<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_jns_tarif (nama_jns_tarif, kode_jns_tarif) values ('".$_POST['nama_jns_tarif']."', '".$_POST['kode_jns_tarif']."' )", 0);
	}
	header("location:../../index.php?mod=master&submod=jenis_tarif");
?>