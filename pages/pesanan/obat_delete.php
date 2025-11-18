<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$deleteheader = $db->query("delete from tbl_pesanan_obat where md5(id)='".$_GET['id']."'");
		$deleteDetail = $db->query("delete from tbl_pesanan_obat_detail where md5(pesanan_id)='".$_GET['id']."'");
	}
	header("location:../../index.php?mod=pesanan&submod=obat");
?>