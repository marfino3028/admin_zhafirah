<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$update = $db->query("update tbl_coa set nm_coa='".$_POST['nm_coa']."', kd_coa='".$_POST['kd_coa']."', ac_type ='".$_POST['ac_type ']."', post_tape='".$_POST['post_tape']."', group_coa='".$_POST['group_coa']."', parent_coa='".$_POST['parent_coa']."', sd_coa='".$_POST['sd_coa']."', tempo_coa='".$_POST['tempo_coa']."', note='".$_POST['note']."', unit='".$_POST['unit ']."', pl_coa='".$_POST['pl_coa']."', is_valid='".$_POST['is_valid']."', is_settlemen='".$_POST['is_settlemen']."', is_penunjang='".$_POST['is_penunjang']."', is_pettycash='".$_POST['is_pettycash']."', profit='".$_POST['profit']."', default_pos='".$_POST['default_pos']."' where md5(id)='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=coa");
?>


