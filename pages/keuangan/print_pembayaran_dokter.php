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
	  	return "Nol ";
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
	
	$data = $db->query("select * from tbl_bayar_dokter where no_bayar='".$_GET['id']."'");
	$_POST['id'] = $kasir[0]['no_daftar'];
	$nilai = $db->query("select sum(b_dokter) jml_bdokter, count(id) jml_pasien from tbl_bayar_dokter_detail where bayar_dokter_id='".$data[0]['id']."' and jaminan <> 'JAMSOSTEK'");
	$nilai2 = $db->query("select sum(b_dokter) jml_bdokter, count(id) jml_pasien from tbl_bayar_dokter_detail where bayar_dokter_id='".$data[0]['id']."' and jaminan = 'JAMSOSTEK'");
	$itemUmum = $nilai[0]['jml_bdokter'] / $nilai[0]['jml_pasien'];
	$itemJAM = $nilai2[0]['jml_bdokter'] / $nilai2[0]['jml_pasien'];
	
	$biayaTindakan = $db->queryItem("select sum(b_tindakan) from tbl_bayar_dokter_detail where bayar_dokter_id='".$data[0]['id']."'", 0);
	$nrbiayaTindakan = $db->queryItem("select count(b_tindakan) from tbl_bayar_dokter_detail where bayar_dokter_id='".$data[0]['id']."' and b_tindakan > 0", 0);

	$biayaLab = $db->queryItem("select sum(b_lab) from tbl_bayar_dokter_detail where bayar_dokter_id='".$data[0]['id']."'", 0);
	$nrbiayalab = $db->queryItem("select count(b_lab) from tbl_bayar_dokter_detail where bayar_dokter_id='".$data[0]['id']."' and b_lab > 0", 0);

	$biayafis = $db->queryItem("select sum(b_fisio) from tbl_bayar_dokter_detail where bayar_dokter_id='".$data[0]['id']."'", 0);
	$nrbiayafis = $db->queryItem("select count(b_fisio) from tbl_bayar_dokter_detail where bayar_dokter_id='".$data[0]['id']."' and b_fisio > 0", 0);
	
	$biayafee = $db->queryItem("select sum(fee_dokter) from tbl_bayar_dokter_detail where bayar_dokter_id='".$data[0]['id']."'", 0);

	$totJasa = $biayafis+$biayaLab+$biayaTindakan+$biayafee+$nilai[0]['jml_bdokter']+$data[0]['biaya_jaga'];
	$dokter = $db->query("select * from tbl_dokter where kode_dokter='".$data[0]['kode_dokter']."'");
	if ($dokter[0]['npwp'] == "") {
		$txtnpwp = 'Jika Non NPWP (3%)';
		$npwp = $totJasa * 3/100;
	}
	else {
		$txtnpwp = 'Jika Punya NPWP (2,5%)';
		$npwp = $totJasa * 2.5/100;
	}
	$totPajak = $npwp;
	$totalAll = $totJasa - $totPajak;
?>

<div align="left">
	<p style="text-align: left; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
		<img src="../../images/logo1.png" />
	</p>
	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 25px;">
		Tanda Terima Honor Dokter<br />
		Periode <?php echo date("d F Y", strtotime($data[0]['tgl_start'])).' - '.date("d F Y", strtotime($data[0]['tgl_end']))?><br /><br />
		<b><?php echo $data[0]['nama_dokter']?></b><br />
	</p>
<table width="95%" border="1" cellspacing="0" cellpadding="0" style="margin-left: 2%;">
  <tr height="25">
    <td>Uang Duduk</td>
    <td style="width: 40px;">:</td>
    <td style="text-align: right" colspan="3"><?php echo number_format($data[0]['nrhari_jaga']).' Hari Kerja : '?></td>
    <td style="width: 50px; text-align: right">RP</td>
    <td style="width: 100px; text-align: right"><?php echo number_format($data[0]['biaya_jaga'])?></td>
  </tr>
  <tr height="25">
    <td>Pasien Umum</td>
    <td style="width: 40px;">:</td>
    <td style="width: 40px;"><?php echo number_format($nilai[0]['jml_pasien'])?> x</td>
    <td style="width: 20px;">RP</td>
    <td style="width: 80px; text-align: right"><?php echo number_format($itemUmum, 2)?></td>
    <td style="width: 50px; text-align: right">RP</td>
    <td style="width: 100px; text-align: right"><?php echo number_format($nilai[0]['jml_bdokter'], 2)?></td>
  </tr>
  <tr><td colspan="7">&nbsp;</td></tr>
  <tr height="25">
    <td>Tindakan Umum</td>
    <td style="width: 40px;">:</td>
    <td colspan="3"><?php echo number_format($nrbiayaTindakan)?> x Tindakan Pasien</td>
    <td style="width: 50px; text-align: right">RP</td>
    <td style="width: 100px; text-align: right"><?php echo number_format($biayaTindakan, 2)?></td>
  </tr>
  <tr height="25">
    <td>Tindakan LAB</td>
    <td style="width: 40px;">:</td>
    <td colspan="3"><?php echo number_format($nrbiayaLab)?> x Tindakan Pasien</td>
    <td style="width: 50px; text-align: right">RP</td>
    <td style="width: 100px; text-align: right"><?php echo number_format($biayaLab, 2)?></td>
  </tr>
  <tr height="25">
    <td>Tindakan FISIOTERAPI</td>
    <td style="width: 40px;">:</td>
    <td colspan="3"><?php echo number_format($nrbiayafis)?> x Tindakan Pasien</td>
    <td style="width: 50px; text-align: right">RP</td>
    <td style="width: 100px; text-align: right"><?php echo number_format($biayafis, 2)?></td>
  </tr>
  <tr height="25">
    <td>Professional Fee</td>
    <td style="width: 40px;">:</td>
    <td colspan="3">&nbsp;</td>
    <td style="width: 50px; text-align: right">RP</td>
    <td style="width: 100px; text-align: right"><?php echo number_format($biayafee, 2)?></td>
  </tr>
  <!--<tr height="25">
    <td>Sub Total</td>
    <td style="width: 40px;">:</td>
    <td colspan="3">&nbsp;</td>
    <td style="width: 50px; text-align: right">RP</td>
    <td style="width: 100px; text-align: right"><?php echo number_format($totJasa, 2)?></td>
  </tr>-->
  <tr height="25">
    <td>Total Pendapatan Dokter</td>
    <td style="width: 40px;">:</td>
    <td colspan="3">&nbsp;</td>
    <td style="width: 50px; text-align: right">RP</td>
    <td style="width: 100px; text-align: right"><?php echo number_format($totalAll, 2)?></td>
  </tr>
</table>
</div>
</body>
</html>
