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
	$tst = explode("-", $_POST['id']);
	if ($tst[0] == 'JAM') {
		$data1 = $db->query("select a.nomr, b.nm_pasien, a.kode_dokter, a.nama_perusahaan, 0 as biayaAdmin, c.nama_poli, c.tarif from tbl_pendaftaran_jamsostek a left join tbl_pasien_jamsostek b on b.id=a.idNomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$tst[1]."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
	}
	else {
		$data1 = $db->query("select a.nomr, b.nm_pasien, a.kode_dokter, a.nama_perusahaan, a.biayaAdmin, if (c.nama_poli is NULL, a.kd_poli, c.nama_poli) as nama_poli, c.tarif from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$_POST['id']."' and a.status_delete='UD'", 0);
	}
?>
<div align="left">
	<p style="text-align: left; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
<div style="width: 100%;"><img src="../../images/logo1.png" /></div>
		<div style="width: 95%; margin-left: 12px; font-weight: bold; margin-top: 22px; text-align: right; font-size: 20px;">KWITANSI NO : <?php echo $kasir[0]['no_kwitansi']?></div>
	</p>
	<table border="0" cellpadding="0" style="border-collapse: collapse" width="98%" bordercolor="#000000">
	   <tr height="28">
			<td valign="middle" colspan="2">
				<div class="hastable box box-content nopadding" align="left" style="margin-left: 0; margin-right: 0; width: 100%; margin-top: 0px;">
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<tbody> 
							<tr>
								<td style="text-align: left; font-size: 15px; border: 0px; width: 170px;">
									Nomor MR
								</td> 
								<td style="text-align: left; font-size: 15px; border: 0px; width: 10px;">:</td> 
								<td style="text-align: left; font-size: 15px; border: 0px;">
									<?php echo $data1[0]['nomr'].' / '.$data1[0]['nm_pasien']?>
								</td> 
							</tr> 
							<tr>
								<td style="text-align: left; font-size: 15px; border: 0px; width: 170px;">
									Sudah Terima dari
								</td> 
								<td style="text-align: left; font-size: 15px; border: 0px; width: 10px;">:</td> 
								<td style="text-align: left; font-size: 15px; border: 0px;">
									<?php echo $kasir[0]['penjamin']?>
								</td> 
							</tr> 
							<tr>
								<td style="text-align: left; font-size: 15px; border: 0px; width: 170px;">
									Terbilang
								</td> 
								<td style="text-align: left; font-size: 15px; border: 0px; width: 10px;">:</td> 
								<td style="text-align: left; font-size: 15px; border: 0px;">
									<?php echo Terbilang($kasir[0]['total']+$kasir[0]['jml_pembulatan'])?>
								</td> 
							</tr> 
							<tr>
								<td style="text-align: left; font-size: 15px; border: 0px; width: 170px;">
									Untuk Pembayaran
								</td> 
								<td style="text-align: left; font-size: 15px; border: 0px; width: 10px;">:</td> 
								<td style="text-align: left; font-size: 15px; border: 0px;">
									<?php echo $kasir[0]['untuk_pembayaran']?>
								</td> 
							</tr> 
							<tr>
								<td style="text-align: left; font-size: 15px; border: 0px; width: 170px;">
									Jumlah
								</td> 
								<td style="text-align: left; font-size: 15px; border: 0px; width: 10px;">:</td> 
								<td style="text-align: left; font-size: 15px; border: 0px;">
									<b>Rp. <?php echo number_format($kasir[0]['total']+$kasir[0]['jml_pembulatan'], 0)?></b>
								</td> 
							</tr> 
						</tbody>
					</table>
					<div style="float: right; width: 200px; text-align:center; margin-right: 50px;">
						<p style="margin-bottom: 9px; font-size: 15px;">Jakarta, <?php echo date("d F Y", strtotime($kasir[0]['tgl_insert']))?></p>
						<p style="margin-top: 9px; font-size: 15px;">(<?php echo $kasir[0]['user_insert']?>)</p>
					</div>
				</div>
			</td>
	   </tr>
	</table>
</div>
</body>
</html>
