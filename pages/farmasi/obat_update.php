<?php
session_start();
include "../../3rdparty/engine.php";

if ($_SESSION['rg_user'] != '') {
	$vendorid = $db->queryItem("select nama_vendor from tbl_vendor where kode_vendor='" . $_POST['vendor'] . "'");
	$suplierid = $db->queryItem("select nama_suplier from tbl_suplier where kode_suplier='" . $_POST['suplier'] . "'");
	$kategori = $db->query("select id, kategori from tbl_coa_category where id='" . $_POST['kategori_barang'] . "'");
	$golongan = $db->query("select kd_gol, golongan from tbl_gol_obt where kd_gol='" . $_POST['golongan'] . "'");
	$comodity = $db->query("select kd_comodity, comodity from tbl_comodity where kd_comodity='" . $_POST['comodity'] . "'");

	$insert = $db->query("update tbl_obat set nama_obat='" . $_POST['nama_obat'] . "', jenis='" . $_POST['jenis'] . "', satuan_terkecil='" . $_POST['satuan'] . "', stock_akhir='" . $_POST['stock_akhir'] . "', stock_min='" . $_POST['stock_min'] . "', vendor_id='" . $_POST['vendor'] . "', vendor='" . $vendorid . "', suplier_id='" . $_POST['suplier'] . "', suplier='" . $suplierid . "', harga_beli='" . $_POST['harga_beli'] . "', harga_jual='" . $_POST['harga_jual'] . "', expire_date='" . $_POST['tgl_expired'] . "', jml_per_box='" . $_POST['jml_per_box'] . "', harga_per_box='" . $_POST['harga_per_box'] . "', stock_min_gudang='" . $_POST['stock_min_gudang'] . "', stock_min_apotik='" . $_POST['stock_min_apotik'] . "', satuan_besar='" . $_POST['satuan_besar'] . "', kategori_id='" . $_POST['kategori_barang'] . "', kategori_nama='" . $kategori[0]['kategori'] . "', golongan_kode='" . $_POST['golongan'] . "', golongan_nama='" . $golongan[0]['golongan'] . "', comodity_kode='" . $_POST['comodity'] . "', comodity_nama='" . $comodity[0]['comodity'] . "', stock_keluar='" . $_POST['stock_keluar'] . "', stock_akhir_apotik='" . $_POST['stock_akhir_apotik'] . "', ppn='" . $_POST['ppn'] . "', harga_sebelum_ppn='" . $_POST['sebelum_ppn'] . "', margin='" . $_POST['margin'] . "', stock_akhir_fisio='" . $_POST['stock_akhir_fisio'] . "', stock_akhir_keperawatan='" . $_POST['stock_akhir_keperawatan'] . "' where md5(id)='" . $_POST['id'] . "'", 0);
}
header("location:../../index.php?mod=farmasi&submod=obat");
