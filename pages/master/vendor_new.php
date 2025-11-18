<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Vendor/Pabrik</a>
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
                                        Form Tambah Data Master Vendor/Pabrik
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/vendor_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Vendor/Pabrik</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="kode_vendor" name="kode_vendor" class="form-control"  tabindex="1" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Vendor/Pabrik</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nama_vendor" name="nama_vendor" class="form-control" tabindex="2" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Alamat Vendor/Pabrik</label>
                                            <div class="col-sm-10">
                                                <textarea tabindex="2" cols="50" rows="2" class="form-control" name="alamat_vendor" id="alamat_vendor" tabindex="3" ></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Contact Person</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="contact_vendor" name="contact_vendor" class="form-control" tabindex="4" />
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Master Vendor/Pabrik" tabindex="5" onclick="simpanData(this.form, 'pages/master/vendor_insert.php')" />
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
