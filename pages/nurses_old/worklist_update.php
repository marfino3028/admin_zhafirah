<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		$nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$_POST['id']."'");
		$insert = $db->query("update tbl_catatan_dktr set v_weight='".$_POST['v_weight']."', v_height='".$_POST['v_height']."', v_bmi='".$_POST['v_bmi']."', v_bp='".$_POST['v_bp']."', v_bpd='".$_POST['v_bpd']."', v_pr='".$_POST['v_pr']."', v_rr='".$_POST['v_rr']."', v_temp='".$_POST['v_temp']."', lingkar_k='".$_POST['lingkar_k']."', spo2='".$_POST['spo2']."', pain_l='".$_POST['pain_l']."' where nomr='".$_POST['id']."' and no_daftar='".$_POST['no_daftar']."'", 0);
		header("location:../../index.php?mod=nurses&submod=worklist");
		
	}
?>