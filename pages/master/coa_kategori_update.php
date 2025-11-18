<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		//$_POST['is_stock'] = 'TIDAK';
		$inventory = $db->query("select nm_coa from tbl_coa where kd_coa='".$_POST['id_inventory']."'");
		$inpatient = $db->query("select nm_coa from tbl_coa where kd_coa='".$_POST['id_inpatient']."'");
		$outpatient = $db->query("select nm_coa from tbl_coa where kd_coa='".$_POST['id_outpatient']."'");
		$cogs = $db->query("select nm_coa from tbl_coa where kd_coa='".$_POST['id_cogs']."'");
		$cogs_inpatient = $db->query("select nm_coa from tbl_coa where kd_coa='".$_POST['id_cogs_inpatient']."'");
		$cogs_inadjusment = $db->query("select nm_coa from tbl_coa where kd_coa='".$_POST['id_adjusment']."'");
		$cogs_ap_konsinyasi = $db->query("select nm_coa from tbl_coa where kd_coa='".$_POST['cogs_ap_konsinyasi']."'");
		$cogs_inpatient_konsinyasi = $db->query("select nm_coa from tbl_coa where kd_coa='".$_POST['cogs_inpatient_konsinyasi']."'");
		$cogs_outpatient_konsinyasi = $db->query("select nm_coa from tbl_coa where kd_coa='".$_POST['cogs_outpatient_konsinyasi']."'");
		$insert = $db->query("update tbl_coa_category set kategori='".$_POST['kategori']."', id_inventory_kode='".$_POST['id_inventory']."', id_inventory_nama='".$inventory[0]['nm_coa']."', id_inpatient_kode='".$_POST['id_inpatient']."', id_inpatient_nama='".$inpatient[0]['nm_coa']."', id_outpatient_kode='".$_POST['id_outpatient']."', id_outpatient_nama='".$outpatient[0]['nm_coa']."', id_cogs_kode='".$_POST['id_cogs']."', id_cogs_nama='".$cogs[0]['nm_coa']."', id_cogs_inpatient_kode='".$_POST['id_cogs_inpatient']."', id_cogs_inpatient_nama='".$cogs_inpatient[0]['nm_coa']."', id_cogs_inadjusment_kode='".$_POST['id_adjusment']."', id_cogs_inadjusment_nama='".$cogs_inadjusment[0]['nm_coa']."', cogs_ap_konsinyasi_kode='".$_POST['cogs_ap_konsinyasi']."', cogs_ap_konsinyasi_nama='".$cogs_ap_konsinyasi[0]['nm_coa']."', cogs_inpatient_konsinyasi_kode='".$_POST['cogs_inpatient_konsinyasi']."', cogs_inpatient_konsinyasi_nama='".$cogs_inpatient_konsinyasi[0]['nm_coa']."', cogs_outpatient_konsinyasi_kode='".$_POST['cogs_outpatient_konsinyasi']."', cogs_outpatient_konsinyasi_nama='".$cogs_outpatient_konsinyasi[0]['nm_coa']."', is_consignee='".$_POST['is_consignee']."', is_fixed_asset='".$_POST['is_fixed_asset']."', is_logistic='".$_POST['is_logistic']."', is_service='".$_POST['is_service']."', is_stock='".$_POST['is_stock']."', jenis_barang='".$_POST['jenis_barang']."' where md5(id)='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=coa_kategori");
?>