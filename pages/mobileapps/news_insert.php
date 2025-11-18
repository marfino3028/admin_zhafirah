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
    	
	    
		$insert = $db->query("insert into tbl_news (title_news, news, tgl_publish, status, dokumen) values ('".$_POST['title_news']."', '".$_POST['news']."', '".$_POST['tgl_publish']."', '".$_POST['status']."', '$nama_file')");
	}
	header("location:../../index.php?mod=mobileapps&submod=news");
?>