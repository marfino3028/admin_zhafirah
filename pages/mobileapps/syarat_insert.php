<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
      	//echo '<pre>';
    	//print_r($_POST);    	
	    
		$insert = $db->query("insert into tbl_syarat (no, content) values ('".$_POST['no']."', '".$_POST['content']."')");
	}
	header("location:../../index.php?mod=mobileapps&submod=syarat");
?>