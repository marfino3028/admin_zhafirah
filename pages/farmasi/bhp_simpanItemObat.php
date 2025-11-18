<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
	    $obat = $db->query("select * from tbl_obat where kode_obat='".$_POST['kode']."'");
		$insert = $db->query("insert into tbl_bph_detail (bphID, kode_obat, nama_obat, qty, harga_satuan, harga_beli, satuan) values ('".$_POST['id']."', '".$_POST['kode']."', '".$obat[0]['nama_obat']."', '".$_POST['qty']."', '".$obat[0]['harga_jual']."', '".$obat[0]['harga_beli']."', '".$obat[0]['satuan_terkecil']."')");
	}
?>

<script language="javascript">
    location.reload();
</script>