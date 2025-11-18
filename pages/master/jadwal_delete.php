<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("delete from tbl_jadwal where md5(id)='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=jadwal");
?>