<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_tarif_group set nama='".$_POST['nama']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=gt");
?>