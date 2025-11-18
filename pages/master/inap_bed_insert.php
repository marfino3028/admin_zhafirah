<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("insert into tbl_kelas_ruang_bed (kelas_id, kelas_ruang_id, nama) values ('".$_POST['kelas']."', '".$_POST['kelas_ruang']."', '".$_POST['bed']."')");
	}
	header("location:../../index.php?mod=master&submod=inap_bed");
?>