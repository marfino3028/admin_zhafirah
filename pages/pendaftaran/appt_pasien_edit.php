<?php
    date_default_timezone_set("Asia/Jakarta"); 

	$data = $db->query("select * from tbl_perjanjian where md5(id)='".$_GET['id']."'");
	//print_r($janji);
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Perjanjian Pasien</a>
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
                                        Form Tambah Data Perjanjian Pasien
                                </div>
                                <div class="box-content">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/appt_pasienNew_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered  form-validate form-validate" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Pasien</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $data[0]['nama']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1" style="text-align: right;">NIK</label>
                                            <div class="col-sm-3">
                                                <input type="text" id="nik" name="nik" class="form-control" value="<?php echo $data[0]['nik']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Tempat & Tanggal Lahir</label>
                                            <div class="col-sm-7">
                                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" value="<?php echo $data[0]['tempat_lahir']?>" />
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="<?php echo $data[0]['tanggal_lahir']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Alamat Pasien</label>
                                            <div class="col-sm-10">
                                                <textarea tabindex="2" rows="2" class="form-control" name="alamat" id="alamat" ><?php echo $data[0]['alamat']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Jenis Kelamin</label>
                                            <div class="col-sm-3">
                                                <select id="jk" name="jk" size="1" class="form-control">
                                                        <option value="">--Pilih Jenis Kelamin--</option>
                                                        <?php
                                                            if ($data[0]['jenis_kelamin'] == 'Laki-Laki') {
                                                                echo '<option value="Laki-Laki" selected>Laki-Laki</option>
                                                                      <option value="Perempuan">Perempuan</option>';
                                                            }
                                                            elseif ($data[0]['jenis_kelamin'] == 'Perempuan') {
                                                                echo '<option value="Laki-Laki" selected>Laki-Laki</option>
                                                                      <option value="Perempuan">Perempuan</option>';
                                                            }
                                                            else {
                                                                echo '<option value="Laki-Laki">Laki-Laki</option>
                                                                      <option value="Perempuan">Perempuan</option>';
                                                            }
                                                        ?>
                                                </select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1" style="text-align: right;">E-mail</label>
                                            <div class="col-sm-3">
                                                <input type="text" id="email" name="email" class="form-control" value="<?php echo $data[0]['email']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Handphone</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="hp" name="hp" class="form-control" value="<?php echo $data[0]['hp']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">No. Perjanjian</label>
                                            <div class="col-sm-3">
                                                <input type="text" id="no_daftar" name="no_daftar" class="form-control" value="<?php echo $data[0]['no_perjanjian']?>" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">tgl_perjanjian</label>
                                            <div class="col-sm-2">
                                                <input type="date" id="tgl_appt" name="tgl_appt" class="form-control" value="<?php echo $data[0]['tgl_daftar']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Pilih Poli</label>
                                            <div class="col-sm-7">
                                                <select id="kd_poli" name="kd_poli" size="1" onchange="pilihPoli(this.value)" class="form-control" required="required">
                                                    <option value="">--Pilih Poli--</option>
                                                    <?php
                                                    $poli = $db->query("select * from tbl_poli where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        if ($data[0]['kd_poli'] == $poli[$i]['kd_poli']) {
                                                            echo '<option value="'.$poli[$i]['kd_poli'].'" selected>'.$poli[$i]['nama_poli'].'</option>';
                                                        }
                                                        else {
                                                            echo '<option value="'.$poli[$i]['kd_poli'].'">'.$poli[$i]['nama_poli'].'</option>';
                                                        }
                                                    }
                                                    echo '<option value="LANGSUNG">PENUNJANG MEDIS</option>';
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Shift</label>
                                                    <div class="col-sm-3">
                                                        <select id="shift_hd" name="shift_hd" size="1" class="form-control" required="required">
                                                            <?php
                                                            $poli = $db->query("select * from tbl_shift_hd");
                                                            for ($i = 0; $i < count($poli); $i++) {
                                                                if ($data[0]['shift'] == $poli[$i]['nilai']) {
                                                                    echo '<option value="'.$poli[$i]['nilai'].'" selected>'.$poli[$i]['nama'].'</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <label for="textfield" class="control-label col-sm-2" style="text-align: right;">Mesin HD</label>
                                                    <div class="col-sm-3">
                                                        <select id="mesin_hd" name="mesin_hd" size="1" class="form-control" required="required">
                                                            <?php
                                                            $prsh = $db->query("select * from tbl_mesinHD where id not in (select mesinHD_id from tbl_perjanjian where status_pasien='OPEN' and tgl_daftar='".$data[0]['tgl_daftar']."' and shift='".$data[0]['shift']."')");
                                                            for ($i = 0; $i < count($prsh); $i++) {
                                                                if ($data[0]['mesinHD_id'] == $prsh[$i]['id']) {
                                                                    echo '<option value="'.$prsh[$i]['id'].'" selected>'.$prsh[$i]['merk_mesin'].'</option>';
                                                                }
								else {
								    echo '<option value="'.$prsh[$i]['id'].'">'.$prsh[$i]['merk_mesin'].'</option>';
								}
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Pilih Dokter</label>
                                            <div class="col-sm-10">
                                                <div style="margin-bottom: 4px; margin-top: 4px;" id="langsung">
                                                    <select id="kd_dokter" name="kd_dokter" size="1" onchange="oncall_dokter(this.value)" class="form-control" required="required">
                                                        <?php
                                                        $poli = $db->query("select * from tbl_dokter where status_delete='UD'");
                                                        for ($i = 0; $i < count($poli); $i++) {
                                                            if ($data[0]['kd_dokter'] == $poli[$i]['kode_dokter']) {
                                                                echo '<option value="'.$poli[$i]['kode_dokter'].'" selected>'.$poli[$i]['nama_dokter'].'</option>';
                                                            }
                                                            else {
                                                                echo '<option value="'.$poli[$i]['kode_dokter'].'">'.$poli[$i]['nama_dokter'].'</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div style="margin-bottom: 4px; margin-top: 4px;" id="dokter_oncall"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"> Pilih Jaminan </label>
                                            <div class="col-sm-10">
                                                <select id="kode_perusahaan" name="kode_perusahaan" size="1" class="form-control" required="required">
                                                    <option value="">Pilih Jaminan</option>
                                                    <?php
                                                    $prsh = $db->query("select * from tbl_perusahaan where status_delete='UD'");
                                                    for ($i = 0; $i < count($prsh); $i++) {
                                                        if ($data[0]['kode_perusahaan'] == $prsh[$i]['id']) {
                                                            echo '<option value="'.$prsh[$i]['id'].'" selected>'.$prsh[$i]['nama_perusahaan'].'</option>';
                                                        }
                                                        else {
                                                            echo '<option value="'.$prsh[$i]['id'].'">'.$prsh[$i]['nama_perusahaan'].'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" name="id" value="<?php echo md5($data[0]['id'])?>">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Perjanjian Pasien" onclick="simpanData(this.form, 'pages/pendaftaran/appt_pasienNew_update.php')" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-success rounded" value="Daftar Perjanjian Pasien" onclick="simpanData(this.form, 'index.php?mod=pendaftaran&submod=appt')" />
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
    function CariPasien(id) {
        var url = "pages/pendaftaran/view_pasien.php";
        id = '1###' + id;
        var data = {id:id};

        $('.loading').fadeIn();
        $('#data_pasien').fadeOut();
        $('#data_pasien').load(url,data, function(){
            $('.loading').fadeOut('fast');
            $('#data_pasien').fadeIn('fast');
        });
    }

    function pilihPoli(id) {
        var tanggal = document.getElementById('tgl_appt').value;
        var data = {id:id, tanggal:tanggal};

        if (id == 'LANGSUNG') {
            var url = "pages/pendaftaran/view_langsung.php";
        }
        else {
            var url = "pages/pendaftaran/view_not_langsung.php";
        }
      	//alert(id);
      	$('#langsung').load(url,data, function(){
            $('#langsung').fadeIn('fast');
        });
    }
  
    function oncall_dokter(id) {
        var data = {id:id};
        var url = "pages/pendaftaran/view_oncall.php";
      	$('#dokter_oncall').load(url,data, function(){
            $('#dokter_oncall').fadeIn('fast');
        });
    }
  
  	function pilihKelas(id) {
      var data = {id:id};
      var url = "pages/pendaftaran/kelas_inap.php";
      $('#KelasInap').load(url,data, function(){
        $('#KelasInap').fadeIn('fast');
      });
    }
  
  	function pilihRuangan(id) {
      var data = {id:id};
      var url = "pages/pendaftaran/kelas_inap_bed.php";
      $('#KelasInapBed').load(url,data, function(){
        $('#KelasInapBed').fadeIn('fast');
      });
    }

    function pilih_hubungan(id) {
        var url = "pages/pendaftaran/langsung_hubungan.php";
        var data = {id:id};
        $('#langsung_hub').load(url,data, function(){
            $('#langsung_hub').fadeIn('fast');
        });
    }

    function simpanDataDaftar(t, url) {
        var poli = document.getElementById('kd_poli').value;
        var prsh = document.getElementById('kode_perusahaan').value;
        if (poli == "" || prsh == "") {
            alert("Silahkan lengkapi data yang sudah disediakan");
        }
        else {
            document.getElementById('form_karyawan').action = url;
            t.submit();
        }
    }
</script>