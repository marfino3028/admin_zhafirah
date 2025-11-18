<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_kat_sub_menu (kategori_id, nm_ka_menu, ket_kategori) values ('".$_POST['kategori']."', '".$_POST['nm_ka_menu']."', '".$_POST['ket_kategori']."')", 0);
	}
	header("location:../../index.php?mod=user&submod=kat_menu_sub");
?>