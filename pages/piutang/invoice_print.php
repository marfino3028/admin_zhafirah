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
	
	$data = $db->query("select a.nama_perusahaan, a.id, b.alamat_perusahaan, a.tgl_kirim, a.tgl_jatuh_tempo, a.no_inv from tbl_invoice a left join tbl_perusahaan b on b.kode_perusahaan=a.kode_perusahaan where a.id='".$_GET['id']."'", 0);
?>
<div align="left">
	<p style="text-align: left; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
		<img src="../../images/logo1.png" />
	</p>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td>
	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
		<b>Kepada Yth:</b><br />
		<?php echo $data[0]['nama_perusahaan'].'<br>'.$data[0]['alamat_perusahaan'].', '.$data[0]['kota'].' '.$data[0]['kd_pos'].'<br>Telp/Fax: '.$data[0]['telp'].'/'.$data[0]['fax']?><br />
	</p>
		</td>
		
		<td width="250" valign="top">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr height="20">
				<td style="text-align: left; font-weight: bold">INVOICE</td>
			  </tr>
			  <tr>
				<td>
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
					  <tr height="20">
						<td width="95">Tanggal</td>
						<td width="5">&nbsp;</td>
						<td><?php echo date("d-m-Y", strtotime($data[0]['tgl_kirim']))?></td>
					  </tr>
					  <tr height="20">
						<td width="95">Jatuh Tempo</td>
						<td width="5">&nbsp;</td>
						<td><?php echo date("d-m-Y", strtotime($data[0]['tgl_jatuh_tempo']))?></td>
					  </tr>
					  <tr height="20">
						<td width="95">No. Invoice</td>
						<td width="5">&nbsp;</td>
						<td><?php echo $data[0]['no_inv']?></td>
					  </tr>
					</table>
				</td>
			  </tr>
			</table>
		</td>
	  </tr>
	</table>
	<table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
	   <tr height="28">
			<td valign="middle" colspan="2">
				<div class="hastable box box-content nopadding" align="left" style="margin-left: 10px; margin-right: 10px; width: 100%">
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<thead> 
						<tr>
							<th rowspan="2" style="text-align: center">No</th> 
							<th rowspan="2" style="text-align: center">TANGGAL<br />BEROBAT</th> 
							<th rowspan="2" style="text-align: center">NoMR</th> 
							<th rowspan="2" style="text-align: center">NAMA PASIEN</th> 
							<th rowspan="2" style="text-align: center">PT</th> 
							<th rowspan="2" style="text-align: center">DIAGNOSA</th> 
							<th colspan="8" style="text-align: center">BIAYA</th> 
							<th rowspan="2" style="text-align: center">TOTAL</th> 
						</tr>
						<tr>
							<th>ADM</th>
							<th>DOKTER</th>
							<th>P. GIGI</th>
							<th>TIND</th>
							<th>LAB</th>
							<th>FISIO</th>
							<th>RAD</th>
							<th>OBAT</th>
						</tr>
						</thead> 
						<tbody> 
						<?php
							$item = $db->query("select a.nomr, a.no_daftar, b.nama, d.no_resep, b.tgl_insert, e.kode_dokter, e.biayaAdmin, e.kd_poli, c.pekerjaan, d.diagnosa, b.no_kwitansi from tbl_invoice_detail a left join tbl_kasir b on b.no_daftar=a.no_daftar left join tbl_pasien c on c.nomr=a.nomr left join tbl_resep d on d.no_daftar=a.no_daftar left join tbl_pendaftaran e on e.no_daftar=a.no_daftar where a.invoiceID='".$data[0]['id']."' and c.status_delete='UD'", 0);
							for ($i =0; $i < count($item); $i++) {
								$no = $i + 1;
								$lab = $db->queryItem("select sum(bayar) as jml1 from tbl_kasir_detail where no_kwitansi='".$item[$i]['no_kwitansi']."' and payment_to='ASURANSI' and kategori='LAB'", 0);
								
								$rad = $db->queryItem("select sum(bayar) as jml1 from tbl_kasir_detail where no_kwitansi='".$item[$i]['no_kwitansi']."' and payment_to='ASURANSI' and kategori='RAD'", 0);
								$fis = $db->queryItem("select sum(bayar) as jml1 from tbl_kasir_detail where no_kwitansi='".$item[$i]['no_kwitansi']."' and payment_to='ASURANSI' and kategori='FIS'", 0);
								$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
								$obat = $db->queryItem("select sum(bayar) as jml1 from tbl_kasir_detail where no_kwitansi='".$item[$i]['no_kwitansi']."' and payment_to='ASURANSI' and kategori='PHARMACY'", 0);
								$tindakan = $db->queryItem("select sum(bayar) as jml1 from tbl_kasir_detail where no_kwitansi='".$item[$i]['no_kwitansi']."' and payment_to='ASURANSI' and kategori='TINDAKAN'");
								$adm = $db->queryItem("select sum(bayar) as jml1 from tbl_kasir_detail where no_kwitansi='".$item[$i]['no_kwitansi']."' and payment_to='ASURANSI' and kategori='ADMINISTRASI' and nomor='1'");
								$biayaDokter = $db->queryItem("select sum(bayar) as jml1 from tbl_kasir_detail where no_kwitansi='".$item[$i]['no_kwitansi']."' and payment_to='ASURANSI' and kategori='ADMINISTRASI' and nomor='2'");
								$gigi = $db->queryItem("select sum(bayar) as jml1 from tbl_kasir_detail where no_kwitansi='".$item[$i]['no_kwitansi']."' and payment_to='ASURANSI' and kategori='GIGI'");
								$total = $adm + $biayaDokter + $tindakan + $lab + $fis + $rad + $obat + $gigi;
						?>
						<tr>
							<td style="width: 15px; text-align: right"><?php echo $no?></td> 
							<td style="text-align: left"><?php echo date("d-m-Y", strtotime($item[$i]['tgl_insert']))?></td> 
							<td style="text-align: center"><?php echo $item[$i]['nomr']?></td>
							<td style="text-align: left"><?php echo $item[$i]['nama']?></td>
							<td style="text-align: right"><?php echo $item[$i]['pekerjaan']?></td>
							<td style="text-align: right"><?php echo $item[$i]['diagnosa']?></td>
							<td style="text-align: right"><?php echo number_format($adm)?></td>
							<td style="text-align: right"><?php echo number_format($biayaDokter)?></td>
							<td style="text-align: right"><?php echo number_format($gigi)?></td>
							<td style="text-align: right"><?php echo number_format($tindakan)?></td>
							<td style="text-align: right"><?php echo number_format($lab)?></td>
							<td style="text-align: right"><?php echo number_format($fis)?></td>
							<td style="text-align: right"><?php echo number_format($rad)?></td>
							<td style="text-align: right"><?php echo number_format($obat)?></td>
							<td style="text-align: right"><?php echo number_format($total)?></td>
						</tr> 
						<?php
							}
						?>
						</tbody>
					</table>
				</div>
			</td>
	   </tr>
	</table>
	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
		<b>Pembayaran Transfer Melalui Rekening :</b><br />
		Bank Mandiri Cab.Salemba Raya<br />
		A/C : 123.00.0217147.0               A/N Dr.Abdul Radjak, DSOG<br />
		<b>Mohon Ada Pemberitahuan Bukti Transfer Pembayaran melalui:</b><br />
		Email : klinikmhthamrin_kalideres@yahoo.co.id, Atau Fax:021-5456027<br />
		Pembayaran Di Lakukan Paling Lambat 1 Bulan Setelah Data Ini Di Terima.<br />
		Jika Pembayaran Tidak Dilakukan Sesuai Jangka Waktu Tersebut Di Atas Maka Pelayanan Akan Kami TUTUP.
	</p>
</div>
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
				Unit Pelayanan Kesehatan<br />
				MH.Thamrin Kalideres<br /><br /><br /><br />
				
				
				Dr.Hj.Siti Makiah
			</p>
		</td>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				Accounting<br />
				MH.Thamrin Kalideres<br /><br /><br /><br />
				
				
				Dr.Hj.Siti Makiah
			</p>
		</td>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				Admin Piutang<br />
				MH.Thamrin Kalideres<br /><br /><br /><br />
				
				
				Dr.Hj.Siti Makiah
			</p>
		</td>
	</tr>
</table>

	</body>
</html>
