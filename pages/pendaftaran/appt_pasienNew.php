<?php
    date_default_timezone_set("Asia/Jakarta"); 
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	$ceknmr = $db->queryItem("select max(right(no_perjanjian, 3)*1) from tbl_perjanjian where left(no_perjanjian, 4)='".date("ym")."'", 0);
	$ceknmr2 = $db->queryItem("select a.panjang from (select LENGTH(no_perjanjian) as panjang from tbl_perjanjian where left(no_daftar, 4)='".date("ym")."' group by LENGTH(no_daftar)) a order by a.panjang desc", 0);
	if ($ceknmr2 > 7) {
		$ceknmr = $db->queryItem("select max(right(no_perjanjian, 5)*1) from tbl_perjanjian where left(no_perjanjian, 4)='".date("ym")."'", 0);
	}
		$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '000'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 1000) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 10000) $ceknmr = $ceknmr;
	$nomr = date("ym").$ceknmr;
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
                                                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $data[0]['nama_perusahaan']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1" style="text-align: right;">NIK</label>
                                            <div class="col-sm-3">
                                                <input type="text" id="nik" name="nik" class="form-control" value="<?php echo $data[0]['nama_perusahaan']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Tempat & Tanggal Lahir</label>
                                            <div class="col-sm-7">
                                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" value="<?php echo $data[0]['nama_perusahaan']?>" />
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Alamat Pasien</label>
                                            <div class="col-sm-10">
                                                <textarea tabindex="2" rows="2" class="form-control" name="alamat" id="alamat" ><?php echo $data[0]['alamat_perusahaan']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Jenis Kelamin</label>
                                            <div class="col-sm-3">
                                                <select id="jk" name="jk" size="1" class="form-control">
                                                        <option value="">--Pilih Jenis Kelamin--</option>
                                                        <option value="Laki-Laki">Laki-Laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1" style="text-align: right;">E-mail</label>
                                            <div class="col-sm-3">
                                                <input type="text" id="email" name="email" class="form-control" value="<?php echo $data[0]['nama_perusahaan']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Handphone</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="hp" name="hp" class="form-control" value="<?php echo $data[0]['telp']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">No. Perjanjian</label>
                                            <div class="col-sm-3">
                                                <input type="text" id="no_daftar" name="no_daftar" class="form-control" value="<?php echo $nomr?>" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">tgl_perjanjian</label>
                                            <div class="col-sm-2">
                                                <input type="date" id="tgl_appt" name="tgl_appt" class="form-control" value="<?php echo date("Y-m-d")?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Pilih Poli</label>
                                            <div class="col-sm-7">
                                                <select id="kd_poli" name="kd_poli" size="1" onchange="pilihPoli(this.value); pilihPoliMesin(this.value)" class="form-control" required="required">
                                                    <option value="">--Pilih Poli--</option>
                                                    <?php
                                                    $poli = $db->query("select * from tbl_poli where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        echo '<option value="'.$poli[$i]['kd_poli'].'">'.$poli[$i]['nama_poli'].'</option>';
                                                    }
                                                    echo '<option value="LANGSUNG">PENUNJANG MEDIS</option>';
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Pilih Dokter</label>
                                            <div class="col-sm-10">
                                                <div style="margin-bottom: 4px; margin-top: 4px;" id="langsung">
                                                    &nbsp;
                                                </div>
                                                <div style="margin-bottom: 4px; margin-top: 4px;" id="dokter_oncall"></div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="pilihMesinHD"></div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"> Pilih Jaminan </label>
                                            <div class="col-sm-10">
                                                <select id="kode_perusahaan" name="kode_perusahaan" size="1" class="form-control" required="required">
                                                    <option value="">Pilih Jaminan</option>
                                                    <?php
                                                    $prsh = $db->query("select * from tbl_perusahaan where status_delete='UD'");
                                                    for ($i = 0; $i < count($prsh); $i++) {
                                                        echo '<option value="'.$prsh[$i]['id'].'">'.$prsh[$i]['nama_perusahaan'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Perjanjian Pasien" onclick="simpanData(this.form, 'pages/pendaftaran/appt_pasienNew_insert.php')" />
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
	//alert(id);
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

    function pilihPoliMesin(id) {
        var tanggal = document.getElementById('tgl_appt').value;
        var data = {id:id, tanggal: tanggal};
	//alert(tanggal); 
	var urlHD = "pages/pendaftaran/view_mesinhd_field2.php";

      	$('#pilihMesinHD').load(urlHD,data, function(){
            $('#pilihMesinHD').fadeIn('fast');
        });
	
    }

    function pilihShiftHD(id) {
        var tanggal = document.getElementById('tgl_appt').value;
        var kd_poli = document.getElementById('kd_poli').value;
        var data = {id:id, tanggal: tanggal, kd_poli: kd_poli};
	//alert(tanggal); test
	var urlHD = "pages/pendaftaran/view_mesinhd_field_with.php";

      	$('#MesinHDShift').load(urlHD,data, function(){
            $('#MesinHDShift').fadeIn('fast');
        });
    }
</script>