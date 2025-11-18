<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		if ($_POST['bulan'] < 10) $blnTxt = '0'.$_POST['bulan'];
		else $blnTxt = $_POST['bulan'];
		$ts_yymm = $_POST['tahun'].$blnTxt;
		$nama_obat = $db->queryItem("select nama_obat from tbl_obat where kode_obat='".$_POST['obat']."'");
		$insert = $db->query("insert into tbl_stock_awal (kode_obat, nama_obat, tahun, bulan, ts_yymm, nilai) values ('".$_POST['obat']."', '".$nama_obat."', '".$_POST['tahun']."', '".$_POST['bulan']."', '".$ts_yymm."', '".$_POST['stock']."')", 0);
		header("location:../../index.php?mod=inv&submod=stock_awal");
	}
?>