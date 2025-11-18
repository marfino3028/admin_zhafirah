<?php
	session_start();
	include "../../3rdparty/engine.php";

	ini_set("display_errors", 0);
	echo '<pre>';
	print_r($_POST);
	if ($_SESSION['rg_user'] != '') {
		$date1 = $_POST['tgl_faktur'];
		$noPo = $_POST['jenis_penerimaan'] == 'po' ? $_POST['no_po'][1] : $_POST['no_po'][0];
		$namaVendor = trim($_POST['nama_vendor']);
		$namaSupplier = trim($_POST['nama_suplier']);
		$jenisBarang = $_POST['jenis_barang'];
		$jumlahObat = array_sum(array_map('intval', $_POST['qty'] ?: []));
		echo "$date1 dan $noPo dan $namaVendor dan $namaSupplier dan $jenisBarang dan $jumlahObat<br>";

		//masukkan heade penerimaan
		if ($_POST['jenis_penerimaan'] == 'po') {
			$insert = $db->query("insert into tbl_penerimaan (no_penerimaan,jenis_penerimaan, jenis_barang, no_po, no_faktur, tgl_faktur, kode_vendor, nama_vendor, kode_supplier, nama_supplier,jml_obat, status_update) values ('".$_POST['no_penerimaan']."', '".$_POST['jenis_penerimaan']."', '".$_POST['jenis_barang']."', '".$noPo."', '".$_POST['no_faktur']."', '".$_POST['tgl_faktur']."', '".$_POST['kode_vendor']."', '".$namaVendor."', '".$_POST['kode_suplier']."', '".$namaSupplier."', '".$jumlahObat."', 'UPDATE')");
		}
		else {
			$insert = $db->query("insert into tbl_penerimaan (no_penerimaan,jenis_penerimaan, jenis_barang, no_po, no_faktur, tgl_faktur, kode_vendor, nama_vendor, kode_supplier, nama_supplier,jml_obat, status_update) values ('".$_POST['no_penerimaan']."', '".$_POST['jenis_penerimaan']."', '".$_POST['jenis_barang']."', '".$noPo."', '".$_POST['no_faktur']."', '".$_POST['tgl_faktur']."', '".$_POST['kode_vendor']."', '".$namaVendor."', '".$_POST['kode_suplier']."', '".$namaSupplier."', '".$jumlahObat."', 'NOUPDATE')");
		}
		$id = mysql_insert_id();

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
		$keterangan = 'GRN,  No. Penerimaan.'.$_POST['no_penerimaan'].', Supplier Name: '.$namaSupplier;

		
		if ($_POST['jenis_penerimaan'] == 'po') {
			for ($i = 0; $i < count($_POST['kd_obat']); $i++) {
				$code = $_POST['kd_obat'][$i];
				$harga_jual = $_POST['harga'][$i] + $_POST['margin'][$i];
				$total = $_POST['qty'][$i] * $_POST['harga'][$i];
				$qty = $_POST['qty'][$i];

				$insert_detail = $db->query("insert into tbl_penerimaan_detail (penerimaan_id, no_penerimaan, kode_obat, nama_obat, qty, harga_beli, total, margin_obat, harga_jual) values ('$id', '".$_POST['no_penerimaan']."', '".$code."', '".$_POST['nama_obat'][$i]."', '".$qty."', '".$_POST['harga'][$i]."', '".$total."', '".$_POST['margin'][$i]."', '".$harga_jual."')");

				//update tabell obat
				if ($jenisBarang == 'obat') {
					$updateStock = $db->query("update tbl_obat set stock_akhir=stock_akhir+$qty where kode_obat='$code'");
				}
				else {
					$updateStock = $db->query("update tbl_logistik set stock_gudang=stock_gudang+$qty where kode='$code'");
				}
				$jumlah = $jumlah + $_POST['qty'][$i];

				$gl_kode = '11040101';
				$gl_nama = 'PERSEDIAAN MEDIS OBAT';
				$deskripsi = 'GRN PO#'.$noPo.' FAKTUR#'.$_POST['no_faktur'].' BRG#OBT'.$_POST['kd_obat'][$i].' '.$_POST['nama_obat'][$i].' '.$_POST['qty'][$i].' @'.$_POST['harga'][$i];
				$dtarif = $db->query("select * from tbl_poli where kd_poli='".$_POST['kd_poli']."'");
				$reg_no = '';
				$cost_center_kode = '';
				$cost_center_nama = '';
				$debit = $total;
				$kredit = 0;
				//insert Administrasi di Jurnal
				$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);
				$total_all = $total_all + $total;
			}
			//Masukkan ke dalam jurnal
			$gl_kode = '21010600';
			$gl_nama = 'HUTANG USAHA BELUM DIAKUI';
			$deskripsi = 'GRN PO#'.$noPo.' FAKTUR#'.$_POST['no_faktur'];
			$dtarif = $db->query("select * from tbl_poli where kd_poli='".$_POST['kd_poli']."'");
			$reg_no = '';
			$cost_center_kode = '';
			$cost_center_nama = '';
			$debit = 0;
			$kredit = $total_all;
			//insert Administrasi di Jurnal
			$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

			header("location:../../index.php?mod=inv&submod=penerimaan_obat");
		}
		else {
			header("location:../../index.php?mod=inv&submod=penerimaan_obat_input_detail&id=" . md5($id));
		}
	}
?>