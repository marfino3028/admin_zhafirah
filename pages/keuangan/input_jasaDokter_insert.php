<?php
	ini_set("display_errors", 1);
	session_start();
	include "../../3rdparty/engine.php";
	echo '<pre>';
	if ($_SESSION['rg_user'] != '') {
		//masukkan ke tabel header tbl_bayar_dakter
		$t1 = explode("/", $_POST['mulai']);
		$t2 = explode("/", $_POST['selesai']);
		$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1];
		$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
		$dokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$_POST['kode_dokter']."'");
echo $dokter;
        if (!is_int($_POST['biaya_jaga'])) $_POST['biaya_jaga'] = 0;
		if ($_POST['totPajak']=="") $_POST['totPajak'] = 0;
		if ($_POST['npwp'] < 0) $_POST['npwp'] = 0;
		$insert = $db->query("insert into tbl_bayar_dokter (no_bayar, kode_dokter, nama_dokter, tgl_start, tgl_end, total_kotor, biaya_jaga, total_jasa, pajak, npwp, total_pajak, total_pendapatan, nrhri_jaga) values ('".$_POST['no_bayar']."', '".$_POST['kode_dokter']."', '".$dokter."', '".$date1."', '".$date2."', '".$_POST['total_kotor']."', '".$_POST['biaya_jaga']."', '".$_POST['totJasa']."', '".$_POST['pajak']."', '".$_POST['npwp']."', '".$_POST['totPajak']."', '".$_POST['totalAll']."', '".$_POST['hari_jaga']."' )", 0);
		$id = mysql_insert_id();
		//input ke detail
		for ($i = 1; $i <= $_POST['jml_data']; $i++) {
			$insert = $db->query("insert into tbl_bayar_dokter_detail (bayar_dokter_id, nomr, no_daftar, nama, jaminan, b_dokter, b_tindakan, b_lab, b_fisio, total, fee_dokter) values ('".$id."', '".$_POST['nomrs'][$i]."', '".$_POST['no_daftar'][$i]."', '".$_POST['nama_pasien'][$i]."', '".$_POST['jaminan'][$i]."', '".$_POST['bDokter'][$i]."', '".$_POST['bTindakan'][$i]."', '".$_POST['bLab'][$i]."', '".$_POST['bFisio'][$i]."', '".$_POST['bTotal'][$i]."', '".$_POST['bFeedokter'][$i]."')", 0);
			$update = $db->query("update tbl_kasir set status_bayar_dokter='SDH' where no_daftar='".$_POST['no_daftar'][$i]."'");
		}
	}
	header("location:../../index.php?mod=keuangan&submod=jasa_dokter");
	//}
	//echo "insert into tbl_bayar_dokter (no_bayar, kode_dokter, nama_dokter, tgl_start, tgl_end, total_kotor, biaya_jaga, total_jasa, pajak, npwp, total_pajak, total_pendapatan, nrhri_jaga) values ('".$_POST['no_bayar']."', '".$_POST['kode_dokter']."', '".$dokter."', '".$date1."', '".$date2."', '".$_POST['total_kotor']."', '".$_POST['biaya_jaga']."', '".$_POST['totJasa']."', '".$_POST['pajak']."', '".$_POST['npwp']."', '".$_POST['totPajak']."', '".$_POST['totalAll']."', '".$_POST['hari_jaga']."' )";
	//print_r($_POST);
?>