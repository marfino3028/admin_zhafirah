<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data tindakan laboratorium
		$no_fis = $db->queryItem("select no_fisio from tbl_fisio_detail where id='".$_GET['id']."'");
		$update = $db->query("delete from tbl_fisio_detail where id='".$_GET['id']."'");
		
		$totalNya = $db->queryItem("select sum(tarif) from tbl_fisio_detail where  no_fisio='$no_fis' and status_delete='UD'", 0);
		$update = $db->query("update tbl_fisio set total_harga_fisio=".$totalNya." where no_fisio='$no_fis'", 0);
	}
	header("location:../../index.php?mod=penunjang_medis&submod=input_fisio_tindakan&id=".$_GET['subid']);
?>