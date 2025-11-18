<?php
	session_start();
	include "../../3rdparty/engine.php";
	//echo "<pre>";
	//print_r($_POST);
	ini_set("display_errors", 0);
	date_default_timezone_set("Asia/Jakarta");
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("update tbl_mcu_worklist set kesimpulan='".$_POST['kesimpulan']."', saran='".$_POST['saran']."' where md5(id)='".$_POST['key']."'", 0);

		header("location:../../index.php?mod=mcu&submod=worklist&id=".$_POST['id']."&ids=".$_POST['ids']);
	}
?>?>