<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') { 
		$jenis = $db->queryItem("select nama_jns_tarif from tbl_jns_tarif where kode_jns_tarif='".$_POST['id']."'", 0);
		$data = $db->query("select * from tbl_kat_pelayanan where kode_jns_tarif='".$_POST['id']."' and status_delete='UD'");
		echo '<select id="layan" name="layan" size="1" class="form-control" onchange="pilihObat(this.value)">';
		echo '<option value="">--Pilih Jenis Layanan '.$jenis.'--</option>';
		for ($i = 0; $i < count($data); $i++) {
			echo '<option value="'.$data[$i]['kode_kat_pelayanan'].'">'.$data[$i]['nama_kat_pelayanan'].'</option>';
		}
		echo '</select>';
	}
?>