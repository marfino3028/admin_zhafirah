<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$info = $db->queryItem("select tarif_max from tbl_tarif where kode_jns_tarif='99'");
		echo '<input type="text" name="Tarif_Label" id="Tarif_Label" size="5" style="text-align: right" value="'.number_format($info).'" readonly="" class="form-control" />';
		echo '<input type="hidden" name="Tarif" id="Tarif" size="5" style="text-align: right" value="'.$info.'" readonly=""  class="form-control" />';
	}

?>
