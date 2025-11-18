<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$delete = $db->query("delete from tbl_kelas_ruang_bed where md5(id)='".$_GET['id']."'");
	}
	header("location:../../index.php?mod=master&submod=inap_bed");
?>