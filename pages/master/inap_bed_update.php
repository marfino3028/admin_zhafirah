<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_kelas_ruang_bed set kelas_id='".$_POST['kelas']."', kelas_ruang_id='".$_POST['kelas_ruang']."', nama='".$_POST['bed']."' where md5(id)='".$_POST['id']."'");
	}
	header("location:../../index.php?mod=master&submod=inap_bed");
?>