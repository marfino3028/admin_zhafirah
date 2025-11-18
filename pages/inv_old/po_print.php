<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print PO</title>
	<link href="../../style.css" rel="stylesheet" media="all" />
</head>

<body>
<?php
	
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";
	
	$po = $db->query("select * from tbl_po where no_po='".$_GET['id']."'");
	$ro = $db->query("select * from tbl_ro where no_ro='".$po[0]['no_ro']."'");
	$unit1 = $db->queryItem("select nilai from tbl_config where kode='SBU'");
	$unit = $db->queryItem("select nama from tbl_sbu where kode='$unit1'");
	$alamat_unit = $db->queryItem("select alamat from tbl_sbu where kode='$unit1'",0);
	$namaDokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
	$now = $ro[0]['tgl_input_ro'];
	$bln1 = date('F', strtotime($tgl.' - 1 month'));
	$bln2 = date('F', strtotime($tgl.' - 2 month'));
	$bln3 = date('F', strtotime($tgl.' - 3 month'));
	
	if ($po[0]['kode_vendor'] != '') {
		$alamat = $db->queryItem("select alamat_vendor from tbl_vendor where kode_vendor='".$po[0]['kode_vendor']."'");
	}
	else {
		$alamat = $db->queryItem("select alamat_suplier from tbl_suplier where kode_suplier='".$po[0]['kode_suplier']."'");
	}
?>
<div align="center">
	<p style="text-align: left; margin-bottom: 2px; height: 90px; border-bottom: 3px #000000 double; width: 850px">
		<label style="float:left"><img src="../../images/logo2.png" /></label>
		<label style="height: 88px; width: 750px; float: right; text-align: center; margin-top: 20px;">
			<span style="font-size: 18px; font-weight: bolder"><strong>YAYASAN RUMAH SAKIT MH THAMRIN</strong></span><br />
			<span style="font-size: 12px;">Jl. Salemba Tengah No. 24-28 Jakarta Pusat 10440</span><br />
			<span style="font-size: 12px;">Telp. 3904422 (Hunting) Fax. 2305182</span><br />
		</label>
	</p>
	<p align="left" style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px; width: 850px;">
		PO Number : <?php echo $po[0]['no_po']?><br />
		Company Name : <?php echo $po[0]['nama_vendor'].' / '.$po[0]['nama_suplier']?><br />
		Address : <?php echo $alamat?><br />
		Unit : <?php echo $unit?><br />
	</p>
	<table border="1" cellpadding="0" style="border-collapse: collapse" width="900" bordercolor="#000000">
	   <tr height="28">
			<td valign="middle" colspan="2">
				<div class="hastable box box-content nopadding" align="left" style="margin-left: 10px; margin-right: 10px; width: 100%">
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<thead> 
						<tr>
							<th style="text-align: center">No</th> 
							<th style="text-align: center">Nama Obat</th> 
							<th style="text-align: center">Satuan</th> 
							<th style="text-align: center">Qty PO</th> 
							<th style="text-align: center">Harga PO</th> 
							<th style="text-align: center">Total</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							$totgigi = 0;
							$adm = $db->query("select * from tbl_ro_detail where no_ro='".$po[0]['no_ro']."' and status_delete='UD'");
							for ($i = 0; $i < count($adm); $i++) {
								$no = $i + 1;
								$total = $adm[$i]['qty_po'] * $adm[$i]['harga_po'];
						?>
						<tr>
							<td style="width: 15px; text-align: right"><?php echo $no?></td> 
							<td style="text-align: left"><?php echo $adm[$i]['nama_obat']?></td> 
							<td style="text-align: left"><?php echo $adm[$i]['sat']?></td> 
							<td style="text-align: right"><?php echo number_format($adm[$i]['qty_po'])?></td>
							<td style="text-align: right"><?php echo number_format($adm[$i]['harga_po'])?></td>
							<td style="text-align: right"><?php echo number_format($total)?></td>
						</tr> 
						<?php
								$total1 = $total1 + $adm[$i]['qty_po'];
								$total2 = $total2 + $adm[$i]['harga_po'];
								$total3 = $total3 + $total;
							}
						?>
						<tr>
							<td colspan="3" style="text-align: right; font-weight: bold; text-align: right">Grand Total</td>
							<td style="text-align: right; font-weight: bold"><?php echo number_format($total1)?></td>
							<td style="text-align: right; font-weight: bold"><?php echo number_format($total2)?></td>
							<td style="text-align: right; font-weight: bold"><?php echo number_format($total3)?></td>
						</tr> 
						</tbody>
					</table>
					<p align="left" style="margin-left: 5px;">
						Barang yang dipesan diatas mohon dikirim ke <strong><?php echo $unit?></strong><br />
						Alamat 	: <?php echo $alamat_unit?><br />
						Setelah PO ini diterima
					</p>
					<p align="right" style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px; width: 850px;">
						<?php echo 'Jakarta, '.date("d F Y", strtotime($po[0]['tgl_input_po']))?>
					</p>
				</div>
			</td>
	   </tr>
	</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				Mengetahui<br /><br /><br /><br />
				
				
				<strong><u>Ir. Didi RS Adi, MBA</u></strong><br />
				Keuangan
			</p>
		</td>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				Apoteker<br /><br /><br /><br />
				
				
				<strong><u>Musiana, S.Si, Apt</u></strong><br />
				Sik/Sip.Kp 01.01.1.2.00583
			</p>
		</td>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				Bagian Pembelian<br /><br /><br /><br />
				
				
				<strong><u>Ai Susilawati</u></strong><br />
				Bagian Pembelian
			</p>
			</p>
		</td>
	</tr>
</table>
</div>
</body>
</html>
