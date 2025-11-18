<?php
	$data = $db->query("select * from tbl_pasien where nomr='".$_GET['id']."'");
        $today = date("Y-m-d");
        $data = $db->query("select nomr, nm_pasien, round(DATEDIFF('$today', tgl_lahir) /  365) umur, tgl_lahir, jk, alamat_pasien, telp_pasien, id from tbl_pasien where status_delete='UD' order by nomr desc limit 5000", 0);
              for ($i = 0; $i < count($data); $i++)
	$sub = $db->query("select * from tbl_catatan_dktr where nomr='".$_GET['id']."' and no_daftar='".$_GET['ids']."'");
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


<div>
	<div class="box box-bordered box-color">
		<div class="box-title">
			<h3>
				<i class="fa fa-th-list"></i>Formulir Catatan Hemodialisa- Pasien [<?php echo $_GET['id'].' - '.$data[0]['nm_pasien']?>]</h3>
		</div>
		<div class="box-content nopadding" style="overflow: auto;">
          	<div class="col-sm-7">
			<form action="pages/dokter/<?php echo $menuju?>" method="POST" class='form-horizontal form-bordered' enctype="multipart/form-data">
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>INFORMASI HEMODIALISA</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Diagnosa & Etiologi</small>
						<input type="text" class="form-control" id="diag_etiologi" name="diag_etiologi" placeholder="Diagnosa & Etiologi" value="<?php echo $sub[0]['cc_hpi']?>">
					</div>
					<div class="col-sm-6">
                      <small>Tanggal Pertama HD</small>
						<input type="text" class="form-control" id="tgl_hd1" name="tgl_hd1" placeholder="Tanggal Pertama HD" value="<?php echo $sub[0]['past_med_history']?>">
                    </div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Tanggal Terakhir HD</small>
						<input type="text" class="form-control" id="tgl_hd_last" name="tgl_hd_last" placeholder="Tanggal Terakhir HD" value="<?php echo $sub[0]['past_surgical_histort']?>">
					</div>
					<div class="col-sm-6">
                      	<small>Frekuensi Hemodialisa</small>
						<input type="text" class="form-control" id="frekuensi" name="frekuensi" placeholder="Frekuensi Hemodialisa" value="<?php echo $sub[0]['alergi']?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Durasi HD</small>
						<input type="text" class="form-control" id="durasi_hd" name="durasi_hd" placeholder="Durasi HD" value="<?php echo $sub[0]['other_subject']?>">
					</div>
					<div class="col-sm-6">
					  <small>Tipe Mesin</small>
                      <input type="text" class="form-control" id="tipe_mesin" name="tipe_mesin" placeholder="Tipe Mesin" value="<?php echo $sub[0]['v_weight']?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Akses Sirkulasi</small>
						<input type="text" class="form-control" id="akses_sirkulasi" name="akses_sirkulasi" placeholder="Akses Sirkulasi" value="<?php echo $sub[0]['other_subject']?>">
					</div>
					<div class="col-sm-6">
					  <small>Lokasi</small>
                      <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi" value="<?php echo $sub[0]['v_weight']?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Fistulas</small>
						<input type="text" class="form-control" id="fistula" name="fistula" placeholder="Fistulas" value="<?php echo $sub[0]['other_subject']?>">
					</div>
					<div class="col-sm-6">
					  <small>Quick Blood Flow (QB)</small>
                      <input type="text" class="form-control" id="qb" name="qb" placeholder="Quick Blood Flow (QB)" value="<?php echo $sub[0]['v_weight']?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                      	<small>Quick Dialysis Flow (QD)</small>
						<input type="text" class="form-control" id="qd" name="qd" placeholder="Quick Dialysis Flow (QD)" value="<?php echo $sub[0]['other_subject']?>">
					</div>
					<div class="col-sm-6">
					  <small>Heparin Dosis Awal</small>
                      <input type="text" class="form-control" id="heparin_awal" name="heparin_awal" placeholder="Heparin Dosis Awal" value="<?php echo $sub[0]['v_weight']?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
                      	<small>Heparin Maintenance</small>
						<input type="text" class="form-control" id="heparin_m" name="heparin_m" placeholder="Heparin Maintenance" value="<?php echo $sub[0]['other_subject']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>TEKANAN DARAH</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
					  <small>Pre</small>
                      <input type="text" class="form-control" id="pre" name="pre" placeholder="Pre" value="<?php echo $sub[0]['v_weight']?>">
					</div>
					<div class="col-sm-6">
						<small>Post</small>
						<input type="text" class="form-control" id="post" name="post" placeholder="Post" value="<?php echo $sub[0]['v_height']?>">
					</div>
					<div class="col-sm-12">
						<small>Berat Badan Kering</small>
						<input type="text" class="form-control" id="bb_kering" name="bb_kering" placeholder="Berat Badan Kering" value="<?php echo $sub[0]['v_height']?>">
					</div>
                </div>
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>BERAT BADAN HD</strong></label>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
					  <small>Berat Badan HD (Pre)</small>
                      <input type="text" class="form-control" id="bb_pre" name="bb_pre" placeholder="Berat Badan HD (Pre)" value="<?php echo $sub[0]['v_weight']?>">
					</div>
					<div class="col-sm-6">
						<small>Berat Badan HD (Post)</small>
						<input type="text" class="form-control" id="bb_post" name="bb_post" placeholder="Berat Badan HD (Post)" value="<?php echo $sub[0]['v_height']?>">
					</div>
                </div>
				<div class="form-group">
					<div class="col-sm-12">
						<small>Dialisat</small>
						<input type="text" class="form-control" id="dialisat" name="dialisat" placeholder="Dialisat" value="<?php echo $sub[0]['v_height']?>">
					</div>
					<div class="col-sm-12">
                      	<small>Riwayat Transfusi Darah</small>
						<input type="text" class="form-control" id="riwayat_td" name="riwayat_td" placeholder="Riwayat Transfusi Darah" value="<?php echo $sub[0]['as_problems']?>">
					</div>
				</div>
			<div class="form-group">
			<label class="control-label col-sm-2">Alergi</label>
				<div class="col-sm-10">
					<div class="checkbox">
					<label>
						<input type="checkbox" name="alergi_ya">Ya
					</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="alergi_tdk">Tidak
						</label>
					</div>
				</div>
			</div>                
				<div class="form-group">
					<label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>RIWAYAT PEMERIKSAAN</strong></label>
				</div>
			<div class="form-group">
			<label class="control-label col-sm-2">HBs AG</label>
				<div class="col-sm-10">
					<div class="checkbox">
					<label>
						<input type="checkbox" name="hbs_ag_ya">Ya
					</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="hbs_ag_tdk">Tidak
						</label>
					</div>
				</div>
			</div>                
			<div class="form-group">
			<label class="control-label col-sm-2">Anti HCV</label>
				<div class="col-sm-10">
					<div class="checkbox">
					<label>
						<input type="checkbox" name="hcv_ya">Ya
					</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="hcv_tdk">Tidak
						</label>
					</div>
				</div>
			</div>                
			<div class="form-group">
			<label class="control-label col-sm-2">Anti HIV</label>
				<div class="col-sm-10">
					<div class="checkbox">
					<label>
						<input type="checkbox" name="hiv_ya">Ya
					</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="hiv_tdk">Tidak
						</label>
					</div>
				</div>
			</div>
		<div class="form-group">
					<div class="col-sm-12">
						<small>Komplikasi HD</small>
						<input type="text" class="form-control" id="komplikasi_hd" name="komplikasi_hd" placeholder="Komplikasi HD" value="<?php echo $sub[0]['v_height']?>">
					</div>
					<div class="col-sm-12">
                      	<small>Diet</small>
						<input type="text" class="form-control" id="diet" name="diet" placeholder="Diet" value="<?php echo $sub[0]['as_problems']?>">
					</div>
				</div>
		<div class="form-group">
					<div class="col-sm-12">
						<small>Obat-obatan</small>
						<input type="text" class="form-control" id="obat2" name="obat2" placeholder="Obat-obatan" value="<?php echo $sub[0]['v_height']?>">
					</div>
				</div>
			<div class="form-group">
			<label class="control-label col-sm-2">Hasil Lab</label>
				<div class="col-sm-10">
					<div class="checkbox">
					<label>
						<input type="checkbox" name="hasil_lab_ya">Ya
					</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="hasil_lab_tdk">Tidak
						</label>
					</div>
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
                  <td><?php echo $data[0]['umur']?> Thn</td>
                </tr>
                <tr>
                  <td style="width:140px">Pekerjaan</td>
                  <td><?php echo $data[0]['pekerjaan']?></td>
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