<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') { 
		$data = $db->query("select * from tbl_tarif where kode_kat_pelayanan='".$_POST['id']."' and status_delete='UD'");
		echo '<select id="obat" name="obat" size="1" class="form-control" onchange="TampilHarga(this.value)">';
		echo '<option value="">--Pilih Jenis Layanan --</option>';
		for ($i = 0; $i < count($data); $i++) {
			echo '<option value="'.$data[$i]['kode_tarif'].'">'.$data[$i]['nama_pelayanan'].'</option>';
		}
		echo '</select>';
	}
?>