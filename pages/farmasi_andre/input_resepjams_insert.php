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
			$nama = $db->queryItem("select nm_pasien from tbl_pasien_jamsostek where id='".$_POST['idmr']."'");
			$insert = $db->query("insert into  tbl_resepjams (no_resep, nomr, nama, tgl_input, total_harga, no_daftar, diagnosa) values ('".$_POST['no_resep']."', '".$_POST['nomr']."', '".$nama."', '".date("Y-m-d")."', '0', '".$_POST['nodaftar']."', '".$_POST['diagnosa']."')", 0);
			$id = mysql_insert_id();
			header("location:../../index.php?mod=farmasi&submod=input_resepjams_obat&id=$id");
		}
	}
?>