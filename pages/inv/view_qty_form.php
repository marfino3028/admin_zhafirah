<?php
    ini_set("display_errors", 0);
    include "../../3rdparty/engine.php";
    $noRO = $db->query("select id, qty from tbl_ro_to_gudang_detail where id='" . $_POST['id'] . "'");
?>

<input type="text" id="qty_change" name="qty_change" class="form-control"  value="<?php echo $noRO[0]['qty']?>" onkeydown="SimpanQTY(this.value, '<?php echo $_POST['id']?>', event)" />

<script language="Javascript">
	document.getElementById("qty_change").focus();
</script>