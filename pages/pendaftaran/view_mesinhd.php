<?php
	//print_r($_POST);
	include "../../3rdparty/engine.php";
	$mesinhd = $db->query("select count(id) jumlah from tbl_mesinHD");
	$dipakai = $db->query("select count(a.id) jumlah from tbl_perjanjian a where a.status_pasien='OPEN' and tgl_daftar='".$_POST['tanggal']."'");
	$tersedia = $mesinhd[0]['jumlah'] - $dipakai[0]['jumlah'];
	
	if ($_POST['id'] == 'HE01') {
?>
<div style="margin-top: 25px; margin-left: 10px; margin-right: 10px;">
	<pre style="font-size: 18px;">Total Mesin HD yang tersedia : <?php echo $tersedia?> Unit Mesin HD</pre>
</div>
<?php
	}
?>

