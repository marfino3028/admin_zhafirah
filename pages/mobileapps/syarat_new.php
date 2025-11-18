	<?php
	$sub = $db->query("select * from tbl_news where id='".$_GET['id']."'");
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
                <a href="javascript:void(0)">CMS</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Promo dan Berita</a>
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
                                        Tambah Syarat dan Ketentuan 
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/mobileapps/syarat_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered  form-validate form-validate" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">No</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="Number" name="Number" class="form-control" value="<?php echo $data[0]['no']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Syarat & Ketentuan</label>
                                            <div class="col-sm-10">
                                                <textarea tabindex="2" cols="50" rows="2" class="ckeditor span12" name="content" id="content" ><?php echo $data[0]['content']?></textarea>
                                            </div>
                                        </div>
                                         <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Syarat dan Ketentuan" onclick="simpanData(this.form, 'pages/mobileapps/syarat_insert.php')" />
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