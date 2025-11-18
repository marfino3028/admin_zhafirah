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
	
	$ro = $db->query("select * from tbl_ro_to_gudang where no_ro_gudang='".$_GET['id']."'", 0);
	$unit = $db->queryItem("select nilai from tbl_config where kode='SBU'");
	$unit = $db->queryItem("select nama from tbl_sbu where kode='$unit'");
	$namaDokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
	$now = $ro[0]['tgl_input_ro'];
	
	//update untuk status move
	$tgl_mutasi = date("Y-m-d");
	$update = $db->query("update tbl_ro_to_gudang set status_move='M', tgl_mutasi='$tgl_mutasi' where no_ro_gudang='".$_GET['id']."'");
?>

<div align="left">
	<!--<p style="text-align: left; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
		<img src="../../images/logo1.png" />
	</p>-->
	<p style="text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
		DETAIL REQUEST OBAT DARI APOTIK KE GUDANG<br />
	</p>
	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		No. Request : <?php echo $ro[0]['no_ro_gudang']?><br />
		Tanggal Request : <?php echo date("d-m-Y", strtotime($ro[0]['tgl_input_ro_gudang']))?><br />
	</p>
	<table border="1" cellpadding="0" style="border-collapse: collapse" width="900" bordercolor="#000000">
	   <tr height="28">
			<td valign="middle" colspan="2">
				<div class="hastable box box-content nopadding" align="left" style="margin-left: 10px; margin-right: 10px; width: 100%">
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<thead> 
						<tr>
							<th style="text-align: center">No</th> 
							<th style="text-align: center">Item</th> 
							<th style="text-align: center; width: 150px;">Jumlah Permintaan</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							$totgigi = 0;
							$adm = $db->query("select * from tbl_ro_to_gudang_detail where no_ro_gudang='".$_GET['id']."' and status_delete='UD'");
							for ($i = 0; $i < count($adm); $i++) {
								$no = $i + 1;
								$total = $adm[$i]['qty'] * $adm[$i]['harga'];
						?>
						<tr>
							<td style="width: 15px; text-align: right"><?php echo $no?></td> 
							<td style="text-align: left"><?php echo $adm[$i]['nama_obat']?></td> 
							<td style="text-align: right"><?php echo number_format($adm[$i]['qty'])?></td>
						</tr> 
						<?php
								$total1 = $total1 + $adm[$i]['qty'];
								$total2 = $total2 + $adm[$i]['harga'];
								$total3 = $total3 + $total;
							}
						?>
						<tr>
							<td colspan="2" style="text-align: right; font-weight: bold; text-align: right">Total Jumlah</td>
							<td style="text-align: right; font-weight: bold"><?php echo number_format($total1)?></td>
						</tr> 
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
