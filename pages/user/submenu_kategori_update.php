<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		if ($_POST['subkategoriID'] == "") $_POST['subkategoriID'] = 0;
		$update = $db->query("update tbl_kat_sub_menu set kategori_id='".$_POST['kategori']."', nm_ka_menu='".$_POST['nama']."', ket_kategori='".$_POST['keterangan']."' where md5(id)='".$_POST['id']."'", 0);
		//print_r($_POST);
	}
	header("location:../../index.php?mod=user&submod=submenu_kategori");
?>
