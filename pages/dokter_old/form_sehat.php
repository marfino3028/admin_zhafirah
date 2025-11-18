<div class="row" id="formSehat" style="display: none;">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl_periksa_kesehatan">Tanggal Periksa Kesehatan*</label>
            <input type="date" value="<?= date('Y-m-d'); ?>" class="form-control" id="tgl_periksa_kesehatan" name="tgl_periksa_kesehatan">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="catatan_keperluan">Keperluan*</label>
            <input type="text" class="form-control" id="catatan_keperluan" name="catatan_keperluan">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="buta_warna">Buta Warna*</label>
            <input type="text" value="Tidak Buta Warna" class="form-control" id="buta_warna" name="buta_warna">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="visus">Visus*</label>
            <input type="text" class="form-control" id="visus" name="visus">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="penyakit_kronis">Riwayat Penyakit Kronis*</label>
            <input type="text" value="Tidak Ada" class="form-control" id="penyakit_kronis" name="penyakit_kronis">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="penyakit_menular">Penyakit Menular*</label>
            <input type="text" value="Tidak Ada" class="form-control" id="penyakit_menular" name="penyakit_menular">
        </div>
    </div>
</div>