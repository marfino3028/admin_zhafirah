<?php
	ini_set("display_errors", 1);
	session_start();
	include "../../3rdparty/engine.php";
	echo '<pre>';
	if ($_SESSION['rg_user'] != '') {
		if ($_FILES['dokumen']['name'] != "") {
			//print_r($_POST);
			$path = $_FILES['dokumen']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$ktp_file = 'Bayar_dokter-'.date("YmdHis").'.'.$ext;
			@copy($_FILES['dokumen']['tmp_name'], '../../dokumen/'.$ktp_file);
		}
		else {
			$ktp_file = "";
		}
		$data = $db->query("select * from tbl_bayar_dokter where md5(id)='".$_POST['id']."'", 0);
		$update = $db->query("update tbl_bayar_dokter set status_payment='SDH', tgl_paymen='".$_POST['tgl_paymen']."', nilai_paymen='".$_POST['nilai_paymen']."', bukti_paymen='$ktp_file', keterangan='".$_POST['keterangan']."' where md5(id)='".$_POST['id']."'", 0);
		//print_r($_POST);
		//print_r($_FILES);
		//print_r($data);
	}
	header("location:../../index.php?mod=keuangan&submod=jasa_dokter");
?>