<?php

ini_set("display_errors", 0);
include "../../3rdparty/engine.php";
$tst = explode("JAMSOSTEK", $_POST['id']);
if ($tst[0] == 1) {
	$data1 = $db->query("select a.nomr, b.nm_pasien, a.kode_dokter, a.nama_perusahaan, 0 biayaAdmin, c.nama_poli, c.kd_poli, c.tarif as biayaPoli, b.telp_pasien from tbl_pendaftaran_jamsostek a left join tbl_pasien_jamsostek b on b.id=a.idNomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.status_pasien='OPEN' and a.no_daftar='" . $tst[1] . "' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
	//$lab = $db->queryItem("select sum(tarif) as jml1 from tbl_lab_detail a  left join tbl_lab b on b.id=a.labId where b.no_daftar='".$_POST['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);

	//$rad = $db->queryItem("select sum(tarif) as jml1 from tbl_rad_detail a  left join tbl_rad b on b.id=a.radId where b.no_daftar='".$_POST['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
	$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='" . date("Y") . "'");
	$total = $biayaAdmin + $farmasi1[0]['jml1'] + $farmasi2[0]['jml1'] + $embalase + $lab + $rad;
	$namaDokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='" . $data1[0]['kode_dokter'] . "'");
	$biayaDokter = $db->queryItem("select tarif_jamsostek from tbl_dokter where kode_dokter='" . $data1[0]['kode_dokter'] . "'");
	//$biayaDokter = $biayaDokter + $data1[0]['biayaPoli'];
	$biayaAdmin = $biayaDokter + $data1[0]['biayaAdmin'];
	$nomor_daftar = $tst[1];
} else {
	$data1 = $db->query("select a.nomr, b.nm_pasien, a.tgl_insert, a.kode_dokter, a.nama_perusahaan, a.biayaAdmin biayaAdmin, c.kd_poli, c.nama_poli, c.tarif as biayaPoli, b.telp_pasien from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.status_pasien='OPEN' and a.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD'", 0);
	//print_r($data1);
	$lab = $db->queryItem("select sum(tarif) as jml1 from tbl_lab_detail a  left join tbl_lab b on b.id=a.labId where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
	$gigi = $db->queryItem("select sum(tarif) as jml1 from tbl_gigi_detail a  left join tbl_gigi b on b.id=a.gigiId where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
	$obygn = $db->queryItem("select sum(tarif) as jml1 from tbl_obygn_detail a  left join tbl_obygn b on b.id=a.obygnID where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
	$bedah = $db->queryItem("select sum(tarif) as jml1 from tbl_bedah_detail a  left join tbl_bedah b on b.id=a.bedahID where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);

	$rad = $db->queryItem("select sum(tarif) as jml1 from tbl_rad_detail a  left join tbl_rad b on b.id=a.radId where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
	$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='" . date("Y") . "'");
	$total = $biayaAdmin + $farmasi1[0]['jml1'] + $farmasi2[0]['jml1'] + $embalase + $lab + $rad;
	$namaDokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='" . $data1[0]['kode_dokter'] . "'");
	//Cek untuk meliat Poi Bedah maka Biaya poli dan Biaya Dokter Nol
	if ($data1[0]['nama_poli'] == 'POLI BEDAH') {
		$biayaDokter = 0;
	} else {
		$biayaDokter = $db->queryItem("select tarif_dokter from tbl_dokter where kode_dokter='" . $data1[0]['kode_dokter'] . "'");
		$biayaDokter = $biayaDokter + $data1[0]['biayaPoli'];
	}
	$biayaAdmin = $biayaDokter + $data1[0]['biayaAdmin'];
	$nomor_daftar = $_POST['id'];
}
$id_pl = str_replace('PL/', '', ($_POST['id']));
$pelayanan_lain = $db->query("select * from tbl_pelayanan_lainnya AS a WHERE a.Id = " . $id_pl . " ", 0);
$berobat = $db->query("select nama, hubungan from tbl_hubungan_keluarga where nomr='" . $data1[0]['nomr'] . "'", 0);

?>
<div align="left">
	<table class="table table-hover table-nomargin table-responsive dataTable-noheader">
		<tbody>
			<tr>
				<td style="width: 30%;">
					NoMR
				</td>
				<td>
					<?php echo $data1[0]['nomr'] ?>
				</td>
			</tr>
			<tr>
				<td style="width: 30%;">
					Nama Pasien
				</td>
				<td>
					<?php echo !empty($data1[0]['nm_pasien']) ? $data1[0]['nm_pasien'] : $pelayanan_lain[0]['NamaPasien']; ?>
				</td>
			</tr>
			<tr>
				<td style="width: 30%;">
					yang Berobat
				</td>
				<td>
					<?php echo $berobat[0]['nama'] . ' - ' . $berobat[0]['hubungan']; ?>
				</td>
			</tr>
			<tr>
				<td style="width: 30%;">
					Penjamin Pasien
				</td>
				<td>
					<?php echo $data1[0]['nama_perusahaan'] ?>
				</td>
			</tr>
			<tr>
				<td style="width: 30%;">
					Nama Poli
				</td>
				<td>
					<?php echo $data1[0]['nama_poli'] ?>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-hover table-nomargin table-responsive">
		<tr height="28">
			<td valign="middle" colspan="2">
				<div class="hastable box box-content nopadding" align="left" style="width: 100%">
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
						<thead>
							<tr>
								<th colspan="4" style="text-align: left">
									Administrasi
								</th>
								<th style="width: 75px">
									Asuransi
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($data1[0]['kd_poli'] != 'RI01') {
								$jml_kunjungan = $db->query("select count(id) jumlah from tbl_kasir where nomr='" . $data1[0]['nomr'] . "'");
								//print_r($jml_kunjungan[0]['jumlah']);
								if ($jml_kunjungan[0]['jumlah'] > 1) {
									$admPasien = $db->query("select nilai from tbl_config where kode='ADMOLD' and tahun='" . date("Y") . "'");
								} else {
									$admPasien = $db->query("select nilai from tbl_config where kode='ADMNEW' and tahun='" . date("Y") . "'");
								}
								$data1[0]['biayaAdmin'] = $admPasien[0]['nilai'];
							?>
								<tr>

									<td style="width: 15px; text-align: right">-</td>
									<td style="text-align: left">
										Biaya Administrasi
										<input type="hidden" id="admin[0][nama]" name="admin[0][nama]" value="Biaya Administrasi" />
									</td>
									<td style="text-align: left">
										<?php echo date("d-M-Y", strtotime($data1[0]['tgl_insert'])) ?>
									</td>
									<td style="text-align: right">
										<input type="hidden" id="admin[0][nilai]" name="admin[0][nilai]" value="<?php echo $data1[0]['biayaAdmin'] ?>" />
										<?php echo number_format($data1[0]['biayaAdmin']) ?>
									</td>
									<td style="text-align: right">
										<input type="text" id="admin[0][asuransi]" name="admin[0][asuransi]" class="form-control text-right" value="<?php echo $data1[0]['biayaAdmin'] ?>" />
									</td>
								</tr>
							<?php
							}
							if ($data1[0]['kd_poli'] == 'P002') {
							?>
								<tr>
									<td style="width: 15px; text-align: right">-</td>
									<td style="text-align: left">
										Biaya Administrasi Poli Gigi
										<input type="hidden" id="admin[5][nama_gigi]" name="admin[5][nama_gigi]" value="Biaya Administrasi Poli Gigi" />
									</td>
									<td style="text-align: left">
										<?php echo date("d-M-Y", strtotime($data1[0]['tgl_insert'])) ?>
									</td>
									<td style="text-align: right">
										<?php
										$adminGigi = $db->queryItem("select nilai from tbl_config where tahun='" . date("Y") . "' and kode='ADMG'");
										$biayaAdmin = $biayaAdmin + $adminGigi;
										?>
										<input type="hidden" id="admin[5][nilai_gigi]" name="admin[5][nilai_gigi]" value="<?php echo $adminGigi ?>" />
										<?php echo number_format($adminGigi) ?>
									</td>
									<td style="text-align: right">
										<input type="text" id="admin[5][asuransi_]" name="admin[5][asuransi]" class="form-control text-right" value="<?php echo $adminGigi ?>" />
									</td>
								</tr>
							<?php
							}
							?>
							<tr>
								<td style="width: 15px; text-align: right">-</td>
								<td style="text-align: left">
									<input type="hidden" id="admin[1][nama]" name="admin[1][nama]" value="<?php echo $data1[0]['nama_poli'] . ' - ' . $namaDokter ?>" />
									<?php echo $data1[0]['nama_poli'] . ' - ' . $namaDokter ?>
								</td>
								<td style="text-align: left">
									<?php echo date("d-M-Y", strtotime($data1[0]['tgl_insert'])) ?>
								</td>
								<td style="text-align: right; width: 75px;">
									<input type="hidden" id="admin[1][nilai]" name="admin[1][nilai]" value="<?php echo $biayaDokter ?>" />
									<?php echo number_format($biayaDokter) ?>
								</td>
								<td style="text-align: right">
									<input type="text" id="admin[1][asuransi]" name="admin[1][asuransi]" class="form-control text-right" value="<?php echo $biayaDokter ?>" />
								</td>
							</tr>
							<tr>
								<th colspan="3" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Administrasi</th>
								<th style="text-align: right; font-weight: bold"><?php echo number_format($biayaAdmin + $data1[0]['biayaAdmin']) ?></th>
								<th>&nbsp;</th>
							</tr>
						</tbody>
					</table>
					<?php
					if ($tst[0] == 1) {
					?>
						<table id="sort-table" style="margin-bottom: 2px; margin-top: 7px;" class="table table-hover table-nomargin dataTable table-bordered nomargin">
							<thead>
								<tr>
									<th colspan="3" style="text-align: left">Pharmacy</th>
									<th style="width: 75px">
										Asuransi
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($tst[0] == 1) {
									$farm = $db->query("select a.no_resep, a.nama_obat, a.total, tgl_insert, a.qty, a.satuan from tbl_resepjams_detail a  left join tbl_resepjams b on b.no_resep=a.no_resep where b.no_daftar='" . $tst[1] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
								} else {
									$farm = $db->query("select a.no_resep, a.nama_obat, a.total, tgl_insert, a.qty, a.satuan from tbl_resep_detail a  left join tbl_resep b on b.no_resep=a.no_resep where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
								}
								for ($i = 0; $i < count($farm); $i++) {
								?>
									<tr>
										<td style="width: 15px; text-align: right">-</td>
										<td style="text-align: left"><?php echo $farm[$i]['nama_obat'] ?></td>
										<td style="text-align: left">
											<?php echo date("d-M-Y", strtotime($farm[$i]['tgl_insert'])) ?>
										</td>
										<td style="text-align: left"><?php echo $farm[$i]['nama_obat'] ?></td>
										<td style="text-align: right; width: 75px;"><?php echo number_format($farm[$i]['total']) ?></td>
										<td style="text-align: right">
											<input type="hidden" id="pharmacy[<?php echo $i ?>][nama]" name="pharmacy[<?php echo $i ?>][nama]" value="<?php echo $farm[$i]['nama_obat'] ?>" />
											<input type="hidden" id="pharmacy[<?php echo $i ?>][nilai]" name="pharmacy[<?php echo $i ?>][nilai]" value="<?php echo $farm[$i]['total'] ?>" />
											<input type="text" id="pharmacy[<?php echo $i ?>][asuransi]" name="pharmacy[<?php echo $i ?>][asuransi]" class="form-control text-right" value="<?php echo $farm[$i]['total'] ?>" />
											<input type="hidden" id="pharmacy[<?php echo $i ?>][qty]" name="pharmacy[<?php echo $i ?>][qty]" value="<?php echo $farm[$i]['qty'] ?>" />
											<input type="hidden" id="pharmacy[<?php echo $i ?>][satuan]" name="pharmacy[<?php echo $i ?>][satuan]" value="<?php echo $farm[$i]['satuan'] ?>" />
										</td>
									</tr>
								<?php
									$totFarm = $totFarm + $farm[$i]['total'];
								}
								$farm2 = $db->query("select b.nama, sum(total) as jml1, a.tgl_insert, a.qty from tbl_racikan_detail a  left join tbl_racikan b on b.id=a.racikanId where b.no_resep='" . $farm[0]['no_resep'] . "' and a.status_delete='UD' and b.status_delete='UD' group by racikanId, a.tgl_insert", 0);

								if (count($farm2) > 0 and $farm2[0]['nama'] != NULL) {
									//$o = $i + 1;
									$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='" . date("Y") . "'");
									$nilai_racikan = $farm2[0]['jml1'] + $embalase;
								?>
									<tr>
										<td style="width: 15px; text-align: right">-</td>
										<td style="text-align: left"><?php echo $farm2[0]['nama'] ?></td>
										<td style="text-align: left">
											<?php echo date("d-M-Y", strtotime($form2[0]['tgl_insert'])) ?>
										</td>
										<td style="text-align: right; width: 75px;"><?php echo number_format($nilai_racikan) ?></td>
										<td style="text-align: right">
											<input type="hidden" id="pharmacy[<?php echo $i ?>][nama]" name="pharmacy[<?php echo $i ?>][nama]" value="<?php echo $farm2[0]['nama'] ?>" />
											<input type="hidden" id="pharmacy[<?php echo $i ?>][nilai]" name="pharmacy[<?php echo $i ?>][nilai]" value="<?php echo $nilai_racikan ?>" />
											<input type="text" id="pharmacy[<?php echo $i ?>][asuransi]" name="pharmacy[<?php echo $i ?>][asuransi]" class="form-control text-right" value="<?php echo $nilai_racikan ?>" />
											<input type="hidden" id="pharmacy[<?php echo $i ?>][qty]" name="pharmacy[<?php echo $i ?>][qty]" value="<?php echo $farm[$i]['qty'] ?>" />
											<input type="hidden" id="pharmacy[<?php echo $i ?>][satuan]" name="pharmacy[<?php echo $i ?>][satuan]" value="<?php echo $farm[$i]['satuan'] ?>" />
										</td>
									</tr>
								<?php
									$totFarm = $totFarm + $farm2[0]['jml1'] + $embalase;
								}
								?>
								<tr>
									<th colspan="3" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Pharmacy</th>
									<th style="text-align: right; font-weight: bold"><?php echo number_format($totFarm) ?></th>
									<th style="text-align: right">&nbsp;</th>
								</tr>
							</tbody>
						</table>
						<?php
					} else {
						$farmnr = $db->queryItem("select sum(a.total) from tbl_resep_detail a  left join tbl_resep b on b.no_resep=a.no_resep where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
						$farmnr2 = $db->queryItem("select sum(total) as jml1 from tbl_racikan_detail a  left join tbl_racikan b on b.id=a.racikanId where b.no_resep='" . $farm[0]['no_resep'] . "' and a.status_delete='UD' and b.status_delete='UD' group by racikanId", 0);
						$farmnr = $farmnr + $farmnr2;
						$farmnr_racikan = $db->queryItem("select count(a.id) from tbl_resep a  where a.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD'", 0);
						if ($farmnr > 0 or $farmnr_racikan > 0) {
						?>
							<table id="sort-table" style="margin-bottom: 2px; margin-top: 7px;" class="table table-hover table-nomargin dataTable table-bordered nomargin">
								<thead>
									<tr>
										<th colspan="5" style="text-align: left">Pharmacy</th>
										<th style="width: 75px">
											Asuransi
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($tst[0] == 1) {
										$farm = $db->query("select a.no_resep, a.nama_obat, a.total, a.tgl_insert, a.qty, a.satuan from tbl_resepjams_detail a  left join tbl_resepjams b on b.no_resep=a.no_resep where b.no_daftar='" . $tst[1] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
									} else {
										$farm = $db->query("select a.no_resep, a.nama_obat, a.qty, a.total, a.tgl_insert, a.qty, a.satuan from tbl_resep_detail a  left join tbl_resep b on b.no_resep=a.no_resep where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
									}
									for ($i = 0; $i < count($farm); $i++) {
									?>
										<tr>
											<td style="width: 15px; text-align: right">-</td>
											<td style="text-align: left"><?php echo $farm[$i]['nama_obat'] ?></td>
											<td style="text-align: left">
												<?php echo date("d-M-Y", strtotime($farm[$i]['tgl_insert'])) ?>
											</td>
											<td style="text-align: left"><?php echo $farm[$i]['qty'] ?></td>
											<td style="text-align: right; width: 75px;"><?php echo number_format($farm[$i]['total']) ?></td>
											<td style="text-align: right">
												<input type="hidden" id="pharmacy[<?php echo $i ?>][nama]" name="pharmacy[<?php echo $i ?>][nama]" value="<?php echo $farm[$i]['nama_obat'] ?>" />
												<input type="hidden" id="pharmacy[<?php echo $i ?>][nilai]" name="pharmacy[<?php echo $i ?>][nilai]" value="<?php echo $farm[$i]['total'] ?>" />
												<input type="text" id="pharmacy[<?php echo $i ?>][asuransi]" name="pharmacy[<?php echo $i ?>][asuransi]" class="form-control text-right" value="<?php echo $farm[$i]['total'] ?>" />
												<input type="hidden" id="pharmacy[<?php echo $i ?>][qty]" name="pharmacy[<?php echo $i ?>][qty]" value="<?php echo $farm[$i]['qty'] ?>" />
												<input type="hidden" id="pharmacy[<?php echo $i ?>][satuan]" name="pharmacy[<?php echo $i ?>][satuan]" value="<?php echo $farm[$i]['satuan'] ?>" />
											</td>
										</tr>
									<?php
										$totFarm = $totFarm + $farm[$i]['total'];
										//echo $totFarm.'<br>';
									}
								}
								$no_resep_farmasi = $db->queryItem("select a.no_resep from tbl_resep a where a.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD'", 0);

								//$farm2 = $db->query("select b.nama, sum(total) as jml1 from tbl_racikan_detail a  left join tbl_racikan b on b.id=a.racikanId where b.no_resep='".$farm[0]['no_resep']."' and a.status_delete='UD' and b.status_delete='UD' group by racikanId, a.tgl_insert", 0);
								//$no_resep_farmasi
								$farm2 = $db->query("select a.racikanId, b.nama, sum(total) as jml1, sum(a.qty) qty from tbl_racikan_detail a  left join tbl_racikan b on b.id=a.racikanId where b.no_resep='" . $no_resep_farmasi . "' and a.status_delete='UD' and b.status_delete='UD' group by a.racikanId", 0);



								if (count($farm2) > 0 and $farm2[0]['nama'] != NULL) {
									//$o = $i + 1;
									$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='" . date("Y") . "'");
									$itrs = $i;
									for ($i = 0; $i < count($farm2); $i++) {
										//echo $itr.'-';
										$nilai_racikan = $farm2[$i]['jml1'] + $embalase;
										if ($i == 0)  $itr = $itrs + $i;
										else $itr = $itr + 1;
										//echo "$itr = $itr + $i<br>";
										//nambah colspan
										$tglRck = $db->query("select tgl_insert from tbl_racikan where id='".$farm2[$i]['racikanId']."'");
									?>
										<tr>
											<td style="width: 15px; text-align: right">-</td>
											<td style="text-align: left"><?php echo $farm2[$i]['nama'] ?></td>
											<td style="text-align: left">
												<?php echo date("d-M-Y", strtotime($tglRck[0]['tgl_insert'])) ?>
											</td>
											<td style="text-align: left">-</td>
											<td style="text-align: right; width: 75px;"><?php echo number_format($nilai_racikan) ?></td>
											<td style="text-align: right">
												<input type="hidden" id="pharmacy[<?php echo $itr ?>][nama]" name="pharmacy[<?php echo $itr ?>][nama]" value="<?php echo $farm2[$i]['nama'] ?>" />
												<input type="hidden" id="pharmacy[<?php echo $itr ?>][nilai]" name="pharmacy[<?php echo $itr ?>][nilai]" value="<?php echo $nilai_racikan ?>" />
												<input type="hidden" id="pharmacy[<?php echo $itr ?>][qty]" name="pharmacy[<?php echo $itr ?>][qty]" value="-" />
												<input type="hidden" id="pharmacy[<?php echo $itr ?>][satuan]" name="pharmacy[<?php echo $itr ?>][satuan]" value="<?php echo $farm2[$i]['satuan'] ?>" />
												<input type="text" id="pharmacy[<?php echo $itr ?>][asuransi]" name="pharmacy[<?php echo $itr ?>][asuransi]" class="form-control text-right" value="<?php echo $nilai_racikan ?>" />
											</td>
										</tr>
									<?php
										$totFarm = $totFarm + $farm2[$i]['jml1'] + $embalase;
									}
								}
								//$maxs = array_keys($array, max($array));
								//ganti colspan
								if ($totFarm > 0) {
									?>
									<tr>
										<th colspan="4" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Pharmacys</th>
										<th style="text-align: right; font-weight: bold"><?php echo number_format($totFarm) ?></th>
										<th style="text-align: right">&nbsp;</th>
									</tr>
								</tbody>
							</table>
						<?php
								}
							}

							$dAlkes = $db->query("select * from tbl_alkes where no_daftar='" . $_POST['id'] . "' and nomr= '" . $data1[0]['nomr'] . "' and status_delete='UD'", 0);
							if ($dAlkes > 0) {
						?>
						<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
							<thead>
								<tr>
									<th colspan="4" style="text-align: left">Alkes</th>
									<th style="width: 75px;">Asuransi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								for ($i = 0; $i < count($dAlkes); $i++) {
								?>
									<tr>
										<td style="width: 15px; text-align: right">-</td>
										<td style="text-align: left"><?php echo $dAlkes[$i]['nama_alkes'] ?></td>
										<td style="text-align: left">
											<?php echo date("d-M-Y", strtotime($dAlkes[$i]['tanggal_input'])) ?>
										</td>
										<td style="text-align: right; width: 75px;"><?php echo number_format($dAlkes[$i]['tarif']) ?></td>
										<td style="text-align: right">
											<input type="hidden" id="alkes[<?php echo $i ?>][nama]" name="alkes[<?php echo $i ?>][nama]" value="<?php echo $dAlkes[$i]['nama_alkes'] ?>" />
											<input type="hidden" id="alkes[<?php echo $i ?>][nilai]" name="alkes[<?php echo $i ?>][nilai]" value="<?php echo $dAlkes[$i]['tarif'] ?>" />
											<input type="hidden" id="alkes[<?php echo $i ?>][qty]" name="alkes[<?php echo $i ?>][qty]" value="1" />
											<input type="text" id="alkes[<?php echo $i ?>][asuransi]" name="alkes[<?php echo $i ?>][asuransi]" class="form-control text-right" value="<?php echo $dAlkes[$i]['tarif'] ?>" />
										</td>
									</tr>
								<?php
									$totAlkes = $totAlkes + $dAlkes[$i]['tarif'];
								}
								?>
								<tr>
									<th colspan="3" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Alkes</th>
									<th style="text-align: right; font-weight: bold"><?php echo number_format($totAlkes) ?></th>
									<th style="text-align: right">&nbsp;</th>
								</tr>
							</tbody>
						</table>
					<?php
							}

							$dTindakan = $db->query("select * from tbl_tindakan where no_daftar='" . $_POST['id'] . "' and nomr= '" . $data1[0]['nomr'] . "' and status_delete='UD'", 0);
							if ($dTindakan > 0) {
					?>
						<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
							<thead>
								<tr>
									<th colspan="5" style="text-align: left">Tindakan Medis</th>
									<th style="width: 75px;">Asuransi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								for ($i = 0; $i < count($dTindakan); $i++) {
								?>
									<tr>
										<td style="width: 15px; text-align: right">-</td>
										<td style="text-align: left"><?php echo $dTindakan[$i]['nama_tindakan'] ?></td>
										<td style="text-align: left">
											<?php echo date("d-M-Y", strtotime($dTindakan[$i]['tanggal_input'])) ?>
										</td>
										<td style="text-align: left"><?php echo $dTindakan[$i]['qty'] ?></td>
										<td style="text-align: right; width: 75px;"><?php echo number_format($dTindakan[$i]['tarif']) ?></td>
										<td style="text-align: right">
											<input type="hidden" id="tindakan[<?php echo $i ?>][nama]" name="tindakan[<?php echo $i ?>][nama]" value="<?php echo $dTindakan[$i]['nama_tindakan'] ?>" />
											<input type="hidden" id="tindakan[<?php echo $i ?>][nilai]" name="tindakan[<?php echo $i ?>][nilai]" value="<?php echo $dTindakan[$i]['tarif'] ?>" />
											<input type="hidden" id="tindakan[<?php echo $i ?>][qty]" name="tindakan[<?php echo $i ?>][qty]" value="<?php echo $dTindakan[$i]['qty'] ?>" />
											<input type="text" id="tindakan[<?php echo $i ?>][asuransi]" name="tindakan[<?php echo $i ?>][asuransi]" class="form-control text-right" value="<?php echo $dTindakan[$i]['tarif'] ?>" />
										</td>
									</tr>
								<?php
									$totTdk = $totTdk + $dTindakan[$i]['tarif'];
								}
								?>
								<tr>
									<th colspan="4" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Tindakan Medis</th>
									<th style="text-align: right; font-weight: bold"><?php echo number_format($totTdk) ?></th>
									<th style="text-align: right">&nbsp;</th>
								</tr>
							</tbody>
						</table>
					<?php
							}
							if ($lab > 0) {
					?>
						<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
							<thead>
								<tr>
									<th colspan="5" style="text-align: left">Laboratorium</th>
									<th style="width: 75px;">Asuransi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$lab = $db->query("select nama_tindakan, tarif, tanggal_input, a.qty, a.satuan from tbl_lab_detail a  left join tbl_lab b on b.id=a.labId where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
								for ($i = 0; $i < count($lab); $i++) {
								?>
									<tr>
										<td style="width: 15px; text-align: right">-</td>
										<td style="text-align: left"><?php echo $lab[$i]['nama_tindakan'] ?></td>
										<td style="text-align: left">
											<?php echo date("d-M-Y", strtotime($lab[$i]['tanggal_input'])) ?>
										</td>
										<td style="text-align: left"><?php echo $lab[$i]['qty'] ?></td>
										<td style="text-align: right; width: 75px;"><?php echo number_format($lab[$i]['tarif']) ?></td>
										<td style="text-align: right">
											<input type="hidden" id="lab[<?php echo $i ?>][nama]" name="lab[<?php echo $i ?>][nama]" value="<?php echo $lab[$i]['nama_tindakan'] ?>" />
											<input type="hidden" id="lab[<?php echo $i ?>][nilai]" name="lab[<?php echo $i ?>][nilai]" value="<?php echo $lab[$i]['tarif'] ?>" />
											<input type="hidden" id="lab[<?php echo $i ?>][qty]" name="lab[<?php echo $i ?>][qty]" value="<?php echo $lab[$i]['qty'] ?>" />
											<input type="hidden" id="lab[<?php echo $i ?>][satuan]" name="lab[<?php echo $i ?>][satuan]" value="<?php echo $lab[$i]['satuan'] ?>" />
											<input type="text" id="lab[<?php echo $i ?>][asuransi]" name="lab[<?php echo $i ?>][asuransi]" class="form-control text-right" value="<?php echo $lab[$i]['tarif'] ?>" />
										</td>
									</tr>
								<?php
									$totLab = $totLab + $lab[$i]['tarif'];
								}
								?>
								<tr>
									<th colspan="4" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Laboratorium</th>
									<th style="text-align: right; font-weight: bold"><?php echo number_format($totLab) ?></th>
									<th style="text-align: right">&nbsp;</th>
								</tr>
							</tbody>
						</table>
					<?php
							}
							if ($gigi > 0) {
					?>
						<!--Input Data tindakan Poli Gigi	-->
						<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
							<thead>
								<tr>
									<th colspan="5" style="text-align: left">Poli Gigi</th>
									<th style="width: 75px;">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$gigi = $db->query("select nama_tindakan, tarif, tanggal_input from tbl_gigi_detail a  left join tbl_gigi b on b.id=a.gigiId where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
								for ($i = 0; $i < count($gigi); $i++) {
								?>
									<tr>
										<td style="width: 15px; text-align: right">-</td>
										<td style="text-align: left"><?php echo $gigi[$i]['nama_tindakan'] ?></td>
										<td style="text-align: left">
											<?php echo date("d-M-Y", strtotime($gigi[$i]['tanggal_input'])) ?>
										</td>
										<td style="text-align: left"><?php echo $farm[$i]['qty'] ?></td>
										<td style="text-align: right; width: 75px;"><?php echo number_format($gigi[$i]['tarif']) ?></td>
										<td style="text-align: right">
											<input type="hidden" id="gigi[<?php echo $i ?>][nama]" name="gigi[<?php echo $i ?>][nama]" value="<?php echo $gigi[$i]['nama_tindakan'] ?>" />
											<input type="hidden" id="gigi[<?php echo $i ?>][nilai]" name="gigi[<?php echo $i ?>][nilai]" value="<?php echo $gigi[$i]['tarif'] ?>" />
											<input type="hidden" id="gigi[<?php echo $i ?>][qty]" name="gigi[<?php echo $i ?>][qty]" value="1" />
											<input type="text" id="gigi[<?php echo $i ?>][asuransi]" name="gigi[<?php echo $i ?>][asuransi]" class="form-control text-right" value="<?php echo $gigi[$i]['tarif'] ?>" />
										</td>
									</tr>
								<?php
									$totgigi = $totgigi + $gigi[$i]['tarif'];
								}
								?>
								<tr>
									<th colspan="3" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Poli Gigi</th>
									<th style="text-align: right; font-weight: bold"><?php echo number_format($totgigi) ?></th>
									<th style="text-align: right">&nbsp;</th>
								</tr>
							</tbody>
						</table>
					<?php
							}
							if ($obygn > 0) {
					?>
						<!--Input Data tindakan Poli Obygn	-->
						<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
							<thead>
								<tr>
									<th colspan="4" style="text-align: left">Poli Obgyn/Kandungan</th>
									<th style="width: 75px;">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$obygn = $db->query("select nama_tindakan, tarif, tanggal_input from tbl_obygn_detail a left join tbl_obygn b on b.id=a.obygnID where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
								for ($i = 0; $i < count($obygn); $i++) {
								?>
									<tr>
										<td style="width: 15px; text-align: right">-</td>
										<td style="text-align: left"><?php echo $obygn[$i]['nama_tindakan'] ?></td>
										<td style="text-align: left">
											<?php echo date("d-M-Y", strtotime($obygn[$i]['tanggal_input'])) ?>
										</td>
										<td style="text-align: right; width: 75px;"><?php echo number_format($obygn[$i]['tarif']) ?></td>
										<td style="text-align: right">
											<input type="hidden" id="obygn[<?php echo $i ?>][nama]" name="obygn[<?php echo $i ?>][nama]" value="<?php echo $obygn[$i]['nama_tindakan'] ?>" />
											<input type="hidden" id="obygn[<?php echo $i ?>][nilai]" name="obygn[<?php echo $i ?>][nilai]" value="<?php echo $obygn[$i]['tarif'] ?>" />
											<input type="hidden" id="obygn[<?php echo $i ?>][qty]" name="obygn[<?php echo $i ?>][qty]" value="1" />
											<input type="text" id="obygn[<?php echo $i ?>][asuransi]" name="obygn[<?php echo $i ?>][asuransi]" class="form-control text-right" value="<?php echo $obygn[$i]['tarif'] ?>" />
										</td>
									</tr>
								<?php
									$totobygn = $totobygn + $obygn[$i]['tarif'];
								}
								?>
								<tr>
									<th colspan="3" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Poli Obygn/Kandungan</th>
									<th style="text-align: right; font-weight: bold"><?php echo number_format($totobygn) ?></th>
									<th style="text-align: right">&nbsp;</th>
								</tr>
							</tbody>
						</table>
					<?php
							}
							if ($bedah > 0) {
					?>
						<!--Input Data tindakan Poli Bedah	-->
						<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
							<thead>
								<tr>
									<th colspan="4" style="text-align: left">Poli Bedah</th>
									<th style="width: 75px;">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$bedah = $db->query("select nama_tindakan, tarif, tanggal_input from tbl_bedah_detail a left join tbl_bedah b on b.id=a.bedahID where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
								for ($i = 0; $i < count($bedah); $i++) {
								?>
									<tr>
										<td style="width: 15px; text-align: right">-</td>
										<td style="text-align: left"><?php echo $bedah[$i]['nama_tindakan'] ?></td>
										<td style="text-align: left">
											<?php echo date("d-M-Y", strtotime($bedah[$i]['tanggal_input'])) ?>
										</td>
										<td style="text-align: right; width: 75px;"><?php echo number_format($bedah[$i]['tarif']) ?></td>
										<td style="text-align: right">
											<input type="hidden" id="bedah[<?php echo $i ?>][nama]" name="bedah[<?php echo $i ?>][nama]" value="<?php echo $bedah[$i]['nama_tindakan'] ?>" />
											<input type="hidden" id="bedah[<?php echo $i ?>][nilai]" name="bedah[<?php echo $i ?>][nilai]" value="<?php echo $bedah[$i]['tarif'] ?>" />
											<input type="hidden" id="bedah[<?php echo $i ?>][qty]" name="bedah[<?php echo $i ?>][qty]" value="1" />
											<input type="text" id="bedah[<?php echo $i ?>][asuransi]" name="bedah[<?php echo $i ?>][asuransi]" class="form-control text-right" value="<?php echo $bedah[$i]['tarif'] ?>" />
										</td>
									</tr>
								<?php
									$totbedah = $totbedah + $bedah[$i]['tarif'];
								}
								?>
								<tr>
									<th colspan="3" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Poli Bedah</th>
									<th style="text-align: right; font-weight: bold"><?php echo number_format($totbedah) ?></th>
									<th style="text-align: right">&nbsp;</th>
								</tr>
							</tbody>
						</table>
					<?php
							}
							if ($rad > 0) {
					?>
						<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
							<thead>
								<tr>
									<th colspan="5" style="text-align: left">Radiologi</th>
									<th style="width: 75px;">Asuransi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$lab = $db->query("select nama_tindakan, tarif, tanggal_input, a.qty from tbl_rad_detail a  left join tbl_rad b on b.id=a.radId where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
								for ($i = 0; $i < count($lab); $i++) {
								?>
									<tr>
										<td style="width: 15px; text-align: right">-</td>
										<td style="text-align: left"><?php echo $lab[$i]['nama_tindakan'] ?></td>
										<td style="text-align: left">
											<?php echo date("d-M-Y", strtotime($lab[$i]['tanggal_input'])) ?>
										</td>
										<td style="text-align: left"><?php echo $lab[$i]['qty'] ?></td>
										<td style="text-align: right; width: 75px;"><?php echo number_format($lab[$i]['tarif']) ?></td>
										<td style="text-align: right">
											<input type="hidden" id="rad[<?php echo $i ?>][nama]" name="rad[<?php echo $i ?>][nama]" value="<?php echo $lab[$i]['nama_tindakan'] ?>" />
											<input type="hidden" id="rad[<?php echo $i ?>][nilai]" name="rad[<?php echo $i ?>][nilai]" value="<?php echo $lab[$i]['tarif'] ?>" />
											<input type="hidden" id="rad[<?php echo $i ?>][qty]" name="rad[<?php echo $i ?>][qty]" value="<?php echo $lab[$i]['qty'] ?>" />
											<input type="text" id="rad[<?php echo $i ?>][asuransi]" name="rad[<?php echo $i ?>][asuransi]" class="form-control text-right" value="<?php echo $lab[$i]['tarif'] ?>" />
										</td>
									</tr>
								<?php
									$totRad = $totRad + $lab[$i]['tarif'];
								}
								?>
								<tr>
									<th colspan="4" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Radiologi</th>
									<th style="text-align: right; font-weight: bold"><?php echo number_format($totRad) ?></th>
									<th style="text-align: right">&nbsp;</th>
								</tr>
							</tbody>
						</table>
					<?php
							}
							$fisT = $db->queryItem("select sum(tarif) as jml1 from tbl_fisio_detail a  left join tbl_fisio b on b.id=a.fisioId where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
							if ($fisT > 0) {
					?>
						<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
							<thead>
								<tr>
									<th colspan="5" style="text-align: left">Fisioterapi</th>
									<th style="width: 75px;">Asuransi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$lab = $db->query("select nama_tindakan, tarif, tanggal_input, a.qty from tbl_fisio_detail a  left join tbl_fisio b on b.id=a.fisioId where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
								for ($i = 0; $i < count($lab); $i++) {
								?>
									<tr>
										<td style="width: 15px; text-align: right">-</td>
										<td style="text-align: left"><?php echo $lab[$i]['nama_tindakan'] ?></td>
										<td style="text-align: left">
											<?php echo date("d-M-Y", strtotime($lab[$i]['tanggal_input'])) ?>
										</td>
										<td style="text-align: left"><?php echo $lab[$i]['qty'] ?></td>
										<td style="text-align: right; width: 75px;"><?php echo number_format($lab[$i]['tarif']) ?></td>
										<td style="text-align: right">
											<input type="hidden" id="fis[<?php echo $i ?>][nama]" name="fis[<?php echo $i ?>][nama]" value="<?php echo $lab[$i]['nama_tindakan'] ?>" />
											<input type="hidden" id="fis[<?php echo $i ?>][nilai]" name="fis[<?php echo $i ?>][nilai]" value="<?php echo $lab[$i]['tarif'] ?>" />
											<input type="hidden" id="fis[<?php echo $i ?>][qty]" name="fis[<?php echo $i ?>][qty]" value="<?php echo $lab[$i]['qty'] ?>" />
											<input type="text" id="fis[<?php echo $i ?>][asuransi]" name="fis[<?php echo $i ?>][asuransi]" class="form-control text-right" value="<?php echo $lab[$i]['tarif'] ?>" />
										</td>
									</tr>
								<?php
									$totFis = $totFis + $lab[$i]['tarif'];
								}
								?>
								<tr>
									<th colspan="4" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Fisioterapi</th>
									<th style="text-align: right; font-weight: bold"><?php echo number_format($totFis) ?></th>
									<th style="text-align: right">&nbsp;</th>
								</tr>
							</tbody>
						</table>
					<?php
							}

							$perawat = $db->queryItem("select sum(tarif) as jml1 from tbl_rawat_detail a  left join tbl_rawat b on b.id=a.rawatID where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
							if ($perawat > 0) {
								//echo '&nbsp;';
					?>
						<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
							<thead>
								<tr>
									<th colspan="5" style="text-align: left">Tindakan Keperawatan</th>
									<th style="width: 75px;">Asuransi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$lab = $db->query("select nama_tindakan, tarif, tanggal_input, a.qty from tbl_rawat_detail a  left join tbl_rawat b on b.id=a.rawatID where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
								for ($i = 0; $i < count($lab); $i++) {
								?>
									<tr>
										<td style="width: 15px; text-align: right">-</td>
										<td style="text-align: left"><?php echo $lab[$i]['nama_tindakan'] ?></td>
										<td style="text-align: left">
											<?php echo date("d-M-Y", strtotime($lab[$i]['tanggal_input'])) ?>
										</td>
										<td style="text-align: left"><?php echo $lab[$i]['qty'] ?></td>
										<td style="text-align: right; width: 75px;"><?php echo number_format($lab[$i]['tarif']) ?></td>
										<td style="text-align: right">
											<input type="hidden" id="prwt[<?php echo $i ?>][nama]" name="prwt[<?php echo $i ?>][nama]" value="<?php echo $lab[$i]['nama_tindakan'] ?>" />
											<input type="hidden" id="prwt[<?php echo $i ?>][nilai]" name="prwt[<?php echo $i ?>][nilai]" value="<?php echo $lab[$i]['tarif'] ?>" />
											<input type="hidden" id="prwt[<?php echo $i ?>][qty]" name="prwt[<?php echo $i ?>][qty]" value="<?php echo $lab[$i]['qty'] ?>" />
											<input type="text" id="prwt[<?php echo $i ?>][asuransi]" name="prwt[<?php echo $i ?>][asuransi]" class="form-control text-right" value="<?php echo $lab[$i]['tarif'] ?>" />
										</td>
									</tr>
								<?php
									$totRawat = $totRawat + $lab[$i]['tarif'];
								}
								?>
								<tr>
									<th colspan="4" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Tindakan Keperawatan</th>
									<th style="text-align: right; font-weight: bold"><?php echo number_format($totRawat) ?></th>
									<th style="text-align: right">&nbsp;</th>
								</tr>
							</tbody>
						</table>
					<?php
							}
					?>
					<?php
					$total_pl = 0;
					if (!empty($pelayanan_lain)) {
					?>
						<table class="table table-hover table-nomargin dataTable table-bordered">
							<thead>
								<tr>
									<th colspan="2">Pelayanan Lainnya</th>
									<th style="width:40px">Tarif</th>
									<th style="width:30px">Asuransi</th>
								</tr>
							</thead>
							<tbody>
								<?php

								$table = $db->query("
                                SELECT detail.Id, detail.ParentId, tarif.nama_pelayanan, detail.Tarif,  detail.Qty
                                FROM tbl_pelayanan_lainnya_detail AS detail
                                LEFT JOIN tbl_tarif AS tarif ON detail.Tarif_Id = tarif.kode_tarif

                                WHERE detail.ParentId = " . $id_pl . "
                                ", 0);
								$subtotal = 0;
								for ($i = 0; $i < count($table); $i++) {
									$no = $i + 1;
									$tarif = number_format(($table[$i]['Tarif'] * $table[$i]['Qty']));
									echo "<tr>
                                    <td>{$no}</td>
                                    <td>{$table[$i]['nama_pelayanan']}</td>
                                    <td align='right'>{$tarif}</td>
                                    <td align='center'>

                                        <input id='pl[" . $i . "][nama]' name='pl[" . $i . "][nama]' value='" . $pelayanan_lain[0]['NamaPasien'] . "' type='hidden'>
                                        <input id='pl[" . $i . "][qty]' name='pl[" . $i . "][qty]' value='" . $table[$i]['Qty'] . "' type='hidden'>
                                        <input id='pl[" . $i . "][nilai]' name='pl[" . $i . "][nilai]' value='" . ($table[$i]['Tarif'] * $table[$i]['Qty']) . "' type='hidden'>
                                        <input id='pl[" . $i . "][asuransi]' name='pl[" . $i . "][asuransi]' class='form-control text-right' value='0' type='text'>
                                    </td>
                                  </tr>";
									$total_pl += ($table[$i]['Tarif'] * $table[$i]['Qty']);
								}
								?>
								<tr>
									<th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Pelayanan Lainnya</th>
									<td colspan="2">
										<div align="left" style="font-weight: bold"><?php echo number_format($total_pl) ?></div>
									</td>
								</tr>
							</tbody>
						</table>
					<?php
					}

					//Tindakan Rawat Inap (Apabila ada dantermasuk rawat inap)
					$cekRanap = $db->queryItem("select id from tbl_pendaftaran where no_daftar='$nomor_daftar' and kd_poli='RI01'");
					if ($cekRanap > 0) {
					?>
						<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
							<thead>
								<tr>
									<th colspan="4" style="text-align: left">Tindakan Rawat Inap</th>
									<th style="width: 75px;">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php
								date_default_timezone_set('Asia/Jakarta');
								$now = date("Y-m-d H:i:s");
								$kelas = $db->query("select a.tgl_insert, b.nama, b.tarif, c.nama ruangan, datediff('$now', a.tgl_insert) jml_hari from tbl_pendaftaran a left join tbl_kelas b on b.id=a.kelas_id left join tbl_kelas_ruang c on c.id=a.ruang_id where a.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD'", 0);
								if ($kelas[0]['jml_hari'] == 0) $kelas[0]['jml_hari'] = 1;
								?>
								<tr>
									<td style="width: 15px; text-align: right">-</td>
									<td style="text-align: left"><?php echo $kelas[0]['nama'] . ' ' . $kelas[0]['ruangan'] . ' (' . $kelas[0]['jml_hari'] . ' Hari)' ?></td>
									<td style="text-align: left"><?php echo date("d-M-Y", strtotime($kelas[0]['tgl_insert'])) . ' s/d ' . date("d-M-Y", strtotime($now)) ?></td>
									<td style="text-align: right; width: 75px;"><?php echo number_format($kelas[0]['tarif']) ?></td>
									<td style="text-align: right">
										<input type="hidden" id="ranap" name="ranap" value="<?php echo $kelas[0]['nama'] . ' ' . $kelas[0]['ruangan'] . ' (' . $kelas[0]['jml_hari'] . ' Hari)<br>' . $kelas[0]['tgl_insert'] . ' s/d ' . $now ?>" />
										<input type="hidden" id="ranap_nilai" name="ranap_nilai" value="<?php echo $kelas[0]['tarif'] ?>" />
										<input type="text" id="ranap_ass" name="ranap_ass" class="form-control text-right" value="<?php echo $kelas[0]['tarif'] ?>" />
									</td>
								</tr>
								<?php
								$obygn = $db->query("select nama_tindakan, tarif, tanggal_input, a.qty from tbl_rawat_detail a left join tbl_rawat b on b.id=a.rawatID where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
								for ($i = 0; $i < count($obygn); $i++) {
									//$ij = $i + 
								?>
									<tr>
										<td style="width: 15px; text-align: right">-</td>
										<td style="text-align: left"><?php echo $obygn[$i]['nama_tindakan'] ?></td>
										<td style="text-align: left"><?php echo date("d-M-Y", strtotime($obygn[$i]['tanggal_input'])) ?></td>
										<td style="text-align: right; width: 75px;"><?php echo number_format($obygn[$i]['tarif']) ?></td>
										<td style="text-align: right">
											<input type="hidden" id="rawat[<?php echo $i ?>][nama]" name="rawat[<?php echo $i ?>][nama]" value="<?php echo $obygn[$i]['nama_tindakan'] ?>" />
											<input type="hidden" id="rawat[<?php echo $i ?>][nilai]" name="rawat[<?php echo $i ?>][nilai]" value="<?php echo $obygn[$i]['tarif'] ?>" />
											<input type="hidden" id="rawat[<?php echo $i ?>][qty]" name="rawat[<?php echo $i ?>][qty]" value="<?php echo $obygn[$i]['qty'] ?>" />
											<input type="text" id="rawat[<?php echo $i ?>][asuransi]" name="rawat[<?php echo $i ?>][asuransi]" class="form-control text-right" value="<?php echo $obygn[$i]['tarif'] ?>" />
										</td>
									</tr>
								<?php
									$totranap = $totranap + $obygn[$i]['tarif'];
								}
								$totranap = $totranap + $kelas[0]['tarif'];
								if ($totranap < 5000000) {
									$biayaAdmRI = $db->query("select nilai from tbl_config where kode='ADMRI' and tahun='" . date("Y") . "'");
									$total_biayaAdmRI = $biayaAdmRI[0]['nilai'] * $totranap / 100;
								} else {
									$biayaAdmRI = $db->query("select nilai from tbl_config where kode='ADMRIMAX' and tahun='" . date("Y") . "'");
									$total_biayaAdmRI = $biayaAdmRI[0]['nilai'];
								}
								$totranap = $totranap + $total_biayaAdmRI;
								?>
								<tr>
									<th colspan="3" style="text-align: right; margin-right: 5px; font-weight: bold">Biaya Administrasi Rawat Inap</th>
									<th style="text-align: right; font-weight: bold"><?php echo number_format($total_biayaAdmRI) ?></th>
									<th style="text-align: right">&nbsp;</th>
								</tr>
								<tr>
									<th colspan="3" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Rawat Inap</th>
									<th style="text-align: right; font-weight: bold"><?php echo number_format($totranap) ?></th>
									<th style="text-align: right">&nbsp;</th>
								</tr>
							</tbody>
						</table>
					<?php
					}
					?>
					<?php
					$total = $biayaAdmin + $data1[0]['biayaAdmin'] + $totFarm + $totLab + $totRad + $totTdk + $totFis + $totgigi + $totAlkes + $totobygn + $totbedah + $total_pl + $totranap + $totRawat;
					?>
				</div>
			</td>
		</tr>
	</table>
</div>


<?php
$uang_muka = $db->queryItem("select sum(total_harga_um) jumlah from tbl_um where no_daftar='$nomor_daftar'", 0);
$uang_muka_text = number_format($uang_muka);
$sub_total = $total;
$total = abs($total - $uang_muka);

?>


&nbsp;
<script language="javascript">
	inputTotalBayar('<?php echo $total ?>', '<?php echo number_format($total) ?>', '<?php echo $sub_total ?>', '<?php echo number_format($sub_total) ?>', '<?php echo $uang_muka ?>', '<?php echo number_format($uang_muka) ?>', '<?php echo $data1[0]['telp_pasien'] ?>');
</script>