<?php
session_start();
include "../../../3rdparty/engine.php";
ini_set("display_errors", 1);

if ($_SESSION['rg_user'] != '') {

	$unitEnum = [
		'apotik' => 'APOTIK',
		'fisio' => 'FISIOTHERAPI',
		'keperawatan' => 'KEPERAWATAN',
		'gudang' => 'GUDANG'
	];

	function getUnitKey($unitName, $unitEnum)
	{
		return array_search(strtoupper($unitName), $unitEnum); // balikin key-nya, misal 'apotik'
	}


	$userID = $_SESSION['rg_user'];
	$noPO = $_POST['no_po'];
	$noPenerimaan = $_POST['no_penerimaan'];
	$tglInput = date("Y-m-d");

	$headerPermintaan = $db->query("select * from tbl_ro_to_gudang where no_ro_gudang='$noPO'")[0];
	$detailPermintaan = $db->query("select * from tbl_ro_to_gudang_detail where no_ro_gudang='$noPO'");
	$qty = $db->query("select SUM(qty) as jumlahQty from tbl_ro_to_gudang_detail where no_ro_gudang='$noPO'")[0];

	$jumlahObat = count($detailPermintaan);
	$qtyObat = $qty['jumlahQty'];
	$unitPeminta = $headerPermintaan['unit'];
	$unitDiminta = $headerPermintaan['unit_diminta'];
	$jenisBarang = $headerPermintaan['jenis'];

	// INSERT HEADER TRANSFER
	$db->query("insert into tbl_transfer (no_transfer, tgl_input_transfer, input_by, no_ro_gudang, jml_obat, qty_obat) values ('$noPenerimaan', '$tglInput', '$userID', '$noPO', '$jumlahObat', '$qtyObat')", 0);
	$idHeaderTransfer = mysql_insert_id();


	foreach ($detailPermintaan as $key => $item) {
		$code = $item['kode_obat'];
		$name = $item['nama_obat'];
		$qty = $item['qty'];
		$sql = "";

		$keyPeminta = getUnitKey($unitPeminta, $unitEnum);
		$keyDiminta = getUnitKey($unitDiminta, $unitEnum);


		if (!$keyPeminta || !$keyDiminta) return; // skip kalau tidak cocok

		// Deteksi jenis item dari struktur datanya
		$isLogistik = isset($jenisBarang) && $jenisBarang == "LOGISTIK_UMUM";

		if ($isLogistik) {
			// INSERT DETAIL TRANSFER
			$stock_logistik = $db->queryItem("select st_{$keyPeminta} from tbl_logistik where kode = '{$code}'");
			$stock_akhir = $stock_logistik + $qty;
			$db->query("insert into tbl_transfer_detail (transferID, no_transfer, kode_obat, nama_obat, qty, stock_akhir ) values ('$idHeaderTransfer', '$noPenerimaan', '$code', '$name', '$qty', '$stock_akhir')", 0);

			// update logistik
			$sql = "UPDATE tbl_logistik SET st_{$keyPeminta} = st_{$keyPeminta} - {$qty}, st_{$keyDiminta} = st_{$keyDiminta} + {$qty} WHERE kode = '{$code}'";
		} else {

			// INSERT DETAIL TRANSFER
			$stock_obat = $db->queryItem("select stock_akhir_{$keyPeminta} from tbl_obat where kode_obat = '{$code}'");
			$stock_akhir = $stock_obat + $qty;
			$db->query("insert into tbl_transfer_detail (transferID, no_transfer, kode_obat, nama_obat, qty, stock_akhir ) values ('$idHeaderTransfer', '$noPenerimaan', '$code', '$name', '$qty', '$stock_akhir')", 0);

			// jika stock dari gudang
			$keyUpdate = "";
			if ($keyDiminta == 'gudang') {
				$keyUpdate = "stock_akhir = stock_akhir - {$qty}";
			} else {
				$keyUpdate = "stock_akhir_{$keyDiminta} = stock_akhir_{$keyDiminta} - {$qty}";
			}
			$sql = "UPDATE tbl_obat SET stock_akhir_{$keyPeminta} = stock_akhir_{$keyPeminta} + {$qty}, $keyUpdate  WHERE kode_obat = '{$code}'";
		}

		$db->query($sql);
	}
	$_SESSION['success'] = "Transfer obat/logistik berhasil";
	header("location:../../../index.php?mod=inv&submod=transfer");
} else {
	$_SESSION['error'] = "Session Expired";
	header("location:../../../index.php");
}
