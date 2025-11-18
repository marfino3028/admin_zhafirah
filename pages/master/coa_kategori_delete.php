<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$delete = $db->query("delete from tbl_coa_category where md5(id)='".$_GET['id']."'");
	}
	header("location:../../index.php?mod=master&submod=coa_kategori");
?>