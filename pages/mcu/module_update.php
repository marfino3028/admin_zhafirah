<?php
	session_start();
	include "../../3rdparty/engine.php";
	echo "<pre>";
	print_r($_POST);
	ini_set("display_errors", 0);
	date_default_timezone_set("Asia/Jakarta");
	
	if ($_SESSION['rg_user'] != '') {
	    	$komponens = $db->query("select * from tbl_tarif where id='".$_POST['komponen']."'");
		$insert = $db->query("update tbl_modul_mcu set nama='".$_POST['nama']."', kategori='".$_POST['kategori_komponen']."', dokter='".$_POST['dokter']."', rs='".$_POST['rs']."', total='".$_POST['total']."', komponen='".$komponens[0]['nama_pelayanan']."', komponen_id='".$_POST['komponen']."', urutan='".$_POST['urutan']."', butuhdokter='".$_POST['butuhdokter']."', keterangan='".$_POST['keterangan']."' where md5(id)='".$_POST['id']."'", 0);

		header("location:../../index.php?mod=mcu&submod=module");
	}
?>?>