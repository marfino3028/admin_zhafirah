<?php
	$data = $db->query("select * from tbl_pasien where nomr='".$_GET['id']."'");
	$sub = $db->query("select * from tbl_catatan_dktr where nomr='".$_GET['id']."' and no_daftar='".$_GET['ids']."'");
	if ($sub[0]['id'] > 0) $menuju = "worklist_update.php";
	else $menuju = "worklist_insert.php";
echo $menuju;
?>
<div>
	<div class="box box-bordered box-color">
		<div class="box-title">
			<h3>
				<i class="fa fa-th-list"></i>Formulir Catatan Dokter untuk Pasien [<?php echo $_GET['id'].' - '.$data[0]['nm_pasien']?>]</h3>
		</div>
		<div class="box-content nopadding" style="overflow: auto;">
          	<div class="col-sm-7">
			<form action="pages/dokter/<?php echo $menuju?>" method="POST" class='form-horizontal form-bordered' enctype="multipart/form-data">
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>SUBJECTIVE</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>CC + HPI</small>
						<input type="text" class="form-control" id="cc_hpi" name="cc_hpi" placeholder="CC + HPI" value="<?php echo $sub[0]['cc_hpi']?>" readonly="readonly">
					</div>
					<div class="col-sm-6">
                      <small>Past Medical History</small>
						<input type="text" class="form-control" id="past_med_history" name="past_med_history" placeholder="Past Medical History" readonly="readonly" value="<?php echo $sub[0]['past_med_history']?>">
                    </div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Past Surgical History</small>
						<input type="text" class="form-control" id="past_surgical_histort" name="past_surgical_histort" placeholder="Past Surgical History" readonly="readonly" value="<?php echo $sub[0]['past_surgical_histort']?>">
					</div>
					<div class="col-sm-6">
                      	<small>Allergies</small>
						<input type="text" class="form-control" id="alergi" name="alergi" placeholder="Allergies" value="<?php echo $sub[0]['alergi']?>" readonly="readonly">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
                      	<small>Other</small>
						<input type="text" class="form-control" id="other_subject" name="other_subject" placeholder="Other" value="<?php echo $sub[0]['other_subject']?>" readonly="readonly">
					</div>
				</div>
                
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>OBJECTIVE</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
					  <small>Vitals-Weight</small>
                      <input type="text" class="form-control" id="v_weight" name="v_weight" placeholder="Weight" value="<?php echo $sub[0]['v_weight']?>" readonly="readonly">
					</div>
					<div class="col-sm-3">
						<small>Vitals-Hiight</small>
						<input type="text" class="form-control" id="v_height" name="v_height" placeholder="Height" value="<?php echo $sub[0]['v_height']?>" readonly="readonly">
					</div>
					<div class="col-sm-3">
						<small>Vitals-BMI</small>
						<input type="text" class="form-control" id="v_bmi" name="v_bmi" placeholder="BMI" value="<?php echo $sub[0]['v_bmi']?>" readonly="readonly">
					</div>
					<div class="col-sm-3">
						<small>Vitals-BP</small>
						<input type="text" class="form-control" id="v_bp" name="v_bp" placeholder="BP" value="<?php echo $sub[0]['v_bp']?>" readonly="readonly">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<small>Vitals-PR</small>
						<input type="text" class="form-control" id="v_pr" name="v_pr" placeholder="PR" value="<?php echo $sub[0]['v_pr']?>" readonly="readonly">
					</div>
					<div class="col-sm-3">
						<small>Vitals-RR</small>
						<input type="text" class="form-control" id="v_rr" name="v_rr" placeholder="RR" value="<?php echo $sub[0]['v_rr']?>" readonly="readonly">
					</div>
					<div class="col-sm-3">
						<small>Vitals-Temp</small>
						<input type="text" class="form-control" id="v_temp" name="v_temp" placeholder="Temp" value="<?php echo $sub[0]['v_temp']?>" readonly="readonly">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<div class="col-sm-6">
                            <small>Physical Examination-Mata</small>
                          	<input type="text" class="form-control" id="pe_mata" name="pe_mata" placeholder="Mata" value="<?php echo $sub[0]['pe_mata']?>" readonly="readonly">
                      	</div>
						<div class="col-sm-6" style="padding-left: 5px;">
                            <small>Physical Examination-THT</small>
                          <input type="text" class="form-control" id="pe_tht" name="pe_tht" placeholder="THT" value="<?php echo $sub[0]['pe_tht']?>" readonly="readonly">
                      	</div>
						<div class="col-sm-6" style="padding-top: 5px;">
                            <small>Physical Examination-Jantung</small>
                          <input type="text" class="form-control" id="pe_jantung" name="pe_jantung" placeholder="Jantung" value="<?php echo $sub[0]['pe_jantung']?>" readonly="readonly">
                      	</div>
						<div class="col-sm-6" style="padding-top: 5px; padding-left: 5px;">
                            <small>Physical Examination-Paru</small>
                          <input type="text" class="form-control" id="pe_paru" name="pe_paru" placeholder="Paru" value="<?php echo $sub[0]['pe_paru']?>" readonly="readonly">
                      	</div>
						<div class="col-sm-6" style="padding-top: 5px;">
                            <small>Physical Examination-Abil</small>
                          <input type="text" class="form-control" id="pe_abil" name="pe_abil" placeholder="Abil" value="<?php echo $sub[0]['pe_abil']?>" readonly="readonly">
                      	</div>
						<div class="col-sm-6" style="padding-top: 5px; padding-left: 5px;">
                            <small>Physical Examination-Eks</small>
                          <input type="text" class="form-control" id="pe_eks" name="pe_eks" placeholder="Eks" value="<?php echo $sub[0]['pe_eks']?>" readonly="readonly">
                      	</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
                      	<small>Systemic Examination</small>
						<input type="text" class="form-control" id="s_exam" name="s_exam" placeholder="Systemic Examination" value="<?php echo $sub[0]['s_exam']?>" readonly="readonly">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
                      	<small>Observation</small>
						<input type="text" class="form-control" id="observation" name="observation" placeholder="Observation" value="<?php echo $sub[0]['observation']?>" readonly="readonly">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
                      	<small>Other</small>
						<input type="text" class="form-control" id="other_obj" name="other_obj" placeholder="Other" value="<?php echo $sub[0]['other_obj']?>" readonly="readonly">
					</div>
				</div>
                
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>ASSESMENT</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Diagnosis</small>
                      <input type="text" class="form-control" id="as_problems" name="as_problems" placeholder="Diagnosis" value="<?php echo $sub[0]['as_diagnosis']?>" readonly="readonly">	
					</div>
					<div class="col-sm-6">
                      	<small>Problems</small>
						<input type="text" class="form-control" id="as_problems" name="as_problems" placeholder="Problems" value="<?php echo $sub[0]['as_problems']?>" readonly="readonly">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Progress Note</small>
						<input type="text" class="form-control" id="as_progres" name="as_progres" placeholder="Progress Note" value="<?php echo $sub[0]['as_progres']?>" readonly="readonly">
					</div>
					<div class="col-sm-6">
                      	<small>Other</small>
						<input type="text" class="form-control" id="other_as" name="other_as" placeholder="Other" value="<?php echo $sub[0]['other_as']?>" readonly="readonly">
					</div>
				</div>
                
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>PLANNING</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Order</small>
						<input type="text" class="form-control" id="plan_order" name="plan_order" placeholder="Order" value="<?php echo $sub[0]['plan_order']?>" readonly="readonly">
					</div>
					<div class="col-sm-6">
                      	<small>Advice</small>
						<input type="text" class="form-control" id="plan_advice" name="plan_advice" placeholder="Advice" value="<?php echo $sub[0]['plan_advice']?>" readonly="readonly">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Konsul Internal</small>
						<input type="text" class="form-control" id="konsul_internal" name="konsul_internal" placeholder="Konsul Internal" value="<?php echo $sub[0]['konsul_internal']?>" readonly="readonly">
					</div>
					<div class="col-sm-6">
                      	<small>Order OK / VK</small>
						<input type="text" class="form-control" id="order_ok" name="order_ok" placeholder="Order OK / VK" value="<?php echo $sub[0]['order_ok']?>" readonly="readonly">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Prescription</small>
						<input type="text" class="form-control" id="prescrip" name="prescrip" placeholder="Prescription" value="<?php echo $sub[0]['prescrip']?>" readonly="readonly">
					</div>
					<div class="col-sm-6">
                      	<small>Other</small>
						<input type="text" class="form-control" id="other_plan" name="other_plan" placeholder="Other" value="<?php echo $sub[0]['other_plan']?>" readonly="readonly">
					</div>
				</div>

				<div class="form-group">
					<label for="textfield" class="control-label col-sm-2">Di Rujuk Ke-</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="other_plan" name="other_plan" placeholder="Belum diisi Rujukannya" value="<?php echo $sub[0]['rujukan']?>" readonly="readonly">	
					</div>
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