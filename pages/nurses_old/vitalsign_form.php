<?php
	//$data = $db->query("select * from tbl_pasien where nomr='".$_GET['id']."'");
        $today = date("Y-m-d");
        $data = $db->query("select nomr, nm_pasien, round(DATEDIFF('$today', tgl_lahir) /  365) umur, tgl_lahir, jk, alamat_pasien, telp_pasien, id from tbl_pasien where status_delete='UD' and  nomr='".$_GET['id']."'", 0);
              for ($i = 0; $i < count($data); $i++)
	$sub = $db->query("select * from tbl_catatan_dktr where nomr='".$_GET['id']."' and no_daftar='".$_GET['ids']."'", 0);
	if ($sub[0]['id'] > 0) $menuju = "worklist_update.php";
	else $menuju = "worklist_insert.php";
//echo $menuju;
?>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- PageGuide -->
	<link rel="stylesheet" href="css/plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- Tagsinput -->
	<link rel="stylesheet" href="css/plugins/tagsinput/jquery.tagsinput.css">
	<!-- chosen -->
	<link rel="stylesheet" href="css/plugins/chosen/chosen.css">
	<!-- multi select -->
	<link rel="stylesheet" href="css/plugins/multiselect/multi-select.css">
	<!-- timepicker -->
	<link rel="stylesheet" href="css/plugins/timepicker/bootstrap-timepicker.min.css">
	<!-- colorpicker -->
	<link rel="stylesheet" href="css/plugins/colorpicker/colorpicker.css">
	<!-- Datepicker -->
	<link rel="stylesheet" href="css/plugins/datepicker/datepicker.css">
	<!-- Daterangepicker -->
	<link rel="stylesheet" href="css/plugins/daterangepicker/daterangepicker.css">
	<!-- Plupload -->
	<link rel="stylesheet" href="css/plugins/plupload/jquery.plupload.queue.css">
	<!-- select2 -->
	<link rel="stylesheet" href="css/plugins/select2/select2.css">
	<!-- icheck -->
	<link rel="stylesheet" href="css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">
	<!-- Filetree -->
	<link rel="stylesheet" href="css/plugins/dynatree/ui.dynatree.css">

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>

	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- imagesLoaded -->
	<script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- jQuery UI -->
	<script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.spinner.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.slider.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Bootbox -->
	<script src="js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Masked inputs -->
	<script src="js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
	<!-- TagsInput -->
	<script src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<!-- Datepicker -->
	<script src="js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Daterangepicker -->
	<script src="js/plugins/daterangepicker/moment.min.js"></script>
	<script src="js/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Timepicker -->
	<script src="js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- Colorpicker -->
	<script src="js/plugins/colorpicker/bootstrap-colorpicker.js"></script>
	<!-- Chosen -->
	<script src="js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- MultiSelect -->
	<script src="js/plugins/multiselect/jquery.multi-select.js"></script>
	<!-- CKEditor -->
	<script src="js/plugins/ckeditor/ckeditor.js"></script>
	<!-- PLUpload -->
	<script src="js/plugins/plupload/plupload.full.js"></script>
	<script src="js/plugins/plupload/jquery.plupload.queue.js"></script>
	<!-- Custom file upload -->
	<script src="js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
	<script src="js/plugins/mockjax/jquery.mockjax.js"></script>
	<!-- select2 -->
	<script src="js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- complexify -->
	<script src="js/plugins/complexify/jquery.complexify-banlist.min.js"></script>
	<script src="js/plugins/complexify/jquery.complexify.min.js"></script>
	<!-- Mockjax -->
	<script src="js/plugins/mockjax/jquery.mockjax.js"></script>
	<!-- Filetree -->
	<script src="js/plugins/dynatree/jquery.dynatree.js"></script>


	<!-- Theme framework -->
	<script src="js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>

	<script language="javascript">
		function hitungBMI() {
			var berat = document.getElementById("v_weight").value;
			var tinggi = document.getElementById("v_height").value;

			if (berat > 0 && tinggi > 0) {
			   tg = tinggi / 100;
			   bmi = berat / (tg * tg)
			}
			else {
			   bmi = 0;
			}
			document.getElementById("v_bmi").value = bmi.toFixed(2)
		}
	</script>
