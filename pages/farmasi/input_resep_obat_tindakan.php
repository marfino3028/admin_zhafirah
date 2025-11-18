<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
?>
<div class="form-group">
    <label for="textfield" class="control-label col-sm-4">Nama Tindakan</label>
    <div class="col-sm-8">
        <?php
        $kategori = $db->query("select * from tbl_kat_pelayanan where kode_jns_tarif='2' and status_delete='UD'");
        ?>
        <select id="obat_tindakan" onchange="PilihTindakan(this.value)" name="obat_tindakan" style="width: 100%;">
            <option value=""></option>
            <?php
            for ($i = 0; $i < count($kategori); $i++) {
                $kodePelayanan = $kategori[$i]['kode_kat_pelayanan'];
                $obat = $db->query("select * from tbl_tarif where kode_jns_tarif='2' and status_delete='UD' and kode_kat_pelayanan = '$kodePelayanan'");
                echo '<optgroup label="' . $kategori[$i]['nama_kat_pelayanan'] . '">';
                for ($x = 0; $x < count($obat); $x++) {
                    echo '<option value="' . $obat[$x]['kode_tarif'] . '">' . $obat[$x]['nama_pelayanan'] . '</option>';
                }
                echo '</optgroup>';
            }
            ?>
        </select>

        <script>
            $(document).ready(function() {
                $('#obat_tindakan').select2({
                    placeholder: 'Pilih tindakan...',
                    allowClear: true
                });
            });
        </script>
    </div>
</div>
<div class="form-group">
    <label for="textfield" class="control-label col-sm-4">Tarif Tindakan</label>
    <div class="col-sm-8">
        <div id="TarifTindakan">
            <input type="text" id="tTindakan" name="tTindakanText" value="0" class="form-control text-right" style="font-weight: bold" />
            <input type="hidden" id="tTindakan" name="tTindakan" value="0" style="width: 120px; text-align: right; font-weight: bold" />
        </div>
    </div>
</div>
<div class="form-group">
    <label for="textfield" class="control-label col-sm-4">Qty/Jml</label>
    <div class="col-sm-8">
        <input type="text" id="qty" name="qty" value="1" class="form-control text-right" />
    </div>
</div>
<div class="form-actions">
    <input type="button" value="Simpan Tindakan" onclick="TambahTindakan()" class="btn btn-sm btn-small btn-primary rounded" />
</div>
