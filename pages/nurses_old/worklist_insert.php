<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		$nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$_POST['id']."'");
		$insert = $db->query("insert into  tbl_catatan_dktr (tgl_data, nomr, nama, v_weight, v_height, v_bmi, v_bp, v_bpd, v_pr, v_rr, v_temp, lingkar_k, spo2, no_daftar, user_insert, user_shift, pain_l) values ('".date("Y-m-d")."', '".$_POST['id']."', '".$nama."', '".$_POST['v_weight']."', '".$_POST['v_height']."', '".$_POST['v_bmi']."', '".$_POST['v_bp']."', '".$_POST['v_bpd']."', '".$_POST['v_pr']."', '".$_POST['v_rr']."', '".$_POST['v_temp']."', '".$_POST['lingkar_k']."', '".$_POST['spo2']."', '".$_POST['no_daftar']."', '".$_SESSION['rg_user']."', '".$_SESSION['rg_shift']."', '".$_POST['pain_l']."')", 0);
		//$id = mysql_insert_id();
		header("location:../../index.php?mod=nurses&submod=worklist");

	}
?>