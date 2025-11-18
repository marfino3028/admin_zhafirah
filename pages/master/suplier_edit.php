<?php
	$data = $db->query("select * from tbl_suplier where id='".$_GET['id']."'");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Suplier</a>
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
                                        Form Edit Data Master Suplier
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/suplier_update.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Suplier</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="kode_suplier" name="kode_suplier" class="form-control"  value="<?php echo $data[0]['kode_suplier']?>" tabindex="1" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Suplier</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nama_suplier" name="nama_suplier" class="form-control" tabindex="2" value="<?php echo $data[0]['nama_suplier']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Alamat Suplier</label>
                                            <div class="col-sm-10">
                                                <textarea tabindex="2" cols="50" rows="2" class="form-control" name="alamat_suplier" id="alamat_suplier" tabindex="3" ><?php echo $data[0]['alamat_suplier']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Contact Person</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="contact_suplier" name="contact_suplier" class="form-control" tabindex="4" value="<?php echo $data[0]['contact_suplier']?>" />
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <input type="hidden" id="id" name="id" value="<?php echo $data[0]['id']?>" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Master Suplier" tabindex="5" onclick="simpanData(this.form, 'pages/master/suplier_update.php')" />
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