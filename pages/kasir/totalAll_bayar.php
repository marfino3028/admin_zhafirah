
<?php
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";
	$total = $_POST['subtotal'] - $_POST['diskon'];
	if ($_POST['pembulatan'] == '')	$_POST['pembulatan'] = $total;
	$jml_bulat = $_POST['pembulatan'] - $total;
	//$jml_bulat = 0;
	
	if ($_POST['metode'] == 'CC') {
?>
        <div class="form-group">
            <label for="textfield" class="control-label col-sm-3">No Kartu</label>
            <div class="col-sm-9">
                <input type="text" id="nocc" name="nocc" class="form-control" required="required" />
            </div>
        </div>
<?php	
	}
	elseif ($_POST['metode'] == 'DEBIT') {
?>
        <div class="form-group">
            <label for="textfield" class="control-label col-sm-3">No Kartu</label>
            <div class="col-sm-9">
                <select id="NamaBank" name="NamaBank" size="1" class="form-control" required="required">
                    <option value="">--Pilih Bank--</option>
                    <option value="BCA">BCA</option>
                    <option value="MANDIRI">MANDIRI</option>
                    <option value="BNJ">BNI</option>
                </select>
            </div>
        </div>
<?php	
	}
?>
<div class="form-group">
    <label for="textfield" class="control-label col-sm-3">Total Bayar</label>
    <div class="col-sm-9">
        <input type="text" id="total_bayar_all_text" name="total_bayar_all_text" class="form-control text-right" value="<?php echo number_format($total)?>" readonly=""/>
        <input type="hidden" id="total_bayar_all" name="total_bayar_all" value="<?php echo $total?>" style="width: 120px; text-align: right; font-weight: bold" />
    </div>
</div>
<div class="form-group">
    <label for="textfield" class="control-label col-sm-3">Jml Pembulatan</label>
    <div class="col-sm-9">
        <input type="text" id="jml_bulat_text" name="jml_bulat_text" class="form-control text-right" value="<?php echo number_format($jml_bulat)?>" readonly="" />
        <input type="hidden" id="jml_bulat" name="jml_bulat" value="<?php echo $jml_bulat?>" style="width: 120px; text-align: right; font-weight: bold" />
    </div>
</div>