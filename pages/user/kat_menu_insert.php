<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_kat_menu (nm_ka_menu, ket_kategori) values ('".$_POST['nm_ka_menu']."', '".$_POST['ket_kategori']."')", 0);
		$id = mysql_insert_id();
		$update = $db->query("update tbl_kat_menu set kategori_id='$id' where id='$id'");
	}
	header("location:../../index.php?mod=user&submod=kat_menu");
?>