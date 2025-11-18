<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	$data = $db->query("select * from tbl_poli where id='".$_GET['id']."'");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">
                    Poli / Layanan
                </a>
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
                                        Form Edit Data Master Poli
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/poli_update.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-1">Kode Poli</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="kd_poli" name="kd_poli" class="form-control" readonly="readonly" style="50px" value="<?php echo $data[0]['kd_poli']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Nama Poli</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="nama_poli" name="nama_poli" class="form-control" value="<?php echo $data[0]['nama_poli']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-1">Tarif Poli</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="tarif" name="tarif" class="form-control" value="<?php echo $data[0]['tarif']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Profit Center</label>                                           
                                            <div class="col-sm-4">
                                                        <select class="form-control" id="profit" name="profit">
                                                            <option value="">--Pilih Profit Center--</option>
                                        					<?php
                                        					    $sub = $db->query("select kd_profit, nm_profit from tbl_profit");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        if ($data[0]['kd_profit'] == $sub[$i]['kd_profit']) echo '<option value="'.$sub[$i]['kd_profit'].'" selected>'.$sub[$i]['nm_profit'].'</option>';
                                        					    else 
                                        					        echo '<option value="'.$sub[$i]['kd_profit'].'">'.$sub[$i]['nm_profit'].'</option>';
                                        					    }
                                        					?>
														</select>
                                                    </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" id="id" name="id" value="<?php echo $data[0]['id']?>" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Master Poli" onclick="simpanData(this.form, 'pages/master/poli_update.php')" />
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