<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>MH.THAMRIN HEALTH CARE | Radjak Group</title>
	<link href="style.css" rel="stylesheet" media="all" />
	<script type="text/javascript" src="../../js/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="../../js/superfish.js"></script>
	<script type="text/javascript" src="../../js/jquery-ui-1.8.18.custom.min.js"></script>
	<script type="text/javascript" src="../../js/tooltip.js"></script>
	<script type="text/javascript" src="../../js/cookie.js"></script>
	<script type="text/javascript" src="../../js/custom.js"></script>
	<script type="text/javascript" src="../../js/utama.js"></script>
	<link href="../../style.css" rel="stylesheet" media="all" />

</head>
<body>

	<p style="text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 2px; margin-top: 10px;">
		REKAPITULASI PENDAPATAN KASIR (CASH)<br>
		PERIODE : <?php echo $_GET['d1'].' s/d '.$_GET['d2']?>
	</p>

<?php
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	$t1 = explode("/", $_GET['d1']);
	$t2 = explode("/", $_GET['d2']);
	//Nilai Tutup Pendapatan Harian
	$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
	$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
	$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;

	$administrasi = $db->queryItem("select sum(b.bayar) from tbl_kasir a left join tbl_kasir_detail b on b.no_kwitansi=a.no_kwitansi where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and kategori='ADMINISTRASI' and nomor='1' and payment_to='PASIEN'", 0);
	$lab = $db->queryItem("select sum(b.bayar) from tbl_kasir a left join tbl_kasir_detail b on b.no_kwitansi=a.no_kwitansi where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and kategori='LAB' and payment_to='PASIEN'", 0);
	$fis = $db->queryItem("select sum(b.bayar) from tbl_kasir a left join tbl_kasir_detail b on b.no_kwitansi=a.no_kwitansi where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and kategori='FIS' and payment_to='PASIEN'", 0);
	$rad = $db->queryItem("select sum(b.bayar) from tbl_kasir a left join tbl_kasir_detail b on b.no_kwitansi=a.no_kwitansi where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and kategori='RAD' and payment_to='PASIEN'", 0);
	$gigi = $db->queryItem("select sum(b.bayar) from tbl_kasir a left join tbl_kasir_detail b on b.no_kwitansi=a.no_kwitansi where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and kategori='GIGI' and payment_to='PASIEN'", 0);
	$pharmacy = $db->queryItem("select sum(b.bayar) from tbl_kasir a left join tbl_kasir_detail b on b.no_kwitansi=a.no_kwitansi where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and kategori='PHARMACY' and payment_to='PASIEN'", 0);
	$tindakan = $db->queryItem("select sum(b.bayar) from tbl_kasir a left join tbl_kasir_detail b on b.no_kwitansi=a.no_kwitansi where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and kategori='TINDAKAN' and payment_to='PASIEN'", 0);
	$alkes = $db->queryItem("select sum(b.bayar) from tbl_kasir a left join tbl_kasir_detail b on b.no_kwitansi=a.no_kwitansi where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and kategori='alkes' and payment_to='PASIEN'", 0);
	$pembulatan = $db->queryItem("select sum(a.jml_pembulatan) from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2'", 0);
	$totalAll = $administrasi + $lab + $fis + $rad + $gigi + $pharmacy + $tindakan + $alkes + $pembulatan;
	
