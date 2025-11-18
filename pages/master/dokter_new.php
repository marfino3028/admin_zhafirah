<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Dokter</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data Dokter</a>
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
                                        Form Tambah Data Master Dokter
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/master/dokter_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Dokter</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="kode_dokter" name="kode_dokter" class="form-control" placeholder="Kode Dokter" required="required" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2" style="text-align: right;">Nama Dokter</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="nama_dokter" name="nama_dokter" class="form-control" placeholder="Nama Dokter" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Spesialis</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="spesialis" name="spesialis" class="form-control" placeholder="Spesialis" />
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="hp" name="hp" class="form-control" placeholder="Nomor HP" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Poli</label>
                                            <div class="col-sm-5">
                                                <select id="kd_poli" name="kd_poli" size="1" class="form-control">
                                                    <option value="">--Pilih Poli--</option>
                                                    <?php
                                                    $layanan = $db->query("select kd_poli as kode, nama_poli as nama from tbl_poli where status_delete='UD'");
                                                    for ($i = 0; $i < count($layanan); $i++) {
                                                        echo '<option value="'.$layanan[$i]['kode'].'">'.$layanan[$i]['kode'].' - '.$layanan[$i]['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2" style="text-align: right;">Nomor KTP</label>
                                            <div class="col-sm-3">
                                                <input type="text" id="noktp" name="noktp" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Tempat Lahir</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="tmpt_lahir" name="tmpt_lahir" class="form-control" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1" style="text-align: right">Tgl Lahir</label>
                                            <div class="col-sm-2">
                                                 <input type="date" id="tanggal_lahir" name="tgl_lahir" class="form-control" value="<?php echo date("Y-m-d", strtotime("-10 year"))?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2" style="text-align: right;">Jenis Kelamin</label>
                                            <div class="col-sm-3">
                                                <select id="jk" name="jk" class="form-control">
                                                    <option value="">--Pilih Jenis Kelamin--</option>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                        		    <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Upload Foto</label>
                                            <div class="col-sm-10">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-default btn-file btn-success">
                                                        <span class="fileinput-new">&nbsp;Pilih/Ambil file&nbsp;</span>
                                                    <span class="fileinput-exists">Ganti</span>
                                                    <input type="file" name="dokumen" accept="image/*">
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                </div>
					    </div>
                        		</div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">No.SIP</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="no_sip" name="no_sip" class="form-control" required="required" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Masa Berlaku SIP</label>
                                            <div class="col-sm-2">
                                                <input type="date" id="tgl_sip" name="tgl_sip" class="form-control" value="<?php echo date("Y-m-d");?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">No.STR</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="no_str" name="no_str" class="form-control" required="required" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Masa Berlaku STR</label>
                                            <div class="col-sm-2">
                                                <input type="date" id="tgl_str" name="tgl_str" class="form-control" value="<?php echo date("Y-m-d");?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">No.Kredensial</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="no_kre" name="no_kre" class="form-control" required="required" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Masa Berlaku Kredensial</label>
                                            <div class="col-sm-2">
                                                <input type="date" id="tgl_kre" name="tgl_kre" class="form-control" value="<?php echo date("Y-m-d");?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-12" style="font-size: 16px; font-weight: bold;">Informasi Rekening Dokter</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Bank</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="bank" name="bank" class="form-control" required="required" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2" style="text-align: right;">Bank Cabang</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="bank_c" name="bank_c" class="form-control" required="required" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2" style="text-align: right;">Bank Atas Nama</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="bank_an" name="bank_an" class="form-control" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Bank No Rekening</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="norek" name="norek" class="form-control" required="required" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2" style="text-align: right;">NPWP</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="npwp" name="npwp" class="form-control" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-12" style="font-size: 16px; font-weight: bold;">Informasi Tarif Dokter</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Tarif Dokter</label>
                                            <div class="col-sm-4">
                                                <input type="number" id="tarif_dokter" name="tarif_dokter" class="form-control" value="0" />
                                            </div>
					    <label for="textfield" class="control-label col-sm-6">Harus Menggunakan Angka</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Tarif Jamsostek</label>
                                            <div class="col-sm-4">
                                                <input type="number" id="jamsostek" name="jamsostek" class="form-control" value="0" />
                                            </div>
					    <label for="textfield" class="control-label col-sm-6">Harus Menggunakan Angka</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Proffesional Fee</label>
                                            <div class="col-sm-4">
                                                <input type="number" id="professional_fee" name="professional_fee" class="form-control" value="0" />
                                            </div>
					    <label for="textfield" class="control-label col-sm-6">Harus Menggunakan Angka</label>
                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Dokter" />
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