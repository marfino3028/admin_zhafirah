<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_profit set kd_profit='".$_POST['kd_profit']."', nm_profit='".$_POST['nm_profit']."', profit_type='".$_POST['profit_type']."', group_type='".$_POST['group_type']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=profit");
?>