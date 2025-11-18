<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
      	echo '<pre>';
    	print_r($_POST);
    	if ($_FILES['link_dokumen']['name'] != "") {
			print_r($_POST);
			$path = $_FILES['link_dokumen']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$nama_file = 'Manual-Book-'.date("dFYHis").'.'.$ext;
			@copy($_FILES['link_dokumen']['tmp_name'], '../../dokumen/'.$nama_file);
		}
		else {
			$nama_file = "";
		}
	    
		$insert = $db->query("insert into tbl_faq (header_faq, no, header2, isi_faq, link_dokumen, ini_membantu) values ('".$_POST['header_faq']."', '".$_POST['no']."', '".$_POST['header2']."', '".$_POST['isi_faq']."', '$nama_file', '".$_POST['ini_membantu']."')");
	}
	header("location:../../index.php?mod=mobileapps&submod=faq");
?>