?>
<div class="hastable box box-content nopadding" align="left" style="margin-left:10px; margin-right: 10px; margin-top: 20px; width: 98%">
	<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
		<thead> 
			<tr style="font-weight: bold">
				<th style="text-align: left; font-size: 14px">TOTAL BIAYA ADMINISTRASI</th>
				<th style="text-align: right; width: 150px; font-size: 14px"><?php echo number_format($administrasi)?></th> 
			</tr> 
			<tr style="font-weight: bold">
				<th colspan="2" style="text-align: left; padding-top: 25px; background-color:#FFFFFF; font-size: 14px">TOTAL PENUNJANG MEDIS</th>
			</tr> 
			<tr style="font-weight: bold">
				<th style="text-align: left; padding-left: 40px; font-size: 12px">LABORATORIUM</th>
				<th style="text-align: right; width: 150px; font-size: 14px"><?php echo number_format($lab)?></th> 
			</tr> 
			<tr style="font-weight: bold">
				<th style="text-align: left; padding-left: 40px; font-size: 12px">FISIOTHERAPI</th>
				<th style="text-align: right; width: 150px; font-size: 14px"><?php echo number_format($fis)?></th> 
			</tr> 
			<!--<tr style="font-weight: bold">
				<th style="text-align: left; padding-left: 40px; font-size: 12px">RADIOLOGI</th>
				<th style="text-align: right; width: 150px; font-size: 14px"><?php echo number_format($rad)?></th> 
			</tr>-->
			<?php
				//$umum = $db->queryItem("select count(b.kd_poli) * c.tarif from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar left join tbl_poli c on c.kd_poli=b.kd_poli where a.no_kwitansi in (select b.no_kwitansi from tbl_kasir a left join tbl_kasir_detail b on b.no_kwitansi=a.no_kwitansi where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and b.kategori='ADMINISTRASI' and b.nomor='2' and b.payment_to='PASIEN' and b.bayar > 0)", 0);
				$umum = $db->queryItem("select sum(p.tot) from (select (count(b.kd_poli) * c.tarif) as tot from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar left join tbl_poli c on c.kd_poli=b.kd_poli where a.no_kwitansi in (select b.no_kwitansi from tbl_kasir a left join tbl_kasir_detail b on b.no_kwitansi=a.no_kwitansi where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and b.kategori='ADMINISTRASI' and b.nomor='2' and b.payment_to='PASIEN' and b.bayar > 0) group by b.kd_poli) p", 0);
				$data_lgs = $db->query("select * from tbl_penjualan_obat where tgl_insert >= '$date1' and tgl_insert < '$date2' and status_kwitansi='CLOSED' and status_delete='UD'");
				for ($ldf = 0; $ldf < count($data_lgs); $ldf++) {
					$totalRacikan = $db->queryItem("select sum(total) from tbl_penjualan_obat_detail where jenis='R' and status_delete='UD' and penjualan_id='".$data_lgs[$ldf]['id']."'", 0);
					$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'", 0);
					if ($totalRacikan > 0) $total_jual = $data_lgs[$ldf]['total_harga'] + $totalRacikan + $embalase;
					else  $total_jual = $data_lgs[$ldf]['total_harga'] + $totalRacikan;
					$obatLangsung = $obatLangsung + $total_jual;
				}

				$data_pkr = $db->query("select * from tbl_polkar where tgl_insert >= '$date1' and tgl_insert < '$date2' and status_delete='UD'", 0);
				for ($dd = 0; $dd < count($data_pkr); $dd++) {
					$polkar = $polkar + $data_pkr[$dd]['total_harga_polkar'];
				}

				$totalAll = $totalAll + $umum + $obatLangsung + $polkar;
			?>
			<tr style="font-weight: bold">
				<th style="text-align: left; font-size: 14px">POLI UMUM</th>
				<th style="text-align: right; width: 150px; font-size: 14px"><?php echo number_format($umum)?></th> 
			</tr> 
			<tr style="font-weight: bold">
				<th style="text-align: left; font-size: 14px">POLI GIGI</th>
				<th style="text-align: right; width: 150px; font-size: 14px"><?php echo number_format($gigi)?></th> 
			</tr> 
			<tr style="font-weight: bold">
				<th style="text-align: left; font-size: 14px">POLI KARYAWAN</th>
				<th style="text-align: right; width: 150px; font-size: 14px"><?php echo number_format($polkar)?></th> 
			</tr> 
			<tr style="font-weight: bold">
				<th style="text-align: left; font-size: 14px">PHARMACY</th>
				<th style="text-align: right; width: 150px; font-size: 14px"><?php echo number_format($pharmacy)?></th> 
			</tr> 
			<tr style="font-weight: bold">
				<th style="text-align: left; font-size: 14px">TINDAKAN MEDIS</th>
				<th style="text-align: right; width: 150px; font-size: 14px"><?php echo number_format($tindakan)?></th> 
			</tr> 
			<tr style="font-weight: bold">
				<th style="text-align: left; font-size: 14px">ALKES</th>
				<th style="text-align: right; width: 150px; font-size: 14px"><?php echo number_format($alkes)?></th> 
			</tr> 
			<tr style="font-weight: bold">
				<th style="text-align: left; font-size: 14px">OBAT LANGSUNG</th>
				<th style="text-align: right; width: 150px; font-size: 14px"><?php echo number_format($obatLangsung)?></th> 
			</tr> 
			<tr style="font-weight: bold">
				<th style="text-align: left; font-size: 14px">PENDAPATAN PEMBULATAN</th>
				<th style="text-align: right; width: 150px; font-size: 14px"><?php echo number_format($pembulatan)?></th> 
			</tr> 
			<tr style="font-weight: bold">
				<th colspan="2" style="text-align: left; padding-top: 25px; background-color:#FFFFFF; font-size: 14px">PENDAPATAN DOKTER</th>
			</tr> 
			<?php
				$dokter = $db->query("select sum(b.bayar) as jumlah, b.nama, b.no_kwitansi, count(b.no_kwitansi) as jml from tbl_kasir a left join tbl_kasir_detail b on b.no_kwitansi=a.no_kwitansi where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and b.kategori='ADMINISTRASI' and b.nomor='2' and b.payment_to='PASIEN' and b.bayar > 0 group by b.nama", 0);
				for ($i = 0; $i < count($dokter); $i++) {
					$kd_poli = $db->queryItem("select b.kd_poli from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where a.no_kwitansi='".$dokter[$i]['no_kwitansi']."'");
					$nilai_poli = $db->queryItem("select tarif from tbl_poli where kd_poli='".$kd_poli."'");
					$nilai_poli = $nilai_poli * $dokter[$i]['jml'];
					$dokter[$i]['jumlah'] = $dokter[$i]['jumlah'] - $nilai_poli;
			?>
			<tr style="font-weight: bold">
				<th style="text-align: left; padding-left: 40px; font-size: 12px"><?php echo $dokter[$i]['nama']?></th>
				<th style="text-align: right; width: 150px; font-size: 14px"><?php echo number_format($dokter[$i]['jumlah'])?></th> 
			</tr> 
			<?php
					$totalAll = $totalAll + $dokter[$i]['jumlah'];
				}
				$totalAll = $totalAll;
			?>
			<tr style="font-weight: bold">
				<th style="text-align: left; font-size: 16px">TOTAL KESELURUHAN PENDAPATAN</th>
				<th style="text-align: right; width: 150px; font-size: 16px"><?php echo number_format($totalAll)?></th> 
			</tr> 
		</thead>
	</table>
</div>
</body>
</html>