<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_jns_tarif set  kode_jns_tarif='".$_POST['kode_jns_tarif']."', nama_jns_tarif='".$_POST['nama_jns_tarif']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=jenis_tarif");
?>