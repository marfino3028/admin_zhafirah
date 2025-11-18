<?php
	print_r($_POST);

	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);

	$t1 = explode("/", $_POST['mulai']);
	$tanggal = $t1[2].'-'.$t1[0].'-'.$t1[1];
	print_r($_POST);
	
	if ($_SESSION['rg_user'] != '') {
		$nomor = $db->queryItem("select max(nomor_bukti) from tbl_jurnal where kode_bukti='".$_POST['jenis_jurnal']."' and year(tanggal_transaksi)='".$t1[2]."' and month(tanggal_transaksi)='".$t1[0]."'");
		$no = $nomor + 1;
		
		if ($no < 10) $nom = '00'.$no;
		elseif ($no < 100 and $no >= 10) $nom = '0'.$no;
		if ($no < 1000 and $no >= 100) $nom = $no;
		
		$no_bukti = $_POST['jenis_jurnal'].'/'.$t1[0].'/'.substr($t1[2], 2, 2).'/'.$nom;
		//echo $no_bukti;
		
		//update data
		$data = $db->query("select * from tbl_jurnal where id='".$_POST['id']."'");
		if ($_POST['jenis_jurnal'] == $data[0]['kode_bukti']) {
			$no_bukti = $data[0]['no_jurnal'];
			$kode_bukti = $data[0]['kode_bukti'];
			$no_buktis = $data[0]['nomor_bukti'];
		}
		else {
			$no_bukti = $no_bukti;
			$kode_bukti = $_POST['jenis_jurnal'];
			$no_buktis = $no;
		}
		
		$update = $db->query("update tbl_jurnal set tanggal_update='".date("Y-m-d")."', no_jurnal='$no_bukti', deskripsi='".$_POST['deskripsi']."', kode='".$_POST['kode_akun']."', jenis_kode='D', kode_inv='".$_POST['mkode_akun']."', jenis_kode_inv='K', nilai='".$_POST['nilai']."', kode_bukti='$kode_bukti', nomor_bukti='$no_buktis' where id='".$_POST['id']."'");
		
		header("location:../../index.php?mod=keuangan&submod=jurnal_entri");
	}
?>