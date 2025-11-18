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
		$insert = $db->query("insert into tbl_coa_category (kategori, id_inventory_kode, id_inventory_nama, id_inpatient_kode, id_inpatient_nama, id_outpatient_kode, id_outpatient_nama, id_cogs_kode, id_cogs_nama, id_cogs_inpatient_kode, id_cogs_inpatient_nama, id_cogs_inadjusment_kode, id_cogs_inadjusment_nama, cogs_ap_konsinyasi_kode, cogs_ap_konsinyasi_nama, cogs_inpatient_konsinyasi_kode, cogs_inpatient_konsinyasi_nama, cogs_outpatient_konsinyasi_kode, cogs_outpatient_konsinyasi_nama, is_consignee, is_fixed_asset, is_logistic, is_service, is_stock, jenis_barang) values ('".$_POST['kategori']."', '".$_POST['id_inventory']."', '".$inventory[0]['nm_coa']."', '".$_POST['id_inpatient']."', '".$inpatient[0]['nm_coa']."', '".$_POST['id_outpatient']."', '".$outpatient[0]['nm_coa']."', '".$_POST['id_cogs']."', '".$cogs[0]['nm_coa']."', '".$_POST['id_cogs_inpatient']."', '".$cogs_inpatient[0]['nm_coa']."', '".$_POST['id_adjusment']."', '".$cogs_inadjusment[0]['nm_coa']."', '".$_POST['cogs_ap_konsinyasi']."', '".$cogs_ap_konsinyasi[0]['nm_coa']."', '".$_POST['cogs_inpatient_konsinyasi']."', '".$cogs_inpatient_konsinyasi[0]['nm_coa']."', '".$_POST['cogs_outpatient_konsinyasi']."', '".$cogs_outpatient_konsinyasi[0]['nm_coa']."', '".$_POST['is_consignee']."', '".$_POST['is_fixed_asset']."', '".$_POST['is_logistic']."', '".$_POST['is_service']."', '".$_POST['is_stock']."', '".$_POST['jenis_barang']."' )", 0);
	}
	header("location:../../index.php?mod=master&submod=coa_kategori");
?>