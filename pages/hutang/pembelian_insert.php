
<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	//echo '<pre>';
	//print_r($_POST);

	if ($_SESSION['rg_user'] != "") {
		$data = $db->query("select * from tbl_penerimaan where no_penerimaan='".$_POST['nodaftar']."'");
		$sub = $db->query("select * from tbl_penerimaan_detail where no_penerimaan='".$_POST['nodaftar']."'");
		$total = $db->query("select sum(harga_beli*qty) jumlah from tbl_penerimaan_detail where no_penerimaan='".$_POST['nodaftar']."' and status_delete='UD'");
		//print_r($data);
		//print_r($total);
		//print_r(round($ppn));

		//masukkan ke header di hutang pembelian
		if ($_POST['diskon'] == "") $_POST['diskon'] = 0;
		$insert = $db->query("insert into tbl_hutang_pembelian (tgl_ap, jatuh_tempo, tgl_faktur_pajak, faktur_pajak, invoice, keterangan, suplier_kode, suplier_nama, diskon, retur, dp, biaya_lainnya, total) values ('".$_POST['tgl_ap']."', '".$_POST['jatuh_tempo']."', '".$_POST['tgl_faktur_pajak']."', '".$_POST['faktur_pajak']."', '".$_POST['invoice']."', '".$_POST['keterangan']."', '".$data[0]['kode_supplier']."', '".$data[0]['nama_supplier']."', '".$_POST['diskon']."', '".$_POST['retur']."', '".$_POST['dp']."', '".$_POST['lain']."', '0')", 1);
		$id = mysql_insert_id();
		for ($i = 0; $i < count($sub); $i++) {
			$vari = 'checkbox'.$sub[$i]['id'];
			if ($_POST[$vari] != "") {
				$insert = $db->query("insert into tbl_hutang_pembelian_detail (hutang_id, no_penerimaan, kode_obat, nama_obat, qty, harga_beli, total, margin_obat, harga_jual, expired_date) values ('".$id."', '".$_POST['nodaftar']."', '".$sub[$i]['kode_obat']."', '".$sub[$i]['nama_obat']."', '".$sub[$i]['qty']."', '".$sub[$i]['harga_beli']."', '".$sub[$i]['total']."', '".$sub[$i]['margin_obat']."', '".$sub[$i]['harga_jual']."', '".$sub[$i]['expired_date']."')", 1);
				//echo "insert into tbl_hutang_pembelian_detail (hutang_id, no_penerimaan, kode_obat, nama_obat, qty, harga_beli, total, margin_obat, harga_jual, expired_date) values ('".$id."', '".$_POST['nodaftar']."', '".$sub[$i]['kode_obat']."', '".$sub[$i]['nama_obat']."', '".$sub[$i]['qty']."', '".$sub[$i]['harga_beli']."', '".$sub[$i]['total']."', '".$sub[$i]['margin_obat']."', '".$sub[$i]['harga_jual']."', '".$sub[$i]['expired_date']."')<br>";
				$ttlAll = $ttlAll + ($sub[$i]['harga_beli'] * $sub[$i]['qty']);
			}
		}
		$ppn = $ttlAll * 11 / 100;
		$all = $ttlAll - $_POST['diskon'] - $_POST['retur'] - $_POST['dp'] + $ppn + $_POST['lain'];
		$udpdate = $db->query("update tbl_hutang_pembelian set subtotal='$ttlAll', ppn='$ppn', ppn_persen='11', total='$all' where id='$id'");

	}
	header("location:../../index.php?mod=hutang&submod=pembelian");
?>