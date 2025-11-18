<?php
session_start();
include "../../3rdparty/engine.php";
ini_set("display_errors", 1);

if ($_SESSION['rg_user'] != '') {

	$userID = $_SESSION['rg_user'];
	$noPO = $_POST['no_po'];
	$noPenerimaan = $_POST['no_penerimaan'];
	$tglInput = date("Y-m-d");

	$updatePermintaan = $db->query("update tbl_ro_to_gudang set status_pakai='SDH' where no_ro_gudang='$noPO'");
	$headerPermintaan = $db->query("select * from tbl_ro_to_gudang where no_ro_gudang='$noPO'")[0];
	$detailPermintaan = $db->query("select * from tbl_ro_to_gudang_detail where no_ro_gudang='$noPO'");
	$qty = $db->query("select SUM(qty) as jumlahQty from tbl_ro_to_gudang_detail where no_ro_gudang='$noPO'")[0];

	$jumlahObat = count($detailPermintaan);
	$qtyObat = $qty['jumlahQty'];
	$unitPeminta = $headerPermintaan['unit'];
	$unitDiminta = $headerPermintaan['unit_diminta'];

	$db->query("insert into tbl_transfer (no_transfer, tgl_input_transfer, input_by, no_ro_gudang, jml_obat, qty_obat) values ('$noPenerimaan', '$tglInput', '$userID', '$noPO', '$jumlahObat', '$qtyObat')", 0);
	$idHeaderTransfer = mysql_insert_id();

	// INSERT DETAIL TRANSFER
	for ($i = 0; $i < count($detailPermintaan); $i++) {

		$kode_obat = $detailPermintaan[$i]['kode_obat'];
		$nama_obat = $detailPermintaan[$i]['nama_obat'];
		$qty = $detailPermintaan[$i]['qty'];
		$stock_akhir = $detailPermintaan[$i]['stok_akhir'];

		$db->query("insert into tbl_transfer_detail (transferID, no_transfer, kode_obat, nama_obat, qty, stock_akhir ) values ('$idHeaderTransfer', '$noPenerimaan', '$kode_obat', '$nama_obat', '$qty', '$stock_akhir')", 0);
	}

	// UPDATE OBAT
	if ($unitPeminta == "APOTIK" && $unitDiminta == "GUDANG") {
		for ($i = 0; $i < count($detailPermintaan); $i++) {
			$kode_obat = $detailPermintaan[$i]['kode_obat'];
			$qty = $detailPermintaan[$i]['qty'];
			$db->query("update tbl_obat set stock_akhir = stock_akhir - $qty, stock_akhir_apotik = stock_akhir_apotik + $qty where kode_obat='$kode_obat'");
		}
	} else if ($unitPeminta == "FISIOTERAPI" && $unitDiminta == "GUDANG") {
		for ($i = 0; $i < count($detailPermintaan); $i++) {
			$kode_obat = $detailPermintaan[$i]['kode_obat'];
			$qty = $detailPermintaan[$i]['qty'];
			$db->query("update tbl_obat set stock_akhir = stock_akhir - $qty, stock_akhir_fisio = stock_akhir_fisio + $qty where kode_obat='$kode_obat'");
		}
	} else if ($unitPeminta == "KEPERAWATAN" && $unitDiminta == "GUDANG") {
		for ($i = 0; $i < count($detailPermintaan); $i++) {
			$kode_obat = $detailPermintaan[$i]['kode_obat'];
			$qty = $detailPermintaan[$i]['qty'];
			$db->query("update tbl_obat set stock_akhir = stock_akhir - $qty, stock_akhir_keperawatan = stock_akhir_keperawatan + $qty where kode_obat='$kode_obat'");
		}
	} //teruskan jika ada kondisi lain....

}

header("location:../../index.php?mod=inv&submod=transfer");
