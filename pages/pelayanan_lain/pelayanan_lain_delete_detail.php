<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data tindakan laboratorium
		$Delete_Detail = $db->query("DELETE FROM tbl_pelayanan_lainnya_detail WHERE Id = {$_GET['id']}");
		$Total = $db->queryItem("select sum(Tarif * Qty) as Total from tbl_pelayanan_lainnya_detail where ParentId={$_GET['ParentId']}");
		$UpdateParent = $db->query("update tbl_pelayanan_lainnya set Total = ".$Total." where Id= {$_GET['ParentId']}");
	}
	header("location:../../index.php?mod=pelayanan_lain&submod=pelayanan_lain_input_tindakan&id=".$_GET['ParentId']);
?>
