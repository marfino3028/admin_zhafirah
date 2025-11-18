<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
      	echo '<pre>';
    	print_r($_POST);
    	if ($_FILES['dokumen_im']['name'] != "") {
			print_r($_POST);
			$path = $_FILES['dokumen_im']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$nama_file = 'Slider-'.date("d F Y H:i:s").'.'.$ext;
			@copy($_FILES['dokumen_im']['tmp_name'], '../../dokumen/'.$nama_file);
		}
		else {
			$nama_file = "";
		}
    	
	    
		$insert = $db->query("insert into tbl_image (image_name, status, dokumen_im) values ('".$_POST['image_name']."', '".$_POST['status']."', '$nama_file')");
	}
	header("location:../../index.php?mod=mobileapps&submod=slider");
?>