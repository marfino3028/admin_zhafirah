<?php
	session_start();
	include "../../3rdparty/engine.php";
	
		$delete = $db->query("DELETE FROM tbl_pelayanan_lainnya where Id = {$_GET['id']}", 0);
		header("location:../../index.php?mod=pelayanan_lain&submod=pelayanan_lain");
	
?>
