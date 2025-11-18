<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data tindakan laboratorium
		$travel = $db->query("select * from tbl_travel_detail where md5(id)='".$_GET['id']."'");
		$travelID = $db->query("select * from tbl_travel where id='".$travel[0]['travel_id']."'");
		$delete = $db->query("delete from tbl_travel_detail where md5(id)='".$_GET['id']."'", 0);
	}
	header("location:../../index.php?mod=hd&submod=travel&id=".md5($travelID[0]['no_daftar']));
?>