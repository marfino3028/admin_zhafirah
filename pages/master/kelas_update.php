<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("update tbl_kelas set kode='".$_POST['kode']."', nama='".$_POST['nama']."', tarif='".$_POST['tarif']."' where md5(id)='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=kelas");
?>