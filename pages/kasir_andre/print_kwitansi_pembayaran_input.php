<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Kwitansi Pembayaran Asuransi</title>
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
<div style="width: 100%;"><img src="../../images/logo1.png" /></div>
		<div style="width: 95%; margin-left: 12px; font-weight: bold; margin-top: 22px; text-align: right">KWITANSI NO : <?php echo $kasir[0]['no_kwitansi']?></div>
	</p>
	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		Tanggal Kwitansi : <?php echo $kasir[0]['tgl_insert']?><br />
		NoMR / Nama Pasien : <?php echo $data1[0]['nomr'].' / '.$data1[0]['nm_pasien']?><br />
		Penjamin Pasien : <?php echo $data1[0]['nama_perusahaan']?>
	</p>
	<form method="post" enctype="multipart/form-data" action="print_kwitansi_pembayaran_insert.php" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
	<table border="1" cellpadding="0" style="border-collapse: collapse" width="98%" bordercolor="#000000">
	   <tr height="28">
			<td valign="middle" colspan="2">
				<div class="hastable box box-content nopadding" align="left" style="margin-left: 0; margin-right: 0; width: 100%; margin-top: 0px;">
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<thead> 
						<tr>
							<th colspan="3" style="text-align: left">SUDAH TERIMA DARI</th> 
						</tr> 
						</thead> 
						<tbody> 
							<tr>
								<td style="text-align: left; font-size: 10px;">
									<input type="text" id="terima" name="terima" class="form-control" value="<?php echo $kasir[0]['penjamin']?>" style="width: 99%;"/>
								</td> 
							</tr> 
						</tbody>
					</table>
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<thead> 
						<tr>
							<th colspan="3" style="text-align: left">UNTUK PEMBAYARAN</th> 
						</tr> 
						</thead> 
						<tbody> 
							<tr>
								<td style="text-align: left; font-size: 10px;">
									<textarea id="untuk" name="untuk" rows="3" style="width: 100%; border: #CCCCCC ridge 1px;;"><?php echo $kasir[0]['untuk_pembayaran']?></textarea>
								</td> 
							</tr> 
							<tr>
								<th style="text-align: center; font-size: 10px;">
									<input type="hidden" name="id" id="id" value="<?php echo $_GET['id']?>" />
									<input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded"  value="Lanjutkan Ke Kwitansi Pembayaran" onclick="simpanData(this.form, 'pages/kasir/print_kwitansi_pembayaran_insert.php')" />
								</th>
							</tr> 
						</tbody>
					</table>
				</div>
			</td>
	   </tr>
	</table>
	</form>
</div>
</body>
</html>
