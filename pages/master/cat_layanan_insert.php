<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_kat_pelayanan (kode_kat_pelayanan, nama_kat_pelayanan, kode_jns_tarif) values ('".$_POST['kode_pelayanan']."', '".$_POST['nama_pelayanan']."', '".$_POST['jenis_layanan']."' )", 0);
	}
	header("location:../../index.php?mod=master&submod=category_layanan");
?>