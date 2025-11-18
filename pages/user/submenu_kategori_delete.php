<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$hapus = $db->query("delete from tbl_kat_sub_menu where md5(id)='".$_GET['id']."'", 0);
		//print_r($_POST);
	}
	header("location:../../index.php?mod=user&submod=submenu_kategori");
?>
