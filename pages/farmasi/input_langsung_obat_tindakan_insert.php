<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	$obt = $db->queryItem("select nama_pelayanan from tbl_tarif where kode_tarif='".$_POST['obat']."' and kode_jns_tarif='2'", 0);
	$totTarif = $_POST['tarif'] * $_POST['qty'];
	$insert = $db->query("insert into tbl_tindakan_langsung (no_penjualan, kode_tarif, nama_tindakan, tarif_asli, tarif, qty) values ('".$_POST['resep']."', '".$_POST['obat']."', '".$obt."', '".$_POST['tarif']."', '".$totTarif."', '".$_POST['qty']."')", 0);
	
?>
<script language="javascript">
	location.reload(); 
</script>