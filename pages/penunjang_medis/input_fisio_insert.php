<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		if ($_POST['idmr'] == "") {
			echo '<script language="javascript">alert("Silahkan Gunakan NoMR yang Lain"); back(-1);</script>';
		}
		else {
			$nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$_POST['nomr']."'");
			$insert = $db->query("insert into tbl_fisio (no_fisio, nomr, nama, tgl_input_fisio, total_harga_fisio, no_daftar) values ('".$_POST['no_resep']."', '".$_POST['nomr']."', '".$nama."', '".date("Y-m-d")."', '0', '".$_POST['nodaftar']."')", 0);
			$id = mysql_insert_id();
			header("location:../../index.php?mod=penunjang_medis&submod=input_fisio_tindakan&id=$id");
		}
	}
?>