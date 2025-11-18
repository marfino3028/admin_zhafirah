<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
      	$uangmuka = $db->queryItem("select no_um from tbl_um where md5(id)='".$_GET['id']."'");
		$delete = $db->query("delete from tbl_um where md5(id)='".$_GET['id']."'", 0);
		$id = $db->queryItem("select id from tbl_um where no_um='".$uangmuka."'");
      	if ($id == "") 
        	header("location:../../index.php?mod=kasir&submod=uangmuka");
      	else 
			header("location:../../index.php?mod=kasir&submod=input_um_tindakan&id=".md5($id));
	}
?>