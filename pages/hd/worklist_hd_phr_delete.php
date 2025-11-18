<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_hd_phr where md5(id)='".$_GET['id']."'");
		//Input Data tindakan laboratorium
		$hapus = $db->query("delete from tbl_hd_phr where md5(id)='".$_GET['id']."'", 0);
	}
	header("location:../../index.php?mod=hd&submod=worklist_phr&id=".md5($data[0]['nomr']).'&ids='.md5($data[0]['no_daftar']));
?>