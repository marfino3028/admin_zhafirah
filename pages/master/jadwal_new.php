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
                <a href="javascript:void(0)">Dokter</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Setup Jadwal Dokter</a>
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
                                        Setup Jadwal Dokter
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/dokter_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Pilih Poli / Layanan</label>                                           
                                            <div class="col-sm-2">
                                                        <select class="form-control" id="poli" name="poli">
                                                            <option value="">--Pilih Poli--</option>
                                        					<?php
                                        					    $sub = $db->query("select kd_poli, nama_poli from tbl_poli where status_delete='UD'");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        echo '<option value="'.$sub[$i]['kd_poli'].'">'.$sub[$i]['nama_poli'].'</option>';
                                        					    }
                                        					?>
														</select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Pilih Dokter</label>
                                            <div class="col-sm-4">
                                                        <select class="form-control" id="dokter" name="dokter">
                                                            <option value="">--Pilih Dokter--</option>
                                        					<?php
                                        					    $sub = $db->query("select kode_dokter, nama_dokter from tbl_dokter where status_delete='UD'");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        echo '<option value="'.$sub[$i]['kode_dokter'].'">'.$sub[$i]['nama_dokter'].'</option>';
                                        					    }
                                        					?>
														</select>
                                            </div>  
                                        </div>
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-2">Jadwal Dokter</label>
					<div class="col-sm-4">
						<select id="tanggal" name="tanggal" class="chosen-select form-control" >
							<option value="">--Pilih Hari--</option>
							<?php
							$hr = array("", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
							for ($i = 1; $i < 8; $i++) {
								echo '<option value="'.$i.'">'.$hr[$i].'</option>';
							}
							?>
						</select>
					</div>
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-1" style="text-align: right;">Mulai</label>
					<div class="col-sm-2">
						<input type="text" id="mulai2" name="mulai2" class="form-control" placeholder="Mulai"/>
					</div>
					<label for="textfield" class="control-label col-sm-1" style="text-align: right;">Selesai</label>
					<div class="col-sm-2">
						<input type="text" id="selesai2" name="selesai2" class="form-control" placeholder="Selesai"/>
					</div>
				</div>
				</div>
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-2">
                    	Keterangan
                        <small>Apabila ada tanda *</small>
                    </label>
					<div class="col-sm-10">
						<input type="text" id="keterangan" name="keterangan" class="form-control" autocomplete="off" placeholder="Keterangan" />
					</div>
				</div>
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-2">Sesuai Janji (janjian)</label>
					<div class="col-sm-2">
						<select id="janji" name="janji" class="chosen-select form-control" >
							<option value="">--Pilih Jawaban--</option>
							<option value="*Dengan Perjanjian">Ya</option>
						</select>
					</div>
					<label for="textfield" class="control-label col-sm-8">
                    	<small>
                        	Apabila pilih Ya, maka jadwalnya adalah : <i>Dengan Perjanjian</i> dan kolom mulai dan selesai akan kosong
                        </small>
                    </label>
				</div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Jadwal Dokter" onclick="simpanData(this.form, 'pages/master/jadwal_insert.php')" />
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