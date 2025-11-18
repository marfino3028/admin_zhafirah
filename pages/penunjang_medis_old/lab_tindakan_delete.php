<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data tindakan laboratorium
		$nama_tindakan = $db->queryItem("select nama_pelayanan from tbl_tarif where kode_tarif='".$_POST['lab']."'");
		$no_lab = $db->queryItem("select no_lab from tbl_lab_detail where id='".$_GET['id']."'");
		$update = $db->query("update tbl_lab_detail set status_delete='D' where id='".$_GET['id']."'");
		
		$totalNya = $db->queryItem("select sum(tarif) from tbl_lab_detail where  no_lab='$no_lab' and status_delete='UD'", 0);
		$update = $db->query("update tbl_lab set total_harga_lab=".$totalNya." where no_lab='$no_lab'", 0);
	}
	header("location:../../index.php?mod=penunjang_medis&submod=input_lab_tindakan&id=".$_GET['subid']);
?>