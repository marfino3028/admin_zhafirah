<?php
    date_default_timezone_set("Asia/Jakarta"); 
	$data = $db->query("select * from tbl_perjanjian where md5(id)='".$_GET['id']."'");
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
                                        Perjanjian Pasien (Appoinment) - Edit
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/pendaftaran/appt_update.php" method="post" enctype="multipart/form-data" class="form-horizontal form-column form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">No. Perjanjian</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="no_daftar" name="no_daftar" class="form-control" value="<?php echo $data[0]['no_perjanjian']?>" maxlength="6" required="required" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Tgl Perjanjian</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" id="tgl_appt" name="tgl_appt" class="form-control" value="<?php echo date("Y-m-d", strtotime($data[0]['tgl_daftar']))?>" required="required" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Pasien</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="nomr_pasien" class="form-control" value="<?php echo $data[0]['nomr'].' - '.$data[0]['nama']?>" readonly="readonly">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Ganti Pasien</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="nomr" onchange="CariPasien(this.value)" style="width: 100%;" value="<?php echo $data[0]['nomr']?>" required="required">
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
                                                    <label for="textfield" class="control-label col-sm-3">Pilih Dokter</label>
                                                    <div class="col-sm-9">
                                                        <div style="margin-bottom: 4px; margin-top: 4px;" id="langsung">
                                                            <select id="kd_dokter" name="kd_dokter" size="1" onchange="oncall_dokter(this.value)" class="form-control" required="required">
                                                                <?php
                                                                $poli = $db->query("select * from tbl_dokter where status_delete='UD'");
                                                                for ($i = 0; $i < count($poli); $i++) {
                                                                    if ($data[0]['kode_dokter'] == $poli[$i]['kode_dokter']) {
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
                                                    <label for="textfield" class="control-label col-sm-3"> Pilih Jaminan </label>
                                                    <div class="col-sm-9">
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
                                            </div>
                                            <div class="col-sm-6" style="align-content: center;align-self: center;">
                                                <div id="data_pasien" style="align-self: center; position: relative;">
                                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered table-striped nomargin">
                                                        <thead>
                                                        <th colspan="2" class="text-center">Detail Pasien</th>
                                                        </thead>
                                                        <tr>
                                                            <td style="width:140px">Nama Pasien</td>
                                                            <td><?php echo $data[0]['nama']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Jenis Kelamin</td>
                                                            <td><?php echo $data[0]['jenis_kelamin']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Tempat Lahir</td>
                                                            <td><?php echo $data[0]['tempat_lahir']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Tanggal Lahir</td>
                                                            <td><?php echo date("d F Y", strtotime($data[0]['tanggal_lahir']))?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Alamat</td>
                                                            <td><?php echo $data[0]['alamat']?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" name="id" value="<?php echo md5($data[0]['id'])?>">
                                            <input type="hidden" name="nomr_lama" value="<?php echo $data[0]['nomr']?>">
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