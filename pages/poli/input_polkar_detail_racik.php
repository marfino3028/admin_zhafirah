<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
?>
<div class="form-group">
    <label for="textfield" class="control-label col-sm-4">Nama Racikan</label>
    <div class="col-sm-8">
        <div class="input-group">
            <input type="text" name="nRacikan" id="nRacikan"  tabindex="3"  class="form-control" />
            <div class="input-group-btn">
                <input type="button" value="Add" onclick="TambahRacikan()" class="btn btn-sm btn-small btn-primary rounded" />
            </div>
        </div>
    </div>
</div>
