<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	$jml = $db->queryItem("select count(id) from tbl_ro_detail where no_ro='".$_POST['no_ro']."'", 0);
	$jml = $jml - 1;

	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$nama_vendor = $db->queryItem("select nama_vendor from tbl_vendor where kode_vendor='".$_POST['vendor']."'");
		$nama_suplier = $db->queryItem("select nama_suplier from tbl_suplier where kode_suplier='".$_POST['suplier']."'");
		$insert = $db->query("update tbl_po set kode_vendor='".$_POST['vendor']."', nama_vendor='$nama_vendor', kode_suplier='".$_POST['suplier']."', nama_suplier='$nama_suplier' where no_po='".$_POST['no_po']."' and no_ro='".$_POST['no_ro']."'", 0);
		
		for ($i = 0; $i <= $jml; $i++) {
			//echo $_POST['qty'][$i];
			$_POST['harga'][$i] = str_replace(',', '', $_POST['harga'][$i]);
			$_POST['harga'][$i] = str_replace('.', '', $_POST['harga'][$i]);
			$_POST['qty'][$i] = str_replace(',', '', $_POST['qty'][$i]);
			$_POST['qty'][$i] = str_replace('.', '', $_POST['qty'][$i]);
			$update = $db->query("update tbl_ro_detail set qty_po='".$_POST['qty'][$i]."', harga_po='".$_POST['harga'][$i]."' where id='".$_POST['id'][$i]."'");
			$jml_po = $jml_po + $_POST['qty'][$i];
		}
		
		$update = $db->query("update tbl_ro set status_po='PROSES' where no_ro='".$_POST['no_ro']."'", 0);
		$update = $db->query("update tbl_po set total_po='$jml_po' where no_po='".$_POST['no_po']."' and no_ro='".$_POST['no_ro']."'", 0);
		
		header("location:../../index.php?mod=inv&submod=po");
	}
?>