<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);

	
	if ($_SESSION['rg_user'] != '') {
		
		if ($_POST['nama_pasien'] == "") {
			echo '<script language="javascript">alert("Silahkan masukan Nama Pasien!"); back(-1);</script>';
		}
		else {
			$TanggalLahir = date("Y-m-d", strtotime($_POST['tgl_lahir']));
			$perusahaan = $db->queryItem("select nama_perusahaan from tbl_perusahaan where id='".$_POST['kode_perusahaan']."'");
			$perusahaan_kode = $db->queryItem("select kode_perusahaan from tbl_perusahaan where id='".$_POST['kode_perusahaan']."'");
			$insert = $db->query("insert into  tbl_pelayanan_lainnya (NamaPasien, TanggalLahir, 
			Total, CreatedDate, CreatedBy, UpdatedDate, UpdatedBy, kode_perusahaan, nama_perusahaan) values ('".$_POST['nama_pasien']."', '".$TanggalLahir."', 0, CURRENT_DATE, CURRENT_DATE, CURRENT_DATE, '', '".$perusahaan_kode."', '".$perusahaan."')", 0);
			$id = mysql_insert_id();
			header("location:../../index.php?mod=pelayanan_lain&submod=pelayanan_lain_input_tindakan&id=$id");
			//header("location:../../index.php?mod=pelayanan_lain&submod=pelayanan_lain&id=$id");
		}
	}else{
		echo '<script language="javascript">alert("Not authorized !!"); back(-1);</script>';

		}
?>
