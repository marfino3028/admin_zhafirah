<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
      	echo '<pre>';
    	print_r($_POST);
    	if ($_FILES['dokumen_ch']['name'] != "") {
			print_r($_POST);
			$path = $_FILES['dokumen_ch']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$nama_file = 'News-Image-'.date("d F Y H:i:s").'.'.$ext;
			@copy($_FILES['dokumen_ch']['tmp_name'], '../../dokumen/'.$nama_file);
		}
		else {
			$nama_file = "";
		}
    	
	    
		$insert = $db->query("insert into tbl_charity (title_charity, charity, tgl_publish, status, donasi, dokumen_ch) values ('".$_POST['title_charity']."', '".$_POST['charity']."', '".$_POST['tgl_publish']."', '".$_POST['status']."', '".$_POST['donasi']."', '$nama_file')");
	}
	header("location:../../index.php?mod=mobileapps&submod=charity");
?>