<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../../3rdparty/engine.php";
	//echo '<pre>';
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		//echo "$mulai dan $selesai dan selisihnya adalah ".$diff->m;
		$data = $db->query("select * from tbl_bhp where md5(id)='".$_POST['bhp']."'", 1);
		$sub = $db->query("select * from tbl_bph_detail where md5(bphID)='".$_POST['bhp']."'", 1);
		//print_r($data);
		//print_r($sub);
		$medication = $db->query("select * from tbl_medication where md5(no_daftar)='".$_POST['id']."'");
		//print_r($medication);
		for ($i = 0; $i < count($sub); $i++) {
		    $insert = $db->query("insert into tbl_medication_detail (medication_id, no_medication, kode_obat, nama_obat, jenis, satuan, qty, harga, total, bhp_id, bhp_nama, bhp_detail_id) values ('".$medication[0]['id']."', '".$medication[0]['no_medication']."', '".$sub[$i]['kode_obat']."', '".$sub[$i]['nama_obat']."', 'OBT-MEDICATION', '".$sub[$i]['satuan']."', '".$sub[$i]['qty']."', '".$sub[$i]['harga_satuan']."', '".$sub[$i]['qty']*$sub[$i]['harga_satuan']."', '".$data[0]['id']."', '".$data[0]['nm_bhp']."', '".$sub[$i]['id']."')", 0);
		}

		header("location:../../index.php?mod=hd&submod=medication&id=".$_POST['id']);

	}
?>