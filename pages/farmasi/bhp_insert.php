<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_bhp (nm_bhp, des_bhp) values ('".$_POST['nm_bhp']."', '".$_POST['des_bhp']."')", 0);
	}
	header("location:../../index.php?mod=farmasi&submod=bhp");
?>