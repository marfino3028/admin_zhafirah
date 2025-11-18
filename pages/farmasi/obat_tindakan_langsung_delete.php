<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$delete = $db->query("delete from tbl_tindakan_langsung where id='".$_GET['id']."'", 0);
	}
	header("location:../../index.php?mod=farmasi&submod=input_jual_langsung_obat&id=".$_GET['ids']);
?>