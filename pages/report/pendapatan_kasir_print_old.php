<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Pendapatan Labn</title>
	<link href="../../style.css" rel="stylesheet" media="all" />
</head>

<body>

	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		Laporan Pendapatan Kasir<br />
		Periode : <?php echo $_GET['d1'].' s/d '.$_GET['d2']?><br />
		Metode Pembayaran : <?php echo $_GET['m']?><br />
	</p>

    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th style="width:20px">NO</th> 
							<th style="width:70px">NO.MR</th> 
							<th style="width:70px">NO.FR</th> 
							<th style="width:70px">NO.DAFTAR</th> 
							<th>NAMA</th> 
							<th>JAMINAN</th> 
							<th>NAMA DOKTER</th> 
							<th>POLI</th> 
							<th style="width:100px">METODE BAYAR</th> 
							<th style="width:120px">TOTAL PEMBAYARAN</th> 
							<th style="width:50px">SHIFT</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							include "../../3rdparty/engine.php";
							ini_set("display_errors", 0);
							session_start();
							$t1 = explode("/", $_GET['d1']);
							$t2 = explode("/", $_GET['d2']);
							//Nilai Tutup Pendapatan Harian
							$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
							$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
							//$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;
							if ($_GET['su'] == 'ALL' and $_GET['m'] != 'ALL') {
								$data = $db->query("select a.* from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.metode_payment='".$_GET['m']."' order by a.tgl_insert desc", 0);
							}
							elseif ($_GET['m'] == 'ALL' and $_GET['su'] != 'ALL') {
								$data = $db->query("select a.* from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.user_shift='".$_GET['su']."' order by a.tgl_insert desc", 0);
							}
							elseif ($_GET['m'] == 'ALL' and $_GET['su'] == 'ALL') {
								$data = $db->query("select a.* from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' order by a.user_shift", 0);
							}
							else {
								$data = $db->query("select a.* from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.user_shift='".$_GET['su']."' and a.metode_payment='".$_GET['m']."' order by a.tgl_insert desc", 0);
							}
							//$dokter = $db->query("select * from tbl_dokter where kode_dokter='".$_GET['dokter']."'");
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								if ($data[$i]['nama_perusahaan'] == 'JAMSOSTEK') {
									$dokter = $db->queryItem("select b.nama_dokter from tbl_pendaftaran_jamsostek a left join tbl_dokter b on b.kode_dokter=a.kode_dokter where concat('JAM-', a.no_daftar)='".$data[$i]['no_daftar']."'", 0);
									$poli = $db->queryItem("select b.nama_poli from tbl_pendaftaran_jamsostek a left join tbl_poli b on b.kd_poli=a.kd_poli where concat('JAM-', a.no_daftar)='".$data[$i]['no_daftar']."'", 0);
									$pasien = $db->query("select * from tbl_pasien_jamsostek where nomr='".$data[$i]['nomr']."'");
								}
								else {
									$dokter = $db->queryItem("select b.nama_dokter from tbl_pendaftaran a left join tbl_dokter b on b.kode_dokter=a.kode_dokter where a.no_daftar='".$data[$i]['no_daftar']."'", 0);
									$poli = $db->queryItem("select b.nama_poli from tbl_pendaftaran a left join tbl_poli b on b.kd_poli=a.kd_poli where a.no_daftar='".$data[$i]['no_daftar']."'", 0);
									$pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
									if ($poli == '') {
										$data[$i]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[$i]['no_daftar']."'");
										$data[$i]['nama_perusahaan'] = 'JAMINAN PRIBADI';
										$poli = 'SKS';
										$pasien[0]['nm_pasien'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[$i]['nomr']."'", 0);
									}

									if ($dokter == "") {
										$data[$i]['nama_perusahaan'] = $db->queryItem("select nama_perusahaan from tbl_pendaftaran where no_daftar='".$data[$i]['no_daftar']."'");
										$data[$i]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[$i]['no_daftar']."'");
										$poli = $db->queryItem("select kd_poli from tbl_pendaftaran where no_daftar='".$data[$i]['no_daftar']."'");
										$pasien[0]['nm_pasien'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[$i]['nomr']."'", 0);
										if ($poli == 'FIS') $dokter = 'FISIOTERAPI';
										elseif ($poli == 'LAB') $dokter = 'LABORATORIUM';
										elseif ($poli == 'RAD') $dokter = 'RADIOLOGI';
									}
								}
								//$plusBiaya = $db->queryItem("select c.tarif from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
								$data[$i]['total'] = $data[$i]['total'] + $plusBiaya;
								$data[$i]['pasien'] = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$data[$i]['no_kwitansi']."' and payment_to='PASIEN'");
								$data[$i]['ass'] = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$data[$i]['no_kwitansi']."' and payment_to='ASURANSI'");
								//echo $_GET['m'];
								if ($_GET['m'] == 'ALL') {
									if (($data[$i]['pasien'] > 0) and ($data[$i]['ass'] > 0)) {
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['nofr']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $pasien[0]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td><?php echo $dokter?></td>
							<td><?php echo $poli?></td>
							<td style="text-align: right;">ASS</td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['ass'])?></td> 
							<td style="text-align: right;"><?php echo $data[$i]['user_insert'].'/'.$data[$i]['user_shift']?></td> 
						</tr> 
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['nofr']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $pasien[0]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td><?php echo $dokter?></td>
							<td><?php echo $poli?></td>
							<td style="text-align: right;">PASIEN</td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['pasien'])?></td> 
							<td style="text-align: right;"><?php echo $data[$i]['user_insert'].'/'.$data[$i]['user_shift']?></td> 
						</tr> 
						<?php
									}
									else {
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['nofr']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $pasien[0]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td><?php echo $dokter?></td>
							<td><?php echo $poli?></td>
							<td style="text-align: right;"><?php echo $data[$i]['metode_payment']?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['total'])?></td> 
							<td style="text-align: right;"><?php echo $data[$i]['user_insert'].'/'.$data[$i]['user_shift']?></td> 
						</tr> 
						<?php
									}
								}
								else {
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['nofr']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $pasien[0]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td><?php echo $dokter?></td>
							<td><?php echo $poli?></td>
							<td style="text-align: right;"><?php echo $data[$i]['metode_payment']?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['total'])?></td> 
							<td style="text-align: right;"><?php echo $data[$i]['user_insert'].'/'.$data[$i]['user_shift']?></td> 
						</tr> 
						<?php
								}
								$ttlSum = $ttlSum + $data[$i]['total'];
							}
							if ($_GET['m'] != 'ASS' and $_GET['m'] != 'ALL') {
								$_GET['mADD'] = 'ASS';
								if ($_GET['su'] == 'ALL' and $_GET['m'] != 'ALL') {
									$data = $db->query("select a.* from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.metode_payment='".$_GET['mADD']."' order by a.tgl_insert desc", 0);
								}
								elseif ($_GET['m'] == 'ALL' and $_GET['su'] != 'ALL') {
									$data = $db->query("select a.* from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.user_shift='".$_GET['su']."' order by a.tgl_insert desc", 0);
								}
								for ($i = 0; $i < count($data); $i++) {
									$data[$i]['nama_perusahaan'] = $db->queryItem("select nama_perusahaan from tbl_pendaftaran where no_daftar='".$data[$i]['no_daftar']."'");
									$data[$i]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[$i]['no_daftar']."'");
									$poli = $db->queryItem("select kd_poli from tbl_pendaftaran where no_daftar='".$data[$i]['no_daftar']."'");
									$pasien[0]['nm_pasien'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[$i]['nomr']."'", 0);
									if ($poli == 'FIS') $dokter = 'FISIOTERAPI';
									elseif ($poli == 'LAB') $dokter = 'LABORATORIUM';
									elseif ($poli == 'RAD') $dokter = 'RADIOLOGI';

									//$plusBiaya = $db->queryItem("select c.tarif from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
									$data[$i]['total'] = $data[$i]['total'] + $plusBiaya;
									$data[$i]['pasien'] = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$data[$i]['no_kwitansi']."' and payment_to='PASIEN'");
									$data[$i]['ass'] = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$data[$i]['no_kwitansi']."' and payment_to='ASURANSI'");
									if ($data[$i]['pasien'] > 0 and $data[$i]['ass'] > 0) {
										$no = $no + 1;
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['nofr']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $pasien[0]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td><?php echo $dokter?></td>
							<td><?php echo $poli?></td>
							<td style="text-align: right;">PASIEN</td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['pasien'])?></td> 
							<td style="text-align: right;"><?php echo $data[$i]['user_insert'].'/'.$data[$i]['user_shift']?></td> 
						</tr> 
						<?php
										$ttlSum = $ttlSum + $data[$i]['pasien'];
									}
								}
							}
							//Data dari penjualan obat langsung
							$data_lgs = $db->query("select * from tbl_penjualan_obat where tgl_insert >= '$date1' and tgl_insert < '$date2' and status_kwitansi='CLOSED' and status_delete='UD'");
							for ($d = 0; $d < count($data_lgs); $d++) {
								$no = $d + $no + 1;
								$totalRacikan = $db->queryItem("select sum(total) from tbl_penjualan_obat_detail where jenis='R' and status_delete='UD' and penjualan_id='".$data_lgs[$d]['id']."'", 0);
								$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'", 0);
								if ($totalRacikan > 0) $total_jual = $data_lgs[$d]['total_harga'] + $totalRacikan + $embalase;
								else  $total_jual = $data_lgs[$d]['total_harga'] + $totalRacikan;
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td colspan="2"><?php echo $data_lgs[$d]['no_penjualan']?></td> 
							<td><?php echo $data[$i]['nofr']?></td> 
							<td><?php echo $data_lgs[$d]['nama']?></td>
							<td>JAMINAN PRIBADI</td>
							<td>-</td>
							<td>OBAT LANGSUNG</td>
							<td style="text-align: right;">CASH</td> 
							<td style="text-align: right;"><?php echo number_format($total_jual)?></td> 
							<td style="text-align: right;"><?php echo $_SESSION['rg_nama']?></td> 
						</tr> 
						<?php	
								$ttlSum = $ttlSum + $total_jual;
							}

							//Data dari POLKAR
							$data_pkr = $db->query("select * from tbl_polkar where tgl_insert >= '$date1' and tgl_insert < '$date2' and status_delete='UD'", 0);
							for ($dd = 0; $dd < count($data_pkr); $dd++) {
								$no = $no + 1;
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td colspan="2"><?php echo $data_pkr[$dd]['no_polkar']?></td> 
							<td><?php echo $data_pkr[$dd]['nomr']?></td> 
							<td><?php echo $data_pkr[$dd]['nama']?></td>
							<td>JAMINAN PRIBADI</td>
							<td>-</td>
							<td>POLKAR</td>
							<td style="text-align: right;">CASH</td> 
							<td style="text-align: right;"><?php echo number_format($data_pkr[$dd]['total_harga_polkar'])?></td> 
							<td style="text-align: right;"><?php echo $_SESSION['rg_nama']?></td> 
						</tr> 
						<?php		
								$ttlSum = $ttlSum + $data_pkr[$dd]['total_harga_polkar'];
							}

							if ($ttlSum > 0) {
								$totJasa = $ttlSum + $biayaJaga;
								$pajak = $totJasa * 50/100;
								//$cash = $db->queryItem("select count(id) from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.kode_perusahaan='PPP031'", 0);
								//$asuransi = $db->queryItem("select count(id) from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2 and a.kode_perusahaan <> 'PPP031' and a.kode_perusahaan <> 'JJJ030'", 0);
								//$jamsostek = $db->queryItem("select count(id) from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2 and a.kode_perusahaan='JJJ030'", 0);

							$cash = $db->queryItem("select count(id) from tbl_kasir a where a.tgl_insert >= '$date1' and date(a.tgl_insert) < '$date2' and a.kode_perusahaan='PPP031'", 0);
							$asuransi = $db->queryItem("select count(id) from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.kode_perusahaan <> 'PPP031' and a.kode_perusahaan <> 'JJJ030' and a.nomr <> ''", 0);
							$jamsostek = $db->queryItem("select count(id) from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.kode_perusahaan='JJJ030'", 0);

							$cash1 = $db->queryItem("select count(id) from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.nomr = '' and a.metode_payment='CASH'", 0);
							$asuransi1 = $db->queryItem("select count(id) from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.nomr = '' and a.metode_payment='ASS'", 0);
							$jamsostek1 = $db->queryItem("select count(id) from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.nomr = '' and a.metode_payment='JAMSOSTEK'", 0);
							$cash = $cash + $cash1;
							$asuransi = $asuransi + $asuransi1;
							$jamsostek = $jamsostek + $jamsostek1;
						?>
						<tr>
							<th colspan="9" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th style="text-align: right; font-weight: bold" colspan="2">
								<?php echo number_format($ttlSum)?>
							</th>
						</tr>
						<tr>
							<th colspan="9" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN CASH
							</th>
							<th style="text-align: right; font-weight: bold" colspan="2">
								<?php echo number_format($cash)?>
							</th>
						</tr>
						<tr>
							<th colspan="9" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN ASURANSI
							</th>
							<th style="text-align: right; font-weight: bold" colspan="2">
								<?php echo number_format($asuransi)?>
							</th>
						</tr>
						<tr>
							<th colspan="9" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN JAMSOSTEK
							</th>
							<th style="text-align: right; font-weight: bold" colspan="2">
								<?php echo number_format($jamsostek)?>
							</th>
						</tr>
						<?php	
							}
						?>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
<script>
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>

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
