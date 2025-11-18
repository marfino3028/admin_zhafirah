<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Golongan Obat</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Golongan Obat
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/gol_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Golongan</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="kd_gol" name="kd_gol" class="form-control"  tabindex="1" />
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Golongan</label>
                                            <div class="col-sm-10">
                                                <textarea tabindex="2" cols="50" rows="2" class="form-control" name="golongan" id="golongan" tabindex="3" ></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
					<label class="control-label col-sm-2">Jenis Item</label>
					<div class="col-sm-2">
					<div class="radio">
						<label>
						<input type="radio" value="Obat" id="jenis_item" name="jenis_item">Obat
						</label>
						</div>
					<div class="radio">
						<label>
						<input type="radio" value="Logistik" id="jenis_item" name="jenis_item">Logistik
						</label>
					</div>
					</div>
                                        </div>
                                        <div class="form-group">
					<label class="control-label col-sm-2">Is Mims</label>
					<div class="col-sm-2">
					<div class="radio">
						<label>
						<input type="radio" value="Ya" id="is_mims" name="is_mims">Ya
						</label>
						</div>
					<div class="radio">
						<label>
						<input type="radio" value="Tidak" id="is_mims" name="is_mims">Tidak
						</label>
					</div>
					</div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Master Golongan Obat" tabindex="5" onclick="simpanData(this.form, 'pages/master/gol_insert.php')" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
