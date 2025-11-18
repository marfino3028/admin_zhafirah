<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data tindakan laboratorium
		$nama_tindakan = $db->queryItem("select nama_pelayanan from tbl_tarif where kode_tarif='".$_POST['gigi']."'");
		$no_umum = $db->queryItem("select no_umum from tbl_umum_detail where id='".$_GET['id']."'");
		$update = $db->query("delete from tbl_umum_detail where id='".$_GET['id']."'");
		
		$totalNya = $db->queryItem("select sum(tarif) from tbl_umum_detail where  no_umum='$no_umum' and status_delete='UD'", 0);
		$update = $db->query("update tbl_umum set total_harga_umum=".$totalNya." where no_umum='$no_umum'", 0);
	}
	header("location:../../index.php?mod=poli&submod=umum_new_tindakan&id=".$_GET['subid']);
?>