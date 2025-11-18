<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	$insert = $db->query("insert into tbl_penjualan_obat_racikan (no_penjualan, nama, user) values ('".$_POST['resep']."', '".$_POST['racikan']."', '".$_SESSION['rg_user']."')");
	$id_racikan = mysql_insert_id();
?>

<div class="form-group">
    <label for="textfield" class="control-label col-sm-4">Nama Racikan</label>
    <div class="col-sm-8">
        <input type="text" name="nRacikan" id="nRacikan" value="<?php echo $_POST['racikan']?>" class="form-control" tabindex="3" />
    </div>
</div>
<div class="form-group">
    <label for="textfield" class="control-label col-sm-4">Pilih Obat</label>
    <div class="col-sm-8">
        <select id="obatR" name="obatR" size="1" class="form-control" tabindex="1">
            <option value="">--Pilih Obat--</option>
            <?php
            $obat = $db->query("select * from tbl_obat where status_delete='UD'");
            for ($i = 0; $i < count($obat); $i++) {
                echo '<option value="'.$obat[$i]['kode_obat'].'"> &nbsp; &nbsp; &nbsp;'.$obat[$i]['nama_obat'].'</option>';
            }
            ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="textfield" class="control-label col-sm-4">Qty / Jumlah</label>
    <div class="col-sm-8">
        <input type="text" name="qty" id="qty" size="5" style="text-align: right" tabindex="3" />
    </div>
</div>
<div class="form-actions">
    <input type="hidden" id="id_racikan" name="id_racikan" value="<?php echo $id_racikan?>" />
    <input type="button" value="Tambahkan Obat" onclick="simpanObatRacikan()" class="btn btn-sm btn-small btn-primary rounded" />
    <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Penjualan" onclick="simpanData(this.form, 'index.php?mod=farmasi&submod=jual_langsung')" />
</div>
