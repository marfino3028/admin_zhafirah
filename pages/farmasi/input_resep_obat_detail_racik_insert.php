<?php
session_start();
include "../../3rdparty/engine.php";
ini_set("display_errors", 0);

$insert = $db->query("insert into tbl_racikan (no_resep, nama, user, no_daftar) values ('" . $_POST['resep'] . "', '" . $_POST['racikan'] . "', '" . $_SESSION['rg_user'] . "', '" . $_POST['noPendaftaran'] . "')");
$id_racikan = mysql_insert_id();
?>
<div class="form-group">
    <label for="textfield" class="control-label col-sm-4">Nama Racikan</label>
    <div class="col-sm-8">
        <input type="text" name="nRacikan" id="nRacikan" size="25" value="<?php echo $_POST['racikan'] ?>" class="form-control" tabindex="3" />
    </div>
</div>
<div class="form-group">
    <label for="textfield" class="control-label col-sm-4">Pilih Obat</label>
    <div class="col-sm-8">
        <select id="obatR" name="obatR" size="1" style="width:100%" tabindex="1">
            <option value="">--Pilih Obat--</option>
            <?php
            $obat = $db->query("select * from tbl_obat where status_delete='UD'");
            for ($i = 0; $i < count($obat); $i++) {
                echo '<option value="' . $obat[$i]['kode_obat'] . '"> &nbsp; &nbsp; &nbsp;' . $obat[$i]['nama_obat'] . '</option>';
            }
            ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="textfield" class="control-label col-sm-4">Qty / Jumlah</label>
    <div class="col-sm-8">
        <input type="text" name="qty" id="qty" size="5" class="form-control" tabindex="3" />
    </div>
</div>
<div class="form-actions">
    <input type="hidden" id="id_racikan" name="id_racikan" value="<?php echo $id_racikan ?>" />
    <input type="button" value="Tambahkan Obat" class="btn btn-sm btn-small btn-primary rounded" onclick="simpanObatRacikan()" />
    <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Resep" onclick="simpanData(this.form, 'index.php?mod=farmasi&submod=input_resep')" />
</div>

<script>
    $(document).ready(function() {
        $('#obatR').select2({
            placeholder: 'Pilih obat...',
            allowClear: true
        });
    });
</script>