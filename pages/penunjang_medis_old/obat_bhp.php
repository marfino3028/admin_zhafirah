<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$info = $db->queryItem("select harga_jual from tbl_obat where kode_obat='".$_POST['kode']."'");
		echo '<input type="text" name="tarif" id="tarif" size="5" class="form-control text-right" value="'.number_format($info).'" readonly="" />';
		echo '<input type="hidden" name="tarifNo" id="tarifNo" size="5" style="text-align: right" value="'.$info.'" />';
		echo '<input type="hidden" name="kode" id="kode" size="5" style="text-align: right" value="'.$_POST['kode'].'" />';
	}

?>