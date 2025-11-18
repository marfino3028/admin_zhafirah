<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	$data = $db->query("select * from tbl_charity where id='".$_GET['id']."'");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">CMS</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Charity</a>
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
                                        Update Data Charity
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/perusahaan_update.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Title Charity</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="title_charity" name="title_charity" class="form-control" value="<?php echo $data[0]['title_charity']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Charity Deskripsi</label>
                                            <div class="col-sm-10">
                                                <textarea tabindex="2" cols="50" rows="2" class="ckeditor span12" name="charity" id="charity" ><?php echo $data[0]['charity']?></textarea>
                                            </div>
                                        </div>
                        				<div class="form-group">
                        					<label for="textfield" class="control-label col-sm-2" style="text-align: left;">Upload Gambar</label>
                        					<div class="col-sm-10">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-default btn-file btn-success">
                                                        <span class="fileinput-new">&nbsp;Pilih/Ambil file&nbsp;</span>
                                                    <span class="fileinput-exists">Ganti</span>
                                                    <input type="file" name="dokumen_ch" accept="image/*" required="required">
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                </div>
                        					</div>
                        				</div>
                        				<div class="form-group">
                        					<label for="textfield" class="control-label col-sm-2" style="text-align: left;">Photo</label>
                        					<label for="textfield" class="control-label col-sm-10">
                        						<?php
                            			            $sub = $db->query("select * from tbl_charity where id='".$dt[0]['id']."'");
                            			            echo '<img src="../../dokumen/'.$data[0]['dokumen_ch'].'" width="200" style="">';
                            			        ?>
                        					</label>
                        				</div>
                        				<div class="form-group">
                        					<label for="textfield" class="control-label col-sm-2" style="text-align: left;">Tanggal Publish</label>
                        					<div class="col-sm-3">
                        						<input type="date" class="form-control" id="tgl_publish" name="tgl_publish" value="<?php echo date("Y-m-d");?>" required="required">
                        					</div>
                        				</div>
                                        <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Aktif / Non Aktif</label>
                                                    <div class="col-sm-4">
                                                        <select id="status" name="status" size="1" class="form-control">
                                                            <option value="">--Pilih Aktif / Non Aktif--</option>
                                                            <?php
                                                            if ($data[0]['status'] == 'AKTIF') {
                                                                echo '<option value="AKTIF" selected="selected">AKTIF</option>';
                                                                echo '<option value="NON AKTIF">NON AKTIF</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Donasi yang dibutuhkan</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="donasi" name="donasi" class="form-control" value="<?php echo $data[0]['donasi']?>" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" id="id" name="id" value="<?php echo $data[0]['id']?>" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Update Charity" onclick="simpanData(this.form, 'pages/mobileapps/charity_update.php')" />
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