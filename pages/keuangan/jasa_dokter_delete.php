<?php
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	$data = $db->query("select * from tbl_bayar_dokter where id='".$_GET['id']."'");
	$sub = $db->query("select * from tbl_bayar_dokter_detail where bayar_dokter_id='".$_GET['id']."'");
	
	$date1 = $data[0]['tgl_start'];
	$date2 = $data[0]['tgl_end'];
	if ($date1 == $date2) {
		$subID = $db->query("select a.id, a.status_bayar_dokter from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and b.kode_dokter='".$data[0]['kode_dokter']."' and a.status_bayar_dokter='SDH' order by a.tgl_insert desc", 0);
	}
	else {
		$subID = $db->query("select a.id, a.status_bayar_dokter from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert <= '$date2' and b.kode_dokter='".$data[0]['kode_dokter']."' and a.status_bayar_dokter='SDH' order by tgl_insert desc", 0);
	}
	
	for ($i = 0; $i < count($subID); $i++) {
		//echo $subID[$i]['status_bayar_dokter'].'<br>';
		$update = $db->query("update tbl_kasir set status_bayar_dokter='BLM' where id='".$subID[$i]['id']."'");
	}
	
	$delete = $db->query("delete from tbl_bayar_dokter where id='".$_GET['id']."'");
	$delete = $db->query("delete from tbl_bayar_dokter_detail where bayar_dokter_id='".$_GET['id']."'");
	
	header("location:../../index.php?mod=keuangan&submod=jasa_dokter");
?>