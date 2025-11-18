<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Kelas Rawat Inap</a>
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
                                        Form Edit Data Master Kelas Rawat Inap
                                  </h3>
                                </div>
                              	<?php
                              		$data = $db->query("select id, kode, nama from tbl_kelas where md5(id)='".$_GET['id']."'");
                              	?>
                                <div class="box-content nopadding">
                                    <form action="pages/master/kelas_update.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Kelas</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="kode" name="kode" value="<?php echo $data[0]['kode']?>" class="form-control" required="required" Placeholder="Kode" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Kelas</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nama" name="nama" value="<?php echo $data[0]['nama']?>" class="form-control" required="required" Placeholder="Nama Kelas" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Tarif</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="tarif" name="tarif" value="<?php echo $data[0]['tarif']?>" class="form-control" required="required" Placeholder="Tarif Kelas" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                          	<input type="hidden" name="id" value="<?php echo md5($data[0]['id'])?>" />
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Kelas Ruang Inap" />
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