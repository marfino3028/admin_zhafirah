<?php
session_start();
include "../../3rdparty/engine.php";
//print_r($_POST);
ini_set("display_errors", 0);

if ($_SESSION['rg_user'] != '') {
	date_default_timezone_set("Asia/Jakarta");
	$tgl = date('Y-m-d H:i:s');
	$nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='" . $_POST['id'] . "'");

	$kode1 = explode("#####", $_POST['diagnosa_sekunder1']);
	$kd1 = $kode1[1];
	$kd_nama1 = $kode1[0];

	$kode2 = explode("#####", $_POST['diagnosa_sekunder2']);
	$kd2 = $kode2[1];
	$kd_nama2 = $kode2[0];

	$kode3 = explode("#####", $_POST['diagnosa_sekunder3']);
	$kd3 = $kode3[1];
	$kd_nama3 = $kode3[0];

	$kode4 = explode("#####", $_POST['diagnosa_sekunder4']);
	$kd4 = $kode4[1];
	$kd_nama4 = $kode4[0];

	$kode5 = explode("#####", $_POST['as_diagnosis']);
	$kd5 = $kode5[1];
	$kd_nama5 = $kode5[0];

	$insert = $db->query("insert into  tbl_catatan_dktr (tgl_data, nomr, nama, cc_hpi, past_med_history, past_surgical_histort, alergi, other_subject, v_weight, v_height, v_bmi, v_bp, v_bpd, v_pr, v_rr, anamnesis, v_temp, pe_mata, pe_tht, pe_jantung, pe_paru, pe_abil, pe_eks, s_exam, observation, other_obj, as_diagnosis, as_problems, as_progres, other_as, plan_order, plan_advice, konsul_internal, order_ok, prescrip, other_plan, no_daftar, user_insert, user_shift, rujukan, insert_resume, icdcode_sekunder1, diagnosa_sekunder1, diagnosa_sekunder2, diagnosa_sekunder3, diagnosa_sekunder4, icdcode_sekunder2, icdcode_sekunder3, icdcode_sekunder4, as_diagnosis_kode) values ('" . date("Y-m-d") . "', '" . $_POST['id'] . "', '" . $nama . "', '" . $_POST['cc_hpi'] . "', '" . $_POST['past_med_history'] . "', '" . $_POST['past_surgical_histort'] . "', '" . $_POST['alergi'] . "', '" . $_POST['other_subject'] . "', '" . $_POST['v_weight'] . "', '" . $_POST['v_height'] . "', '" . $_POST['v_bmi'] . "', '" . $_POST['v_bp'] . "', '" . $_POST['v_bpd'] . "', '" . $_POST['v_pr'] . "', '" . $_POST['v_rr'] . "','" . $_POST['anamnesis'] . "', '" . $_POST['v_temp'] . "', '" . $_POST['pe_mata'] . "', '" . $_POST['pe_tht'] . "', '" . $_POST['pe_jantung'] . "', '" . $_POST['pe_paru'] . "', '" . $_POST['pe_abil'] . "', '" . $_POST['pe_eks'] . "', '" . $_POST['s_exam'] . "', '" . $_POST['observation'] . "', '" . $_POST['other_obj'] . "', '" . $kd_nama5 . "', '" . $_POST['as_problems'] . "', '" . $_POST['as_progres'] . "', '" . $_POST['other_as'] . "', '" . $_POST['plan_order'] . "', '" . $_POST['plan_advice'] . "', '" . $_POST['konsul_internal'] . "', '" . $_POST['order_ok'] . "', '" . $_POST['prescrip'] . "', '" . $_POST['other_plan'] . "', '" . $_POST['no_daftar'] . "', '" . $_SESSION['rg_user'] . "', '" . $_SESSION['rg_shift'] . "', '" . $_POST['rujukan'] . "', '$tgl', '" . $kd1 . "', '" . $kd_nama1 . "', '" . $kd_nama2 . "', '" . $kd_nama3 . "', '" . $kd_nama4 . "', '" . $kd2 . "', '" . $kd3 . "', '" . $kd4 . "', '" . $kd5 . "')", 0);
	//$id = mysql_insert_id();
	header("location:../../index.php?mod=dokter&submod=worklist");
}
