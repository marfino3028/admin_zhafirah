<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	$ceknmr = $db->queryItem("select max(right(no_daftar, 3)*1) from tbl_pendaftaran where left(no_daftar, 4)='".date("ym")."'", 0);
	$ceknmr2 = $db->queryItem("select a.panjang from (select LENGTH(no_daftar) as panjang from tbl_pendaftaran where left(no_daftar, 4)='".date("ym")."' group by LENGTH(no_daftar)) a order by a.panjang desc", 0);
	if ($ceknmr2 > 7) {
		$ceknmr = $db->queryItem("select max(right(no_daftar, 5)*1) from tbl_pendaftaran where left(no_daftar, 4)='".date("ym")."'", 0);
	}
		$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '000'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 1000) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 10000) $ceknmr = $ceknmr;
	$nomr = date("ym").$ceknmr;
	
	$otc = $db->query("select * from tbl_perjanjian where md5(id)='".$_GET['id']."'");
	$idmr = $db->query("select * from tbl_pasien where nomr='".$otc[0]['nomr']."'", 0);
	//print_r($idmr);
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
                            <div class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Data Pendaftaran Pasien
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/pendaftaran/daftar_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-column form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">No. Pendaftaran</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="no_daftar" name="no_daftar" class="form-control" value="<?php echo $nomr?>" maxlength="6" required="required" disabled />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Nomor MR</label>
                                                    <div class="col-sm-9">
                                                    	<select id="nomr" name="nomr" size="1" class="form-control">
                                                    		<?php
                                                				echo '<option value="'.$otc[0]['nomr'].'">'.$otc[0]['nomr'].' - '.$otc[0]['nama'].'</option>';
                                                    		?>
                                                    	</select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Hubungan</label>
                                                    <div class="col-sm-9">
                                                        <div id="langsung_hub">
                                                        	<select id="keluarga" name="keluarga" size="1" class="form-control">
                                                        		<option value="">--Pilih Keluarga--</option>
                                                        		<?php
                                                        			$poli = $db->query("select * from tbl_hubungan_keluarga where nomr='".$otc[0]['nomr']."'");
                                                        			echo '<option value="'.$poli[0]['nomr_nama'].' (Diri Sendiri)">'.$poli[0]['nomr_nama'].' (Diri Sendiri)</option>';
                                                        			for ($i = 0; $i < count($poli); $i++) {
                                                        				echo '<option value="'.$poli[$i]['nama'].' - '.$poli[$i]['hubungan'].'">'.$poli[$i]['nama'].' - '.$poli[$i]['hubungan'].'</option>';
                                                        			}
                                                        		?>
                                                        	</select>
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
                                        <div class="form-group">
										<label class="control-label col-sm-3">Pilih Rujukan</label>
										<div class="col-sm-9">
											<div class="radio">
												<label>
													<input type="radio" value="Inisiatif Sendiri" id="is_sendiri" name="is_sendiri">Inisiatif Sendiri
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" value="Luar RS/Klinik" id="is_luar" name="is_luar">Luar RS/Klinik
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" value="Faskes BPJS" id="is_luar" name="is_luar">Faskes BPJS
												</label>
											</div>
										</div>
										</div>
                                            </div>
                                            <div class="col-sm-6" style="align-content: center;align-self: center;">
                                                <div id="data_pasien" style="align-self: center; position: relative;">
                                                    <?php
                                                    	$data = $db->query("select * from tbl_pasien where nomr='".$otc[0]['nomr']."' and status_delete='UD'");
                                                    ?>
                                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered table-striped nomargin">
                                                        <thead>
                                                        <th colspan="2" class="text-center">Detail Pasien</th>
                                                        </thead>
                                                        <tr>
                                                            <td style="width:140px">Nama Pasien</td>
                                                            <td><?php echo $data[0]['nm_pasien']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Jenis Kelamin</td>
                                                            <td><?php echo $data[0]['jk']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Tempat Lahir</td>
                                                            <td><?php echo $data[0]['tmpt_lahir']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Tanggal Lahir</td>
                                                            <td><?php echo date("d F Y", strtotime($data[0]['tgl_lahir']))?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Alamat</td>
                                                            <td><?php echo $data[0]['alamat_pasien']?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" name="idOTC" value="<?php echo md5($otc[0]['id'])?>">
                                            <input type="hidden" name="idmr" value="<?php echo $idmr[0]['id']?>">
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Pendaftaran" />
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
        var data = {id:id};

        if (id == 'LANGSUNG') {
            var url = "pages/pendaftaran/view_langsung.php";
        }
        else {
            var url = "pages/pendaftaran/view_not_langsung.php";
        }
        var data = {id:id};
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