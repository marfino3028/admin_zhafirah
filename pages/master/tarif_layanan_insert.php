<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
	    $sub = $db->queryItem("select nm_gt from tbl_tarif_group where kd_gt='".$_POST['gttarif']."'");
	    $sub2 = $db->queryItem("select nama_poli from tbl_poli where kd_poli='".$_POST['poli']."'");
		if ($_POST['tarif_min'] != "" and $_POST['tarif_max'] == "") $_POST['tarif_max'] = $_POST['tarif_min'];
		elseif ($_POST['tarif_max'] != "" and $_POST['tarif_min'] == "") $_POST['tarif_min'] = $_POST['tarif_max'];
		$insert = $db->query("insert into tbl_tarif (kode_jns_tarif, kode_kat_pelayanan, kode_tarif, nama_pelayanan, tarif_min, tarif_max, harga_modal, satuan, normal, kd_gt, nm_gt, kd_poli, nama_poli) values ('".$_POST['jenis_layanan']."', '".$_POST['kat_layanan']."', '".$_POST['kode_tarif']."', '".$_POST['nama_pelayanan']."', '".$_POST['tarif_min']."', '".$_POST['tarif_max']."', '".$_POST['harga_modal']."', '".$_POST['satuan']."', '".$_POST['normal']."','".$_POST['gttarif']."', '".$sub."','".$_POST['poli']."', '".$sub2."')");
	}
	header("location:../../index.php?mod=master&submod=tarif_layanan");
?>