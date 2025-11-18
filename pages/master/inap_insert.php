<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select kode, nama from tbl_kelas where id='".$_POST['kategori']."'");
      	$insert = $db->query("insert into tbl_kelas_ruang (kelas_id, kelas_nama, nama) values ('".$_POST['kategori']."', '".$data[0]['nama']."', '".$_POST['nama']."')", 0);
	}
	header("location:../../index.php?mod=master&submod=inap");
?>