<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		if ($_POST['subkategoriID'] == "") $_POST['subkategoriID'] = 0;
		$insert = $db->query("insert into tbl_menu (kategori_id, nama_menu, link, keterangan, kategori_sub_id) values ('".$_POST['kategori']."', '".$_POST['nama_menu']."', '".$_POST['link']."', '".$_POST['ket_kategori']."', '".$_POST['subkategoriID']."')", 0);
		//print_r($_POST);
	}
	header("location:../../index.php?mod=user&submod=menu");
?>