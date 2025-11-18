<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">FeedBack</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">FeedBack User</a>
                <i class="fa fa-angle-right"></i>
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
                                        FeedBack User
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/mobileapps/feed_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered  form-validate form-validate" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">User</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="User" name="User" class="form-control" placeHolder="User" value="<?php echo $_SESSION['rg_nama']?>" />
                                            </div>
                                        </div>
					<div class="form-group">
						<label class="control-label col-sm-2">Rating</label>
						<div class="col-sm-2">
							<div class="radio">
								<label><input type="radio" value="1" id="rating1" name="rating">Sangat Kurang Bagus</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="2" id="rating2" name="rating">Kurang Bagus</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="3" id="rating3" name="rating">Bagus</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="4" id="rating4" name="rating">Sangat Bagus</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="5" id="rating5" name="rating">Sangat Bagus Sekali</label>
							</div>
						</div>
					</div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Isi FeedBack</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" rows="5"  name="isi" id="isi" ><?php echo $data[0]['isi_faq']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Submit FeedBack" onclick="simpanData(this.form, 'pages/mobileapps/feed_insert.php')" />
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