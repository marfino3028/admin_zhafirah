<?php
	session_start();
	include "../../3rdparty/engine.php";
	echo "<pre>";
	print_r($_POST);
	ini_set("display_errors", 0);
	date_default_timezone_set("Asia/Jakarta");
	
	if ($_SESSION['rg_user'] != '') {
	    $komponens = $db->query("select * from tbl_tarif where id='".$_POST['komponen']."'");
		$insert = $db->query("insert into tbl_modul_mcu (nama, kategori, dokter, rs, total, komponen, urutan, butuhdokter, keterangan, komponen_id) values ('".$_POST['nama']."', '".$_POST['kategori_komponen']."', '".$_POST['dokter']."', '".$_POST['rs']."', '".$_POST['total']."', '".$komponens[0]['nama_pelayanan']."', '".$_POST['urutan']."', '".$_POST['butuhdokter']."', '".$_POST['keterangan']."', '".$_POST['komponen']."')", 0);

		header("location:../../index.php?mod=mcu&submod=module");
	}
?>?>