<div>
	<div class="box box-bordered box-color">
		<div class="box-title">
			<h3>
				<i class="fa fa-th-list"></i>Vital Sign [<?php echo $_GET['id'].' - '.$data[0]['nm_pasien']?>]</h3>
		</div>
		<div class="box-content nopadding" style="overflow: auto;">
          	<div class="col-sm-7">
			<form action="pages/nurses/<?php echo $menuju?>" method="POST" class='form-horizontal form-bordered' enctype="multipart/form-data">
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>VITAL SIGN</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
					  	<small>Vitals-Weight</small>
                      			  	<input type="number" class="form-control" onkeyup="hitungBMI()" id="v_weight" name="v_weight" placeholder="Weight" value="<?php echo $sub[0]['v_weight']?>" required="required">
					</div>
					<div class="col-sm-3">
						<small>Vitals-Height</small>
						<input type="number" class="form-control" onkeyup="hitungBMI()" id="v_height" name="v_height" placeholder="Height" value="<?php echo $sub[0]['v_height']?>" required="required">
					</div>
					<div class="col-sm-3">
						<small>Vitals-BMI</small>
						<input type="text" class="form-control" id="v_bmi" name="v_bmi" placeholder="BMI" value="<?php echo $sub[0]['v_bmi']?>" readonly>
					</div>
					<div class="col-sm-3">
						<small>Vitals-BP Sistolik</small>
						<input type="text" class="form-control" id="v_bp" name="v_bp" placeholder="BP Sistolik" value="<?php echo $sub[0]['v_bp']?>" required="required">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<small>Vitals-BP Diastolik</small>
						<input type="text" class="form-control" id="v_bpd" name="v_bpd" placeholder="BP Diastolik" value="<?php echo $sub[0]['v_bpd']?>">
					</div>					
					<div class="col-sm-3">
						<small>Vitals-PR</small>
						<input type="text" class="form-control" id="v_pr" name="v_pr" placeholder="PR" value="<?php echo $sub[0]['v_pr']?>" required="required">
					</div>
					<div class="col-sm-3">
						<small>Vitals-RR</small>
						<input type="text" class="form-control" id="v_rr" name="v_rr" placeholder="RR" value="<?php echo $sub[0]['v_rr']?>" required="required">
					</div>
					<div class="col-sm-3">
						<small>Vitals-Temp</small>
						<input type="text" class="form-control" id="v_temp" name="v_temp" placeholder="Temp" value="<?php echo $sub[0]['v_temp']?>" required="required">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
                      	<small>Lingkar Kepala</small>
						<input type="text" class="form-control" id="lingkar_k" name="lingkar_k" placeholder="Lingkar Kepala" value="<?php echo $sub[0]['lingkar_k']?>" required="required">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
                      	<small>SPO2</small>
						<input type="text" class="form-control" id="spo2" name="spo2" placeholder="SPO2" value="<?php echo $sub[0]['spo2']?>" required="required">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
                      	<small>Pain Level</small>
						<input type="text" class="form-control" id="pain_l" name="pain_l" placeholder="Pain Level" value="<?php echo $sub[0]['pain_l']?>" required="required">
					</div>
				</div>
				<div class="form-actions col-sm-offset-2 col-sm-10">
					<input type="hidden" name="id" value="<?php echo $_GET['id']?>">
					<input type="hidden" name="no_daftar" value="<?php echo $_GET['ids']?>">
					<button type="submit" class="btn btn-primary">Save Data</button>
					<button type="button" class="btn" onclick="return window.location = 'index.php?mod=nurses&submod=worklist';">Cancel</button>
				</div>
			</form>
          </div>
          <div class="col-sm-5">
            <p style="font-size: 20px; margin-top: 10px;">Detail Pasien</p>
            <div>
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
                  <td style="width:140px">Umur</td>
                  <td><?php echo $data[0]['umur']?> Thn</td>
                </tr>
                <tr>
                  <td style="width:140px">Alamat</td>
                  <td><?php echo $data[0]['alamat_pasien']?></td>
                </tr>
                <tr>
                  <td style="width:140px">No. Telp</td>
                  <td><?php echo $data[0]['telp_pasien']?></td>
                </tr>
              </table>
								<div class="col-sm-8">
									<h4>Medical Notes</h4>
									<div class="filetree">
										<ul>
											<li a href="index.php?mod=farmasi&submod=input_resep_obat&id=<?php echo $data[$i]['resep']?>" id="key1" title="Resep Elektronik">Resep Elektronik</li>
											<li id="key2" title="Catatan Integrasi">Catatan Integrasi</li>
											<li id="key3" title="Layanan Penunjang Medis">Order Layanan Penunjang Medis
												<ul>
													<li id="key3.1">Radiologi</li>
													<li id="key3.2">Laboratorium</li>
												</ul>
											</li>
										</ul>
									</div>
								</div>
            </div>
          </div>
		</div>
	</div>
</div>