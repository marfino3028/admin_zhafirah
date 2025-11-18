<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
            //$obat = $db->query("select * from tbl_tarif where kode_jns_tarif='8' and status_delete='UD'", 1);
?>
<div class="form-group">
    <label for="textfield" class="control-label col-sm-4">Nama Alkes</label>
    <div class="col-sm-8">
        <select id="obat_tindakan" name="obat_tindakan" size="1" style="width:100%" tabindex="5" onchange="PilihAlkes(this.value)">
            <option value="">--Pilih Alkes--</option>
            <?php
            $obat = $db->query("select * from tbl_tarif where kode_jns_tarif='8' and status_delete='UD'");
            for ($i = 0; $i < count($obat); $i++) {
                echo '<option value="'.$obat[$i]['kode_tarif'].'">'.$obat[$i]['nama_pelayanan'].'</option>';
            }
            ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="textfield" class="control-label col-sm-4">Tarif Alkes</label>
    <div class="col-sm-8">
        <div id="TarifAlkes">
            <input type="text" id="tAlkes" name="tAlkesText" value="0" class="form-control text-right" style="font-weight: bold" />
            <input type="hidden" id="tAlkes" name="tAlkes" value="0" class="form-control" style="width: 120px; text-align: right; font-weight: bold" />
        </div>
    </div>
</div>
<div class="form-actions">
    <input type="button" value="Simpan Alkes" onclick="TambahAlkes()" class="btn btn-sm btn-small btn-primary rounded" />
</div>

	<script>
            $(document).ready(function() {
                $('#obat_tindakan').select2({
                    placeholder: 'Pilih alkes...',
                    allowClear: true
                });
            });
        </script>