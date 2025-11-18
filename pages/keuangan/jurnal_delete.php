<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);

	
	if ($_SESSION['rg_user'] != '') {
		//insert data
		$delete = $db->query("delete from tbl_jurnal where md5(no_dokumen)='".$_GET['id']."'");
		
		header("location:../../index.php?mod=keuangan&submod=jurnal_entri");
	}
?>