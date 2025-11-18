<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Print Pembayaran Pasien</title>
	<link href="../../style.css" rel="stylesheet" media="all" />
</head>

<body>
	<?php

	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";

	function Terbilang($x)
	{
		$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		if ($x <= 0)
			return " ";
		if ($x < 12)
			return " " . $abil[$x];
		elseif ($x < 20)
			return Terbilang($x - 10) . "belas";
		elseif ($x < 100)
			return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
		elseif ($x < 200)
			return " seratus" . Terbilang($x - 100);
		elseif ($x < 1000)
			return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
		elseif ($x < 2000)
			return " seribu" . Terbilang($x - 1000);
		elseif ($x < 1000000)
			return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
		elseif ($x < 1000000000)
			return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
	}

	$kasir = $db->query("select * from tbl_kasir where no_kwitansi='" . $_GET['id'] . "'");
	$_POST['id'] = $kasir[0]['no_daftar'];
	//$diagnosa = $db->queryItem("select diagnosa from tbl_resep where no_daftar='" . $kasir[0]['no_daftar'] . "'");
	$diagnosa = $db->queryItem("select as_diagnosis from tbl_catatan_dktr where no_daftar='" . $kasir[0]['no_daftar'] . "'");
	$tst = explode("-", $_POST['id']);
	if ($tst[0] == 'JAM') {
		$data1 = $db->query("select a.nomr, b.nm_pasien, a.kode_dokter, a.nama_perusahaan, 0 as biayaAdmin, c.nama_poli, c.tarif from tbl_pendaftaran_jamsostek a left join tbl_pasien_jamsostek b on b.id=a.idNomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='" . $tst[1] . "' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
		//$lab = $db->queryItem("select sum(tarif) as jml1 from tbl_lab_detail a  left join tbl_lab b on b.id=a.labId where b.no_daftar='".$_POST['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);

		//$rad = $db->queryItem("select sum(tarif) as jml1 from tbl_rad_detail a  left join tbl_rad b on b.id=a.radId where b.no_daftar='".$_POST['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
		$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='" . date("Y") . "'");
		$total = $biayaAdmin + $farmasi1[0]['jml1'] + $farmasi2[0]['jml1'] + $embalase + $lab + $rad;
		$namaDokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='" . $data1[0]['kode_dokter'] . "'");
		$biayaDokter = $db->queryItem("select tarif_jamsostek from tbl_dokter where kode_dokter='" . $data1[0]['kode_dokter'] . "'");
		$biayaPoli = 0;
		//$biayaDokter = $biayaDokter + $biayaPoli;
		//$biayaAdmin = $biayaDokter + $data1[0]['biayaAdmin'];
	} else {
		$data1 = $db->query("select a.nomr, b.nm_pasien, a.kode_dokter, a.nama_perusahaan, a.biayaAdmin, if (c.nama_poli is NULL, a.kd_poli, c.nama_poli) as nama_poli, c.tarif from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD'", 0);
		$lab = $db->queryItem("select sum(tarif) as jml1 from tbl_lab_detail a  left join tbl_lab b on b.id=a.labId where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);

		$rad = $db->queryItem("select sum(tarif) as jml1 from tbl_rad_detail a  left join tbl_rad b on b.id=a.radId where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
		$gigiNr = $db->queryItem("select sum(tarif) as jml1 from tbl_gigi_detail a  left join tbl_gigi b on b.id=a.gigiId where b.no_daftar='" . $_POST['id'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
		$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='" . date("Y") . "'");
		$total = $biayaAdmin + $farmasi1[0]['jml1'] + $farmasi2[0]['jml1'] + $embalase + $lab + $rad;
		$namaDokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='" . $data1[0]['kode_dokter'] . "'");
		$biayaDokter = $db->queryItem("select tarif_dokter from tbl_dokter where kode_dokter='" . $data1[0]['kode_dokter'] . "'");
		//$biayaPoli = $data1[0]['tarif'];
		//$biayaDokter = $biayaDokter + $biayaPoli;
		//$biayaAdmin = $biayaDokter + $data1[0]['biayaAdmin'];
	}

	//Pelayanan Lain
	$id_pl = str_replace('PL/', '', ($kasir[0]['no_daftar']));
	$pelayanan_lain = $db->query("select * from tbl_pelayanan_lainnya AS a WHERE a.Id = " . $id_pl . " ", 0);


	?>
	<div align="left">
		<p style="text-align: left; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
		<div style="width: 325px; float: right; margin-bottom: 20px;"><img src="../../images/billing_1.png" /></div>
		<div style="width: 500px; float: left; margin-left: 12px; font-weight: bold">KWITANSI PEMBAYARAN PASIEN<br />No : <?php echo $kasir[0]['no_kwitansi'] ?></div>
		</p>
		<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
			Tanggal Kwitansi : <?php echo $kasir[0]['tgl_insert'] ?><br />
			NoMR / Nama Pasien : <?php echo !empty($data1[0]['nomr']) ? $data1[0]['nomr'] . ' / ' . $data1[0]['nm_pasien'] : $pelayanan_lain[0]['NamaPasien']; ?><br />
			Penjamin Pasien : <?php echo $data1[0]['nama_perusahaan'] ?> / Nama Penjamin Pasien : <?php echo $kasir[0]['penjamin'] ?><br />
		</p>
		<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">

		</p>
		<table border="1" cellpadding="0" style="border-collapse: collapse" width="98%" bordercolor="#000000">
			<tr height="28">
				<td valign="middle" colspan="2">
					<div class="hastable box box-content nopadding" align="left" style="margin-left: 0; margin-right: 0; width: 100%; margin-top: 0px;">
						<?php
						$admnr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='ADMINISTRASI' and payment_to='PASIEN'", 0);
						if ($admnr > 0) {
						?>
							<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
								<thead>
									<tr>
										<th colspan="4" style="text-align: left"><span id="openAdmin" onclick="openAdmin()">Administrasi</span></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$biayaAdmin = 0;
									$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='ADMINISTRASI' and payment_to='PASIEN'");
									for ($i = 0; $i < count($adm); $i++) {
										if ($adm[$i]['bayar'] > 0) {
									?>
											<tr>
												<td style="width: 15px; text-align: right; font-size: 10px;">-</td>
												<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama'] ?></td><td style="width: 50px; text-align: right; font-size: 10px;">
<?php echo $adm[$i]['qty'] ?></td>
												<td style="text-align: right; width: 75px; font-size: 10px;"><?php echo number_format($adm[$i]['bayar']) ?></td>
											</tr>
									<?php
											$biayaAdmin = $biayaAdmin + $adm[$i]['bayar'];
										}
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Administrasi</th>
										<th style="text-align: right;width: 75px; font-size: 10px;"><?php echo number_format($biayaAdmin) ?></th>
									</tr>
								</tfoot>
							</table>
						<?php
						}

						$admnr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='PHARMACY' and payment_to='PASIEN'");
						if ($admnr > 0 and $tst[0] != 'JAM') {
						?>
							<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
								<thead>
									<tr>
										<th colspan="4" style="text-align: left"><span id="openPharmacy" onclick="openPharmacy()">Pharmacy</span> <span id="closePharmacy" style="display: none;" onclick="closePharmacy()">Pharmacy</span></th>
									</tr>
								</thead>
								<tbody id="bodyPharmacy" style="display: none;">
									<?php
									if ($tst[0] == 'JAM') {
									?>
										<?php
										$farm = $db->query("select a.no_resep, a.nama_obat, a.total from tbl_resepjams_detail a  left join tbl_resepjams b on b.no_resep=a.no_resep where b.no_daftar='" . $tst[1] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
										for ($i = 0; $i < count($farm); $i++) {
										?>
											<tr>
												<td style="width: 15px; text-align: right">-</td>
												<td style="text-align: left"><?php echo $farm[$i]['nama_obat'] ?></td>
												<?php echo $adm[$i]['qty'] ?> <?php echo $adm[$i]['satuan'] ?></td>
												<td style="text-align: right; width: 75px;"><?php echo number_format($farm[$i]['total']) ?></td>
											</tr>
										<?php
											$totFarm = $totFarm + $farm[$i]['total'];
										}
										$farm2 = $db->query("select b.nama, sum(total) as jml1 from tbl_racikanjams_detail a  left join tbl_racikanjams b on b.id=a.racikanId where b.no_resep='" . $farm[0]['no_resep'] . "' and a.status_delete='UD' and b.status_delete='UD'", 0);
										if (count($farm2) > 0 and $farm2[0]['nama'] != NULL) {
										?>
											<tr>
												<td style="width: 15px; text-align: right">-</td>
												<td style="text-align: left"><?php echo $farm2[0]['nama'] ?></td>
												<td style="text-align: right; width: 75px;"><?php echo number_format($farm2[0]['jml1']) ?></td>
											</tr>
										<?php
											$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='" . date("Y") . "'");
											$totFarm = $totFarm + $farm2[0]['jml1'] + $embalase;
										}
										?>
										<tr>
											<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Pharmacy</th>
											<th style="text-align: right; font-size: 10px;"><?php echo number_format($totFarm) ?></th>
										</tr>
									<?php
									}
									$totFarm = 0;
									$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='PHARMACY' and payment_to='PASIEN'");
									for ($i = 0; $i < count($adm); $i++) {
									?>
										<tr>
											<td style="width: 15px; text-align: right; font-size: 10px;">-</td>
											<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama'] ?></td><td style="width: 50px; text-align: right; font-size: 10px;">
																       <?php echo $adm[$i]['qty'] ?> <?php echo $adm[$i]['satuan'] ?></td>
											<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar']) ?></td>
										</tr>
									<?php
										$totFarm = $totFarm + $adm[$i]['bayar'];
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Pharmacy</th>
										<th style="text-align: right; font-size: 10px;; width: 75px;"><?php echo number_format($totFarm) ?></th>
									</tr>
								</tfoot>
							</table>
						<?php
						}
						$tindnr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='TINDAKAN' and payment_to='PASIEN'");
						if ($tindnr > 0) {
						?>
							<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
								<thead>
									<tr>
										<th colspan="4" style="text-align: left"><span id="openTindakanMedis" onclick="openTindakanMedis()">Tindakan Medis</span></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$totTdk = 0;
									$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='TINDAKAN' and payment_to='PASIEN'");
									for ($i = 0; $i < count($adm); $i++) {
									?>
										<tr>
											<td style="width: 15px; text-align: right; font-size: 10px;">-</td>
											<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama'] ?></td><td style="width: 50px; text-align: right; font-size: 10px;">
<?php echo $adm[$i]['qty'] ?> <?php echo $adm[$i]['satuan'] ?></td>
											<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar']) ?></td>
										</tr>
									<?php
										$totTdk = $totTdk + $adm[$i]['bayar'];
									}
									?>

								</tbody>
								<tfoot>
									<tr>
										<th colspan="3" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Tindakan Medis</th>
										<th width="9%" style="text-align: right; font-size: 10px;"><?php echo number_format($totTdk) ?></th>
									</tr>
								</tfoot>
							</table>
						<?php
						}
						$alkesnr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='alkes' and payment_to='PASIEN'");
						if ($alkesnr > 0) {
						?>
							<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
								<thead>
									<tr>
										<th colspan="3" style="text-align: left"><span id="openAlkes" onclick="openAlkes()">Alkes</span> <span id="closeAlkes" style="display: none;" onclick="closeAlkes()">Alkes</span></th>
									</tr>
								</thead>
								<tbody style="display: none;" id="bodyAlkes">
									<?php
									$totAlkes = 0;
									$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='alkes' and payment_to='PASIEN'");
									for ($i = 0; $i < count($adm); $i++) {
									?>
										<tr>
											<td style="width: 15px; text-align: right; font-size: 10px;">-</td>
											<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama'] ?></td>
											<td style="text-align: right; width: 150px; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar']) ?></td>
										</tr>
									<?php
										$totAlkes = $totAlkes + $adm[$i]['bayar'];
									}
									?>

								</tbody>
								<tfoot>
									<tr>
										<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Alkes</th>
										<th width="9%" style="text-align: right; width: 150px; font-size: 10px;"><?php echo number_format($totAlkes) ?></th>
									</tr>
								</tfoot>
							</table>
						<?php
						}
						$labnr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='LAB' and payment_to='PASIEN'");
						if ($labnr > 0) {
						?>
							<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
								<thead>
									<tr>
										<th colspan="4" style="text-align: left"><span id="openLab" onclick="openLab()">Laboratorium</span></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$totLab = 0;
									$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='LAB' and payment_to='PASIEN'");
									for ($i = 0; $i < count($adm); $i++) {
									?>
										<tr>
											<td style="width: 15px; text-align: right; font-size: 10px;">-</td>
											<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama'] ?></td><td style="width: 50px; text-align: right; font-size: 10px;">
<?php echo $adm[$i]['qty'] ?> <?php echo $adm[$i]['satuan'] ?></td>
											<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar']) ?></td>
										</tr>
									<?php
										$totLab = $totLab + $adm[$i]['bayar'];
									}
									?>

								</tbody>
								<tfoot>
									<tr>
										<th colspan="3" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Laboratorium</th>
										<th width="9%" style="text-align: right; font-size: 10px;"><?php echo number_format($totLab) ?></th>
									</tr>
								</tfoot>
							</table>
						<?php
						}
						$gigi_nr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='GIGI' and payment_to='PASIEN'");
						if ($gigi_nr > 0) {
						?>
							<!--Input Data tindakan Poli Gigi	-->
							<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
								<thead>
									<tr>
										<th colspan="3" style="text-align: left"><span id="openGigi" onclick="openGigi()">Poli Gigi</span></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$totgigi = 0;
									$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='GIGI' and payment_to='PASIEN'");
									for ($i = 0; $i < count($adm); $i++) {
									?>
										<tr>
											<td style="width: 15px; text-align: right; font-size: 10px;">-</td>
											<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama'] ?></td>
											<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar']) ?></td>
										</tr>
									<?php
										$totgigi = $totgigi + $adm[$i]['bayar'];
									}
									?>

								</tbody>
								<tfoot>
									<tr>
										<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Poli Gigi</th>
										<th width="8%" style="text-align: right; font-size: 10px;"><?php echo number_format($totgigi) ?></th>
									</tr>
								</tfoot>
							</table>
						<?php
						}
						$obygn_nr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='OBYGN' and payment_to='PASIEN'");
						if ($obygn_nr > 0) {
						?>
							<!--Input Data tindakan Poli Gigi	-->
							<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
								<thead>
									<tr>
										<th colspan="3" style="text-align: left">Poli Obygn/Kandungan</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$totobygn = 0;
									$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='OBYGN' and payment_to='PASIEN'");
									for ($i = 0; $i < count($adm); $i++) {
									?>
										<tr>
											<td style="width: 15px; text-align: right; font-size: 10px;">-</td>
											<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama'] ?></td>
											<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar']) ?></td>
										</tr>
									<?php
										$totobygn = $totobygn + $adm[$i]['bayar'];
									}
									?>
									<tr>
										<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Poli Obygn/Kandungan</th>
										<th width="9%" style="text-align: right; font-size: 10px;"><?php echo number_format($totobygn) ?></th>
									</tr>
								</tbody>
							</table>
						<?php
						}
						$bedah_nr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='BEDAH' and payment_to='PASIEN'");
						if ($bedah_nr > 0) {
						?>
							<!--Input Data tindakan Poli Bedah	-->
							<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
								<thead>
									<tr>
										<th colspan="3" style="text-align: left">Poli Bedah</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$totobygn = 0;
									$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='BEDAH' and payment_to='PASIEN'");
									for ($i = 0; $i < count($adm); $i++) {
									?>
										<tr>
											<td style="width: 15px; text-align: right; font-size: 10px;">-</td>
											<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama'] ?></td>
											<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar']) ?></td>
										</tr>
									<?php
										$totBedah = $totBedah + $adm[$i]['bayar'];
									}
									?>
									<tr>
										<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Poli Bedah</th>
										<th style="text-align: right; font-size: 10px; width: 75px"><?php echo number_format($totBedah) ?></th>
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
										<th colspan="4" style="text-align: left">Radiologi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$totRad = 0;
									$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='RAD' and payment_to='PASIEN'");
									for ($i = 0; $i < count($adm); $i++) {
									?>
										<tr>
											<td style="width: 15px; text-align: right; font-size: 10px;">-</td>
											<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama'] ?></td><td style="width: 50px; text-align: right; font-size: 10px;">
<?php echo $adm[$i]['qty'] ?> <?php echo $adm[$i]['satuan'] ?></td>
											<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar']) ?></td>
										</tr>
									<?php
										$totRad = $totRad + $adm[$i]['bayar'];
									}
									?>
									<tr>
										<th colspan="3" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Radiologi</th>
										<th width="9%" style="text-align: right; font-size: 10px;"><?php echo number_format($totRad) ?></th>
									</tr>
								</tbody>
							</table>
						<?php
						}

						$fisnr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='FIS' and payment_to='PASIEN'");
						if ($fisnr > 0) {
						?>
							<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
								<thead>
									<tr>
										<th colspan="4" style="text-align: left"><span id="openFisio" onclick="openFisio()">Fisioterapi</span></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$totFis = 0;
									$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='FIS' and payment_to='PASIEN'");
									for ($i = 0; $i < count($adm); $i++) {
									?>
										<tr>
											<td style="width: 15px; text-align: right; font-size: 10px;">-</td>
											<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama'] ?></td>
											<td style="text-align: right; font-size: 10px;"><?php echo number_format($adm[$i]['qty']) ?></td>
											<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar']) ?></td>
										</tr>
									<?php
										$totFis = $totFis + $adm[$i]['bayar'];
									}
									?>

								</tbody>
								<tfoot>
									<tr>
										<th colspan="3" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Fisioterapi</th>
										<th width="9%" style="text-align: right; font-size: 10px;"><?php echo number_format($totFis) ?></th>
									</tr>
								</tfoot>
							</table>

						<?php
						}

						$fisnr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='PRWT' and payment_to='PASIEN'");
						if ($fisnr > 0) {
						?>
							<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
								<thead>
									<tr>
										<th colspan="4" style="text-align: left"><span id="openFisio" onclick="openFisio()">Fisioterapi</span></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$totFis = 0;
									$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='" . $_GET['id'] . "' and kategori='PRWT' and payment_to='PASIEN'");
									for ($i = 0; $i < count($adm); $i++) {
									?>
										<tr>
											<td style="width: 15px; text-align: right; font-size: 10px;">-</td>
											<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama'] ?></td>
											<td style="text-align: right; font-size: 10px;"><?php echo number_format($adm[$i]['qty']) ?></td>
											<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar']) ?></td>
										</tr>
									<?php
										$totFis = $totFis + $adm[$i]['bayar'];
									}
									?>

								</tbody>
								<tfoot>
									<tr>
										<th colspan="3" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Fisioterapi</th>
										<th width="9%" style="text-align: right; font-size: 10px;"><?php echo number_format($totFis) ?></th>
									</tr>
								</tfoot>
							</table>
						<?php
						}

						?>

						<?php
						//Pembayaran Lainnya Section
						$total_pl = 0;
						if (!empty($pelayanan_lain)) {
						?>
							<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
								<thead>
									<tr>
										<th colspan="2">Pelayanan Lainnya</th>
										<th width="18%">Tarif</th>
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
                                    <td width='40px'>{$no}</td>
                                    <td>{$table[$i]['nama_pelayanan']}</td>
                                    <td align='right' style='text-align:right'>{$tarif}</td>
                                  </tr>";
										$total_pl += ($table[$i]['Tarif'] * $table[$i]['Qty']);
									}
									?>
									<tr>
										<th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Pelayanan Lainnya</th>
										<td colspan="2">
											<div align="right" style="font-weight: bold"><?php echo number_format($total_pl) ?></div>
										</td>
									</tr>
								</tbody>
							</table>
						<?php
						}
						?>
						<?php
						//echo "$total = $biayaAdmin + $totFarm + $totLab + $totRad + $totFis + $totgigi + $totTdk;";
						$total = $biayaAdmin + $totFarm + $totLab + $totRad + $totFis + $totgigi + $totTdk + $totAlkes + $totobygn + $totBedah + $total_pl;

						if ($kasir[0]['metode_payment'] = 'DEBIT') {
							$metodeNya = 'Debit dengan menggunakan Bank ' . $kasir[0]['nama_bank'];
						} elseif ($kasir[0]['metode_payment'] = 'CC') {
							$metodeNya = 'Kartu Kredit dengan Nomor Kartu : ' . $kasir[0]['no_kartu'];
						}
						$kasir[0]['subtotal'] = $kasir[0]['subtotal'] + $biayaPoli;
						$kasir[0]['total'] = $kasir[0]['total'] + $biayaPoli;
						$total_bayar = $total - $kasir[0]['diskon'];
						?>
						<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
							<tr>
								<th rowspan="3" style="text-align: left; margin-right: 5px; font-size: 10px;">
									<u><strong>Diagnosa:</strong></u><br /><br />
									<?php
										//echo $diagnosa;
										$diagNos = $db->query("select * from tbl_catatan_dktr where no_daftar='".$kasir[0]['no_daftar']."'", 0);
                    echo '<small><b>Diagnosa Utama :</b>  ' . $diagNos[0]['as_diagnosis'].' - '.$diagNos[0]['as_diagnosis_kode'] . '</small><br>';
                    if ($diagNos[0]['diagnosa_sekunder1'] != '') echo '<small>Diagnosa Sekunder 1 :  ' . $diagNos[0]['diagnosa_sekunder1'].' - '.$diagNos[0]['icdcode_sekunder1'] . '</small><br>';
                    if ($diagNos[0]['diagnosa_sekunder2'] != '') echo '<small>Diagnosa Sekunder 2 :  ' . $diagNos[0]['diagnosa_sekunder2'].' - '.$diagNos[0]['icdcode_sekunder2'] . '</small><br>';
                    if ($diagNos[0]['diagnosa_sekunder3'] != '') echo '<small>Diagnosa Sekunder 3 :  ' . $diagNos[0]['diagnosa_sekunder3'].' - '.$diagNos[0]['icdcode_sekunder3'] . '</small><br>';
                    if ($diagNos[0]['diagnosa_sekunder4'] != '') echo '<small>Diagnosa Sekunder 4 :  ' . $diagNos[0]['diagnosa_sekunder4'].' - '.$diagNos[0]['icdcode_sekunder4'] . '</small><br>';
									?>
								</th>
								<th style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya</th>
								<th style="text-align: right; font-size: 10px;; width: 75px;"><?php echo number_format($total) ?></th>
							</tr>
							<tr>
								<th style="text-align: right; margin-right: 5px; font-size: 10px;">Diskon</th>
								<th style="text-align: right; font-size: 10px;; width: 75px;"><?php echo number_format($kasir[0]['diskon']) ?></th>
							</tr>
							<tr>
								<th style="text-align: right; margin-right: 5px; font-size: 10px;">Total Pembayaran</th>
								<th style="text-align: right; font-size: 10px;; width: 75px;"><?php echo number_format($kasir[0]['total'] + $kasir[0]['jml_pembulatan']) ?></th>
							</tr>
							<tr>
								<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Pembulatan</th>
								<th style="text-align: right; font-size: 10px;; width: 75px;"><?php echo number_format($kasir[0]['jml_pembulatan']) ?></th>
							</tr>
							<tr>
								<th colspan="3" style="text-align: left; font-size: 10px;; margin-left: 15px">Terbilang : "<?php echo ucwords(Terbilang($kasir[0]['total'] + $kasir[0]['jml_pembulatan'])) . ' Rupiah' ?>"</th>
							</tr>
							<!--<tr><td colspan="3">&nbsp;</td></tr>
						<tr>
							<td colspan="3" style="text-align: left">Metode Pembayaran : <?php echo $metodeNya ?></td> 
						</tr> -->
						</table>
						<div style="float: right; width: 200px; text-align:center">
							<p style="margin-bottom: 9px; font-size: 10px;">Jakarta, <?php echo date("d F Y", strtotime($kasir[0]['tgl_insert'])) ?></p>
							<p style="margin-top: 9px; font-size: 10px;"><?php echo $kasir[0]['user_insert'] ?></p>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
<script>
	function openPharmacy() {
		$("#bodyPharmacy").show()
		$("#closePharmacy").show()
		$("#openPharmacy").hide()
	}

	function closePharmacy() {
		$("#bodyPharmacy").hide()
		$("#closePharmacy").hide()
		$("#openPharmacy").show()
	}
</script>

</html>