<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_kat_pelayanan set kode_kat_pelayanan='".$_POST['kode_pelayanan']."', nama_kat_pelayanan='".$_POST['nama_pelayanan']."', kode_jns_tarif='".$_POST['jenis_layanan']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=category_layanan");
?>