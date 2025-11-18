<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$delete = $db->query("delete from tbl_hubungan_keluarga where id='".$_GET['id']."'", 0);
	}
	header("location:../../index.php?mod=pendaftaran&submod=hubungan");
?>