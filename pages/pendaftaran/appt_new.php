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
                <a href="javascript:void(0)">Perjanjian</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Buat Perjanjian</a>
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
                                        Perjanjian Pasien (Appoinment)
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/pendaftaran/appt_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-column form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">No. Perjanjian</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="no_daftar" name="no_daftar" class="form-control" value="<?php echo $nomr?>" maxlength="6" required="required" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Tgl Perjanjian</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" id="tgl_appt" name="tgl_appt" class="form-control" value="<?php echo date("Y-m-d")?>" required="required" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Nomor MR</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="nomr" onchange="CariPasien(this.value)" style="width: 100%;" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Hubungan</label>
                                                    <div class="col-sm-9">
                                                        <div id="langsung_hub">
                                                            &nbsp;
                                                        </div></td>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Pilih Poli</label>
                                                    <div class="col-sm-9">
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
                                                    <label for="textfield" class="control-label col-sm-3">Pilih Dokter</label>
                                                    <div class="col-sm-9">
                                                        <div style="margin-bottom: 4px; margin-top: 4px;" id="langsung">
                                                            &nbsp;
                                                        </div>
                                                        <div style="margin-bottom: 4px; margin-top: 4px;" id="dokter_oncall"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3"> Pilih Jaminan </label>
                                                    <div class="col-sm-9">
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
                                                <div class="form-group" id="pilihMesinHD"></div>
                                            </div>
                                            <div class="col-sm-6" style="align-content: center;align-self: center;">
                                                <div id="data_pasien" style="align-self: center; position: relative;"></div>
                                                <div id="mesin" style="align-self: center; position: relative;"></div>
					    </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Perjanjian Pasien" />
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
        var url = "pages/pendaftaran/view_pasien_perjanjian.php";
        id = '1###' + id;
        var data = {id:id};

        $('.loading').fadeIn();
        $('#data_pasien').fadeOut();
        $('#data_pasien').load(url,data, function(){
            $('.loading').fadeOut('fast');
            $('#data_pasien').fadeIn('fast');
        });
    }

    function oncall_dokter(id) {
        var data = {id:id};
        var url = "pages/pendaftaran/view_oncall.php";
      	$('#dokter_oncall').load(url,data, function(){
            $('#dokter_oncall').fadeIn('fast');
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
        //var data = {id:id};
      	//alert(id);
      	$('#langsung').load(url,data, function(){
            $('#langsung').fadeIn('fast');
        });	
    }

    function pilihPoliMesin(id) {
        var tanggal = document.getElementById('tgl_appt').value;
        var data = {id:id, tanggal: tanggal};
	//alert(id); 
	var url = "pages/pendaftaran/view_mesinhd.php";
	var urlHD = "pages/pendaftaran/view_mesinhd_field.php";

      	//$('#mesin').load(url,data, function(){
            //$('#mesin').fadeIn('fast');
        //});

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
<script language="javascript">
    $(document).ready(function() {
        $("#nomr").select2({
            minimumInputLength: 1,
            ajax: {
                url : "pages/functions/nomr.php",
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                results: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.itemName,
                                id: item.id
                            }
                        })
                    };
                },
            }
        });
    });

</script>