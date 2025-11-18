<?php
session_start();
include "database.php";

ini_set("display_errors", 1);
if ($_SESSION['rg_user'] != '') {
	// Define variable
	$date1 = $_POST['tgl_faktur'];
	$noPo = $_POST['jenis_penerimaan'] == 'po' ? $_POST['no_po'][1] : $_POST['no_po'][0];
	$namaVEndor = trim($_POST['nama_vendor']);
	$namaSupplier = trim($_POST['nama_suplier']);
	$jenisBarang = $_POST['jenis_barang'];
	$jumlahObat = array_sum(array_map('intval', $_POST['qty'] ?: []));
	// Insert data header penerimaan
	try {
		$db->beginTransaction();
		$sql = "insert into tbl_penerimaan (no_penerimaan,jenis_penerimaan, jenis_barang, no_po, no_faktur, tgl_faktur, kode_vendor, nama_vendor, kode_supplier, nama_supplier,jml_obat, status_update) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'UPDATE')";
		$stmt = $db->prepare($sql);
		$stmt->execute([$_POST['no_penerimaan'], $_POST['jenis_penerimaan'], $_POST['jenis_barang'], $noPo, $_POST['no_faktur'], $_POST['tgl_faktur'], $_POST['kode_vendor'], $namaVEndor, $_POST['kode_suplier'], $namaSupplier, $jumlahObat]);
		$id = $db->lastInsertId();

		if ($_POST['jenis_penerimaan'] == 'po') {
			for ($i = 0; $i < count($_POST['kd_obat']); $i++) {
				$code = $_POST['kd_obat'][$i];
				$harga_jual = $_POST['harga'][$i] + $_POST['margin'][$i];
				$total = $_POST['qty'][$i] * $_POST['harga'][$i];
				$qty = $_POST['qty'][$i];

				$sqlDetail = "insert into tbl_penerimaan_detail (penerimaan_id, no_penerimaan, kode_obat, nama_obat, qty, harga_beli, total, margin_obat, harga_jual) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$stmtDetail = $db->prepare($sqlDetail);
				$stmtDetail->execute([$id, $_POST['no_penerimaan'], $code, $_POST['nama_obat'][$i], $qty, $_POST['harga'][$i], $total, $_POST['margin'][$i], $harga_jual]);

				switch ($jenisBarang) {
					case 'obat':
						$updateStock = $db->prepare("update tbl_obat set stock_akhir=stock_akhir+? where kode_obat=?");
						$updateStock->execute([$qty, $code]);
						break;
					default:
						$updateStock = $db->prepare("update tbl_logistik set stock_gudang=stock_gudang+? where kode=?");
						$updateStock->execute([$qty, $code]);
						break;
				}
			}
		} else {
			$db->commit();
			header("location:../../../index.php?mod=inv&submod=penerimaan_obat_input_detail&id=" . md5($id));
		}

		$db->commit();
		// Send session success
		$_SESSION['success'] = "Data Berhasil Disimpan";
		header("location:../../../index.php?mod=inv&submod=penerimaan_obat");
	} catch (Exception $e) {
		$db->rollBack();
		$_SESSION['error'] = "Data Gagal Disimpan: " . $e->getMessage();
		header("location:../../../index.php?mod=inv&submod=penerimaan_obat_input");
		exit();
	}
} else {
	header("location:../../../index.php?mod=inv&submod=penerimaan_obat_input");
}
