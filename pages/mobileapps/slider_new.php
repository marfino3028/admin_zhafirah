	<?php
	$sub = $db->query("select * from tbl_image where id='".$_GET['id']."'");
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
                <a href="javascript:void(0)">Upload :</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Image Slider</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Upload Image Slider</a>
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
                                        Upload Image Slider
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/mobileapps/slider_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered  form-validate form-validate" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Title Image</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="image_name" name="image_name" class="form-control" value="<?php echo $data[0]['image_name']?>" />
                                            </div>
                                        </div>                        				
                        				<div class="form-group">
                        					<label for="textfield" class="control-label col-sm-2" style="text-align: left;">Upload Gambar</label>
                        					<div class="col-sm-10">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-default btn-file btn-success">
                                                        <span class="fileinput-new">&nbsp;Pilih/Ambil file&nbsp;</span>
                                                    <span class="fileinput-exists">Ganti</span>
                                                    <input type="file" name="dokumen_im" accept="image/*" required="required">
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                </div>
                        					</div>
                        				</div>
                        				<div class="form-group">
                        					<label for="textfield" class="control-label col-sm-2" style="text-align: left;">Slider Image</label>
                        					<label for="textfield" class="control-label col-sm-10">
                        						<img src="dokumen/<?php echo $dt[0]['dokumen_im']?>" width="200" style="border: 1px solid black;"><br>&nbsp;
                        					</label>
                        				</div>
                        				<div class="form-group">
                        					<label for="textfield" class="control-label col-sm-2" style="text-align: left;">Aktif / Non Aktif</label>
                        					<div class="col-sm-2">
                                                <select id="status" name="status" size="1" class="chosen-select form-control" style="width: 100%;">
                                                    <option value="-">-PILIH STATUS PUBLISH-</option>
                                                    <option value="AKTIF">AKTIF</option>
                                                    <option value="NON AKTIF">NON AKTIF</option>
                                                </select>
                        					</div>
                        				</div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Image Slider" onclick="simpanData(this.form, 'pages/mobileapps/slider_insert.php')" />
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