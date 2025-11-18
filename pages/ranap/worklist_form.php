<?php
	$data = $db->query("select * from tbl_pasien where md5(nomr)='".$_GET['id']."'");
	$menuju = "worklist_insert.php";
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


<div>
	<div class="box box-bordered box-color">
		<div class="box-title">
			<h3>
				<i class="fa fa-th-list"></i>Formulir Catatan Dokter untuk Pasien [<?php echo $data[0]['nomr'].' - '.$data[0]['nm_pasien']?>]</h3>
		</div>
		<div class="box-content nopadding" style="overflow: auto;">
          <form action="pages/ranap/<?php echo $menuju?>" method="POST" class='form-horizontal form-bordered' enctype="multipart/form-data">
            <div class="form-group">
              <div class="col-sm-1"></div>
              <div class="col-sm-2">
                <small style="margin-left: 20px;">Tanggal Pemeriksaan</small>
                <input type="date" class="form-control" id="tgl" name="tgl" value="<?php echo date("Y-m-d")?>" style="padding-left: 20px;">
              </div>
              <div class="col-sm-9"></div>
            </div>         	
            <div class="col-sm-7">
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>SUBJECTIVE</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>CC + HPI</small>
						<input type="text" class="form-control" id="cc_hpi" name="cc_hpi" placeholder="CC + HPI" value="<?php echo $sub[0]['cc_hpi']?>">
					</div>
					<div class="col-sm-6">
                      <small>Past Medical History</small>
						<input type="text" class="form-control" id="past_med_history" name="past_med_history" placeholder="Past Medical History" value="<?php echo $sub[0]['past_med_history']?>">
                    </div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Past Surgical History</small>
						<input type="text" class="form-control" id="past_surgical_histort" name="past_surgical_histort" placeholder="Past Surgical History" value="<?php echo $sub[0]['past_surgical_histort']?>">
					</div>
					<div class="col-sm-6">
                      	<small>Allergies</small>
						<input type="text" class="form-control" id="alergi" name="alergi" placeholder="Allergies" value="<?php echo $sub[0]['alergi']?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
                      	<small>Other</small>
						<input type="text" class="form-control" id="other_subject" name="other_subject" placeholder="Other" value="<?php echo $sub[0]['other_subject']?>">
					</div>
				</div>
                
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>OBJECTIVE</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
					  <small>Vitals-Weight</small>
                      <input type="text" class="form-control" id="v_weight" name="v_weight" placeholder="Weight" value="<?php echo $sub[0]['v_weight']?>">
					</div>
					<div class="col-sm-3">
						<small>Vitals-Hiight</small>
						<input type="text" class="form-control" id="v_height" name="v_height" placeholder="Height" value="<?php echo $sub[0]['v_height']?>">
					</div>
					<div class="col-sm-3">
						<small>Vitals-BMI</small>
						<input type="text" class="form-control" id="v_bmi" name="v_bmi" placeholder="BMI" value="<?php echo $sub[0]['v_bmi']?>">
					</div>
					<div class="col-sm-3">
						<small>Vitals-BP</small>
						<input type="text" class="form-control" id="v_bp" name="v_bp" placeholder="BP" value="<?php echo $sub[0]['v_bp']?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<small>Vitals-PR</small>
						<input type="text" class="form-control" id="v_pr" name="v_pr" placeholder="PR" value="<?php echo $sub[0]['v_pr']?>">
					</div>
					<div class="col-sm-3">
						<small>Vitals-RR</small>
						<input type="text" class="form-control" id="v_rr" name="v_rr" placeholder="RR" value="<?php echo $sub[0]['v_rr']?>">
					</div>
					<div class="col-sm-3">
						<small>Vitals-Temp</small>
						<input type="text" class="form-control" id="v_temp" name="v_temp" placeholder="Temp" value="<?php echo $sub[0]['v_temp']?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<div class="col-sm-6">
                            <small>Physical Examination-Mata</small>
                          	<input type="text" class="form-control" id="pe_mata" name="pe_mata" placeholder="Mata" value="<?php echo $sub[0]['pe_mata']?>">
                      	</div>
						<div class="col-sm-6" style="padding-left: 5px;">
                            <small>Physical Examination-THT</small>
                          <input type="text" class="form-control" id="pe_tht" name="pe_tht" placeholder="THT" value="<?php echo $sub[0]['pe_tht']?>">
                      	</div>
						<div class="col-sm-6" style="padding-top: 5px;">
                            <small>Physical Examination-Jantung</small>
                          <input type="text" class="form-control" id="pe_jantung" name="pe_jantung" placeholder="Jantung" value="<?php echo $sub[0]['pe_jantung']?>">
                      	</div>
						<div class="col-sm-6" style="padding-top: 5px; padding-left: 5px;">
                            <small>Physical Examination-Paru</small>
                          <input type="text" class="form-control" id="pe_paru" name="pe_paru" placeholder="Paru" value="<?php echo $sub[0]['pe_paru']?>">
                      	</div>
						<div class="col-sm-6" style="padding-top: 5px;">
                            <small>Physical Examination-Abil</small>
                          <input type="text" class="form-control" id="pe_abil" name="pe_abil" placeholder="Abil" value="<?php echo $sub[0]['pe_abil']?>">
                      	</div>
						<div class="col-sm-6" style="padding-top: 5px; padding-left: 5px;">
                            <small>Physical Examination-Eks</small>
                          <input type="text" class="form-control" id="pe_eks" name="pe_eks" placeholder="Eks" value="<?php echo $sub[0]['pe_eks']?>">
                      	</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
                      	<small>Systemic Examination</small>
						<input type="text" class="form-control" id="s_exam" name="s_exam" placeholder="Systemic Examination" value="<?php echo $sub[0]['s_exam']?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
                      	<small>Observation</small>
						<input type="text" class="form-control" id="observation" name="observation" placeholder="Observation" value="<?php echo $sub[0]['observation']?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
                      	<small>Other</small>
						<input type="text" class="form-control" id="other_obj" name="other_obj" placeholder="Other" value="<?php echo $sub[0]['other_obj']?>">
					</div>
				</div>
                
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>ASSESMENT</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
                      	<small>Diagnosis</small>
                        <select name="as_diagnosis[]" id="a" multiple="multiple" class="chosen-select form-control" required="required">
                          
                          <?php
  								$diag = $db->query("select nama_diagnosa, nama_icd from tbl_icd");
              					for ($i = 0; $i < count($diag); $i++) {
                                  	echo '<option value="'.$diag[$i]['nama_diagnosa'].'">'.$diag[$i]['nama_icd'].' - '.$diag[$i]['nama_diagnosa'].'</option>';
                                }
  						  ?>
                        </select>
					</div>
					<div class="col-sm-12">
                      	<small>Problems</small>
						<input type="text" class="form-control" id="as_problems" name="as_problems" placeholder="Problems" value="<?php echo $sub[0]['as_problems']?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Progress Note</small>
						<input type="text" class="form-control" id="as_progres" name="as_progres" placeholder="Progress Note" value="<?php echo $sub[0]['as_progres']?>">
					</div>
					<div class="col-sm-6">
                      	<small>Other</small>
						<input type="text" class="form-control" id="other_as" name="other_as" placeholder="Other" value="<?php echo $sub[0]['other_as']?>">
					</div>
				</div>
                
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>PLANNING</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Order</small>
						<input type="text" class="form-control" id="plan_order" name="plan_order" placeholder="Order" value="<?php echo $sub[0]['plan_order']?>">
					</div>
					<div class="col-sm-6">
                      	<small>Advice</small>
						<input type="text" class="form-control" id="plan_advice" name="plan_advice" placeholder="Advice" value="<?php echo $sub[0]['plan_advice']?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Konsul Internal</small>
						<input type="text" class="form-control" id="konsul_internal" name="konsul_internal" placeholder="Konsul Internal" value="<?php echo $sub[0]['konsul_internal']?>">
					</div>
					<div class="col-sm-6">
                      	<small>Order OK / VK</small>
						<input type="text" class="form-control" id="order_ok" name="order_ok" placeholder="Order OK / VK" value="<?php echo $sub[0]['order_ok']?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Prescription</small>
						<input type="text" class="form-control" id="prescrip" name="prescrip" placeholder="Prescription" value="<?php echo $sub[0]['prescrip']?>">
					</div>
					<div class="col-sm-6">
                      	<small>Other</small>
						<input type="text" class="form-control" id="other_plan" name="other_plan" placeholder="Other" value="<?php echo $sub[0]['other_plan']?>">
					</div>
				</div>

				<div class="form-group">
					<label for="textfield" class="control-label col-sm-2">Di Rujuk Ke-</label>
					<div class="col-sm-10">
						<select id="rujukan" name="rujukan" class='chosen-select form-control'>
							<?php
								$thn2 = $db->query("select nama_rs_rujukan from tbl_rs_rujukan where nama_rs_rujukan <> '' order by nama_rs_rujukan");
								for ($i = 0; $i < count($thn2); $i++) {
									if ($sub[0]['rujukan'] == $thn2[$i]['nama_rs_rujukan']) {
										echo '<option value="'.$thn2[$i]['nama_rs_rujukan'].'" selected>'.$thn2[$i]['nama_rs_rujukan'].'</option>';									}
									else {
										echo '<option value="'.$thn2[$i]['nama_rs_rujukan'].'">'.$thn2[$i]['nama_rs_rujukan'].'</option>';
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-actions col-sm-offset-2 col-sm-10">
					<input type="hidden" name="id" value="<?php echo $_GET['id']?>">
					<input type="hidden" name="no_daftar" value="<?php echo $_GET['ids']?>">
					<button type="submit" class="btn btn-primary">Save Data</button>
					<button type="button" class="btn" onclick="return window.location = 'index.php?mod=dokter&submod=worklist';">Cancel</button>
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
                  <td><?php echo $data[0]['tmpt_lahir']?></td>
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
            </div>
          </div>
		</div>
	</div>
</div>