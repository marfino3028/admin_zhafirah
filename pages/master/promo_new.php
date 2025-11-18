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
                <a href="javascript:void(0)">Master Promo</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data Promo</a>
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
                                        Form Tambah Data Master Promo
                                </div>
                                <div class="box-content nopadding">
                                        <form action="javascript:simpanData(this.form, 'pages/master/promo_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Promo</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nm_promo" name="nm_promo" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Discount (Rp.)</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="discount" name="discount" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Promo" onclick="simpanData(this.form, 'pages/master/promo_insert.php')" />
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