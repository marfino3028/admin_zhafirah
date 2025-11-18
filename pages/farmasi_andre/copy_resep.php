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
	
	$kasir = $db->query("select * from tbl_resep where no_resep='".$_GET['id']."'");
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
		Copy Resep
	</p>
	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		Nomor Resep : <?php echo $kasir[0]['no_resep']?><br />
		Tanggal Berobat : <?php echo date("d-m-Y", strtotime($kasir[0]['tgl_insert']))?><br />
		NoMR : <?php echo $data1[0]['nomr']?><br />
		Nama Pasien : <?php echo $data1[0]['nm_pasien']?><br />
		Penjamin Pasien : <?php echo $data1[0]['nama_perusahaan']?>
	</p>
	<table border="1" cellpadding="0" style="border-collapse: collapse" width="500" bordercolor="#000000">
	   <tr height="28">
			<td valign="middle" colspan="2">
				<div class="hastable box box-content nopadding" align="left" style="margin-left: 10px; margin-right: 10px; width: 100%">
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
						<thead> 
						<tr>
							<th style="text-align: center">No</th> 
							<th style="text-align: center">Nama Obat</th> 
							<th style="text-align: center">Qty</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							$totgigi = 0;
							$adm = $db->query("select * from tbl_resep_detail where no_resep='".$_GET['id']."' and status_delete='UD'");
							for ($i = 0; $i < count($adm); $i++) {
								$no = $i + 1;
						?>
						<tr>
							<td style="width: 15px; text-align: right"><?php echo $no?></td> 
							<td style="text-align: left"><?php echo $adm[$i]['nama_obat']?></td> 
							<td style="text-align: right"><?php echo number_format($adm[$i]['qty'])?></td>
						</tr> 
						<?php
							}
						?>
						</tbody>
					</table>
					<p align="left" style="margin-left: 5px; font-weight: bold"><?php echo $namaDokter?></p>
				</div>
			</td>
	   </tr>
	</table>
</div>
</body>
</html>
