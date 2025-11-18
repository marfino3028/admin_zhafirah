<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data tindakan laboratorium
		//$nama_tindakan = $db->queryItem("select nama_pelayanan from tbl_tarif where kode_tarif='".$_POST['gigi']."'");
		$no_bedah = $db->queryItem("select no_bedah from tbl_bedah_detail where id='".$_GET['id']."'");
		$update = $db->query("update tbl_bedah_detail set status_delete='D' where id='".$_GET['id']."'");
		
		$totalNya = $db->queryItem("select sum(tarif) from tbl_bedah_detail where no_bedah='$no_bedah' and status_delete='UD'", 0);
		$update = $db->query("update tbl_bedah set total_harga_bedah=".$totalNya." where no_bedah='$no_bedah'", 0);
	}
	header("location:../../index.php?mod=poli&submod=input_bedah_tindakan&id=".$_GET['subid']);
?>