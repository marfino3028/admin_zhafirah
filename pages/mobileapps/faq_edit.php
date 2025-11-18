<?php	
	$datafaq = $db->query("select * from tbl_faq where md5(id)='".$_GET['id']."'");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">FAQ</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">FAQ (Frequently Asked Question)</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Edit  Data</a>
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
                                        FAQ (Frequently Asked Question)
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/mobileapps/faq_update.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered  form-validate form-validate" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Header FAQ</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="header_faq" name="header_faq" class="form-control" value="<?php echo $datafaq[0]['header_faq']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">No</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="no" name="no" class="form-control" value="<?php echo $datafaq[0]['no']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Pertanyaan FAQ</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="header2" name="header2" class="form-control" value="<?php echo $datafaq[0]['header2']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Detail FAQ</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" rows="15"  name="isi_faq" id="isi_faq" ><?php echo $datafaq[0]['isi_faq']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Dokumen</label>
                                            <div class="col-sm-10">
                                                <?php echo '<a href="dokumen/'.$datafaq[0]['link_dokumen'].'" target="_blank">'.$datafaq[0]['link_dokumen'].'</a>'?>
                                            </div>
                                        </div>
                        				<div class="form-group">
                        					<label for="textfield" class="control-label col-sm-2" style="text-align: left;">Ganti Dokumen</label>
                        					<div class="col-sm-10">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-default btn-file btn-success">
                                                        <span class="fileinput-new">&nbsp;Pilih/Ambil file&nbsp;</span>
                                                    <span class="fileinput-exists">Ganti</span>
                                                    <input type="file" name="link_dokumen" accept="dokumen/*" required="required">
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                </div>
                        					</div>
                        				</div>
                        				<div class="form-group">
                          				</div>
                                        	<div class="form-group">
						<label class="control-label col-sm-2">Apakah FAQ ini membantu</label>
						<?php
							if ($datafaq[0]['ini_membantu'] == 'YA') {
						?>
						<div class="col-sm-2">
							<div class="radio">
								<label>
									<input type="radio" value="YA" id="ini_membantu" name="ini_membantu" checked>Ya
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" value="TIDAK" id="ini_membantu" name="ini_membantu">Tidak
								</label>
							</div>
						</div>
						<?php
							}
							else {
						?>
						<div class="col-sm-2">
							<div class="radio">
								<label>
									<input type="radio" value="YA" id="ini_membantu" name="ini_membantu">Ya
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" value="TIDAK" id="ini_membantu" name="ini_membantu" checked>Tidak
								</label>
							</div>
						</div>
						<?php
							}
						?>
						</div>
                                        <div class="form-actions">
                                            <input type="hidden" name="id" value="<?php echo md5($datafaq[0]['id'])?>" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan | FAQ (Frequently Asked Question)" onclick="simpanData(this.form, 'pages/mobileapps/faq_update.php')" />
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