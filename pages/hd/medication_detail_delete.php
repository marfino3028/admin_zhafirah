<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data tindakan laboratorium
		$hapus = $db->query("delete from tbl_medication_detail where md5(id)='".$_GET['id']."'", 0);
	}
	header("location:../../index.php?mod=hd&submod=medication&id=".$_GET['subid']);
?>