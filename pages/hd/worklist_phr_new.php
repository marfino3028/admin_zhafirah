<?php
	$pasien = $db->query("select * from tbl_pasien where md5(nomr)='".$_GET['id']."'");
	$daftar_pasien = $db->query("select * from tbl_pendaftaran where md5(no_daftar)='".$_GET['ids']."'");
	//print_r($daftar_pasien);
?>
<div class="box box-color box-bordered box-small blue">
    <div class="box-title">
        <h3>
            <i class="fa fa-edit"></i>
            Form Tambah Data Dokumen PHR
    </div>
    <div class="box-content nopadding">
        <form action="pages/hd/worlist_phr_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Nomor MR</label>
                        <div class="col-sm-10">
                            <?php echo $daftar_pasien[0]['nomr'];?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Nomor Daftar</label>
                        <div class="col-sm-10">
                            <?php echo $daftar_pasien[0]['no_daftar']?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Nama Pasien</label>
                        <div class="col-sm-10">
                            <?php echo $pasien[0]['nm_pasien']?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Tanggal Pemeriksaan</label>
                        <div class="col-sm-3">
                            <input type="date" id="tgl_lahirs" name="tgl_lahir" value="<?php echo date("Y-m-d")?>" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Dokter Perujuk</label>
                        <div class="col-sm-10">
                            <!--<select class="form-control" id="dokter" name="dokter" required="required">
                                <option value="">--Pilih Dokter Perujuk--</option>
                                <?php
                                    $sub = $db->query("select kode_dokter, nama_dokter from tbl_dokter where status_delete='UD' ");
                                    for ($i = 0; $i < count($sub); $i++) {
                                        echo '<option value="'.$sub[$i]['kode_dokter'].'">'.$sub[$i]['nama_dokter'].'</option>';
                                    }
                                ?>
                            </select>-->
			    <input type="text" id="dokter" name="dokter" placeholder="Nama Dokter Perujuk" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Upload Dokumen PHR</label>
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
                    <div class="form-actions">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                        <input type="hidden" name="ids" value="<?php echo $_GET['ids']?>">
                        <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Dokumen PHR" />
                        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-success rounded" value="List/Daftar Dokumen PHR" onclick="simpanData(this.form, 'index.php?mod=hd&submod=worklist_phr&id=<?php echo $_GET['id'].'&ids='.$_GET['ids']?>')" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
