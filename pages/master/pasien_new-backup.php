<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	$ceknmr = $db->queryItem("select max(right(nomr, 3)*1) from tbl_pasien where left(nomr, 4)='".date("ym")."'", 0);
    $ceknmr2 = $db->queryItem("select a.panjang from (select LENGTH(nomr) as panjang from tbl_pasien where left(nomr, 4)='".date("ym")."' group by LENGTH(nomr)) a order by a.panjang desc", 0);

	if ($ceknmr2 > 7) {
		$ceknmr = $db->queryItem("select max(right(nomr, 5)*1) from tbl_pasien where left(nomr, 4)='".date("ym")."'", 0);
	}
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '000'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 1000) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 10000) $ceknmr = $ceknmr;
	$nomr = date("ym").$ceknmr;
	
	$ceknmr = $db->queryItem("select max(right(idmember, 3)*1) from tbl_pasien where left(idmember, 4)='".date("ym")."' order by idmember desc", 0);
    $ceknmr2 = $db->queryItem("select a.panjang from (select LENGTH(idmember) as panjang from tbl_pasien where left(idmember, 4)='".date("ym")."' group by LENGTH(idmember)) a order by a.panjang desc", 0);

	if ($ceknmr2 > 7) {
		$ceknmr = $db->queryItem("select max(right(idmember, 5)*1) from tbl_pasien where left(idmember, 4)='".date("ym")."'", 0);
	}
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '000'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 1000) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 10000) $ceknmr = $ceknmr;
	$nomember = 'ID'.date("ym").$ceknmr;
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
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
                            <div class="box box-bordered box-color">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Data Master Pasien
                                </div>
                                <div class="box-content nopadding">
                                        <form action="javascript:simpanData(this.form, 'pages/master/pasien_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No Medical Record</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nomr" name="nomr" class="form-control"  value="<?php echo $nomr?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">ID Membership</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="idmember" name="idmember" class="form-control"  value="<?php echo $nomember?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Keluarga</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="keluarga" name="keluarga" class="form-control" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No.Karyawan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nip" name="nip" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor Polis</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_polis" name="no_polis" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tempat Lahir</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="tmpt_lahir" name="tmpt_lahir" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Pekerjaan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Propinsi</label>
                                                    <div class="col-sm-8">
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
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Kabupaten</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control custom-select-value" id="kotamadya" name="kotamadya" onchange="pilihKab(this.value)" required="required">
                                                            <option value="">--Pilih Kabupaten / Kota--</option>
														</select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Kode Pos</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="kode_pos_pasien" name="kode_pos_pasien" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Agama</label>
                                                    <div class="col-sm-8">
                                                        <select id="agama" name="agama" size="1" class="form-control">
                                                            <option value="">--Pilih Agama--</option>
                                                            <option value="Islam">Islam</option>
                                                            <option value="Katholik">Katholik</option>
                                                            <option value="Protestan">Protestan</option>
                                                            <option value="Hindhu">Hindhu</option>
                                                            <option value="Budha">Budha</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Penjamin</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nm_penjamin" name="nm_penjamin" class="form-control" />
                                                    </div>
                                                </div>
                                               <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Hubungan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="hubungan" name="hubungan" class="form-control" />
                                                    </div>
                                                </div>
						<div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">E-mail</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="email" name="email" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Status Membership</label>
                                                    <div class="col-sm-8">
                                                        <select id="status_membership" name="status_membership" size="1" class="form-control">
                                                            <option value="">--Pilih Status Membership--</option>
                                                            <option value="Aktif">Aktif</option>
                                                            <option value="Non Aktif">Non Aktif</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Daftar</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="tgLdaftar" name="tgLdaftar" class="form-control medium" value="<?=date('m-d-Y')?>" readonly="readonly"  />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Pasien</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nama" name="nama" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor Peserta BPJS</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_peserta" name="no_peserta" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Jenis Kelamin</label>
                                                    <div class="col-sm-8">
                                                        <select id="jk" name="jk" size="1" class="form-control">
                                                            <option value="">--Pilih Jenis Kelamin--</option>
                                                            <option value="Laki-Laki">Laki-Laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Lahir</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" /> Format mm/dd/yyyy
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Alamat Pasien</label>
                                                    <div class="col-sm-8">
                                                        <textarea tabindex="2" cols="50" rows="3" class="form-control" id="alamat_pasien" name="alamat_pasien" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Kecamatan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control custom-select-value" id="kecamatan" name="kecamatan" onchange="pilihKec(this.value)" required="required">
                                                            <option value="">--Pilih Kecamatan--</option>
														</select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Kelurahan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control custom-select-value" id="kelurahan" name="kelurahan" required="required">
                                                            <option value="">--Pilih Kecamatan--</option>
														</select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Telp</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="telp_pasien" name="telp_pasien" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No.KTP</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_ktp" name="no_ktp" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Alamat Penjamin</label>
                                                    <div class="col-sm-8">
                                                        <textarea tabindex="2" cols="50" rows="3" class="form-control" id="alamat_penjamin" name="alamat_penjamin" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Klinik Asal</label>
                                                    <div class="col-sm-8">
                                                        <select id="rujukan" name="rujukan" size="1" class="form-control">
                                                            <option value="">--Pilih Klinik Asal--</option>
                                                            <?php
                                                            	$rujuk = $db->query("select kode_perusahaan, nama_perusahaan from tbl_perusahaan order by nama_perusahaan");
                                                            	for ($i = 0; $i < count($rujuk); $i++) {
                                                            		echo '<option value="'.$rujuk[$i]['nama_perusahaan'].'">'.$rujuk[$i]['nama_perusahaan'].'</option>';
                                                            	}
							    ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Type Pasien</label>
                                                    <div class="col-sm-8">
                                                        <select id="type_pasien" name="type_pasien" size="1" class="form-control">
                                                            <option value="">--Pilih Type Pasien--</option>
                                                            <option value="Klinik">Klinik</option>
                                                            <option value="Alat HD">Alat HD</option>
                                                            <option value="Corporated">Corporated</option>
							    <option value="Mandiri">Mandiri</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Jenis Pendaftaran</label>
                                                    <div class="col-sm-8">
                                                        <select id="jenis_pendaftaran" name="jenis_pendaftaran" size="1" class="form-control">
                                                            <option value="">--Pilih Jenis Pendaftaran--</option>
                                                            <option value="Rawat Jalan">Rawat Jalan</option>
                                                            <option value="Rawat Inap">Rawat Inap</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Masa Berlaku Membership</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" id="tgl_berlaku" name="tgl_berlaku" class="form-control" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-actions">
                                                    <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Pasien" onclick="simpanData(this.form, 'pages/master/pasien_insert.php')" />
                                                </div>
                                            </div>
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
