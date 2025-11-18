<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		if ($_POST['idmr'] == "") {
			echo '<script language="javascript">alert("Silahkan Gunakan NoMR Karyawan yang Lain"); back(-1);</script>';
		}
		else {
			$data = $db->query("select * from tbl_karyawan where nomr_karyawan='".$_POST['nomr']."'");
			$insert = $db->query("insert into tbl_polkar (no_polkar, nomr, nama, tgl_input_polkar, total_harga_polkar, no_daftar, user_insert, user_shift) values ('".$_POST['no_resep']."', '".$_POST['nomr']."', '".$data[0]['nm_karyawan']."', '".date("Y-m-d")."', '0', '".$_POST['nodaftar']."', '".$_SESSION['rg_user']."', '".$_SESSION['rg_shift']."')", 0);
			$id = mysql_insert_id();
			header("location:../../index.php?mod=poli&submod=input_polkar_tindakan&id=$id");
		}
	}
?>