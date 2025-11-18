<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		//$delete = $db->query("delete from tbl_perjanjian where md5(id)='".$_GET['id']."'", 0);
		$delete = $db->query("update tbl_perjanjian set status_pasien='CANCLE' where md5(id)='".$_GET['id']."'", 0);
	}
	header("location:../../index.php?mod=pendaftaran&submod=appt");
?>