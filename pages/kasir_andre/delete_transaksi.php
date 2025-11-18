<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$no_kw = $db->queryItem("select no_kwitansi from tbl_kasir where id='".$_GET['id']."'");
		$no_daftar = $db->queryItem("select no_daftar from tbl_kasir where id='".$_GET['id']."'");
		$delete = $db->query("delete from tbl_kasir where id='".$_GET['id']."'", 0);
		$delete = $db->query("delete from tbl_kasir_detail where no_kwitansi='".$no_kw."'", 0);
		$update = $db->query("update tbl_pendaftaran set status_pasien='OPEN' where no_daftar='$no_daftar'", 0);
		$delete_jurnal = $db->query("delete from tbl_jurnal_otm where no_kwitansi='".$no_kw."'");
		header("location:../../index.php?mod=kasir&submod=inputKasir");
	}
?>