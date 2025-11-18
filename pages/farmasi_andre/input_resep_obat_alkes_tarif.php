<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	$tarif = $db->queryItem("select tarif_max from tbl_tarif where kode_tarif='".$_POST['id']."'");
?>
<input type="text" id="tAlkes" name="tAlkes" value="0" class="form-control" style="width: 120px; text-align: right; font-weight: bold" />
