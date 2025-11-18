<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_pendaftaran where id='".$_GET['id']."'", 0);
		$delete = $db->query("update  tbl_pendaftaran set status_pasien='CANCEL' where id='".$_GET['id']."'", 0);

		//menghapus semua jurnal yang masuk karena dibatalkan
		$delete_jurnal = $db->query("delete from tbl_jurnal where deskripsi like '%".$data[0]['no_daftar']."%' or keterangan like '%".$data[0]['no_daftar']."%'", 0);
	}
	header("location:../../index.php?mod=pendaftaran&submod=index");
?>