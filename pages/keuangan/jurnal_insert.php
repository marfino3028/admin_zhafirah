<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$no_do = $db->query("select no_dokumen_nr from tbl_jurnal order by no_dokumen_nr desc");
		$nodok = $no_do[0]['no_dokumen_nr'] + 1;
		if ($nodok < 10) $nodokumen = '00000'.$nodok;
		elseif ($nodok >= 10 and $nodok < 100) $nodokumen = '0000'.$nodok;
		elseif ($nodok >= 100 and $nodok < 1000) $nodokumen = '000'.$nodok;
		elseif ($nodok >= 1000 and $nodok < 10000) $nodokumen = '00'.$nodok;
		elseif ($nodok >= 10000 and $nodok < 100000) $nodokumen = '0'.$nodok;
		elseif ($nodok >= 100000 and $nodok < 1000000) $nodokumen = $nodok;
		$_POST['petugas'] = $_SESSION['rg_user'];
		$_POST['rate'] = 1;
		$_POST['no_dokumen'] = date("y-m-d-").$nodokumen;
		$_POST['no_dokumen_nr'] = $nodokumen * 1;
		$_POST['status'] = 'POSTED';

		//Masukkan Data ke Tabel
		$akun1 = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='".$_POST['kode_akun1']."'");
		$costcenter1 = $db->query("select kd_profit, nm_profit, group_type from tbl_profit where kd_profit='".$_POST['cc1']."'");
		$_POST['nama_akun1'] = $akun1[0]['nm_coa'];
		$_POST['nama_cc1'] = $costcenter1[0]['nm_profit'].' - '.$costcenter1[0]['group_type'];
		if ($_POST['nilai_debet1'] == "") $_POST['nilai_debet1'] = 0;
		if ($_POST['nilai_kredit1'] == "") $_POST['nilai_kredit1'] = 0;
		$insert1 = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, tgl_input, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$_POST['no_dokumen_nr']."', '".$_POST['no_dokumen']."', '".$_POST['tanggal']."', '".$_POST['status']."', '".$_POST['tipe_dok']."', '".$_POST['petugas']."', '".$_POST['mata_uang']."', '".$_POST['rate']."', '".$_POST['supplier']."', '".$_POST['keterangan']."', '".$_POST['tanggal']."', '".$_POST['kode_akun1']."', '".$_POST['nama_akun1']."', '".$_POST['deskripsi1']."', '".$_POST['nilai_debet1']."', '".$_POST['nilai_kredit1']."', '".$_POST['reg_no1']."', '".$_POST['cc1']."', '".$_POST['nama_cc1']."', '".$_POST['kode_barang']."', '".$_POST['volume']."', '".$_POST['satuan']."', '".$_POST['reffID']."', 'MANUAL')", 1);

		if ($_POST['nilai_debet2'] == "") $_POST['nilai_debet2'] = 0;
		if ($_POST['nilai_kredit2'] == "") $_POST['nilai_kredit2'] = 0;
		$akun2 = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='".$_POST['kode_akun2']."'");
		$costcenter2 = $db->query("select kd_profit, nm_profit, group_type from tbl_profit where kd_profit='".$_POST['cc2']."'");
		$_POST['nama_akun2'] = $akun2[0]['nm_coa'];
		$_POST['nama_cc2'] = $costcenter2[0]['nm_profit'].' - '.$costcenter2[0]['group_type'];
		$insert2 = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, tgl_input, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$_POST['no_dokumen_nr']."', '".$_POST['no_dokumen']."', '".$_POST['tanggal']."', '".$_POST['status']."', '".$_POST['tipe_dok']."', '".$_POST['petugas']."', '".$_POST['mata_uang']."', '".$_POST['rate']."', '".$_POST['supplier']."', '".$_POST['keterangan']."', '".$_POST['tanggal']."', '".$_POST['kode_akun2']."', '".$_POST['nama_akun2']."', '".$_POST['deskripsi2']."', '".$_POST['nilai_debet2']."', '".$_POST['nilai_kredit2']."', '".$_POST['reg_no2']."', '".$_POST['cc2']."', '".$_POST['nama_cc2']."', '".$_POST['kode_barang']."', '".$_POST['volume']."', '".$_POST['satuan']."', '".$_POST['reffID']."', 'MANUAL')", 1);

		if ($_POST['kode_akun3'] != "" and $_POST['cc3'] !="") {
			if ($_POST['nilai_debet3'] == "") $_POST['nilai_debet3'] = 0;
			if ($_POST['nilai_kredit3'] == "") $_POST['nilai_kredit3'] = 0;
			$akun3 = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='".$_POST['kode_akun3']."'");
			$costcenter3 = $db->query("select kd_profit, nm_profit, group_type from tbl_profit where kd_profit='".$_POST['cc3']."'");
			$_POST['nama_akun3'] = $akun3[0]['nm_coa'];
			$_POST['nama_cc3'] = $costcenter3[0]['nm_profit'].' - '.$costcenter3[0]['group_type'];
			$insert3 = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, tgl_input, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$_POST['no_dokumen_nr']."', '".$_POST['no_dokumen']."', '".$_POST['tanggal']."', '".$_POST['status']."', '".$_POST['tipe_dok']."', '".$_POST['petugas']."', '".$_POST['mata_uang']."', '".$_POST['rate']."', '".$_POST['supplier']."', '".$_POST['keterangan']."', '".$_POST['tanggal']."', '".$_POST['kode_akun3']."', '".$_POST['nama_akun3']."', '".$_POST['deskripsi3']."', '".$_POST['nilai_debet3']."', '".$_POST['nilai_kredit3']."', '".$_POST['reg_no3']."', '".$_POST['cc3']."', '".$_POST['nama_cc3']."', '".$_POST['kode_barang']."', '".$_POST['volume']."', '".$_POST['satuan']."', '".$_POST['reffID']."', 'MANUAL')", 1);
		}

		if ($_POST['kode_akun4'] != "" and $_POST['cc4'] !="") {
			if ($_POST['nilai_debet4'] == "") $_POST['nilai_debet4'] = 0;
			if ($_POST['nilai_kredit4'] == "") $_POST['nilai_kredit4'] = 0;
			$akun4 = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='".$_POST['kode_akun4']."'");
			$costcenter4 = $db->query("select kd_profit, nm_profit, group_type from tbl_profit where kd_profit='".$_POST['cc4']."'");
			$_POST['nama_akun4'] = $akun4[0]['nm_coa'];
			$_POST['nama_cc4'] = $costcenter4[0]['nm_profit'].' - '.$costcenter4[0]['group_type'];
			$insert4 = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, tgl_input, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$_POST['no_dokumen_nr']."', '".$_POST['no_dokumen']."', '".$_POST['tanggal']."', '".$_POST['status']."', '".$_POST['tipe_dok']."', '".$_POST['petugas']."', '".$_POST['mata_uang']."', '".$_POST['rate']."', '".$_POST['supplier']."', '".$_POST['keterangan']."', '".$_POST['tanggal']."', '".$_POST['kode_akun4']."', '".$_POST['nama_akun4']."', '".$_POST['deskripsi4']."', '".$_POST['nilai_debet4']."', '".$_POST['nilai_kredit4']."', '".$_POST['reg_no4']."', '".$_POST['cc4']."', '".$_POST['nama_cc4']."', '".$_POST['kode_barang']."', '".$_POST['volume']."', '".$_POST['satuan']."', '".$_POST['reffID']."', 'MANUAL')", 1);
		}

		if ($_POST['kode_akun5'] != "" and $_POST['cc5'] !="") {
			if ($_POST['nilai_debet5'] == "") $_POST['nilai_debet5'] = 0;
			if ($_POST['nilai_kredit5'] == "") $_POST['nilai_kredit5'] = 0;
			$akun5 = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='".$_POST['kode_akun5']."'");
			$costcenter5 = $db->query("select kd_profit, nm_profit, group_type from tbl_profit where kd_profit='".$_POST['cc5']."'");
			$_POST['nama_akun5'] = $akun5[0]['nm_coa'];
			$_POST['nama_cc5'] = $costcenter5[0]['nm_profit'].' - '.$costcenter5[0]['group_type'];
			$insert4 = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, tgl_input, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$_POST['no_dokumen_nr']."', '".$_POST['no_dokumen']."', '".$_POST['tanggal']."', '".$_POST['status']."', '".$_POST['tipe_dok']."', '".$_POST['petugas']."', '".$_POST['mata_uang']."', '".$_POST['rate']."', '".$_POST['supplier']."', '".$_POST['keterangan']."', '".$_POST['tanggal']."', '".$_POST['kode_akun5']."', '".$_POST['nama_akun5']."', '".$_POST['deskripsi5']."', '".$_POST['nilai_debet5']."', '".$_POST['nilai_kredit5']."', '".$_POST['reg_no5']."', '".$_POST['cc5']."', '".$_POST['nama_cc5']."', '".$_POST['kode_barang']."', '".$_POST['volume']."', '".$_POST['satuan']."', '".$_POST['reffID']."', 'MANUAL')", 1);
		}
		
		//echo '<pre>';
		//print_r($_POST);
		header("location:../../index.php?mod=keuangan&submod=jurnal_entri");
	}
?>