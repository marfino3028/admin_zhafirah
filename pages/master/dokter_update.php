<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
   	echo '<pre>';
    	print_r($_POST);
    	if ($_FILES['dokumen']['name'] != "") {
			print_r($_POST);
			$path = $_FILES['dokumen']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$nama_file = 'News-Image-'.date("d F Y H:i:s").'.'.$ext;
			@copy($_FILES['dokumen']['tmp_name'], '../../dokumen/'.$nama_file);
		}
		else {
			$nama_file = "";
		}
		
		if ($_POST['tgl_lahir'] == '0000-00-00') $_POST['tgl_lahir'] = "NULL";
		if ($_POST['tgl_sip'] == '0000-00-00') $_POST['tgl_sip'] = "NULL";
		if ($_POST['tgl_str'] == '0000-00-00') $_POST['tgl_str'] = "NULL";
		if ($_POST['tgl_kre'] == '0000-00-00') $_POST['tgl_kre'] = "NULL";
		$update = $db->query("update tbl_dokter set nama_dokter='".$_POST['nama_dokter']."', kode_dokter='".$_POST['kode_dokter']."', tarif_dokter='".$_POST['tarif_dokter']."',spesialis ='".$_POST['spesialis']."',kd_poli ='".$_POST['kd_poli']."',npwp ='".$_POST['npwp']."',noktp ='".$_POST['noktp']."',tmpt_lahir ='".$_POST['tmpt_lahir']."',tgl_lahir ='".$_POST['tgl_lahir']."',jk ='".$_POST['jk']."',dokumen ='$nama_file',no_sip ='".$_POST['no_sip']."',tgl_sip ='".$_POST['tgl_sip']."',no_str ='".$_POST['no_str']."',tgl_str ='".$_POST['tgl_str']."',no_kre ='".$_POST['no_kre']."',tgl_kre ='".$_POST['tgl_kre']."',bank ='".$_POST['bank']."',bank_c ='".$_POST['bank_c']."',bank_an ='".$_POST['bank_an']."',norek ='".$_POST['norek']."', professional_fee='".$_POST['professional_fee']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=dokter");
?>