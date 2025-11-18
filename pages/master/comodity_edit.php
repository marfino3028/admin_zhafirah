<?php
	$data = $db->query("select * from tbl_comodity where id='".$_GET['id']."'");
?>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Comodity</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Edit Data</a>
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
                                        Edit Master Comodity
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/comodity_update.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Vendor/Pabrik</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="kd_comodity" name="kd_comodity" class="form-control" value="<?php echo $data[0]['kd_comodity']?>" tabindex="1" / readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Comodity</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="comodity" name="comodity" class="form-control" tabindex="2" value="<?php echo $data[0]['comodity']?>" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" id="id" name="id" value="<?php echo $data[0]['id']?>" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Update Comodity" tabindex="5" onclick="simpanData(this.form, 'pages/master/comodity_update.php')" />
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