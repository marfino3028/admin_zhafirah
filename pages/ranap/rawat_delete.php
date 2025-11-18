<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data tindakan laboratorium
		$no_lab = $db->queryItem("select no_rawat from tbl_rawat_detail where id='".$_GET['id']."'");
		$update = $db->query("delete from tbl_rawat_detail where id='".$_GET['id']."'");
		
		$totalNya = $db->queryItem("select sum(tarif) from tbl_rawat_detail where  no_rawat='$no_lab' and status_delete='UD'", 0);
		$update = $db->query("update tbl_rawat set total_harga_rawat=".$totalNya." where no_rawat='$no_lab'", 0);
	}
	header("location:../../index.php?mod=ranap&submod=input_rawat_tindakan&id=".$_GET['subid']);
?>