<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		if ($_POST['subkategoriID'] == "") $_POST['subkategoriID'] = 0;
		$insert = $db->query("insert into tbl_kat_sub_menu (kategori_id, nm_ka_menu, ket_kategori) values ('".$_POST['kategori']."', '".$_POST['nama']."', '".$_POST['keterangan']."')", 0);
		//print_r($_POST);
	}
	header("location:../../index.php?mod=user&submod=submenu_kategori");
?>