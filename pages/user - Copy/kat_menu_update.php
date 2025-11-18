<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_kat_menu set nm_ka_menu='".$_POST['nm_ka_menu']."', ket_kategori='".$_POST['ket_kategori']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=user&submod=kat_menu");
?>