<style>
	.table-container {
		max-height: 250px;
		overflow-y: auto;
		border: 1px solid #ccc;
		/* margin: 15px 0; */
	}

	.tableStyle {
		width: 100%;
		border-collapse: collapse;
		font-size: 9pt;
	}

	.tBthead {
		position: sticky;
		top: 0;
		background-color: #f1f1f1;
		z-index: 1;
	}

	.tBth,
	.tBtd {
		padding: 6px;
		text-align: left;
		border: 1px solid #ddd;
	}

	.tBth {
		background-color: #4CAF50;
		color: white;
	}
</style>
<?php
//$data = $db->query("select * from tbl_pasien where nomr='".$_GET['id']."'");
$today = date("Y-m-d");
$data = $db->query("select nomr, nm_pasien, round(DATEDIFF('$today', tgl_lahir) /  365) umur, tgl_lahir, jk, alamat_pasien, telp_pasien, id from tbl_pasien where status_delete='UD' and nomr='" . $_GET['id'] . "'", 0);
for ($i = 0; $i < count($data); $i++)
	$sub = $db->query("select * from tbl_catatan_dktr where nomr='" . $_GET['id'] . "' and no_daftar='" . $_GET['ids'] . "'");
if ($sub[0]['id'] > 0) $menuju = "worklist_update.php";
else $menuju = "worklist_insert.php";
//echo $menuju;
?>

