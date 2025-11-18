<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data tindakan laboratorium
		$nama_tindakan = $db->queryItem("select nama_pelayanan from tbl_tarif where kode_tarif='".$_POST['gigi']."'");
		$no_gigi = $db->queryItem("select no_gigi from tbl_gigi_detail where id='".$_GET['id']."'");
		$update = $db->query("update tbl_gigi_detail set status_delete='D' where id='".$_GET['id']."'");
		
		$totalNya = $db->queryItem("select sum(tarif) from tbl_gigi_detail where  no_gigi='$no_gigi' and status_delete='UD'", 0);
		$update = $db->query("update tbl_gigi set total_harga_gigi=".$totalNya." where no_gigi='$no_gigi'", 0);
	}
	header("location:../../index.php?mod=poli&submod=input_gigi_tindakan&id=".$_GET['subid']);
?>