<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$info = $db->query("select * from tbl_obat where id='".$_POST['kode']."'", 0);
		echo '<input type="text" name="Tarif_Label" id="Tarif_Label" size="5" style="text-align: right" value="'.number_format($info[0]['harga_jual']).'" readonly="" class="form-control" />';
		echo '<input type="hidden" name="Tarif" id="Tarif" size="5" style="text-align: right" value="'.$info[0]['harga_jual'].'" readonly=""  class="form-control" />';
		echo '<input type="hidden" name="id_obat" value="'.md5($info[0]['id']).'"/>';
	}

?>