<div class="box box-bordered box-color">
	<div class="box-title">
		<h3>
			<i class="fa fa-th-list"></i>Formulir Catatan Dokter untuk Pasien [<?php echo $_GET['id'] . ' - ' . $data[0]['nm_pasien'] ?>]
		</h3>
	</div>
	<div class="box-content nopadding" style="overflow: auto;">
		<div class="col-sm-7">
			<form action="pages/dokter/<?php echo $menuju ?>" method="POST" class='form-horizontal form-bordered' enctype="multipart/form-data">
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>SUBJECTIVE</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<small>CC + HPI</small>
						<input type="text" class="form-control" id="cc_hpi" name="cc_hpi" placeholder="CC + HPI" value="<?php echo $sub[0]['cc_hpi'] ?>">
					</div>
					<div class="col-sm-6">
						<small>Past Medical History</small>
						<input type="text" class="form-control" id="past_med_history" name="past_med_history" placeholder="Past Medical History" value="<?php echo $sub[0]['past_med_history'] ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<small>Past Surgical History</small>
						<input type="text" class="form-control" id="past_surgical_histort" name="past_surgical_histort" placeholder="Past Surgical History" value="<?php echo $sub[0]['past_surgical_histort'] ?>">
					</div>
					<div class="col-sm-6">
						<small>Allergies</small>
						<input type="text" class="form-control" id="alergi" name="alergi" placeholder="Allergies" value="<?php echo $sub[0]['alergi'] ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Other</small>
						<input type="text" class="form-control" id="other_subject" name="other_subject" placeholder="Other" value="<?php echo $sub[0]['other_subject'] ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>OBJECTIVE</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<small>Vitals-Weight</small>
						<input type="text" class="form-control" id="v_weight" name="v_weight" placeholder="Weight" value="<?php echo $sub[0]['v_weight'] ?>">
					</div>
					<div class="col-sm-3">
						<small>Vitals-Hiight</small>
						<input type="text" class="form-control" id="v_height" name="v_height" placeholder="Height" value="<?php echo $sub[0]['v_height'] ?>">
					</div>
					<div class="col-sm-3">
						<small>Vitals-BMI</small>
						<input type="text" class="form-control" id="v_bmi" name="v_bmi" placeholder="BMI" value="<?php echo $sub[0]['v_bmi'] ?>">
					</div>
					<div class="col-sm-3">
						<small>Vitals-BP</small>
						<input type="text" class="form-control" id="v_bp" name="v_bp" placeholder="BP" value="<?php echo $sub[0]['v_bp'] ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<small>Vitals-PR</small>
						<input type="text" class="form-control" id="v_pr" name="v_pr" placeholder="PR" value="<?php echo $sub[0]['v_pr'] ?>">
					</div>
					<div class="col-sm-3">
						<small>Vitals-RR</small>
						<input type="text" class="form-control" id="v_rr" name="v_rr" placeholder="RR" value="<?php echo $sub[0]['v_rr'] ?>">
					</div>
					<div class="col-sm-3">
						<small>Vitals-Temp</small>
						<input type="text" class="form-control" id="v_temp" name="v_temp" placeholder="Temp" value="<?php echo $sub[0]['v_temp'] ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<div class="col-sm-6">
							<small>Physical Examination-Mata</small>
							<input type="text" class="form-control" id="pe_mata" name="pe_mata" placeholder="Mata" value="<?php echo $sub[0]['pe_mata'] ?>">
						</div>
						<div class="col-sm-6" style="padding-left: 5px;">
							<small>Physical Examination-THT</small>
							<input type="text" class="form-control" id="pe_tht" name="pe_tht" placeholder="THT" value="<?php echo $sub[0]['pe_tht'] ?>">
						</div>
						<div class="col-sm-6" style="padding-top: 5px;">
							<small>Physical Examination-Jantung</small>
							<input type="text" class="form-control" id="pe_jantung" name="pe_jantung" placeholder="Jantung" value="<?php echo $sub[0]['pe_jantung'] ?>">
						</div>
						<div class="col-sm-6" style="padding-top: 5px; padding-left: 5px;">
							<small>Physical Examination-Paru</small>
							<input type="text" class="form-control" id="pe_paru" name="pe_paru" placeholder="Paru" value="<?php echo $sub[0]['pe_paru'] ?>">
						</div>
						<div class="col-sm-6" style="padding-top: 5px;">
							<small>Physical Examination-Abil</small>
							<input type="text" class="form-control" id="pe_abil" name="pe_abil" placeholder="Abil" value="<?php echo $sub[0]['pe_abil'] ?>">
						</div>
						<div class="col-sm-6" style="padding-top: 5px; padding-left: 5px;">
							<small>Physical Examination-Eks</small>
							<input type="text" class="form-control" id="pe_eks" name="pe_eks" placeholder="Eks" value="<?php echo $sub[0]['pe_eks'] ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Systemic Examination</small>
						<input type="text" class="form-control" id="s_exam" name="s_exam" placeholder="Systemic Examination" value="<?php echo $sub[0]['s_exam'] ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Observation</small>
						<input type="text" class="form-control" id="observation" name="observation" placeholder="Observation" value="<?php echo $sub[0]['observation'] ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Other</small>
						<input type="text" class="form-control" id="other_obj" name="other_obj" placeholder="Other" value="<?php echo $sub[0]['other_obj'] ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>ASSESMENT</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Diagnosis <a href="javascript:void(0)" onclick="openDiagnosa()"><i class="fa fa-fw fa-search"></i>Referensi</a></small>
						<select required="required" name="as_diagnosis" id="as_diagnosis" class="form-control"></select>
					</div>
					<div class="col-sm-12">
						<small>Problems</small>
						<input type="text" class="form-control" id="as_problems" name="as_problems" placeholder="Problems" value="<?php echo $sub[0]['as_problems'] ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<small>Progress Note</small>
						<input type="text" class="form-control" id="as_progres" name="as_progres" placeholder="Progress Note" value="<?php echo $sub[0]['as_progres'] ?>">
					</div>
					<div class="col-sm-6">
						<small>Other</small>
						<input type="text" class="form-control" id="other_as" name="other_as" placeholder="Other" value="<?php echo $sub[0]['other_as'] ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>PLANNING</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<small>Order</small>
						<input type="text" class="form-control" id="plan_order" name="plan_order" placeholder="Order" value="<?php echo $sub[0]['plan_order'] ?>">
					</div>
					<div class="col-sm-6">
						<small>Advice</small>
						<input type="text" class="form-control" id="plan_advice" name="plan_advice" placeholder="Advice" value="<?php echo $sub[0]['plan_advice'] ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<small>Konsul Internal</small>
						<input type="text" class="form-control" id="konsul_internal" name="konsul_internal" placeholder="Konsul Internal" value="<?php echo $sub[0]['konsul_internal'] ?>">
					</div>
					<div class="col-sm-6">
						<small>Order OK / VK</small>
						<input type="text" class="form-control" id="order_ok" name="order_ok" placeholder="Order OK / VK" value="<?php echo $sub[0]['order_ok'] ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<small>Prescription</small>
						<input type="text" class="form-control" id="prescrip" name="prescrip" placeholder="Prescription" value="<?php echo $sub[0]['prescrip'] ?>">
					</div>
					<div class="col-sm-6">
						<small>Other</small>
						<input type="text" class="form-control" id="other_plan" name="other_plan" placeholder="Other" value="<?php echo $sub[0]['other_plan'] ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="textfield" class="control-label col-sm-2">Di Rujuk Ke-</label>
					<div class="col-sm-10">
						<select id="rujukan" name="rujukan" class='chosen-select form-control'>
							<option value="-">-</option>
							<?php
							$thn2 = $db->query("select nama from tbl_rujukan where nama <> '' order by nama");
							for ($i = 0; $i < count($thn2); $i++) {
								if ($sub[0]['rujukan'] == $thn2[$i]['nama']) {
									echo '<option value="' . $thn2[$i]['nama'] . '" selected>' . $thn2[$i]['nama'] . '</option>';
								} else {
									echo '<option value="' . $thn2[$i]['nama'] . '">' . $thn2[$i]['nama'] . '</option>';
								}
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-actions col-sm-offset-2 col-sm-10">
					<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
					<input type="hidden" name="no_daftar" value="<?php echo $_GET['ids'] ?>">
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
						<td><?php echo $data[0]['nm_pasien'] ?></td>
					</tr>
					<tr>
						<td style="width:140px">Jenis Kelamin</td>
						<td><?php echo $data[0]['jk'] ?></td>
					</tr>
					<tr>
						<td style="width:140px">Umur</td>
						<td><?php echo $data[0]['umur'] ?> Thn</td>
					</tr>
					<tr>
						<td style="width:140px">Alamat</td>
						<td><?php echo $data[0]['alamat_pasien'] ?></td>
					</tr>
					<tr>
						<td style="width:140px">No. Telp</td>
						<td><?php echo $data[0]['telp_pasien'] ?></td>
					</tr>
				</table>
				<div class="col-sm-8">
					<h4>Medical Notes</h4>
					<div class="filetree">
						<ul>
							<li a href="index.php?mod=farmasi&submod=input_resep_obat&id=<?php echo $data[$i]['resep'] ?>" id="key1" title="Resep Elektronik">Resep Elektronik</li>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				<input type="text" id="cariDiagnosa" onkeyup="pencarianDiagnosa()" class="form-control" placeholder="Cari Diagnosa">
				<div class="table-container">
					<table class="tableStyle table table-bordered table-striped" id="table">
						<thead class="tBthead">
							<tr>
								<td style="width: 53%;">Deskripsi</td>
								<td>ICD</td>
								<td style="width: 5%;">#</td>
							</tr>
						</thead>
						<tbody id="dataDiagnosa"></tbody>

					</table>
				</div>
				<table style="width:45%; margin-top:5px">
					<thead>
						<tr>
							<td><input type="text" class="form-control" id="lainnya" placeholder="Lainnya ..."></td>
							<td style="width: 4%;"><button class="btn btn-primary" onclick="pilihLainnya()"><i class="fa fa-plus"></i></button></td>
						</tr>
					</thead>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>
<script>
	var diagnosaSelect = "<?php echo $sub[0]['as_diagnosis'] ?>";
	html = '<option value="' + diagnosaSelect + '">' + diagnosaSelect + '</option>';
	$("#as_diagnosis").html(html);

	function openDiagnosa() {
		$('#myModal').modal('show');
		$('#myModal').find('.modal-title').text('Referensi Diagnosa');
		dataDiagnosa();
	}

	function dataDiagnosa() {
		var jenis_query = "All Diagnosis";
		$.ajax({
			type: 'ajax',
			url: "pages/dokter/js_dokter.php",
			method: "POST",
			data: {
				jenis_query: jenis_query
			},
			async: true,
			dataType: 'json',
			success: function(data) {
				listDiagnosa(data);
			}
		});
	}

	function pencarianDiagnosa() {
		var cariDiagnosa = document.getElementById("cariDiagnosa").value;
		var jenis_query = "Filter Diagnosis";
		if (cariDiagnosa.length <= 2) {
			dataDiagnosa();
			return;
		}
		$.ajax({
			type: 'ajax',
			url: "pages/dokter/js_dokter.php",
			method: "POST",
			data: {
				cariDiagnosa: cariDiagnosa,
				jenis_query: jenis_query
			},
			async: true,
			dataType: 'json',
			success: function(data) {
				listDiagnosa(data);
			}
		});
	}

	function listDiagnosa(data) {
		if (data.jumlahData == 0) {
			$("#dataDiagnosa").html('<tr><td colspan="3" class="text-center">Data tidak ditemukan</td></tr>');
			return;
		}
		var html = '';
		var i;
		for (i = 0; i < data.jumlahData; i++) {
			html += `
				<tr>
					<td>${data.list[i].nama_diagnosa}</td>
					<td>${data.list[i].kode_icd} - ${data.list[i].nama_icd}</td>
					<td><button class="btn btn-primary" data-kode="${data.list[i].kode_icd}" data-nama="${data.list[i].nama_diagnosa}" data-icd="${data.list[i].nama_icd}" onclick="pilihDiagnosa(this)"><i class="fa fa-plus"></i></button></td>
				</tr>
			`
		}
		$("#dataDiagnosa").html(html);
	}

	function pilihDiagnosa(e) {
		var nama = e.getAttribute("data-nama");
		var icd = e.getAttribute("data-icd");
		var kodeicd = e.getAttribute("data-kode");
		$('#myModal').modal('hide');
		var html = '<option value="' + nama + '">' + icd + ' - ' + nama + ' - '+ kodeicd +'</option>';
		$("#as_diagnosis").html(html);
	}

	function pilihLainnya() {
		var lainnya = document.getElementById("lainnya").value;
		$('#myModal').modal('hide');
		var html = '<option value="' + lainnya + '">' + lainnya + '</option>';
		$("#as_diagnosis").html(html);
	}
</script>