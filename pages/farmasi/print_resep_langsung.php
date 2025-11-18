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
	session_start();
	
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
	
	$update_status = $db->query("update tbl_penjualan_obat set status_kwitansi='CLOSED' where no_penjualan='".$_GET['id']."'", 0);
	$data = $db->query("select * from tbl_penjualan_obat where no_penjualan='".$_GET['id']."'");
	$_POST['id'] = $kasir[0]['no_daftar'];
	$tst = explode("-", $_POST['id']);
	
	$cek = $db->queryItem("select id from tbl_jurnal_otm where no_kwitansi='".$_GET['id']."'");
	if ($cek < 1) {
		$deskripsi = $data[0]['nama'].' / '.$data[0]['no_penjualan'].' / JAMINAN PRIBADI';
		$coa = $db->query("select kd_coa, nm_coa from tbl_coa where id='1'", 0);
		$coa2 = $db->query("select kd_coa, nm_coa from tbl_coa where id='93'", 0);
		
		$nomor = $db->queryItem("select max(nomor_bukti) from tbl_jurnal_otm where kode_bukti='KK' and year(tanggal_transaksi)='".date("Y")."' and month(tanggal_transaksi)='".date("m")."'");
		$no = $nomor + 1;
		
		if ($no < 10) $nom = '00'.$no;
		elseif ($no < 100 and $no >= 10) $nom = '0'.$no;
		if ($no < 1000 and $no >= 100) $nom = $no;
		
		$no_bukti = 'KK/'.date("m").'/'.date("y").'/'.$nom;
		$admnr = $db->queryItem("select total_harga from tbl_penjualan_obat where no_penjualan='".$_GET['id']."'", 0);
		$insert = $db->query("insert into tbl_jurnal_otm (no_kwitansi, tanggal_transaksi, no_jurnal, deskripsi, kode, jenis_kode, kode_inv, jenis_kode_inv, nilai, kode_bukti, nomor_bukti) values ('".$data[0]['no_penjualan']."', '".date("Y-m-d")."', '$no_bukti', '$deskripsi', '".$coa[0]['kd_coa']."', 'D', '".$coa2[0]['kd_coa']."', 'K', '$admnr', 'KK', '$no')");
	}
	
?>
<div align="left">
	<p style="text-align: left; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
		<div style="width: 280px; float: right"><img src="../../images/logo1.png" /></div>
		<div style="width: 500px; float: left; margin-left: 12px; font-weight: bold">KWITANSI PEMBAYARAN PASIEN<br />No : <?php echo $data[0]['no_penjualan']?></div>
	</p>
	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		Tanggal Kwitansi : <?php echo $data[0]['tgl_insert']?><br />
		Nama Pasien : <?php echo $data[0]['nama']?><br />
		No. Telp Pasien : <?php echo $data[0]['telp']?><br />
	</p>
	<table border="1" cellpadding="0" style="border-collapse: collapse" width="98%" bordercolor="#000000">
	   <tr height="28">
			<td valign="middle" colspan="2">
				<div class="hastable box box-content nopadding" align="left" style="margin-left: 0; margin-right: 0; width: 100%; margin-top: 0px;">
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<thead> 
						<tr>
							<th colspan="4" style="text-align: left">Perincian</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							$biayaAdmin = 0;
							$adm = $db->query("select * from tbl_penjualan_obat_detail where no_penjualan='".$_GET['id']."' and jenis='NR' and status_delete='UD'", 0);
							for ($i = 0; $i < count($adm); $i++) {
						?>
						<tr>
							<td style="width: 15px; text-align: right; font-size: 10px;">-</td> 
							<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama_obat']?></td> 
							<td style="text-align: right; width: 75px; font-size: 10px;"><?php echo number_format($adm[$i]['qty'])?></td>
							<td style="text-align: right; width: 75px; font-size: 10px;"><?php echo number_format($adm[$i]['total'])?></td>
						</tr> 
						<?php
								$biayaAdmin = $biayaAdmin + $adm[$i]['total'];
							}
							$rcknnr = $db->queryItem("select count(id) from tbl_penjualan_obat_detail where no_penjualan='".$_GET['id']."' and jenis='R' and status_delete='UD'", 0);
							if ($rcknnr > 0) {
								$adm = $db->query("select * from tbl_penjualan_obat_racikan where no_penjualan='".$_GET['id']."' and status_delete='UD'", 0);
								for ($i = 0; $i < count($adm); $i++) {
									$jml = $db->queryItem("select sum(total) from tbl_penjualan_obat_detail where racikan_id='".$adm[$i]['id']."' and status_delete='UD'");
									$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN'", 0);
									$jml = $jml + $embalase;
						?>
						<tr>
							<td style="width: 15px; text-align: right; font-size: 10px;">-</td> 
							<td style="text-align: left; font-size: 10px;"><?php echo $adm[$i]['nama']?></td> 
							<td style="text-align: right; width: 75px; font-size: 10px;">1</td>
							<td style="text-align: right; width: 75px; font-size: 10px;"><?php echo number_format($jml)?></td>
						</tr> 
						<?php		
								$biayaAdmin = $biayaAdmin + $jml;
								}
							}

						?>
						</tbody>
					</table>
					<?php	
						$total = $biayaAdmin + $totFarm + $totLab + $totRad + $totFis + $totgigi + $totTdk + $totAlkes + $totobygn + $totBedah;
						
						$total_bayar = $total - $kasir[0]['diskon'];
					?>
					<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Biaya</th> 
							<th style="text-align: right; font-size: 10px;; width: 75px;"><?php echo number_format($total)?></th>
						</tr>
						<tr>
							<th colspan="2" style="text-align: right; margin-right: 5px; font-size: 10px;">Total Pembayaran</th> 
							<th style="text-align: right; font-size: 10px;; width: 75px;"><?php echo number_format($total_bayar)?></th>
						</tr>
						<tr>
							<th colspan="3" style="text-align: left; font-size: 10px;; margin-left: 15px">Terbilang : "<?php echo ucwords(Terbilang($total_bayar)).' Rupiah'?>"</th>
						</tr>
					</table>					
					<div style="float: right; width: 200px; text-align:center">
						<p style="margin-bottom: 9px; font-size: 10px;">Jakarta, <?php echo date("d F Y", strtotime($data[0]['tgl_insert']))?></p>
						<p style="margin-top: 9px; font-size: 10px;"><?php echo $_SESSION['rg_nama'];?></p>
					</div>
				</div>
			</td>
	   </tr>
	</table>
</div>
</body>
</html>
