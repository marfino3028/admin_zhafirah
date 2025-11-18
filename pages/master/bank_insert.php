<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_bank (nm_bank, kode_bank, no_rek, cabang) values ('".$_POST['nm_bank']."', '".$_POST['kode_bank']."', '".$_POST['no_rek']."', '".$_POST['cabang']."' )", 0);
	}
	header("location:../../index.php?mod=master&submod=bank");
?>