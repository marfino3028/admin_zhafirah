<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
	    $sub = $db->queryItem("select nm_profit from tbl_profit where kd_profit='".$_POST['profit']."'");
		$update = $db->query("update tbl_poli set nama_poli='".$_POST['nama_poli']."', kd_poli ='".$_POST['kd_poli']."', tarif ='".$_POST['tarif']."', kd_profit ='".$_POST['profit']."', nm_profit ='".$sub."'  where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=poli");
?>