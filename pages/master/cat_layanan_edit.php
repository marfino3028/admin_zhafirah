<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	$data = $db->query("select * from  tbl_kat_pelayanan where id='".$_GET['id']."'");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Category Layanan
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
                                        Form Edit Data Master Category Layanan
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/cat_layanan_update.php	')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Jenis Tarif Layanan</label>
                                            <div class="col-sm-10">
                                                <select id="jenis_layanan" name="jenis_layanan" size="1"class="form-control">
                                                    <?php
                                                    $layanan = $db->query("select kode_jns_tarif as kode, nama_jns_tarif as nama from tbl_jns_tarif where status_delete='UD'");
                                                    for ($i = 0; $i < count($layanan); $i++) {
                                                        if ($layanan[$i]['kode'] == $data[0]['kode_jns_tarif'])  echo '<option value="'.$layanan[$i]['kode'].'" selected="selected">'.$layanan[$i]['kode'].' - '.$layanan[$i]['nama'].'</option>';
                                                        else echo '<option value="'.$layanan[$i]['kode'].'">'.$layanan[$i]['kode'].' - '.$layanan[$i]['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Pelayanan</label>
                                            <div class="col-sm-10">
                                                    <input type="text" id="kode_pelayanan" name="kode_pelayanan" class="form-control" value="<?php echo $data[0]['kode_kat_pelayanan']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Pelayanan</label>
                                            <div class="col-sm-10">
                                                    <input type="text" id="nama_pelayanan" name="nama_pelayanan" class="form-control" value="<?php echo $data[0]['nama_kat_pelayanan']?>" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                                <input type="hidden" id="id" name="id" value="<?php echo $data[0]['id']?>" />
                                                <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Category Layanan" onclick="simpanData(this.form, 'pages/master/cat_layanan_update.php')" />
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