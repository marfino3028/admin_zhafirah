<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		//input ke tabel detail resep pasien
		$obat = explode('###', $_POST['obat']);
		$obt = $db->query("select * from tbl_obat where kode_obat='$obat[1]'");
		$insert = $db->query("insert into tbl_polkar_detail (polkar_id, no_polkar, kode_obat, nama_obat, jenis, satuan, qty, harga, total) values ('".$_POST['id']."', '".$_POST['polkar']."', '".$obat[1]."', '".$obt[0]['nama_obat']."', '".$obat[0]."', '".$obt[0]['satuan_terkecil']."', '".$_POST['qty']."', '".$obt[0]['harga_beli']."', '$total')", 0);
		$sid = mysql_insert_id();
		$update = $db->query("update tbl_polkar_detail set total = qty*harga where id='$sid'");
		$total_harga = $db->queryItem("select sum(total) from tbl_polkar_detail where no_polkar='".$_POST['polkar']."' and status_delete='UD'");
		$update = $db->query("update tbl_polkar set total_harga_polkar='".$total_harga."' where no_polkar='".$_POST['polkar']."'");
	}
?>
<script language="javascript">reload_ulang()</script>