<?php
	// Fungsi header dengan mengirimkan raw data excel
	header("Content-type: application/vnd-ms-excel");
	 
	// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=DaftarObat.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Pembayaran Pasien</title>
</head>

<body>
<?php
	
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";
	
?>
<p style="text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
	DAFTAR SELURUH OBAT
</p>
	<div class="hastable box box-content nopadding" align="center" style="margin-left: 10px; margin-right: 10px; width: 98%">
		
		<table id="table"> 
			<thead> 
			<tr>
				<th style="width:40px">No</th> 
				<th>Kode Obat</th> 
				<th>Nama Obat</th> 
				<th>Vendor</th> 
				<th>Suplier</th> 
				<th style="width:50px">Beli</th> 
				<th style="width:50px">Jual</th> 
				<th style="width:70px">Expired</th> 
			</tr> 
			</thead> 
			<tbody> 
			<?php
				$data = $db->query("select *, period_diff(date_format(expire_date, '%Y%m'), date_format(now(), '%Y%m')) as beda from tbl_obat where status_delete='UD' order by id", 0);
				for ($i = 0; $i < count($data); $i++) {
					$bedaB = $db->queryItem("select nilai from tbl_config where kode='EXOBAT'");
					if ($data[$i]['beda'] <= $bedaB) $warna = "#F99B9B";
					else $warna = "";
					$no = $start + $i + 1;
			?>
			<tr bgcolor="<?php echo $warna?>">
				<td style="text-align: center"><?php echo $no?></td> 
				<td><?php echo $data[$i]['kode_obat']?></td> 
				<td><?php echo $data[$i]['nama_obat']?></td> 
				<td><?php echo $data[$i]['vendor']?></td>
				<td><?php echo $data[$i]['suplier']?></td>
				<td style="text-align: right"><?php echo $data[$i]['harga_beli']?></td> 
				<td style="text-align: right"><?php echo $data[$i]['harga_jual']?></td> 
				<td style="text-align: right"><?php echo date("d-m-Y", strtotime($data[$i]['expire_date']))?></td> 
			</tr> 
			<?php
				}
			?>
			<tr>
				<td colspan="8">
					<?php echo $pagehtml?>
				</td>
			</tr>
			</tbody>
		</table>
	</div>

</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>