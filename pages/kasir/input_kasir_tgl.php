<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {

		$data = $db->query("select * from tbl_kasir where id='".$_POST['idNya']."'");
		$t1 = explode("/", $_POST['mulai']);
		$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1];
		$tgl_insert = $date1.' 08'.date(":i:s");

		$update_header = $db->query("update tbl_kasir set tgl_insert='$tgl_insert' where id='".$_POST['idNya']."'");
		$update_detail = $db->query("update tbl_kasir_detail set tgl_insert='$tgl_insert' where no_kwitansi='".$_POST['no_kwitansi']."'", 0);
		
		//update jurnal pendapatan
		$nomor = $db->queryItem("select max(nomor_bukti) from tbl_jurnal_otm where kode_bukti='KK' and year(tanggal_transaksi)='".$t1[2]."' and month(tanggal_transaksi)='".$t1[0]."'");
		$no = $nomor + 1;
		
		if ($no < 10) $nom = '00'.$no;
		elseif ($no < 100 and $no >= 10) $nom = '0'.$no;
		if ($no < 1000 and $no >= 100) $nom = $no;
		
		$no_bukti = 'KK/'.$t1[0].'/'.substr($t1[2], 2, 2).'/'.$nom;
		$update = $db->query("update tbl_jurnal_otm set tanggal_transaksi='$date1', tanggal_update='$date1', no_jurnal='$no_bukti', nomor_bukti='$no' where no_kwitansi='".$_POST['no_kwitansi']."'");
		
		header("location:../../index.php?mod=kasir&submod=EditTanggal");
	}
?>