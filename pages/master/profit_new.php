<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Profit & Cost Center
                </a>
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
                                        Master Profit & Cost Center
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/profit_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Profit / Cost Center</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="kd_profit" name="kd_profit" class="form-control" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Profit / Cost Center</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="nm_profit" name="nm_profit" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Profit Type</label>                                           
                                            <div class="col-sm-2">
                                                <select id="profit_type" name="profit_type" size="1" class="form-control">
                                                    <option value="">--Pilih Profit Type--</option>
                                                    <option value="Profit Center">Profit Center</option>
                                                    <option value="Cost Center">Cost Center</option>
                                                </select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Group Profit Center</label>                                           
                                            <div class="col-sm-5">
                                                <select id="group_type" name="group_type" size="1" class="form-control">
                                                    <option value="">--Pilih Group Profit Center--</option>
                                                    <option value="Cost Center">Cost Center</option>
                                                    <option value="Pendapatan Poliklinik">Pendapatan Poliklinik</option>
                                                    <option value="Pendapatan Penunjang Medis">Pendapatan Penunjang Medis</option>
                                                    <option value="Pendapatan Hemodialisa">Pendapatan Hemodialisa</option>
                                                    <option value="Pendapatan MCU">Pendapatan MCU</option>
						    <option value="Pendapatan Rawat Inap">Pendapatan Rawat Inap</option>
                                                    <option value="Pendapatan Lainnya">Pendapatan Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data" onclick="simpanData(this.form, 'pages/master/profit_insert.php')" />
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