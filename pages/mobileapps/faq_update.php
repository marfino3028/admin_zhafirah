<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
      		$datafaq = $db->query("select * from tbl_faq where md5(id)='".$_POST['id']."'");

    		if ($_FILES['link_dokumen']['name'] != "") {
			$path = $_FILES['link_dokumen']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$nama_file = 'Manual-Book-'.date("dFYHis").'.'.$ext;
			@copy($_FILES['link_dokumen']['tmp_name'], '../../dokumen/'.$nama_file);
		}
		else {
			$nama_file = $datafaq[0]['link_dokumen'];
		}
	    
		$update = $db->query("update tbl_faq set header_faq='".$_POST['header_faq']."', no='".$_POST['no']."', header2='".$_POST['header2']."', isi_faq='".$_POST['isi_faq']."', link_dokumen='$nama_file', ini_membantu='".$_POST['ini_membantu']."' where md5(id)='".$_POST['id']."'");
	}
	header("location:../../index.php?mod=mobileapps&submod=faq");
?>