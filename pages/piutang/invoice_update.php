<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$t3 = explode("/", $_POST['jatuh_tempo']);
		$date3 = $t3[2].'-'.$t3[0].'-'.$t3[1];
		if ($_POST['perusahaan'] == 'ALL') {
			$no_kwitansi = $db->query("select a.id, c.no_kwitansi from tbl_invoice_detail a left join tbl_pasien b on b.nomr=a.nomr left join tbl_kasir c on c.no_daftar=a.no_daftar where a.invoiceID='".$_POST['id']."'", 1);
		}
		else {
			$no_kwitansi = $db->query("select a.id, c.no_kwitansi from tbl_invoice_detail a left join tbl_pasien b on b.nomr=a.nomr left join tbl_kasir c on c.no_daftar=a.no_daftar where a.invoiceID='".$_POST['id']."' and b.pekerjaan='".$_POST['perusahaan']."'", 0);
		}
		$nama = $db->queryItem("select nama_perusahaan from tbl_invoice where id='" . $_POST['id'] . "'", 1);

		//memasukkan ke tabel jurnal (Konsul di Jurnal)
		$no_do = $db->query("select no_dokumen_nr from tbl_jurnal order by no_dokumen_nr desc");
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
		$keterangan = 'AR Receipt From Guarantor , '.$nama;

		for ($i = 0; $i < count($no_kwitansi); $i++) {
			$bayar = "detailInvoice".$no_kwitansi[$i]['id'];
			//echo $no_kwitansi[$i]['id'].' dan '.$_POST[$bayar].' dan '.$bayar;
			if ($_POST[$bayar] == $no_kwitansi[$i]['id']) {
				$total_inv = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$no_kwitansi[$i]['no_kwitansi']."' and payment_to='ASURANSI'");
				$idD = $db->queryItem("select id from tbl_kasir_detail where no_kwitansi='".$no_kwitansi[$i]['no_kwitansi']."' and payment_to='ASURANSI'");
				//print_r($_POST);
				//echo $no_kwitansi[$i]['no_kwitansi'].' - '.$total_inv.'<br>';
				$update = $db->query("update tbl_invoice_detail set status_bayar='SDH', tgl_bayar='$date3' where id='".$no_kwitansi[$i]['id']."'", 1);
				$update = $db->query("update tbl_invoice set status_bayar='ANGSUR', tgl_bayar='$date3' where id='".$_POST['id']."'", 1);

				$dt = $db->query("select * from tbl_invoice_detail where id='".$no_kwitansi[$i]['id']."'", 0);
				$hdr = $db->query("select a.kode_perusahaan, b.piutang_kd_coa from tbl_invoice a left join tbl_perusahaan b on b.kode_perusahaan=a.kode_perusahaan where a.id='".$dt[0]['invoiceID']."'", 0);
				$coa = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='".$hdr[0]['piutang_kd_coa']."'");
				$gl_kode = $coa[0]['kd_coa'];
				$gl_nama = $coa[0]['nm_coa'];
				$deskripsi = 'AR Guarantor Payment '.$no_kwitansi[$i]['no_kwitansi'];
				//$dtarif = $db->query("select * from tbl_poli where kd_poli='".$_POST['kd_poli']."'");
				$reg_no = $data[$i]['no_kwitansi'];
				$cost_center_kode = '1124';
				$cost_center_nama = 'Layanan Hemodialisa';
				$total_inv = $dt[0]['total'];

				//insert Administrasi di Jurnal
				$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$total_inv."', '0', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 1);
				$ttl_pay = $ttl_pay + $total_inv;

			}
		}
		$cek = $db->queryItem("select id from tbl_invoice_detail where invoiceID='".$_POST['id']."' and status_bayar='BLM'");
		if ($cek == "") {
			$update = $db->query("update tbl_invoice set status_bayar='SDH', tgl_bayar='$date3' where id='".$_POST['id']."'");
		}

		$coa = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='".$_POST['kd_coa']."'");
		$gl_kode = $coa[0]['kd_coa'];
		$gl_nama = $coa[0]['nm_coa'];
		$deskripsi = 'AR Guarantor Payment '.$nama;
		//$dtarif = $db->query("select * from tbl_poli where kd_poli='".$_POST['kd_poli']."'");
		$reg_no = $data[$i]['no_kwitansi'];
		$cost_center_kode = '1124';
		$cost_center_nama = 'Layanan Hemodialisa';

		//insert Administrasi di Jurnal
		if ($ttl_pay > 0) {
			$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '0', '".$ttl_pay."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 1);
		}

		header("location:../../index.php?mod=piutang&submod=invoice");
	}
?>