<?php
session_start();
include "../../3rdparty/engine.php";

if ($_SESSION['rg_user'] != '') {
	$vendorid = $db->queryItem("select nama_vendor from tbl_vendor where kode_vendor='" . $_POST['vendor'] . "'");
	$suplierid = $db->queryItem("select nama_suplier from tbl_suplier where kode_suplier='" . $_POST['suplier'] . "'");
	$kategori = $db->query("select id, kategori from tbl_coa_category where id='" . $_POST['kategori_barang'] . "'");
	$golongan = $db->query("select kd_gol, golongan from tbl_gol_obt where kd_gol='" . $_POST['golongan'] . "'");
	$comodity = $db->query("select kd_comodity, comodity from tbl_comodity where kd_comodity='" . $_POST['comodity'] . "'");

	$insert = $db->query("insert into tbl_obat (kode_obat, nama_obat, jenis, satuan_terkecil, stock_akhir, stock_akhir_apotik, stock_min, stock_keluar, vendor_id, vendor, suplier_id, suplier, harga_beli, harga_jual, expire_date, jml_per_box, harga_per_box, stock_min_gudang, stock_min_apotik, satuan_besar, kategori_id, kategori_nama, golongan_kode, golongan_nama, comodity_kode, comodity_nama, ppn, harga_sebelum_ppn, margin, stock_akhir_fisio, stock_akhir_keperawatan) values ('" . $_POST['kode_obat'] . "', '" . $_POST['nama_obat'] . "', '" . $_POST['jenis'] . "', '" . $_POST['satuan'] . "', '" . $_POST['stock_akhir'] . "', '" . $_POST['stock_akhir_apotik'] . "', '" . $_POST['stock_min'] . "', '" . $_POST['stock_keluar'] . "', '" . $_POST['vendor'] . "', '" . $vendorid . "', '" . $_POST['suplier'] . "', '" . $suplierid . "', '" . $_POST['harga_beli'] . "', '" . $_POST['harga_jual'] . "', '" . $_POST['tgl_expired'] . "', '" . $_POST['jml_per_box'] . "', '" . $_POST['harga_per_box'] . "', '" . $_POST['stock_min_gudang'] . "', '" . $_POST['stock_min_apotik'] . "', '" . $_POST['satuan_besar'] . "', '" . $_POST['kategori_barang'] . "', '" . $kategori[0]['kategori'] . "', '" . $_POST['golongan'] . "', '" . $golongan[0]['golongan'] . "', '" . $_POST['comodity'] . "', '" . $comodity[0]['comodity'] . "', '" . $_POST['ppn'] . "', '" . $_POST['sebelum_ppn'] . "', '" . $_POST['margin'] . "', '" . $_POST['stock_akhir_fisio'] . "', '" . $_POST['stock_akhir_keperawatan'] . "')", 1);
	$id = mysql_insert_id();
	$update = $db->query("update tbl_obat set kode_obat='$id' where id='$id'");
}
header("location:../../index.php?mod=farmasi&submod=obat");
