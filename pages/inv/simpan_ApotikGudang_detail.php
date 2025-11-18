<?php
session_start();
include "../../3rdparty/engine.php";
//print_r($_POST);
ini_set("display_errors", 0);

if ($_SESSION['rg_user'] != '') {
	if ($_POST['jenis'] == 'LOGISTIK UMUM') {
		$data = $db->query("select * from tbl_logistik where kode='" . $_POST['obat'] . "'", 0);

		$insert = $db->query("insert into tbl_ro_to_gudang_detail (ro_gudangID, no_ro_gudang, kode_obat, nama_obat, sat, qty, unit, harga, total, bln1, bln2, bln3, rata, stok_akhir) values ('" . $_POST['ro_gudangID'] . "', '" . $_POST['no_ro_gudang'] . "', '" . $_POST['obat'] . "', '" . $data[0]['nama'] . "', '" . $data[0]['satuan_terkecil'] . "', '" . $_POST['qty'] . "', '','" . $data[0]['hna'] . "', '0', '0', '0', '0', '0', '0')", 0);
		$id = mysql_insert_id();

		$jmlRequest = $db->queryItem("select sum(qty) from tbl_ro_to_gudang_detail where no_ro_gudang='" . $_POST['no_ro_gudang'] . "'");
		$update = $db->query("update tbl_ro_to_gudang set total_permintaan='$jmlRequest' where no_ro_gudang='" . $_POST['no_ro_gudang'] . "'");
	} else {
		$data = $db->query("select * from tbl_obat where kode_obat='" . $_POST['obat'] . "'", 0);
		$data2 = $db->query("select * from tbl_ro_to_gudang where no_ro_gudang='" . $_POST['no_ro_gudang'] . "'", 0);
		$tgl = date('Y-m-d');

		$tgl11 = date('Y-m-01', strtotime($tgl . ' - 1 month'));
		$tgl12 = date('Y-m-01', strtotime($tgl . ' - 0 month'));

		$tgl21 = date('Y-m-01', strtotime($tgl . ' - 2 month'));
		$tgl22 = date('Y-m-01', strtotime($tgl . ' - 1 month'));

		$tgl31 = date('Y-m-01', strtotime($tgl . ' - 3 month'));
		$tgl32 = date('Y-m-01', strtotime($tgl . ' - 2 month'));

		$bln1 = $db->queryItem("select sum(qty) from tbl_resep a left join tbl_resep_detail b on b.resep_id=a.id where a.tgl_input >= '$tgl11' and a.tgl_input < '$tgl12' and b.kode_obat='" . $_POST['obat'] . "'", 0);
		$bln2 = $db->queryItem("select sum(qty) from tbl_resep a left join tbl_resep_detail b on b.resep_id=a.id where a.tgl_input >= '$tgl21' and a.tgl_input < '$tgl22' and b.kode_obat='" . $_POST['obat'] . "'", 0);
		$bln3 = $db->queryItem("select sum(qty) from tbl_resep a left join tbl_resep_detail b on b.resep_id=a.id where a.tgl_input >= '$tgl31' and a.tgl_input < '$tgl32' and b.kode_obat='" . $_POST['obat'] . "'", 0);
		$total = $bln1 + $bln2 + $bln3;
		$rata = $total / 3;
		$qty = ($rata * 1.2) - $data[0]['stock_akhir'];
		$total = $_POST['qty'] * $_POST['harga_beli'];
		if ($bln1 == "") $bln1 = 0;
		if ($bln2 == "") $bln2 = 0;
		if ($bln3 == "") $bln3 = 0;
		if ($rata == "") $rata = 0;

		$insert = $db->query("insert into tbl_ro_to_gudang_detail (ro_gudangID, no_ro_gudang, kode_obat, nama_obat, sat, qty, unit, harga, total, bln1, bln2, bln3, rata, stok_akhir) values ('" . $_POST['ro_gudangID'] . "', '" . $_POST['no_ro_gudang'] . "', '" . $_POST['obat'] . "', '" . $data[0]['nama_obat'] . "', '" . $data[0]['satuan_terkecil'] . "', '" . $_POST['qty'] . "', '" . $data2[0]['unit'] . "','" . $data[0]['harga_beli'] . "', '" . $total . "', '" . $bln1 . "', '" . $bln2 . "', '" . $bln3 . "', '" . $rata . "', '" . $data[0]['stock_akhir'] . "')", 0);
		//echo "insert into tbl_ro_to_gudang_detail (ro_gudangID, no_ro_gudang, kode_obat, nama_obat, sat, qty, harga, total, bln1, bln2, bln3, rata, stok_akhir) values ('".$_POST['ro_gudangID']."', '".$_POST['no_ro_gudang']."', '".$_POST['obat']."', '".$data[0]['nama_obat']."', '".$data[0]['satuan_besar']."', '".$_POST['qty']."', '".$data[0]['harga_beli']."', '".($total ?? 0)."', '".($bln1 ?? 0)."', '".($bln2 ?? 0)."', '".($bln3 ?? 0)."', '".($rata ?? 0)."', '".($data[0]['stock_akhir'] ?? 0)."')";
		$id = mysql_insert_id();

		$jmlRequest = $db->queryItem("select sum(qty) from tbl_ro_to_gudang_detail where no_ro_gudang='" . $_POST['no_ro_gudang'] . "'");
		$update = $db->query("update tbl_ro_to_gudang set total_permintaan='$jmlRequest' where no_ro_gudang='" . $_POST['no_ro_gudang'] . "'");
	}

	header("location:../../index.php?mod=inv&submod=input_ApotikGudang_detail&id=" . md5($_POST['ro_gudangID']));
}
