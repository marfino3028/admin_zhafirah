<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_kiosk_antrian where nomor='".$_POST['no_wa']."' and status_antri='BUAT'", 0);
		$insert = $db->query("insert into tbl_kiosk_kedatangan (no_wa, antrian_id) values ('".$data[0]['no_wa']."', '".$data[0]['id']."' )", 0);
	}
	header("location:../../index.php?mod=qrcode&submod=kedatangan");
?>