<?php
	session_start();
	include "../../3rdparty/engine.php";
	print_r($_POST);
	print_r($_SESSION);
	print_r($_FILES);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		if ($_FILES['dokumen']['name'] != "") {
			//print_r($_POST); 
			$path = $_FILES['dokumen']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$nama_file = 'DOK-RAD-'.date("dFYHis").'.'.$ext;
		}
		else {
			$nama_file = "";
		}
		
		//if ($ext == 'pdf' or $ext == 'PDF') {
			@copy($_FILES['dokumen']['tmp_name'], '../../dokumen/'.$nama_file);
			$data = $db->query("select * from tbl_rad where id='".$_POST['idRad']."'");
			//print_r($data);
			$insert = $db->query("insert into tbl_rad_dokumen (no_rad, nomr, nama, keterangan, dokumen, no_daftar) values ('".$data[0]['no_rad']."', '".$data[0]['nomr']."', '".$data[0]['nama']."', '".$_POST['keterangan']."', '$nama_file', '".$data[0]['no_daftar']."')", 0);
			$update = $db->query("update tbl_rad_dokumen set keterangan='".$_POST['keterangan']."' where no_rad='".$data[0]['no_rad']."'", 0);
    			header("location:../../index.php?mod=penunjang_medis&submod=rad_hasil_upload&id=".md5($_POST['idRad']));
		//}
		
	}
?>