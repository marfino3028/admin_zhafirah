<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_bank set nm_bank='".$_POST['nm_bank']."', kode_bank='".$_POST['kode_bank']."', no_rek='".$_POST['no_rek']."', cabang='".$_POST['cabang']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=bank");
?>