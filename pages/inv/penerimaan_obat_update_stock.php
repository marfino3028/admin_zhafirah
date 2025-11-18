<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$sub = $db->query("select * from tbl_penerimaan where no_penerimaan='".$_POST['no_penerimaan']."'");
		$data = $db->query("select * from tbl_penerimaan_detail where no_penerimaan='".$_POST['no_penerimaan']."' and status_delete='UD'");

		//Masukkan ke tabel Jurnal untuk penerimaan
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
		$tipe_dokumen = 'Material Receipt';
		$petugas = $_SESSION['rg_user'];
		$mata_uang = 'Rupiah';
		$rate = 1;
		$supplier = '';
		$keterangan = 'GRN,  No. Penerimaan.'.$sub[0]['no_penerimaan'].', Supplier Name: '.$sub[0]['nama_supplier'];
		for($i = 0; $i < count($data); $i++) {
			//echo "update ".$data[$i][nama_obat]." - ".$data[$i][qty]."<br>";
			$update_stock = $db->query("update tbl_obat set stock_akhir=stock_akhir+".$data[$i]['qty']." where kode_obat='".$data[$i]['kode_obat']."'");
			$update_harga = $db->query("update tbl_obat set harga_beli=".$data[$i]['harga_beli'].", harga_jual=".$data[$i]['harga_jual']." where kode_obat='".$data[$i]['kode_obat']."'");
			$update_ed = $db->query("update tbl_obat set expire_date=".$data[$i]['expired_date']." where kode_obat='".$data[$i]['kode_obat']."'");

			$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='11040101'");
			$gl_kode = $coa[0]['kd_coa'];
			$gl_nama = $coa[0]['nm_coa'];
			if ($coa[0]['default_pos'] == 'Debit') {
				$debit = $data[$i]['total'];
				$kredit = 0;
			}
			elseif ($coa[0]['default_pos'] == 'Credit') {
				$debit = 0;
				$kredit = $data[$i]['total'];
			}
			$deskripsi = 'GRN PO#'.$sub[0]['no_po'].' FAKTUR#'.$sub[0]['no_faktur'].' BRG#OBT'.$data[$i]['kode_obat'].' '.$data[$i]['nama_obat'].' '.$data[$i]['qty'].' @'.$data[$i]['harga_jual'];
			$dtarif = $db->query("select * from tbl_poli where kd_poli='".$_POST['kd_poli']."'");
			$reg_no = '';
			$cost_center_kode = '';
			$cost_center_nama = '';
			//$debit = $data[$i]['total'];
			//$kredit = 0;
			//insert Administrasi di Jurnal
			$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);
			$total_all = $total_all + $data[$i]['total'];
		}
		$update_status = $db->query("update tbl_penerimaan set status_update='UPDATE' where no_penerimaan='".$_POST['no_penerimaan']."'");

		//Masukkan ke dalam jurnal
		//$gl_kode = '21010600';
		//$gl_nama = 'HUTANG USAHA BELUM DIAKUI';
		$deskripsi = 'GRN PO#'.$sub[0]['no_po'].' FAKTUR#'.$sub[0]['no_faktur'];
		$dtarif = $db->query("select * from tbl_poli where kd_poli='".$_POST['kd_poli']."'");
		$reg_no = '';
		$cost_center_kode = '';
		$cost_center_nama = '';
		//$debit = 0;
		//$kredit = $total_all;

			$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='21010600'");
			$gl_kode = $coa[0]['kd_coa'];
			$gl_nama = $coa[0]['nm_coa'];
			if ($coa[0]['default_pos'] == 'Debit') {
				$debit = $total_all;
				$kredit = 0;
			}
			elseif ($coa[0]['default_pos'] == 'Credit') {
				$debit = 0;
				$kredit = $total_all;
			}

		//insert Administrasi di Jurnal
		$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);
		
		header("location:../../index.php?mod=inv&submod=penerimaan_obat");
	}
?>