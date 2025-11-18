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
	
	$kasir = $db->query("select * from tbl_kasir where no_kwitansi='".$_GET['id']."'");
	$_POST['id'] = $kasir[0]['no_daftar'];
	$diagnosa = $db->queryItem("select diagnosa from tbl_resep where no_daftar='".$kasir[0]['no_daftar']."'");
	$tst = explode("-", $_POST['id']);
	if ($tst[0] == 'JAM') {
		$data1 = $db->query("select a.nomr, b.nm_pasien, a.kode_dokter, a.nama_perusahaan, 0 as biayaAdmin, c.nama_poli, c.tarif from tbl_pendaftaran_jamsostek a left join tbl_pasien_jamsostek b on b.id=a.idNomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$tst[1]."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
		//$lab = $db->queryItem("select sum(tarif) as jml1 from tbl_lab_detail a  left join tbl_lab b on b.id=a.labId where b.no_daftar='".$_POST['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
		
		//$rad = $db->queryItem("select sum(tarif) as jml1 from tbl_rad_detail a  left join tbl_rad b on b.id=a.radId where b.no_daftar='".$_POST['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
		$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
		$total = $biayaAdmin + $farmasi1[0]['jml1'] + $farmasi2[0]['jml1'] + $embalase + $lab + $rad;
		$namaDokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
		$biayaDokter = $db->queryItem("select tarif_jamsostek from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
		$biayaPoli = 0;
		//$biayaDokter = $biayaDokter + $biayaPoli;
		//$biayaAdmin = $biayaDokter + $data1[0]['biayaAdmin'];
	}
	else {
		$data1 = $db->query("select a.nomr, b.nm_pasien, a.kode_dokter, a.nama_perusahaan, a.biayaAdmin, if (c.nama_poli is NULL, a.kd_poli, c.nama_poli) as nama_poli, c.tarif from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$_POST['id']."' and a.status_delete='UD'", 0);
		$lab = $db->queryItem("select sum(tarif) as jml1 from tbl_lab_detail a  left join tbl_lab b on b.id=a.labId where b.no_daftar='".$_POST['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
		
		$rad = $db->queryItem("select sum(tarif) as jml1 from tbl_rad_detail a  left join tbl_rad b on b.id=a.radId where b.no_daftar='".$_POST['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
		$gigiNr = $db->queryItem("select sum(tarif) as jml1 from tbl_gigi_detail a  left join tbl_gigi b on b.id=a.gigiId where b.no_daftar='".$_POST['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
		$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
		$total = $biayaAdmin + $farmasi1[0]['jml1'] + $farmasi2[0]['jml1'] + $embalase + $lab + $rad;
		$namaDokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
		$biayaDokter = $db->queryItem("select tarif_dokter from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
		//$biayaPoli = $data1[0]['tarif'];
		//$biayaDokter = $biayaDokter + $biayaPoli;
		//$biayaAdmin = $biayaDokter + $data1[0]['biayaAdmin'];
	}
?>
<div align="left">
	<p style="text-align: left; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
		<div style="width: 280px; float: right"><img src="../../images/logo1.png" /></div>
		<div style="width: 500px; float: left; margin-left: 12px; font-weight: bold">KWITANSI PEMBAYARAN PASIEN<br />No : <?php echo $kasir[0]['no_kwitansi']?></div>
	</p>
	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		Tanggal Kwitansi : <?php echo $kasir[0]['tgl_insert']?><br />
		NoMR / Nama Pasien : <?php echo $data1[0]['nomr'].' / '.$data1[0]['nm_pasien']?><br />
		Penjamin Pasien : <?php echo $data1[0]['nama_perusahaan']?> / Nama Penjamin Pasien : <?php echo $kasir[0]['penjamin']?><br />
	</p>
	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		
	</p>
	<table border="1" cellpadding="0" style="border-collapse: collapse" width="98%" bordercolor="#000000">
	   <tr height="28">
			<td valign="middle" colspan="2">
				<div class="hastable box box-content nopadding" align="left" style="margin-left: 0; margin-right: 0; width: 100%; margin-top: 0px;">
					<?php
						$admnr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='ADMINISTRASI' and payment_to='PASIEN'", 0);
						if ($admnr > 0) {
					?>
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<thead> 
						<tr>
							<th colspan="3" style="text-align: left">Administrasi</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							$biayaAdmin = 0;
							$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='ADMINISTRASI' and payment_to='PASIEN'");
							for ($i = 0; $i < count($adm); $i++) {
								if ($adm[$i]['bayar'] > 0) {
						?>
						<tr>
							<td style="width: 15px; text-align: right; font-size: 10px;">-</td> 
							<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama']?></td> 
							<td style="text-align: right; width: 75px; font-size: 10px;"><?php echo number_format($adm[$i]['bayar'])?></td>
						</tr> 
						<?php
								$biayaAdmin = $biayaAdmin + $adm[$i]['bayar'];
								}
							}
						?>
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Administrasi</th> 
							<th style="text-align: right; font-size: 10px;"><?php echo number_format($biayaAdmin)?></th>
						</tr> 
						</tbody>
					</table>
					<?php
						}
						
						$admnr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='PHARMACY' and payment_to='PASIEN'");
						if ($admnr > 0 and $tst[0] != 'JAM') {
					?>
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
						<thead> 
						<tr>
							<th colspan="3" style="text-align: left">Pharmacy</th> 
						</tr> 
						</thead>
						<tbody> 
						<?php
							if ($tst[0] == 'JAM') {
						?>
						<?php
								$farm = $db->query("select a.no_resep, a.nama_obat, a.total from tbl_resepjams_detail a  left join tbl_resepjams b on b.no_resep=a.no_resep where b.no_daftar='".$tst[1]."' and a.status_delete='UD' and b.status_delete='UD'", 0);
								for ($i = 0; $i < count($farm); $i++) {
						?>
						<tr>
							<td style="width: 15px; text-align: right">-</td> 
							<td style="text-align: left"><?php echo $farm[$i]['nama_obat']?></td> 
							<td style="text-align: right; width: 75px;"><?php echo number_format($farm[$i]['total'])?></td>
						</tr>
						<?php
									$totFarm = $totFarm + $farm[$i]['total'];
								}
								$farm2 = $db->query("select b.nama, sum(total) as jml1 from tbl_racikanjams_detail a  left join tbl_racikanjams b on b.id=a.racikanId where b.no_resep='".$farm[0]['no_resep']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
								if (count($farm2) > 0 and $farm2[0]['nama'] != NULL) {
						?>
						<tr>
							<td style="width: 15px; text-align: right">-</td> 
							<td style="text-align: left"><?php echo $farm2[0]['nama']?></td> 
							<td style="text-align: right; width: 75px;"><?php echo number_format($farm2[0]['jml1'])?></td>
						</tr>
						<?php
									$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
									$totFarm = $totFarm + $farm2[0]['jml1'] + $embalase;
								}
						?>
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Pharmacy</th> 
							<th style="text-align: right; font-size: 10px;"><?php echo number_format($totFarm)?></th>
						</tr> 
						<?php
							}
							$totFarm = 0;
							$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='PHARMACY' and payment_to='PASIEN'");
							for ($i = 0; $i < count($adm); $i++) {
						?>
						<tr>
							<td style="width: 15px; text-align: right; font-size: 10px;">-</td> 
							<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama']?></td> 
							<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar'])?></td>
						</tr> 
						<?php
								$totFarm = $totFarm + $adm[$i]['bayar'];
							}
						?>
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Pharmacy</th> 
							<th style="text-align: right; font-size: 10px;; width: 75px;"><?php echo number_format($totFarm)?></th>
						</tr> 
						</tbody>
					</table>
					<?php
						}
						$tindnr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='TINDAKAN' and payment_to='PASIEN'");
						if ($tindnr > 0) {
					?>
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<thead> 
						<tr>
							<th colspan="3" style="text-align: left">Tindakan Medis</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							$totTdk = 0;
							$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='TINDAKAN' and payment_to='PASIEN'");
							for ($i = 0; $i < count($adm); $i++) {
						?>
						<tr>
							<td style="width: 15px; text-align: right; font-size: 10px;">-</td> 
							<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama']?></td> 
							<td style="text-align: right font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar'])?></td>
						</tr>
						<?php
								$totTdk = $totTdk + $adm[$i]['bayar'];
							}
						?>
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Tindakan Medis</th> 
							<th width="9%" style="text-align: right; font-size: 10px;"><?php echo number_format($totTdk)?></th>
						</tr> 
						</tbody>
					</table>
					<?php	
						}
						$alkesnr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='alkes' and payment_to='PASIEN'");
						if ($alkesnr > 0) {
					?>
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<thead> 
						<tr>
							<th colspan="3" style="text-align: left">Alkes</th> 
						</tr> 
						</thead>
						<tbody> 
						<?php
							$totAlkes = 0;
							$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='alkes' and payment_to='PASIEN'");
							for ($i = 0; $i < count($adm); $i++) {
						?>
						<tr>
							<td style="width: 15px; text-align: right; font-size: 10px;">-</td> 
							<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama']?></td> 
							<td style="text-align: right; width: 150px; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar'])?></td>
						</tr>
						<?php
								$totAlkes = $totAlkes + $adm[$i]['bayar'];
							}
						?>
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Alkes</th> 
							<th width="9%" style="text-align: right; font-size: 10px;"><?php echo number_format($totAlkes)?></th>
						</tr> 
						</tbody>
					</table>
					<?php	
						}
						$labnr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='LAB' and payment_to='PASIEN'");
						if ($labnr > 0) {
					?>
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<thead> 
						<tr>
							<th colspan="3" style="text-align: left">Laboratorium</th> 
						</tr> 
						</thead>
						<tbody> 
						<?php
							$totLab = 0;
							$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='LAB' and payment_to='PASIEN'");
							for ($i = 0; $i < count($adm); $i++) {
						?>
						<tr>
							<td style="width: 15px; text-align: right; font-size: 10px;">-</td> 
							<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama']?></td> 
							<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar'])?></td>
						</tr> 
						<?php
								$totLab = $totLab + $adm[$i]['bayar'];
							}
						?>
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Laboratorium</th> 
							<th width="9%" style="text-align: right; font-size: 10px;"><?php echo number_format($totLab)?></th>
						</tr> 
						</tbody>
					</table>
					<?php
						}
						$gigi_nr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='GIGI' and payment_to='PASIEN'");
						if ($gigi_nr > 0) {
					?>
					<!--Input Data tindakan Poli Gigi	-->				
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<thead> 
						<tr>
							<th colspan="3" style="text-align: left">Poli Gigi</th> 
						</tr>
						</thead> 
						<tbody> 
						<?php
							$totgigi = 0;
							$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='GIGI' and payment_to='PASIEN'");
							for ($i = 0; $i < count($adm); $i++) {
						?>
						<tr>
							<td style="width: 15px; text-align: right; font-size: 10px;">-</td> 
							<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama']?></td> 
							<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar'])?></td>
						</tr>
						<?php
								$totgigi = $totgigi + $adm[$i]['bayar'];
							}
						?>
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Poli Gigi</th> 
							<th width="8%" style="text-align: right; font-size: 10px;"><?php echo number_format($totgigi)?></th>
						</tr> 
						</tbody>
					</table>
					<?php
						}
						$obygn_nr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='OBYGN' and payment_to='PASIEN'");
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
							$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='OBYGN' and payment_to='PASIEN'");
							for ($i = 0; $i < count($adm); $i++) {
						?>
						<tr>
							<td style="width: 15px; text-align: right; font-size: 10px;">-</td> 
							<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama']?></td> 
							<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar'])?></td>
						</tr>
						<?php
								$totobygn = $totobygn + $adm[$i]['bayar'];
							}
						?>
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Poli Obygn/Kandungan</th> 
							<th width="9%" style="text-align: right; font-size: 10px;"><?php echo number_format($totobygn)?></th>
						</tr> 
						</tbody>
					</table>
					<?php	
						}
						$bedah_nr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='BEDAH' and payment_to='PASIEN'");
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
							$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='BEDAH' and payment_to='PASIEN'");
							for ($i = 0; $i < count($adm); $i++) {
						?>
						<tr>
							<td style="width: 15px; text-align: right; font-size: 10px;">-</td> 
							<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama']?></td> 
							<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar'])?></td>
						</tr>
						<?php
								$totBedah = $totBedah + $adm[$i]['bayar'];
							}
						?>
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Poli Bedah</th> 
							<th style="text-align: right; font-size: 10px; width: 75px"><?php echo number_format($totBedah)?></th>
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
							<th colspan="3" style="text-align: left">Radiologi</th> 
						</tr> 
						</thead>
						<tbody> 
						<?php
							$totRad = 0;
							$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='RAD' and payment_to='PASIEN'");
							for ($i = 0; $i < count($adm); $i++) {
						?>
						<tr>
							<td style="width: 15px; text-align: right; font-size: 10px;">-</td> 
							<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama']?></td> 
							<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar'])?></td>
						</tr>
						<?php
								$totRad = $totRad + $adm[$i]['bayar'];
							}
						?>
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Radiologi</th> 
							<th width="9%" style="text-align: right; font-size: 10px;"><?php echo number_format($totRad)?></th>
						</tr> 
						</tbody>
					</table>
					<?php
						}
						
						$fisnr = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='FIS' and payment_to='PASIEN'");
						if ($fisnr > 0) {
					?>
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<thead> 
						<tr>
							<th colspan="3" style="text-align: left">Fisioterapi</th> 
						</tr> 
						</thead>
						<tbody> 
						<?php
							$totFis = 0;
							$adm = $db->query("select * from tbl_kasir_detail where no_kwitansi='".$_GET['id']."' and kategori='FIS' and payment_to='PASIEN'");
							for ($i = 0; $i < count($adm); $i++) {
						?>
						<tr>
							<td style="width: 15px; text-align: right; font-size: 10px;">-</td> 
							<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama']?></td> 
							<td style="text-align: right; font-size: 10px; width: 75px;"><?php echo number_format($adm[$i]['bayar'])?></td>
						</tr>
						<?php
								$totFis = $totFis + $adm[$i]['bayar'];
							}
						?>
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya Fisioterapi</th> 
							<th width="9%" style="text-align: right; font-size: 10px;"><?php echo number_format($totFis)?></th>
						</tr> 
						</tbody>
					</table>
					<?php	
						}
						//echo "$total = $biayaAdmin + $totFarm + $totLab + $totRad + $totFis + $totgigi + $totTdk;";
						$total = $biayaAdmin + $totFarm + $totLab + $totRad + $totFis + $totgigi + $totTdk + $totAlkes + $totobygn + $totBedah;
						
						if ($kasir[0]['metode_payment'] = 'DEBIT') {
							$metodeNya = 'Debit dengan menggunakan Bank '.$kasir[0]['nama_bank'];
						}
						elseif ($kasir[0]['metode_payment'] = 'CC') {
							$metodeNya = 'Kartu Kredit dengan Nomor Kartu : '.$kasir[0]['no_kartu'];
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
									echo $diagnosa;
								?>
							</th> 
							<th style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya</th> 
							<th style="text-align: right; font-size: 10px;; width: 75px;"><?php echo number_format($total)?></th>
						</tr>
						<tr>
							<th style="text-align: right; margin-right: 5px; font-size: 10px;">Diskon</th> 
							<th style="text-align: right; font-size: 10px;; width: 75px;"><?php echo number_format($kasir[0]['diskon'])?></th>
						</tr>
						<tr>
							<th style="text-align: right; margin-right: 5px; font-size: 10px;">Total Pembayaran</th> 
							<th style="text-align: right; font-size: 10px;; width: 75px;"><?php echo number_format($kasir[0]['total']+$kasir[0]['jml_pembulatan'])?></th>
						</tr>
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Pembulatan</th> 
							<th style="text-align: right; font-size: 10px;; width: 75px;"><?php echo number_format($kasir[0]['jml_pembulatan'])?></th>
						</tr>
						<tr>
							<th colspan="3" style="text-align: left; font-size: 10px;; margin-left: 15px">Terbilang : "<?php echo ucwords(Terbilang($kasir[0]['total']+$kasir[0]['jml_pembulatan'])).' Rupiah'?>"</th>
						</tr>
						<!--<tr><td colspan="3">&nbsp;</td></tr>
						<tr>
							<td colspan="3" style="text-align: left">Metode Pembayaran : <?php echo $metodeNya?></td> 
						</tr> -->
					</table>					
					<div style="float: right; width: 200px; text-align:center">
						<p style="margin-bottom: 9px; font-size: 10px;">Jakarta, <?php echo date("d F Y", strtotime($kasir[0]['tgl_insert']))?></p>
						<p style="margin-top: 9px; font-size: 10px;"><?php echo $kasir[0]['user_insert']?></p>
					</div>
				</div>
			</td>
	   </tr>
	</table>
</div>
</body>
</html>
