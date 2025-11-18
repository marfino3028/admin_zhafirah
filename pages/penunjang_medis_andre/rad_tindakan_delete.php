<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data tindakan laboratorium
		$nama_tindakan = $db->queryItem("select nama_pelayanan from tbl_tarif where kode_tarif='".$_POST['lab']."'");
		$no_rad = $db->queryItem("select no_rad from tbl_rad_detail where id='".$_GET['id']."'");
		$update = $db->query("update tbl_rad_detail set status_delete='D' where id='".$_GET['id']."'");
		
		$totalNya = $db->queryItem("select sum(tarif) from tbl_rad_detail where  no_rad='$no_rad' and status_delete='UD'", 0);
		$update = $db->query("update tbl_rad set total_harga_rad=".$totalNya." where no_rad='$no_rad'", 0);
	}
	header("location:../../index.php?mod=penunjang_medis&submod=input_rad_tindakan&id=".$_GET['subid']);
?>