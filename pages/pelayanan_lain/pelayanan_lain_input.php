<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pelayanan Lain
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
                                        Form Tambah Data Pelayanan Lain
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/pelayanan_lain/pelayanan_lain_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-column form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Nama Pasien</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="nama_pasien" name="nama_pasien" class="form-control" width="500"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Tanggal Lahir</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" width="150"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2"> Pilih Jaminan </label>
                                                    <div class="col-sm-10">
                                                        <select id="kode_perusahaan" name="kode_perusahaan" size="1" class="form-control">
                                                            <option value="">Pilih Jaminan</option>
                                                            <?php
                                                            $prsh = $db->query("select * from tbl_perusahaan where status_delete='UD'");
                                                            for ($i = 0; $i < count($prsh); $i++) {
                                                                echo '<option value="'.$prsh[$i]['id'].'">'.$prsh[$i]['nama_perusahaan'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 container-fluid">
                                                <div id="data_pasien"></div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded"  value="Simpan Data"  />
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