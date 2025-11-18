<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		$nomr = $db->queryItem("select nomr from tbl_pasien where md5(nomr)='".$_POST['id']."'", 0);
		$nodaftar = $db->queryItem("select no_daftar from tbl_pendaftaran where md5(no_daftar)='".$_POST['no_daftar']."'", 0);
		$nama = $db->queryItem("select nm_pasien from tbl_pasien where md5(nomr)='".$_POST['id']."'", 0);
		$insert = $db->query("insert into  tbl_catatan_dktr (tgl_data, nomr, nama, cc_hpi, past_med_history, past_surgical_histort, alergi, other_subject, v_weight, v_height, v_bmi, v_bp, v_pr, v_rr, v_temp, pe_mata, pe_tht, pe_jantung, pe_paru, pe_abil, pe_eks, s_exam, observation, other_obj, as_diagnosis, as_problems, as_progres, other_as, plan_order, plan_advice, konsul_internal, order_ok, prescrip, other_plan, no_daftar, user_insert, user_shift, rujukan) values ('".$_POST['tgl']."', '".$nomr."', '".$nama."', '".$_POST['cc_hpi']."', '".$_POST['past_med_history']."', '".$_POST['past_surgical_histort']."', '".$_POST['alergi']."', '".$_POST['other_subject']."', '".$_POST['v_weight']."', '".$_POST['v_height']."', '".$_POST['v_bmi']."', '".$_POST['v_bp']."', '".$_POST['v_pr']."', '".$_POST['v_rr']."', '".$_POST['v_temp']."', '".$_POST['pe_mata']."', '".$_POST['pe_tht']."', '".$_POST['pe_jantung']."', '".$_POST['pe_paru']."', '".$_POST['pe_abil']."', '".$_POST['pe_eks']."', '".$_POST['s_exam']."', '".$_POST['observation']."', '".$_POST['other_obj']."', '".$_POST['as_diagnosis']."', '".$_POST['as_problems']."', '".$_POST['as_progres']."', '".$_POST['other_as']."', '".$_POST['plan_order']."', '".$_POST['plan_advice']."', '".$_POST['konsul_internal']."', '".$_POST['order_ok']."', '".$_POST['prescrip']."', '".$_POST['other_plan']."', '".$nodaftar."', '".$_SESSION['rg_user']."', '".$_SESSION['rg_shift']."', '".$_POST['rujukan']."')", 0);
		//$id = mysql_insert_id();
		header("location:../../index.php?mod=ranap&submod=worklist&id=".$nomr."&ids=".$nodaftar);
	}
?>