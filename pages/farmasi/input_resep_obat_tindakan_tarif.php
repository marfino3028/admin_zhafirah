<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	$tarif = $db->queryItem("select tarif_max from tbl_tarif where kode_tarif='".$_POST['id']."'");
?>
<input type="text" id="tTindakanText" name="tTindakanText" value="<?php echo number_format($tarif)?>" class="form-control" style="width: 120px; text-align: right; font-weight: bold" />
<input type="hidden" id="tTindakan" name="tTindakan" value="<?php echo $tarif?>" class="form-control" style="width: 120px; text-align: right; font-weight: bold" />