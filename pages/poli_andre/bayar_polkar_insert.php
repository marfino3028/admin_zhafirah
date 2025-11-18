<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	if ($_SESSION['rg_user'] != '') {
		$t1 = explode("/", $_POST['tgl_bayar']);
		$tanggal = $t1[2].'-'.$t1[0].'-'.$t1[1];
		$update = $db->query("update tbl_polkar set status_bayar='CASH', tgl_bayar='".date("Y-m-d")."' where no_polkar='".$_POST['no_polkar']."'", 1);
		
		$data = $db->query("select * from tbl_polkar where no_polkar='".$_POST['no_polkar']."'");
		$deskripsi = $data[0]['nama'].' / '.$data[0]['no_polkar'];
		$coa = $db->query("select kd_coa, nm_coa from tbl_coa where id='1'", 0);
		$coa2 = $db->query("select kd_coa, nm_coa from tbl_coa where id='190'", 0);
		
		$nomor = $db->queryItem("select max(nomor_bukti) from tbl_jurnal_otm where kode_bukti='KK' and year(tanggal_transaksi)='".date("Y")."' and month(tanggal_transaksi)='".date("m")."'");
		$no = $nomor + 1;
		
		if ($no < 10) $nom = '00'.$no;
		elseif ($no < 100 and $no >= 10) $nom = '0'.$no;
		if ($no < 1000 and $no >= 100) $nom = $no;
		
		$no_bukti = 'KK/'.date("m").'/'.date("y").'/'.$nom;
		$admnr = $db->queryItem("select total_harga_polkar from tbl_polkar where no_polkar='".$_POST['no_polkar']."'", 0);
		$insert = $db->query("insert into tbl_jurnal_otm (no_kwitansi, tanggal_transaksi, no_jurnal, deskripsi, kode, jenis_kode, kode_inv, jenis_kode_inv, nilai, kode_bukti, nomor_bukti) values ('".$data[0]['no_polkar']."', '".date("Y-m-d")."', '$no_bukti', '$deskripsi', '".$coa[0]['kd_coa']."', 'D', '".$coa2[0]['kd_coa']."', 'K', '$admnr', 'KK', '$no')");
	}
	header("location:../../index.php?mod=poli&submod=karyawan");
?>