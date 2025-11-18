<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Konfigurasi</a>
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
                                        Form Tambah Data Master Konfigurasi
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/konfigurasi_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Konfigurasi</label>
                                            <div class="col-sm-10">
                                                    <input type="text" id="kode" name="kode" class="form-control" tabindex="1" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Deskripsi</label>
                                            <div class="col-sm-10">
                                                    <input type="text" id="desc" name="desc" class="form-control" tabindex="2" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Tahun</label>
                                            <div class="col-sm-10">
                                                    <select id="tahun" name="tahun" size="1" class="form-control">
                                                        <option value="">--Pilih Tahun--</option>
                                                        <?php
                                                        $y1 = date("Y") - 5;
                                                        $y2 = date("Y") + 5;
                                                        for ($i = $y1; $i <= $y2; $i++) {
                                                            if ($i == date("Y")) {
                                                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                                            }
                                                            else {
                                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nilai Konfigurasi</label>
                                            <div class="col-sm-10">
                                                    <input type="text" id="nilai" name="nilai" class="form-control text-right" tabindex="2" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                                <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Master Konfigurasi" tabindex="5" onclick="simpanData(this.form, 'pages/master/konfigurasi_insert.php')" />
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