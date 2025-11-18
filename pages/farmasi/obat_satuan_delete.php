<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$delete = $db->query("delete from tbl_obat_satuan where md5(id)='".$_GET['id']."'", 0);
	}
	header("location:../../index.php?mod=farmasi&submod=obat_satuan&id=".$_GET['kode']);
?>