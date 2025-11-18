<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		$update = $db->query("update tbl_kasir set penjamin='".$_POST['terima']."', untuk_pembayaran='".$_POST['untuk']."' where no_kwitansi='".$_POST['id']."'", 0);
		$id = $_POST['id'];
		header("location:print_kwitansi_pembayaran.php?id=$id");
	}
?>