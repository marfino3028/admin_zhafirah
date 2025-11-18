<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_penerimaan_detail where md5(id)='".$_GET['id']."'", 0);
		$delete = $db->query("delete from tbl_penerimaan_detail where md5(id)='".$_GET['id']."'");
		$jumlah = $db->query("select sum(qty) jumlah from tbl_penerimaan_detail where penerimaan_id='".$data[0]['penerimaan_id']."'");
		$update = $db->query("update tbl_penerimaan set jml_obat='".$jumlah[0]['jumlah']."' where id='".$data[0]['penerimaan_id']."'");
		header("location:../../index.php?mod=inv&submod=penerimaan_obat_input_detail&id=".md5($data[0]['penerimaan_id']));
		//print_r($jumlah);
	}
?>