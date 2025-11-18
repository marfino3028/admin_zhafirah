<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	date_default_timezone_set('Asia/Jakarta');
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_pasien_mutasi where md5(id)='".$_GET['id']."'");
		$update = $db->query("update tbl_pasien set rujukan='".$data[0]['rujukan_mutasi']."', type_pasien='".$data[0]['type_pasian_mutasi']."' where nomr='".$data[0]['nomr']."'");
		$update = $db->query("update tbl_pasien_mutasi set status_mutasi='SDH' where md5(id)='".$_GET['id']."'");
	}
	header("location:../../index.php?mod=master&submod=pasien");
?>