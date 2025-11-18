<?php
	if ($_POST['metode'] == 'CC') {
?>
        <div class="form-group">
            <label for="textfield" class="control-label col-sm-4">No Kartu</label>
            <div class="col-sm-8">
                <input type="text" id="nocc" name="nocc" class="form-control" required="required"/>
            </div>
        </div>
<?php	
	}
	elseif ($_POST['metode'] == 'DEBIT') {
?>
        <div class="form-group">
            <label for="textfield" class="control-label col-sm-4">No Kartu</label>
            <div class="col-sm-8">
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
