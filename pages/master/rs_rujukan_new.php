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
                                        Form Tambah Data Master Rumah Sakit Rujukan
                                </div>
                                <div class="box-content nopadding">
                                        <form action="pages/master/rs_rujukan_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Rumah Sakit</label>
                                            <div class="col-sm-2">
                                                <small>Kode</small>
                                                <input type="text" id="kode" name="kode" class="form-control" placeholder="Kode" required="required" />
                                            </div>
                                            <div class="col-sm-2">
                                                <small>Tipe</small>
                                                <input type="text" id="tipe" name="tipe" class="form-control" placeholder="A/B/C/D" required="required" />
                                            </div>
                                            <div class="col-sm-6">
                                                <small>Jenis</small>
                                                <input type="text" id="jenis" name="jenis" class="form-control" placeholder="Contoh: Bersalin / Umum / Daerah / Ibu dan Anak" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Rumah Sakit</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nama" name="nama" class="form-control" required="required" placeholder="Nama Rumah Sakit" />
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
                                					        echo '<option value="'.$sub[$i]['id'].'">'.$sub[$i]['name'].'</option>';
                                					    }
                                					?>
												</select>
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-control custom-select-value" id="kotamadya" name="kotamadya" onchange="pilihKab(this.value)" required="required">
                                                    <option value="">--Pilih Propinsi terlebih dahulu--</option>
												</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"></label>
                                            <div class="col-sm-5">
                                                <select class="form-control custom-select-value" id="kecamatan" name="kecamatan" onchange="pilihKec(this.value)" required="required">
                                                    <option value="">--Pilih Kecamatan terlebih dahulu--</option>
												</select>
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-control custom-select-value" id="kelurahan" name="kelurahan" required="required">
                                                    <option value="">--Pilih Kelurahan terlebih dahulu--</option>
												</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"></label>
                                            <div class="col-sm-10">
                                                <small>&nbsp;Alamat Lengkap</small>
                                                <textarea class="form-control" name="alamat" id="alamat" required="required" placeholder="Alamat Lengkap Rumah Sakit Rujukan" ></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">No. Telephone</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="telp" name="telp" class="form-control" required="required" placeholder="No. Telp Rumah Sakit" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
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
