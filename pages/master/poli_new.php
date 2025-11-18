<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	//$nsbu = $db->queryItem("select nama from tbl_sbu where id='".$sub[0]['kode_']."'");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Poli / Layanan</a>
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
                                        Form Tambah Data Master Poli
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/poli_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-1">Kode Poli</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="kd_poli" name="kd_poli" class="form-control" style="50px" />
                                            </div>
                                           <label for="textfield" class="control-label col-sm-1">Nama Poli</label>
                                            <div class="col-sm-7">
                                                <input type="text" id="nama_poli" name="nama_poli" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-1">Tarif Poli</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="tarif" name="tarif" class="form-control" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Profit Center</label>                                           
                                            <div class="col-sm-4">
                                                        <select class="form-control" id="profit" name="profit">
                                                            <option value="">--Pilih Profit Center--</option>
                                        					<?php
                                        					    $sub = $db->query("select kd_profit, nm_profit from tbl_profit");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        echo '<option value="'.$sub[$i]['kd_profit'].'">'.$sub[$i]['nm_profit'].'</option>';
                                        					    }
                                        					?>
														</select>
                                                    </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Poli" onclick="simpanData(this.form, 'pages/master/poli_insert.php')" />
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