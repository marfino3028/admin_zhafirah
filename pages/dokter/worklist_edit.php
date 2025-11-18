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
	$sub = $db->query("select * from tbl_catatan_dktr where md5(id)='".$_GET['kode']."'");
if ($sub[0]['id'] > 0) $menuju = "worklist_updates.php";
else $menuju = "worklist_insert.php";
//echo $menuju;
?>

<div class="box box-bordered box-color">
	<div class="box-title">
		<h3>
			<i class="fa fa-th-list"></i>Edit Formulir Catatan Dokter untuk Pasien <?php echo $data[0]['nm_pasien'] ?>
		</h3>
	</div>
	<div class="box-content nopadding" style="overflow: auto;">
		<div class="col-sm-7">
			<form action="pages/dokter/<?php echo $menuju ?>" method="POST" class='form-horizontal form-bordered' enctype="multipart/form-data">
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>SUBJECTIVE</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Anamnesis (Nurses)</small>
						<textarea tabindex="2" cols="50" rows="3" class="form-control" id="anamnesis" name="anamnesis" placeholder="Anamnesis"><?php echo $sub[0]['anamnesis'] ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Anamnesis (Doctor)</small>
						<textarea tabindex="2" cols="50" rows="3" class="form-control" id="cc_hpi" name="cc_hpi" placeholder="CC + HPI"><?php echo $sub[0]['cc_hpi'] ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Past Medical History</small>
						<input type="text" class="form-control" id="past_med_history" name="past_med_history" placeholder="Past Medical History" value="<?php echo $sub[0]['past_med_history'] ?>" onkeydown="pindahField(event)">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<small>Past Surgical History</small>
						<input type="text" class="form-control" id="past_surgical_histort" name="past_surgical_histort" placeholder="Past Surgical History" value="<?php echo $sub[0]['past_surgical_histort'] ?>" onkeydown="pindahField(event)">
					</div>
					<div class="col-sm-6">
						<small>Allergies</small>
						<input type="text" class="form-control" id="alergi" name="alergi" placeholder="Allergies" value="<?php echo $sub[0]['alergi'] ?>" onkeydown="pindahField(event)">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Other</small>
						<input type="text" class="form-control" id="other_subject" name="other_subject" placeholder="Other" value="<?php echo $sub[0]['other_subject'] ?>" onkeydown="pindahField(event)">
					</div>
				</div>
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>OBJECTIVE</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<small>Berat Badan</small>
						<input type="text" class="form-control" id="v_weight" name="v_weight" placeholder="Berat Badan" value="<?php echo $sub[0]['v_weight'] ?>" onkeydown="pindahField(event)">
					</div>
					<div class="col-sm-3">
						<small>Tinggi Badan</small>
						<input type="text" class="form-control" id="v_height" name="v_height" placeholder="Tinggi Badan" value="<?php echo $sub[0]['v_height'] ?>" onkeydown="pindahField(event)">
					</div>
					<div class="col-sm-3">
						<small>Vitals-BMI</small>
						<input type="text" class="form-control" id="v_bmi" name="v_bmi" placeholder="BMI" value="<?php echo $sub[0]['v_bmi'] ?>" onkeydown="pindahField(event)">
					</div>
					<div class="col-sm-3">
						<small>Vitals-BP Sistolik</small>
						<input type="text" class="form-control" id="v_bp" name="v_bp" placeholder="Vitals-BP Sistolik" value="<?php echo $sub[0]['v_bp'] ?>" onkeydown="pindahField(event)">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<small>Nadi</small>
						<input type="text" class="form-control" id="v_pr" name="v_pr" placeholder="Nadi" value="<?php echo $sub[0]['v_pr'] ?>" onkeydown="pindahField(event)">
					</div>
					<div class="col-sm-3">
						<small>Frekuensi Napas</small>
						<input type="text" class="form-control" id="v_rr" name="v_rr" placeholder="Frekuensi Napas" value="<?php echo $sub[0]['v_rr'] ?>" onkeydown="pindahField(event)">
					</div>
					<div class="col-sm-3">
						<small>Suhu</small>
						<input type="text" class="form-control" id="v_temp" name="v_temp" placeholder="Suhu" value="<?php echo $sub[0]['v_temp'] ?>" onkeydown="pindahField(event)">
					</div>
					<div class="col-sm-3">
						<small>Vitals-BP Diastolik</small>
						<input type="text" class="form-control" id="v_bpd" name="v_bpd" placeholder="Vitals-BP Diastolik" value="<?php echo $sub[0]['v_bpd'] ?>" onkeydown="pindahField(event)">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<div class="col-sm-12" style="padding-top: 5px; padding-left: 5px;">
							<small>Pemeriksaan Fisik</small>
							<textarea tabindex="2" cols="50" rows="3" class="form-control" id="pe_eks" name="pe_eks" placeholder="Pemeriksaan Fisik"><?php echo $sub[0]['pe_eks'] ?></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Laboratorium / Radiology</small>
						<textarea tabindex="2" cols="50" rows="3" class="form-control" id="observation" name="observation" placeholder="Observation"><?php echo $sub[0]['observation'] ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Other</small>
						<input type="text" class="form-control" id="other_obj" name="other_obj" placeholder="Other" value="<?php echo $sub[0]['other_obj'] ?>" onkeydown="pindahField(event)">
					</div>
				</div>

				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>ASSESMENT</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Diagnosa Utama <a href="javascript:void(0)" onclick="openDiagnosa(0)"><i class="fa fa-fw fa-search"></i>Referensi</a></small>
						<select required="required" name="as_diagnosis" id="as_diagnosis" class="form-control"></select>
						
						<small>Diagnosa Sekunder <a href="javascript:void(0)" onclick="openDiagnosa(1)"><i class="fa fa-fw fa-search"></i>Referensi</a></small>
						<select name="diagnosa_sekunder1" id="diagnosa_sekunder1" class="form-control"></select>

						<small>Diagnosa Sekunder <a href="javascript:void(0)" onclick="openDiagnosa(2)"><i class="fa fa-fw fa-search"></i>Referensi</a></small>
						<select name="diagnosa_sekunder2" id="diagnosa_sekunder2" class="form-control"></select>

						<small>Diagnosa Sekunder <a href="javascript:void(0)" onclick="openDiagnosa(3)"><i class="fa fa-fw fa-search"></i>Referensi</a></small>
						<select name="diagnosa_sekunder3" id="diagnosa_sekunder3" class="form-control"></select>

						<small>Diagnosa Sekunder <a href="javascript:void(0)" onclick="openDiagnosa(4)"><i class="fa fa-fw fa-search"></i>Referensi</a></small>
						<select name="diagnosa_sekunder4" id="diagnosa_sekunder4" class="form-control"></select>
					</div>
					<div class="col-sm-12">
						<small>Diagnosis</small>
						<textarea tabindex="2" cols="50" rows="3" class="form-control" id="as_problems" name="as_problems" placeholder="Diagnosis"><?php echo $sub[0]['as_problems'] ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<small>Progress Note</small>
						<input type="text" class="form-control" id="as_progres" name="as_progres" placeholder="Progress Note" value="<?php echo $sub[0]['as_progres'] ?>" onkeydown="pindahField(event)">
					</div>
					<div class="col-sm-6">
						<small>Other</small>
						<input type="text" class="form-control" id="other_as" name="other_as" placeholder="Other" value="<?php echo $sub[0]['other_as'] ?>" onkeydown="pindahField(event)">
					</div>
				</div>

				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>PLANNING</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Order</small>
						<textarea tabindex="2" cols="50" rows="3" class="form-control" id="plan_order" name="plan_order" placeholder="Order"><?php echo $sub[0]['plan_order'] ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Advice</small>
						<textarea tabindex="2" cols="50" rows="3" class="form-control" id="plan_advice" name="plan_advice" placeholder="Advice"><?php echo $sub[0]['plan_advice'] ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<small>Konsul Internal</small>
						<input type="text" class="form-control" id="konsul_internal" name="konsul_internal" placeholder="Konsul Internal" value="<?php echo $sub[0]['konsul_internal'] ?>" onkeydown="pindahField(event)">
					</div>
					<div class="col-sm-6">
						<small>Order OK / VK</small>
						<input type="text" class="form-control" id="order_ok" name="order_ok" placeholder="Order OK / VK" value="<?php echo $sub[0]['order_ok'] ?>" onkeydown="pindahField(event)">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<small>Prescription</small>
						<input type="text" class="form-control" id="prescrip" name="prescrip" placeholder="Prescription" value="<?php echo $sub[0]['prescrip'] ?>" onkeydown="pindahField(event)">
					</div>
					<div class="col-sm-6">
						<small>Other</small>
						<input type="text" class="form-control" id="other_plan" name="other_plan" placeholder="Other" value="<?php echo $sub[0]['other_plan'] ?>" onkeydown="pindahField(event)">
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
					<input type="hidden" name="no_daftar" value="<?php echo $sub[0]['no_daftar'] ?>">
					<input type="hidden" name="kode" value="<?php echo $_GET['kode'] ?>">
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
					<?php
						$idResep = $db->queryItem("select id from tbl_resep where no_daftar='".$_GET['ids']."'", 0);
					?>
					<h4>Medical Notes</h4>
					<div class="filetree">
						<ul>
							<li id="key1" title="Resep Elektronik"><a href="index.php?mod=farmasi&submod=input_resep_obat&id=<?php echo $idResep ?>" target="blank">Resep Elektronik</a></li>
							<li id="key2" title="Catatan Integrasi" style="cursor: pointer;" onclick="WorklistDaftar('<?php echo $_GET['id']?>', '<?php echo $_GET['ids']?>')">Catatan Integrasi</li>
							<li id="key3" title="Layanan Penunjang Medis">Order Layanan Penunjang Medis
								<ul>
									<li id="key3.1"><a href="pages/dokter/worklist_rad.php?id=<?php echo md5($idResep) ?>" target="blank">Radiologi</a></li>
									<li id="key3.2"><a href="pages/dokter/worklist_lab.php?id=<?php echo md5($idResep) ?>" target="blank">Laboratorium</a></li>
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
				<span id="noDiag" style="display: none;"></span>
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
	var diagnosaSelectName = "<?php echo $sub[0]['as_diagnosis'].' - '.$sub[0]['as_diagnosis_kode'] ?>";
	var diagnosaSelect = "<?php echo $sub[0]['as_diagnosis'].'#####'.$sub[0]['as_diagnosis_kode'] ?>";
	html = '<option value="' + diagnosaSelect + '">' + diagnosaSelectName + '</option>';
	$("#as_diagnosis").html(html);

	var diagnosaSelect1Name = "<?php echo $sub[0]['diagnosa_sekunder1'].' - '.$sub[0]['icdcode_sekunder1'] ?>";
	var diagnosaSelect1 = "<?php echo $sub[0]['diagnosa_sekunder1'].'#####'.$sub[0]['icdcode_sekunder1'] ?>";
	html1 = '<option value="' + diagnosaSelect1 + '">' + diagnosaSelect1Name + '</option>';
	$("#diagnosa_sekunder1").html(html1);

	var diagnosaSelect2Name = "<?php echo $sub[0]['diagnosa_sekunder2'].' - '.$sub[0]['icdcode_sekunder2'] ?>";
	var diagnosaSelect2 = "<?php echo $sub[0]['diagnosa_sekunder2'].'#####'.$sub[0]['icdcode_sekunder2'] ?>";
	html2 = '<option value="' + diagnosaSelect2 + '">' + diagnosaSelect2Name + '</option>';
	$("#diagnosa_sekunder2").html(html2);

	var diagnosaSelect3Name = "<?php echo $sub[0]['diagnosa_sekunder3'].' - '.$sub[0]['icdcode_sekunder3'] ?>";
	var diagnosaSelect3 = "<?php echo $sub[0]['diagnosa_sekunder3'].'#####'.$sub[0]['icdcode_sekunder3'] ?>";
	html3 = '<option value="' + diagnosaSelect3 + '">' + diagnosaSelect3Name + '</option>';
	$("#diagnosa_sekunder3").html(html3);

	var diagnosaSelect4Name = "<?php echo $sub[0]['diagnosa_sekunder4'].' - '.$sub[0]['icdcode_sekunder4'] ?>";
	var diagnosaSelect4 = "<?php echo $sub[0]['diagnosa_sekunder4'].'#####'.$sub[0]['icdcode_sekunder4'] ?>";
	html4 = '<option value="' + diagnosaSelect4 + '">' + diagnosaSelect4Name + '</option>';
	$("#diagnosa_sekunder4").html(html4);

	function openDiagnosa(e) {
		$('#myModal').modal('show');
		$('#myModal').find('.modal-title').text('Referensi Diagnosa');
		dataDiagnosa();
		$("#noDiag").html(e);
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
					<td><button class="btn btn-primary" data-kode="${data.list[i].kode_icd}" data-nama="${data.list[i].nama_icd}" data-icd="${data.list[i].nama_icd}" onclick="pilihDiagnosa(this)"><i class="fa fa-plus"></i></button></td>
				</tr>
			`
		}
		$("#dataDiagnosa").html(html);
	}

	function pilihDiagnosa(e) {
		var nama = e.getAttribute("data-nama");
		var icd = e.getAttribute("data-icd");
		var kodeicd = e.getAttribute("data-kode");
		var noDiag = document.getElementById("noDiag").innerHTML;
		$('#myModal').modal('hide');

		if (noDiag == 0) {
			var html = '<option value="' + nama + '#####' + kodeicd + '">' + icd + ' - ' + nama + ' - ' + kodeicd + '</option>';
			$("#as_diagnosis").html(html);
		} else if (noDiag == 1) {
			var html = '<option value="' + nama + '#####' + kodeicd + '">' + icd + ' - ' + nama + ' - ' + kodeicd + '</option>';
			$("#diagnosa_sekunder1").html(html);
		} else if (noDiag == 2) {
			var html = '<option value="' + nama + '#####' + kodeicd + '">' + icd + ' - ' + nama + ' - ' + kodeicd + '</option>';
			$("#diagnosa_sekunder2").html(html);
		} else if (noDiag == 3) {
			var html = '<option value="' + nama + '#####' + kodeicd + '">' + icd + ' - ' + nama + ' - ' + kodeicd + '</option>';
			$("#diagnosa_sekunder3").html(html);
		} else if (noDiag == 4) {
			var html = '<option value="' + nama + '#####' + kodeicd + '">' + icd + ' - ' + nama + ' - ' + kodeicd + '</option>';
			$("#diagnosa_sekunder4").html(html);
		}
	}

	function pilihLainnya() {
		var lainnya = document.getElementById("lainnya").value;
		var noDiag = document.getElementById("noDiag").innerHTML;
		$('#myModal').modal('hide');

		if (noDiag == 0) {
			var html = '<option value="' + lainnya + '">' + lainnya + '</option>';
			$("#as_diagnosis").html(html);
		} else if (noDiag == 1) {
			var html = '<option value="' + lainnya + '">' + lainnya + '</option>';
			$("#diagnosa_sekunder1").html(html);
		} else if (noDiag == 2) {
			var html = '<option value="' + lainnya + '">' + lainnya + '</option>';
			$("#diagnosa_sekunder2").html(html);
		} else if (noDiag == 3) {
			var html = '<option value="' + lainnya + '">' + lainnya + '</option>';
			$("#diagnosa_sekunder3").html(html);
		} else if (noDiag == 4) {
			var html = '<option value="' + lainnya + '">' + lainnya + '</option>';
			$("#diagnosa_sekunder4").html(html);
		}
	}

	function WorklistDaftar(id, ids) {
		var w = 850;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/dokter/worklist_daftar.php?id=' + id;
		if (id != 0) {
			popup = window.open(URL,"",windowprops);
		}
	}

        function pindahField(e) {
            if (e.key === "Enter") {
                e.preventDefault(); // Supaya tidak submit form
                let form = e.target.form;
                let index = Array.prototype.indexOf.call(form, e.target);
                if (form.elements[index + 1]) {
                    form.elements[index + 1].focus();
                }
            }
        }

</script>