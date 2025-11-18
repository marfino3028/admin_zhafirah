<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("delete from tbl_bhp where id='".$_GET['id']."'", 0);
	}
	header("location:../../index.php?mod=farmasi&submod=bhp");
?>