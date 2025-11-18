<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_profit (kd_profit, nm_profit, profit_type, group_type) values ('".$_POST['kd_profit']."', '".$_POST['nm_profit']."', '".$_POST['profit_type']."', '".$_POST['group_type']."' )", 0);
	}
	header("location:../../index.php?mod=master&submod=profit");
?>