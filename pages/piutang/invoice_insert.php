<?php
session_start();
include "../../3rdparty/engine.php";
session_start();
echo '<pre>';
ini_set("display_errors", 0);
date_default_timezone_set("Asia/Jakarta");

if ($_SESSION['rg_user'] != '') {
	// $t1 = explode("/", $_POST['tgl_input']);
	// $t2 = explode("/", $_POST['tgl_kirim']);
	// $t3 = explode("/", $_POST['tgl_jatuh_tempo']);
	// $date1 = $t1[2] . '-' . $t1[0] . '-' . $t1[1];
	// $date2 = $t2[2] . '-' . $t2[0] . '-' . $t2[1];
	// $date3 = $t3[2] . '-' . $t3[0] . '-' . $t3[1];
	$tgl_bayar = date('Y-m-d');
	$date1 = $_POST['tgl_input'];
	$date2 = $_POST['tgl_kirim'];
	$date3 = $_POST['tgl_jatuh_tempo'];
	$nama = $db->queryItem("select nama_perusahaan from tbl_perusahaan where kode_perusahaan='" . $_POST['asuransi'] . "'");

	$insert = $db->query("insert into tbl_invoice (no_inv, tgl_input, tgl_kirim, tgl_jatuh_tempo, kode_perusahaan, nama_perusahaan, total, user_input, tgl_bayar) values ('" . $_POST['no_inv'] . "', '" . $date1 . "', '" . $date2 . "', '" . $date3 . "', '" . $_POST['asuransi'] . "', '$nama', '" . $_POST['total'] . "', '" . $_SESSION['rg_user'] . "', '$tgl_bayar')", 0);
	$id = mysql_insert_id();

	$data = $db->query("select * from  tbl_kasir where kode_perusahaan='" . $_POST['asuransi'] . "' and status_inv='BLM'", 0);

	//memasukkan ke tabel jurnal (Konsul di Jurnal)
	/*$no_do = $db->query("select no_dokumen_nr from tbl_jurnal order by no_dokumen_nr desc");
	$nodok = $no_do[0]['no_dokumen_nr'] + 1;
	if ($nodok < 10) $nodokumen = '00000'.$nodok;
	elseif ($nodok >= 10 and $nodok < 100) $nodokumen = '0000'.$nodok;
	elseif ($nodok >= 100 and $nodok < 1000) $nodokumen = '000'.$nodok;
	elseif ($nodok >= 1000 and $nodok < 10000) $nodokumen = '00'.$nodok;
	elseif ($nodok >= 10000 and $nodok < 100000) $nodokumen = '0'.$nodok;
	elseif ($nodok >= 100000 and $nodok < 1000000) $nodokumen = $nodok;
	$no_dokumen = date("y-m-d-").$nodokumen;
	$no_dokumen_nr = $nodokumen * 1;
	$tanggal = date("Y-m-d");
	$statuss = 'NOT POSTED';
	$tipe_dokumen = 'AR Receipt From Guarantor';
	$petugas = $_SESSION['rg_user'];
	$mata_uang = 'Rupiah';
	$rate = 1;
	$supplier = '';
	$keterangan = 'AR Receipt From Guarantor , '.$nama;*/

	for ($i = 0; $i < count($data); $i++) {
		$data_ins = "kasir".$data[$i]['id'];
		if ($_POST[$data_ins] == $data[$i]['id']) {
			$ttlAss = $db->query("select sum(bayar) jumlah from tbl_kasir_detail where no_kwitansi='".$data[$i]['no_kwitansi']."' and payment_to='ASURANSI'");
			$insert = $db->query("insert into tbl_invoice_detail (invoiceID, nomr, no_daftar, total, tgl_bayar) values ('$id', '" . $data[$i]['nomr'] . "', '" . $data[$i]['no_daftar'] . "', '" . $ttlAss[0]['jumlah'] . "', '$tgl_bayar')");
			$update = $db->query("update tbl_kasir set status_inv='SDH' where id='" . $data[$i]['id'] . "'");
			$total = $total + $ttlAss[0]['jumlah'];

			$coa = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='11030107'");
			$gl_kode = $coa[0]['kd_coa'];
			$gl_nama = $coa[0]['nm_coa'];
			$deskripsi = 'AR Guarantor Payment '.$data[$i]['no_kwitansi'];
			//$dtarif = $db->query("select * from tbl_poli where kd_poli='".$_POST['kd_poli']."'");
			$reg_no = $data[$i]['no_kwitansi'];
			$cost_center_kode = '1124';
			$cost_center_nama = 'Layanan Hemodialisa';

			//insert Administrasi di Jurnal
			/*$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$ttlAss[0]['jumlah']."', '0', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);*/
		}
	}

	$coa = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='11020013'");
	$gl_kode = $coa[0]['kd_coa'];
	$gl_nama = $coa[0]['nm_coa'];
	$deskripsi = 'AR Guarantor Payment '.$nama;
	//$dtarif = $db->query("select * from tbl_poli where kd_poli='".$_POST['kd_poli']."'");
	$reg_no = $data[$i]['no_kwitansi'];
	$cost_center_kode = '1124';
	$cost_center_nama = 'Layanan Hemodialisa';

	//insert Administrasi di Jurnal
	/*$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '0', '".$ttlAss[0]['jumlah']."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);*/
	$update = $db->query("update tbl_invoice set total='$total' where id='$id'");
	header("location:../../index.php?mod=piutang&submod=invoice");
}

