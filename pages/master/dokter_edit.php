<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	$data = $db->query("select * from tbl_dokter where id='".$_GET['id']."'");
	//print_r($data);
	if ($data[0]['tgl_lahir'] == "") $data[0]['tgl_lahir'] = date("Y-m-d");
	if ($data[0]['tgl_sip'] == "") $data[0]['tgl_sip'] = date("Y-m-d");
	if ($data[0]['tgl_str'] == "") $data[0]['tgl_str'] = date("Y-m-d");
	if ($data[0]['tgl_kre'] == "") $data[0]['tgl_kre'] = date("Y-m-d");
	if ($data[0]['tgl_lahir'] == "") $data[0]['tgl_lahir'] = date("Y-m-d");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Dokter</a>
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
                                        Form Edit Data Master Dokter
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/dokter_update.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Dokter</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="kode_dokter" name="kode_dokter" class="form-control" readonly="readonly" style="50px" value="<?php echo $data[0]['kode_dokter']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Nama Dokter</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="nama_dokter" name="nama_dokter" class="form-control" value="<?php echo $data[0]['nama_dokter']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Spesialis</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="spesialis" name="spesialis" class="form-control" value="<?php echo $data[0]['spesialis']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Poli</label>
                                            <div class="col-sm-5">
                                                <select id="kd_poli" name="kd_poli" size="1" class="form-control">
                                                    <?php
                                                    $poli = $db->query("select kd_poli as kode, nama_poli as nama from tbl_poli where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        if ($data[0]['kd_poli'] == $poli[$i]['kode']) echo '<option value="'.$poli[$i]['kode'].'" selected="selected">'.$poli[$i]['kode'].' - '.$poli[$i]['nama'].'</option>';
                                                        else echo '<option value="'.$poli[$i]['kode'].'">'.$poli[$i]['kode'].' - '.$poli[$i]['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2" style="text-align: right;">Nomor KTP</label>
                                            <div class="col-sm-3">
                                                <input type="text" id="noktp" name="noktp" class="form-control" value="<?php echo $data[0]['noktp']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Tempat Lahir</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="tmpt_lahir" name="tmpt_lahir" class="form-control" value="<?php echo $data[0]['tmpt_lahir']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1" style="text-align: right;">Tgl Lahir</label>
                                            <div class="col-sm-2">
                                                 <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" value="<?php echo $data[0]['tgl_lahir']?>"  />
                                            </div>
                                                    <label for="textfield" class="control-label col-sm-2" style="text-align: right;">Jenis Kelamin</label>
                                                    <div class="col-sm-3">
                                                        <select id="jk" name="jk" class="form-control">
                                                            <?php
                                                            if ($data[0]['jk'] == 'Laki-Laki') {
                                                                echo '<option value="Laki-Laki" selected="selected">Laki-Laki</option>';
								echo '<option value="Perempuan">Perempuan</option>';
                                                            }
                                                            elseif ($data[0]['jk'] == 'Perempuan') {
								echo '<option value="Perempuan" selected="selected">Perempuan</option>';
								echo '<option value="Laki-Laki">Laki-Laki</option>';
                                                                
                                                            }
                                                            else {
								echo '<option value="Perempuan" selected="selected">--Pilih Jenis Kelamin--</option>';
								echo '<option value="Perempuan">Perempuan</option>';
								echo '<option value="Laki-Laki">Laki-Laki</option>';
                                                                
                                                            }
                                                            ?>

                                                        </select>
                                            </div>
                                        </div>
                        				<div class="form-group">
                        					<label for="textfield" class="control-label col-sm-2" style="text-align: left;">Photo</label>
                        					<label for="textfield" class="control-label col-sm-10">
                        						<?php
                            			            $sub = $db->query("select * from tbl_news where id='".$dt[0]['id']."'");
                            			            echo '<img src="../../dokumen/'.$data[0]['dokumen'].'" width="200" style="">';
                            			        ?>
                        					</label>
                        				</div>
                        				<div class="form-group">
                        					<label for="textfield" class="control-label col-sm-2" style="text-align: left;">Ganti Photo</label>
                        					<div class="col-sm-10">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-default btn-file btn-success">
                                                        <span class="fileinput-new">&nbsp;Pilih/Ambil file&nbsp;</span>
                                                    <span class="fileinput-exists">Ganti</span>
                                                    <input type="file" name="dokumen" accept="image/*" required="required">
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                </div>
                        					</div>
                        				</div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">No.SIP</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="no_sip" name="no_sip" class="form-control" value="<?php echo $data[0]['no_sip']?>"  />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Masa Berlaku SIP</label>
                                            <div class="col-sm-2">
                                                <input type="date" id="tgl_sip" name="tgl_sip" class="form-control" value="<?php echo $data[0]['tgl_sip']?>"  />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">No.STR</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="no_str" name="no_str" class="form-control" value="<?php echo $data[0]['no_str']?>"  />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Masa Berlaku STR</label>
                                            <div class="col-sm-2">
                                                <input type="date" id="tgl_str" name="tgl_str" class="form-control" value="<?php echo $data[0]['tgl_str']?>"  />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">No.Kredensial</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="no_kre" name="no_kre" class="form-control" value="<?php echo $data[0]['no_kre']?>"  />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Masa Berlaku Kredensial</label>
                                            <div class="col-sm-2">
                                                <input type="date" id="tgl_kre" name="tgl_kre" class="form-control" value="<?php echo $data[0]['tgl_kre']?>"  />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Informasi Rekening Dokter</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Bank</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="bank" name="bank" class="form-control" value="<?php echo $data[0]['bank']?>"  />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Bank Cabang</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="bank_c" name="bank_c" class="form-control" value="<?php echo $data[0]['bank_c']?>"  />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Bank Atas Nama</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="bank_an" name="bank_an" class="form-control" value="<?php echo $data[0]['bank_an']?>"  />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Bank No Rekening</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="norek" name="norek" class="form-control" value="<?php echo $data[0]['norek']?>"  />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">NPWP</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="npwp" name="npwp" class="form-control" value="<?php echo $data[0]['npwp']?>"  />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Informasi Tarif Dokter</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Tarif Dokter</label>
                                            <div class="col-sm-2">
                                                <input type="number" id="tarif_dokter" name="tarif_dokter" class="form-control" value="<?php echo $data[0]['tarif_dokter']?>" onKeyUp="allnumeric(document.form_karyawan.tarif_dokter)" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-6">Harus Menggunakan Angka</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Proffesional Fee</label>
                                            <div class="col-sm-4">
                                                <input type="number" id="professional_fee" name="professional_fee" class="form-control" value="<?php echo $data[0]['professional_fee']?>" />
                                            </div>
					    <label for="textfield" class="control-label col-sm-6">Harus Menggunakan Angka</label>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" id="id" name="id" value="<?php echo $data[0]['id']?>" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Master Dokter" onclick="simpanData(this.form, 'pages/master/dokter_update.php')" />
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

	function allnumeric(inputtxt)
	{
		var numbers = /^[0-9]+$/;
		if(inputtxt.value.match(numbers))
		{
			//alert('Your Registration number has accepted....');
			inputtxt.focus();
			return true;
		}
		else
		{
			alert('Please input numeric characters only');
			inputtxt.focus();
			inputtxt.value = "";
			return false;
		}
	} 

</script>