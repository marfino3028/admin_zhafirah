<?php
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	
	$delete = $db->query("delete from tbl_invoice where id='".$_GET['id']."'");
	$delete = $db->query("delete from tbl_invoice_detail where invoiceID='".$_GET['id']."'");
	
	//$update = $db->query("update tbl_kasir set status_inv='BLM' where id='".$_GET['id']."'");
	
	header("location:../../index.php?mod=piutang&submod=invoice");
?>