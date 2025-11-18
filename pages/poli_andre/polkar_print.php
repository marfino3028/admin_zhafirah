
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
	
	$kasir = $db->query("select * from tbl_polkar where no_polkar='".$_GET['id']."'");
	$_POST['id'] = $kasir[0]['no_daftar'];
	$tst = explode("-", $_POST['id']);
	$data1 = $db->query("select a.nomr, b.nm_pasien, a.kode_dokter, a.nama_perusahaan, a.biayaAdmin, if (c.nama_poli is NULL, a.kd_poli, c.nama_poli) as nama_poli, c.tarif from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$_POST['id']."' and a.status_delete='UD'", 0);
	$namaDokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
?>
<div align="left">
	<p style="text-align: left; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
		<img src="../../images/logo1.png" />
	</p>
	<p style="text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
		Kwitansi Poli Karyawan
	</p>
	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		Nomor Polkar : <?php echo $kasir[0]['no_polkar']?><br />
		Tanggal Transaksi : <?php echo date("d-m-Y", strtotime($kasir[0]['tgl_insert']))?><br />
		No. MR : <?php echo $kasir[0]['nomr']?><br />
		Nama Karyawan : <?php echo $kasir[0]['nama']?>
	</p>
	<table border="1" cellpadding="0" style="border-collapse: collapse" width="620" bordercolor="#000000">
	   <tr height="28">
			<td valign="middle" colspan="2">
				<div class="hastable box box-content nopadding" align="left" style="margin-left: 10px; margin-right: 10px; width: 100%">
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
						<thead> 
						<tr>
							<th style="text-align: center; width: 30px;">No</th> 
							<th style="text-align: center">Nama Obat</th> 
							<th style="text-align: center; width: 40px;">QTY</th> 
							<th style="text-align: center; width: 70px;">Harga</th> 
							<th style="text-align: center; width: 90px;">Total Harga</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							$totgigi = 0;
							$adm = $db->query("select * from tbl_polkar_detail where no_polkar='".$_GET['id']."' and status_delete='UD' and jenis='NR'");
							for ($i = 0; $i < count($adm); $i++) {
								$no = $i + 1;
								$admin = $db->queryItem("select nilai from tbl_config where kode='ADMTW' and tahun='".date('Y')."'");
								$adm[$i]['total_admin'] = $adm[$i]['tarif'] + $admin;
						?>
						<tr>
							<td style="width: 15px; text-align: right"><?php echo $no?></td> 
							<td style="text-align: left"><?php echo $adm[$i]['nama_obat']?></td> 
							<td style="text-align: right"><?php echo number_format($adm[$i]['qty'])?></td>
							<td style="text-align: right"><?php echo number_format($adm[$i]['harga'])?></td>
							<td style="text-align: right"><?php echo number_format($adm[$i]['total'])?></td>
						</tr> 
						<?php
								$total = $total + $adm[$i]['total'];
							}
							$totgigi = 0;
							$adm = $db->query("select sum(total) as total, b.nama as nama_obat from tbl_polkar_detail a left join tbl_polkar_racikan b on b.no_polkar=a.no_polkar where a.no_polkar='".$_GET['id']."' and a.status_delete='UD' and a.jenis='R' group by a.racikan_id");
							for ($i = 0; $i < count($adm); $i++) {
								$noi = $no + $i + 1;
								$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
								$adm[$i]['total'] = $adm[$i]['total'] + $embalase;
						?>
						<tr>
							<td style="width: 15px; text-align: right"><?php echo $noi?></td> 
							<td style="text-align: left"><?php echo $adm[$i]['nama_obat']?></td> 
							<td style="text-align: right">1</td>
							<td style="text-align: right"><?php echo number_format($adm[$i]['total'])?></td>
							<td style="text-align: right"><?php echo number_format($adm[$i]['total'])?></td>
						</tr> 
						<?php
								$total = $total + $adm[$i]['total'];
							}
						?>
						<tr>
							<th style="text-align: right; font-weight: bold" colspan="4">Total</th> 
							<th style="text-align: right; width: 90px; font-weight: bold"><?php echo number_format($total)?></th> 
						</tr> 
						</tbody>
					</table>
					<div style="float: left; width: 350px; text-align:left; margin-left: 15px;">
						<p style="margin-bottom: 2px; margin-top: 15px; font-size: 11px;"><u>Terbilang:</u><br />
						<b> &nbsp&nbsp&nbsp; <?php echo ucwords(Terbilang($total)).' Rupiah'?></b></p>
					</div>
					<div style="float: right; width: 200px; text-align:center">
						<p style="margin-bottom: 9px; margin-top: 15px; font-size: 11px;">Jakarta, <?php echo date("d F Y", strtotime($kasir[0]['tgl_insert']))?></p>
						<p style="margin-top: 9px; font-size: 11px;"><?php echo $kasir[0]['user_insert']?></p>
					</div>
				</div>
			</td>
	   </tr>
	</table>
</div>
</body>
</html>
