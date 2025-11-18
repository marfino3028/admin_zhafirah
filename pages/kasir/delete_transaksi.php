<?php
session_start();
include "../../3rdparty/engine.php";
ini_set("display_errors", 0);

if ($_SESSION['rg_user'] != '') {
	$no_kw = $db->queryItem("select no_kwitansi from tbl_kasir where id='" . $_GET['id'] . "'");
	$no_daftar = $db->queryItem("select no_daftar from tbl_kasir where id='" . $_GET['id'] . "'");

	// kembalikan stok Depo Apotik
	// non racikan
	$no_resep = $db->queryItem("SELECT no_resep FROM tbl_resep WHERE no_daftar = '$no_daftar'");
	$data_resepApotik = $db->query("SELECT kode_obat, qty, depo FROM tbl_resep_detail WHERE no_resep = '$no_resep' and depo='Apotik' and status_delete = 'UD'");

	for ($i = 0; $i < count($data_resepApotik); $i++) {
		$qty_resepApotik = $data_resepApotik[$i]['qty'];
		$update_resepApotik = $db->query("update tbl_obat set stock_akhir_apotik = stock_akhir_apotik + $qty_resepApotik where kode_obat = '" . $data_resepApotik[$i]['kode_obat'] . "'");
	}

	// racikan
	$data_racikanApotik = $db->query("SELECT kode_obat, qty, depo FROM tbl_racikan_detail WHERE no_daftar = '$no_daftar' and depo='Apotik' and status_delete = 'UD'");

	for ($i = 0; $i < count($data_racikanApotik); $i++) {
		$qty_racikanApotik = $data_racikanApotik[$i]['qty'];
		$update_racikanApotik = $db->query("update tbl_obat set stock_akhir_apotik = stock_akhir_apotik + $qty_racikanApotik where kode_obat = '" . $data_racikanApotik[$i]['kode_obat'] . "'");
	}
	// akhir kembalikan stok Depo Apotik

	// kembalikan stok Depo Fisio
	// non racikan
	$data_resepFisio = $db->query("SELECT kode_obat, qty, depo FROM tbl_resep_detail WHERE no_resep = '$no_resep' and depo='Fisioterapi' and status_delete = 'UD'");

	for ($i = 0; $i < count($data_resepFisio); $i++) {
		$qty_resepFisio = $data_resepFisio[$i]['qty'];
		$update_resepFisio = $db->query("update tbl_obat set stock_akhir_fisio = stock_akhir_fisio + $qty_resepFisio where kode_obat = '" . $data_resepFisio[$i]['kode_obat'] . "'");
	}

	// racikan
	$data_racikanFisio = $db->query("SELECT kode_obat, qty, depo FROM tbl_racikan_detail WHERE no_daftar = '$no_daftar' and depo='Fisioterapi' and status_delete = 'UD'");

	for ($i = 0; $i < count($data_racikanFisio); $i++) {
		$qty_racikanFisio = $data_racikanFisio[$i]['qty'];
		$update_racikanFisio = $db->query("update tbl_obat set stock_akhir_fisio = stock_akhir_fisio + $qty_racikanFisio where kode_obat = '" . $data_racikanFisio[$i]['kode_obat'] . "'");
	}
	// akhir kembalikan stok Depo Fisio

	// kembalikan stok Depo Keperawatan
	// non racikan
	$data_resepKeperawatan = $db->query("SELECT kode_obat, qty, depo FROM tbl_resep_detail WHERE no_resep = '$no_resep' and depo='Keperawatan' and status_delete = 'UD'");

	for ($i = 0; $i < count($data_resepKeperawatan); $i++) {
		$qty_resepKeperawatan = $data_resepKeperawatan[$i]['qty'];
		$update_resepKeperawatan = $db->query("update tbl_obat set stock_akhir_keperawatan = stock_akhir_keperawatan + $qty_resepKeperawatan where kode_obat = '" . $data_resepKeperawatan[$i]['kode_obat'] . "'");
	}

	// racikan
	$data_racikanKeperawatan = $db->query("SELECT kode_obat, qty, depo FROM tbl_racikan_detail WHERE no_daftar = '$no_daftar' and depo='Keperawatan' and status_delete = 'UD'");

	for ($i = 0; $i < count($data_racikanKeperawatan); $i++) {
		$qty_racikanKeperawatan = $data_racikanKeperawatan[$i]['qty'];
		$update_racikanKeperawatan = $db->query("update tbl_obat set stock_akhir_keperawatan = stock_akhir_keperawatan + $qty_racikanKeperawatan where kode_obat = '" . $data_racikanKeperawatan[$i]['kode_obat'] . "'");
	}
	// akhir kembalikan stok Depo Keperawatan

	$delete = $db->query("delete from tbl_kasir where id='" . $_GET['id'] . "'", 0);
	$delete = $db->query("delete from tbl_kasir_detail where no_kwitansi='" . $no_kw . "'", 0);
	$update = $db->query("update tbl_pendaftaran set status_pasien='OPEN' where no_daftar='$no_daftar'", 0);
	$delete_jurnal = $db->query("delete from tbl_jurnal_otm where no_kwitansi='" . $no_kw . "'");

	//menghapus tabel jurnal
	$delete_jurnal = $db->query("delete from tbl_jurnal where deskripsi like '%".$no_kw."%' or keterangan like '%".$no_kw."%'", 0);

	header("location:../../index.php?mod=kasir&submod=inputKasir");
}
