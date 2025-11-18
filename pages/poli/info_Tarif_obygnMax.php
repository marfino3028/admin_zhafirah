<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$info = $db->queryItem("select tarif_max from tbl_tarif where kode_tarif='".$_POST['kode']."'");
		echo '<input type="text" name="tarif_max" id="tarif_max" size="7" style="text-align: right" value="'.number_format($info).'" readonly="" />';
		echo '<input type="hidden" name="tarif_maxNo" id="tarif_maxNo" size="7" style="text-align: right" value="'.$info.'" readonly="" />';
	}

?>