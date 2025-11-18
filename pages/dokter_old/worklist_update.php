<?php
session_start();
include "../../3rdparty/engine.php";
//print_r($_POST);
ini_set("display_errors", 0);

if ($_SESSION['rg_user'] != '') {
	date_default_timezone_set("Asia/Jakarta");
	$tgl = date('Y-m-d H:i:s');
	$nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='" . $_POST['id'] . "'");
	$insert = $db->query("update tbl_catatan_dktr set cc_hpi='" . $_POST['cc_hpi'] . "', past_med_history='" . $_POST['past_med_history'] . "', past_surgical_histort='" . $_POST['past_surgical_histort'] . "', alergi='" . $_POST['alergi'] . "', other_subject='" . $_POST['other_subject'] . "', v_weight='" . $_POST['v_weight'] . "', v_height='" . $_POST['v_height'] . "', v_bmi='" . $_POST['v_bmi'] . "', v_bp='" . $_POST['v_bp'] . "', v_pr='" . $_POST['v_pr'] . "', v_rr='" . $_POST['v_rr'] . "', v_temp='" . $_POST['v_temp'] . "', pe_mata='" . $_POST['pe_mata'] . "', pe_tht='" . $_POST['pe_tht'] . "', pe_jantung='" . $_POST['pe_jantung'] . "', pe_paru='" . $_POST['pe_paru'] . "', pe_abil='" . $_POST['pe_abil'] . "', pe_eks='" . $_POST['pe_eks'] . "', s_exam='" . $_POST['s_exam'] . "', observation='" . $_POST['observation'] . "', other_obj='" . $_POST['other_obj'] . "', as_diagnosis='" . $_POST['as_diagnosis'] . "', as_problems='" . $_POST['as_problems'] . "', as_progres='" . $_POST['as_progres'] . "', other_as='" . $_POST['other_as'] . "', plan_order='" . $_POST['plan_order'] . "', plan_advice='" . $_POST['plan_advice'] . "', konsul_internal='" . $_POST['konsul_internal'] . "', order_ok='" . $_POST['order_ok'] . "', prescrip='" . $_POST['prescrip'] . "', other_plan='" . $_POST['other_plan'] . "', rujukan='" . $_POST['rujukan'] . "', update_resume='$tgl' where nomr='" . $_POST['id'] . "' and no_daftar='" . $_POST['no_daftar'] . "'", 0);
	$id = mysql_insert_id();
	header("location:../../index.php?mod=dokter&submod=worklist");
}
