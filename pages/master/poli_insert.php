<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
	    $sub = $db->queryItem("select nm_profit from tbl_profit where kd_profit='".$_POST['profit']."'");
		$insert = $db->query("insert into tbl_poli (nama_poli, kd_poli, tarif, kd_profit, nm_profit) values ('".$_POST['nama_poli']."', '".$_POST['kd_poli']."','".$_POST['tarif']."','".$_POST['profit']."', '".$sub."')", 0);
	}
	header("location:../../index.php?mod=master&submod=poli");
?>