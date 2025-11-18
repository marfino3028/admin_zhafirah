<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_coa (nm_coa, kd_coa, ac_type, post_tape, group_coa, parent_coa, sd_coa, tempo_coa, note, unit, pl_coa, is_valid, is_settlemen, is_penunjang, is_pettycash, profit, default_pos) values ('".$_POST['nm_coa']."', '".$_POST['kd_coa']."', '".$_POST['ac_type']."', '".$_POST['post_tape']."', '".$_POST['group_coa']."', '".$_POST['parent_coa']."', '".$_POST['sd_coa']."', '".$_POST['tempo_coa']."', '".$_POST['note']."', '".$_POST['unit']."', '".$_POST['pl_coa']."', '".$_POST['is_valid']."', '".$_POST['is_settlemen']."', '".$_POST['is_penunjang']."', '".$_POST['is_pettycash']."', '".$_POST['profit']."', '".$_POST['default_pos']."' )", 0);
	}
	header("location:../../index.php?mod=master&submod=coa");
?>