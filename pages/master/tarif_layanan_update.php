<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
	    $sub = $db->queryItem("select nm_gt from tbl_tarif_group where kd_gt='".$_POST['gttarif']."'");
	    $sub2 = $db->queryItem("select nama_poli from tbl_poli where kd_poli='".$_POST['poli']."'");
	    $_POST['tarif_min'] = $_POST['dokter'] + $_POST['sarana'] + $_POST['bhp'] + $_POST['perawat'];
		if ($_POST['tarif_min'] != "" and $_POST['tarif_max'] == "") $_POST['tarif_max'] = $_POST['tarif_min'];
		elseif ($_POST['tarif_max'] != "" and $_POST['tarif_min'] == "") $_POST['tarif_min'] = $_POST['tarif_max'];
		
		$update = $db->query("update tbl_tarif set tarif_min='".$_POST['tarif_min']."', tarif_max='".$_POST['tarif_max']."', harga_modal='".$_POST['harga_modal']."', satuan='".$_POST['satuan']."', normal='".$_POST['normal']."', kd_gt='".$_POST['gttarif']."', nm_gt ='".$sub."', kd_poli='".$_POST['poli']."', nama_poli ='".$sub2."', dokter='".$_POST['dokter']."', sarana='".$_POST['sarana']."', bhp='".$_POST['bhp']."', perawat='".$_POST['perawat']."' where id='".$_POST['id']."'", 0);
		
	}
	header("location:../../index.php?mod=master&submod=tarif_layanan");
?>