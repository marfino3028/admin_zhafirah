<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Permintaan Obat</title>
	<link href="../../style.css" rel="stylesheet" media="all" />
</head>

<body>
<?php
	
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";
	
	$ro = $db->query("select * from tbl_ro where no_ro='".$_GET['id']."'");
	$unit = $db->queryItem("select nilai from tbl_config where kode='SBU'");
	$unit = $db->queryItem("select nama from tbl_sbu where kode='$unit'");
	$namaDokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
	$now = $ro[0]['tgl_input_ro'];
	$bln1 = date('F', strtotime($tgl.' - 1 month'));
	$bln2 = date('F', strtotime($tgl.' - 2 month'));
	$bln3 = date('F', strtotime($tgl.' - 3 month'));
?>
<div align="left">
	<p style="text-align: left; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
		<img src="../../images/logo1.png" />
	</p>
	<p style="text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
		Permintaan Obat
	</p>
	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		Nomor Permintaan : <?php echo $ro[0]['no_ro']?><br />
		Tanggal Input : <?php echo date("d-m-Y", strtotime($ro[0]['tgl_input_ro']))?><br />
		Unit : <?php echo $unit?><br />
	</p>
	<table border="1" cellpadding="0" style="border-collapse: collapse" width="900" bordercolor="#000000">
	   <tr height="28">
			<td valign="middle" colspan="2">
				<div class="hastable box box-content nopadding" align="left" style="margin-left: 10px; margin-right: 10px; width: 100%">
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<thead> 
						<tr>
							<th style="text-align: center" rowspan="2">No</th> 
							<th style="text-align: center" rowspan="2">Nama Obat</th> 
							<th style="text-align: center" rowspan="2">Sat</th> 
							<th style="text-align: center" colspan="3">Bulan</th> 
							<th style="text-align: center" rowspan="2">Saldo<br />Akhir</th> 
							<th style="text-align: center" rowspan="2">Rata-Rata<br />Pemakaian</th> 
							<th style="text-align: center" rowspan="2">Jumlah<br />Pemesanan</th> 
							<th style="text-align: center" rowspan="2">Harga<br />Obat</th> 
							<th style="text-align: center" rowspan="2">Total</th> 
						</tr> 
						<tr>
							<th style="text-align: center"><?php echo $bln3?></th> 
							<th style="text-align: center"><?php echo $bln2?></th> 
							<th style="text-align: center"><?php echo $bln1?></th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							$totgigi = 0;
							$adm = $db->query("select * from tbl_ro_detail where no_ro='".$_GET['id']."' and status_delete='UD'");
							for ($i = 0; $i < count($adm); $i++) {
								$no = $i + 1;
								$total = $adm[$i]['qty'] * $adm[$i]['harga'];
						?>
						<tr>
							<td style="width: 15px; text-align: right"><?php echo $no?></td> 
							<td style="text-align: left"><?php echo $adm[$i]['nama_obat']?></td> 
							<td style="text-align: left"><?php echo $adm[$i]['sat']?></td> 
							<td style="text-align: right"><?php echo number_format($adm[$i]['bln3'])?></td> 
							<td style="text-align: right"><?php echo number_format($adm[$i]['bln2'])?></td> 
							<td style="text-align: right"><?php echo number_format($adm[$i]['bln1'])?></td> 
							<td style="text-align: right"><?php echo number_format($adm[$i]['stok_akhir'])?></td>
							<td style="text-align: right"><?php echo number_format($adm[$i]['rata'])?></td>
							<td style="text-align: right"><?php echo number_format($adm[$i]['qty'])?></td>
							<td style="text-align: right"><?php echo number_format($adm[$i]['harga'])?></td>
							<td style="text-align: right"><?php echo number_format($total)?></td>
						</tr> 
						<?php
								$total1 = $total1 + $adm[$i]['qty'];
								$total2 = $total2 + $adm[$i]['harga'];
								$total3 = $total3 + $total;
							}
						?>
						<tr>
							<td colspan="8" style="text-align: right; font-weight: bold; text-align: right">Grand Total</td>
							<td style="text-align: right; font-weight: bold"><?php echo number_format($total1)?></td>
							<td style="text-align: right; font-weight: bold"><?php echo number_format($total2)?></td>
							<td style="text-align: right; font-weight: bold"><?php echo number_format($total3)?></td>
						</tr> 
						</tbody>
					</table>
					<p align="left" style="margin-left: 5px; font-weight: bold"><?php echo $namaDokter?></p>
				</div>
			</td>
	   </tr>
	</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3">
			<p align="center" style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				<b>Mengetahui</b>
			</p>
		</td>
	</tr>
	<tr>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				&nbsp;
			</p>
		</td>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				KA.UNIT<br />
				MH.Thamrin Kalideres<br /><br /><br /><br />
				
				
				Dr.Hj.Siti Makiah
			</p>
		</td>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				BAGIAN PHARMACY<br />
				MH.Thamrin Kalideres<br /><br /><br /><br />
				
				
				<?php echo $ro[0]['input_by']?>
			</p>
		</td>
	</tr>
</table>
</div>
</body>
</html>
