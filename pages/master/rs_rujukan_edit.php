<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Rumah Sakit Rujukan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Edit Data</a>
            </li>
        </ul>
    </div>
    <?php
        $rujukan = $db->query("select * from tbl_rujukan where md5(id)='".$_GET['id']."'");
        //print_r($rujukan)
    ?>
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
                                        Form Tambah Data Master Rumah Sakit Rujukan
                                </div>
                                <div class="box-content nopadding">
                                        <form action="pages/master/rs_rujukan_update.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Rumah Sakit</label>
                                            <div class="col-sm-2">
                                                <small>Kode</small>
                                                <input type="text" id="kode" name="kode" class="form-control" placeholder="Kode" required="required" value="<?php echo $rujukan[0]['kode']?>" />
                                            </div>
                                            <div class="col-sm-2">
                                                <small>Tipe</small>
                                                <input type="text" id="tipe" name="tipe" class="form-control" placeholder="A/B/C/D" required="required" value="<?php echo $rujukan[0]['tipe']?>" />
                                            </div>
                                            <div class="col-sm-6">
                                                <small>Jenis</small>
                                                <input type="text" id="jenis" name="jenis" class="form-control" placeholder="Contoh: Bersalin / Umum / Daerah / Ibu dan Anak" required="required" value="<?php echo $rujukan[0]['jenis']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Rumah Sakit</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nama" name="nama" class="form-control" required="required" placeholder="Nama Rumah Sakit" value="<?php echo $rujukan[0]['nama']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Alamat Rumah Sakit</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="propinsi" name="propinsi" onchange="pilihProp(this.value)" required="required">
                                                    <option value="">--Pilih Provinsi--</option>
                                					<?php
                                					    $sub = $db->query("select id, name from tbl_daerah_prop");
                                					    for ($i = 0; $i < count($sub); $i++) {
                                					        if ($sub[$i]['id'] == $rujukan[0]['prop_kode']) {
                                					            echo '<option value="'.$sub[$i]['id'].'" selected>'.$sub[$i]['name'].'</option>';
                                					        }
                                					        else {
                                					            echo '<option value="'.$sub[$i]['id'].'">'.$sub[$i]['name'].'</option>';
                                					        }
                                					    }
                                					?>
												</select>
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-control custom-select-value" id="kotamadya" name="kotamadya" onchange="pilihKab(this.value)" required="required">
                                                    <option value="">--Pilih Propinsi terlebih dahulu--</option>
                                					<?php
                                					    $sub = $db->query("select id, name from tbl_daerah_kab where province_id='".$rujukan[0]['prop_kode']."'");
                                					    for ($i = 0; $i < count($sub); $i++) {
                                					        if ($sub[$i]['id'] == $rujukan[0]['kab_kode']) {
                                					            echo '<option value="'.$sub[$i]['id'].'" selected>'.$sub[$i]['name'].'</option>';
                                					        }
                                					        else {
                                					            echo '<option value="'.$sub[$i]['id'].'">'.$sub[$i]['name'].'</option>';
                                					        }
                                					    }
                                					?>
												</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"></label>
                                            <div class="col-sm-5">
                                                <select class="form-control custom-select-value" id="kecamatan" name="kecamatan" onchange="pilihKec(this.value)" required="required">
                                                    <option value="">--Pilih Kecamatan terlebih dahulu--</option>
                                					<?php
                                					    $sub = $db->query("select id, name from tbl_daerah_kec where regency_id='".$rujukan[0]['kab_kode']."'");
                                					    for ($i = 0; $i < count($sub); $i++) {
                                					        if ($sub[$i]['id'] == $rujukan[0]['kec_kode']) {
                                					            echo '<option value="'.$sub[$i]['id'].'" selected>'.$sub[$i]['name'].'</option>';
                                					        }
                                					        else {
                                					            echo '<option value="'.$sub[$i]['id'].'">'.$sub[$i]['name'].'</option>';
                                					        }
                                					    }
                                					?>
												</select>
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-control custom-select-value" id="kelurahan" name="kelurahan" required="required">
                                                    <option value="">--Pilih Kelurahan terlebih dahulu--</option>
                                					<?php
                                					    $sub = $db->query("select id, name from tbl_daerah_kel where district_id='".$rujukan[0]['kec_kode']."'");
                                					    for ($i = 0; $i < count($sub); $i++) {
                                					        if ($sub[$i]['id'] == $rujukan[0]['kel_kode']) {
                                					            echo '<option value="'.$sub[$i]['id'].'" selected>'.$sub[$i]['name'].'</option>';
                                					        }
                                					        else {
                                					            echo '<option value="'.$sub[$i]['id'].'">'.$sub[$i]['name'].'</option>';
                                					        }
                                					    }
                                					?>
												</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"></label>
                                            <div class="col-sm-10">
                                                <small>&nbsp;Alamat Lengkap</small>
                                                <textarea class="form-control" name="alamat" id="alamat" required="required" placeholder="Alamat Lengkap Rumah Sakit Rujukan" ><?php echo $rujukan[0]['alamat']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">No. Telephone</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="telp" name="telp" class="form-control" required="required" placeholder="No. Telp Rumah Sakit" value="<?php echo $rujukan[0]['telp']?>" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" id="id" name="id" value="<?php echo md5($rujukan[0]['id'])?>" />
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Rumah Sakit Rujukan" />
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

<script language="javascript">
	function pilihProp(id) {
		var url = "pages/user/menu_kabupaten.php";
		var data = {id:id};
		
		$('#kotamadya').load(url,data, function(){
			$('#kotamadya').fadeIn('fast');
		});
		pilihKab("");
		pilihKec("");
	}
	function pilihKab(id) {
		var url = "pages/user/menu_kecamatan.php";
		var data = {id:id};
		
		$('#kecamatan').load(url,data, function(){
			$('#kecamatan').fadeIn('fast');
		});
		pilihKec("");
	}
	function pilihKec(id) {
		var url = "pages/user/menu_kelurahan.php";
		var data = {id:id};
		
		$('#kelurahan').load(url,data, function(){
			$('#kelurahan').fadeIn('fast');
		});
	}
</script>
