<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
	    $sub = $db->queryItem("select nm_gt from tbl_tarif_group where kd_gt='".$_POST['gttarif']."'");
	    $coa_piutang = $db->query("select nm_coa from tbl_coa where kd_coa='".$_POST['piutang_kd_coa']."'");
	    $coa_pendapatan = $db->query("select nm_coa from tbl_coa where kd_coa='".$_POST['pendapatan_kd_coa']."'");
		$update = $db->query("update tbl_perusahaan set 
		nama_perusahaan='".$_POST['nama_perusahaan']."', 
		kode_perusahaan='".$_POST['kode_perusahaan']."', 
		alamat_perusahaan='".$_POST['alamat_perusahaan']."',
		kota='".$_POST['kota']."', 
		telp='".$_POST['telp']."', 
		kd_pos='".$_POST['kd_pos']."', 
		fax='".$_POST['fax']."',
		kd_gt ='".$_POST['gttarif']."', 
		nm_gt ='".$sub."',
		group_aim ='".$_POST['aim']."',
		link_map ='".$_POST['link_map']."',
		bank_name ='".$_POST['bank_name']."',
		norek_provider ='".$_POST['norek_provider']."',
		bank_cab ='".$_POST['bank_cab']."',
		rek_nama ='".$_POST['rek_nama']."',
		pic_contact ='".$_POST['pic_contact']."',
		no_ijin ='".$_POST['no_ijin']."',
		piutang_kd_coa ='".$_POST['piutang_kd_coa']."',
		piutang_nm_coa ='".$coa_piutang[0]['nm_coa']."',
		pendapatan_kd_coa ='".$_POST['pendapatan_kd_coa']."',
		pendapatan_nm_coa ='".$coa_pendapatan[0]['nm_coa']."',
		harga_up='".$_POST['harga_up']."' where id='".$_POST['id']."'", 0);
	}
	header("location:../../index.php?mod=master&submod=perusahaan");
?>