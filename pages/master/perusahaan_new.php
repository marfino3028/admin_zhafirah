	<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	//$nsbu = $db->queryItem("select nama from tbl_sbu where id='".$sub[0]['kode_']."'");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Perusahaan</a>
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
                                        Form Tambah Data Master Perusahaan
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/perusahaan_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered  form-validate form-validate" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Perusahaan</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="kode_perusahaan" name="kode_perusahaan" class="form-control"  style="50px" value="<?php echo $data[0]['kode_perusahaan']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Nama Perusahaan</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control" value="<?php echo $data[0]['nama_perusahaan']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Alamat Perusahaan</label>
                                            <div class="col-sm-10">
                                                <textarea tabindex="2" cols="50" rows="2" class="form-control" name="alamat_perusahaan" id="alamat_perusahaan" ><?php echo $data[0]['alamat_perusahaan']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kota</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="kota" name="kota" class="form-control" value="<?php echo $data[0]['kota']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Kode Pos</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="kd_pos" name="kd_pos" class="form-control" value="<?php echo $data[0]['kd_pos']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Telephone</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="telp" name="telp" class="form-control" value="<?php echo $data[0]['telp']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Fax</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="fax" name="fax" class="form-control" value="<?php echo $data[0]['fax']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Group Tarif Perusahaan</label>                                           
                                            <div class="col-sm-2">
                                                        <select class="form-control" id="gttarif" name="gttarif">
                                                            <option value="">--Pilih Group Traif--</option>
                                        					<?php
                                        					    $sub = $db->query("select kd_gt, nm_gt from tbl_tarif_group where status_delete='UD'");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        echo '<option value="'.$sub[$i]['kd_gt'].'">'.$sub[$i]['nm_gt'].'</option>';
                                        					    }
                                        					?>
														</select>
                                                    </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Margin Obat Perusahaan / Penjamin</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="harga_up" name="harga_up" class="form-control" data-rule-required="true" value="0" onKeyUp="allnumeric(document.form_karyawan.harga_up)" />
                                            </div>
					                    <label for="textfield" class="control-label col-sm-6">Harus Menggunakan Angka</label>
                                        </div>
                                        <div class="form-group">
                                        <label for="textfield" class="control-label col-sm-2">Apakah termasuk Group PT AIM</label>
                                            <div class="col-sm-2">
                                            <select id="aim" name="aim" size="1" class="form-control">
                                                    <option value="">--Pilih Group AIM--</option>
                                                    <option value="YA">YA</option>
                                                    <option value="TIDAK">TIDAK</option>
                                            </select>
                                        </div>
                                        </div>
                                       <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Link Google Map</label>
                                            <div class="col-sm-10">
                                                <textarea tabindex="2" cols="50" rows="2" class="form-control" name="link_map" id="link_map" ><?php echo $data[0]['link_map']?></textarea>
                                            </div>
                                        </div>
                        		<div class="form-group">
                        			<label for="textfield" class="control-label col-sm-2" style="text-align: left;">Upload Foto lokasi</label>
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
                        		<label for="textfield" class="control-label col-sm-2" style="text-align: left;">Foto lokasi</label>
                        			<label for="textfield" class="control-label col-sm-10">
                        			<img src="dokumen/<?php echo $dt[0]['gambar']?>" width="200" style="border: 1px solid black;"><br>&nbsp;
                        		</label>
                        		</div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-12"><strong>Informasi No Rekening Provider</strong></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Bank</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="bank_name" name="bank_name" class="form-control"  style="50px" value="<?php echo $data[0]['bank_name']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">No Rekening</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="norek_provider" name="norek_provider" class="form-control" value="<?php echo $data[0]['norek_provider']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Cabang Bank</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="bank_cab" name="bank_cab" class="form-control"  style="50px" value="<?php echo $data[0]['bank_cab']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Atas Nama Rekening</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="rek_nama" name="rek_nama" class="form-control" value="<?php echo $data[0]['rek_nama']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-12"><strong>Informasi Penanggung Jawab</strong></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Penanggung Jawab</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="pic_contact" name="pic_contact" class="form-control"  style="50px" value="<?php echo $data[0]['pic_contact']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">No Ijin Pendirian Klinik</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="no_ijin" name="no_ijin" class="form-control" value="<?php echo $data[0]['no_ijin']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama GL (Piutang)</label>
                                            <div class="col-sm-4">
	                                            <select id="piutang_kd_coa" name="piutang_kd_coa" size="1" class="form-control">
                                	                    <option value="">--Pilih Nama Coa--</option>
							    <?php
								$coa = $db->query("select kd_coa, nm_coa from tbl_coa order by kd_coa");
								for ($i = 0; $i < count($coa); $i++) {
									echo '<option value="'.$coa[$i]['kd_coa'].'">'.$coa[$i]['kd_coa'].' - '.$coa[$i]['nm_coa'].'</option>';
								}
							    ?>
        	                                    </select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Nama GL (Pendapatan)</label>
                                            <div class="col-sm-4">
	                                            <select id="pendapatan_kd_coa" name="pendapatan_kd_coa" size="1" class="form-control">
                                	                    <option value="">--Pilih Nama Coa--</option>
							    <?php
								$coa = $db->query("select kd_coa, nm_coa from tbl_coa order by kd_coa");
								for ($i = 0; $i < count($coa); $i++) {
									echo '<option value="'.$coa[$i]['kd_coa'].'">'.$coa[$i]['kd_coa'].' - '.$coa[$i]['nm_coa'].'</option>';
								}
							    ?>
        	                                    </select>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Master Perusahaan" onclick="simpanData(this.form, 'pages/master/perusahaan_insert.php')" />
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