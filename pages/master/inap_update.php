<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select kode, nama from tbl_kelas where id='".$_POST['kategori']."'");
      	$insert = $db->query("update tbl_kelas_ruang set kelas_id='".$_POST['kategori']."', kelas_nama='".$data[0]['nama']."', nama='".$_POST['nama']."' where md5(id)='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=inap");
?>