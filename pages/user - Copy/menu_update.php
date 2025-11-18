<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_menu set kategori_id='".$_POST['kategori']."', nama_menu='".$_POST['nama_menu']."', link='".$_POST['link']."', keterangan='".$_POST['ket_kategori']."' where id='".$_POST['id']."'", 0);
		//print_r($_POST);
	}
	header("location:../../index.php?mod=user&submod=menu");
?>