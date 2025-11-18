<?php
	// Fungsi header dengan mengirimkan raw data excel
	header("Content-type: application/vnd-ms-excel");
	 
	// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=Outstanding".date("YmdHis").".xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Outstanding</title>
</head>

<body>
<?php
	
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";
	
?>

	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		Laporan Oustanding Pasien<br />
		Periode : <?php echo date("d F Y", strtotime($_GET['d1'])).' s/d '.date("d F Y", strtotime($_GET['d2']))?><br />
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
							<th style="width:70px">TGL</th> 
							<th style="width:70px">NO.MR</th> 
							<th style="width:70px">NO.DAFTAR</th> 
							<th>NAMA</th> 
							<th>JAMINAN</th> 
							<th style="width:120px">TOTAL TRANSAKSI</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php

							//Nilai Tutup Pendapatan Harian
							$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
							$date1 = $_GET['d1'].' '.$tutup_waktu;
							$date2 = $_GET['d2'].' '.$tutup_waktu;

							//$data = $db->query("select * from tbl_fisio where tgl_insert >= '$date1' and tgl_insert < '$date2' and status_delete='UD'", 0);
							//$data = $db->query("select a.*, c.nama_perusahaan, b.metode_payment as metode_pembayaran, b.kode_perusahaan as kodeNya from tbl_rawat a left join tbl_kasir b on b.no_daftar=a.no_daftar left join tbl_pendaftaran c on c.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' order by c.nama_perusahaan", 0);
							$data = $db->query("select a.nomr, a.kode_dokter, a.id, a.status_pasien, a.nama_perusahaan, a.biayaAdmin, a.kd_poli, a.yang_berobat, a.no_daftar, a.tgl_daftar, c.tarif, c.nama_poli, c.kd_poli from tbl_pendaftaran a left join tbl_poli c on c.kd_poli=a.kd_poli where a.status_delete='UD' and a.tgl_daftar >= '$date1' and a.tgl_daftar <= '$date2' and a.status_pasien='OPEN' order by a.id desc", 1);
							//$dokter = $db->query("select * from tbl_dokter where kode_dokter='".$data['dokter']."'");
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$data[$i]['nomr']."'");
                        		if ($data[$i]['nama_poli'] == 'POLI BEDAH') {
                        			$biayaDokter = 0;
                        		}
                        		else {
                                	$biayaDokter = $db->queryItem("select tarif_dokter from tbl_dokter where kode_dokter='".$data[$i]['kode_dokter']."'");
                        			$biayaDokter = $biayaDokter + $data[$i]['tarif'];
                        		}
                            	$biayaAdmin = $biayaDokter + $data[$i]['biayaAdmin'];
                            	
                            	if ($data1[0]['kd_poli'] == 'P002') {
									$adminGigi = $db->queryItem("select nilai from tbl_config where tahun='".date("Y")."' and kode='ADMG'");
									$biayaAdmin = $biayaAdmin + $adminGigi;
                            	}
                            	
                            	$farm = $db->query("select sum(a.total) jumlah from tbl_resep_detail a  left join tbl_resep b on b.no_resep=a.no_resep where b.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                            	$no_resep_farmasi = $db->queryItem("select a.no_resep from tbl_resep a where a.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD'", 0);
                            	$farm2 = $db->query("select sum(total) as jumlah from tbl_racikan_detail a  left join tbl_racikan b on b.id=a.racikanId where b.no_resep='".$no_resep_farmasi."' and a.status_delete='UD' and b.status_delete='UD' group by racikanId", 0);
                            	$dAlkes = $db->query("select sum(tarif) jumlah from tbl_alkes where no_daftar='".$data[$i]['no_daftar']."' and nomr= '".$data[$i]['nomr']."' and status_delete='UD'", 0);
                            	$dTindakan = $db->query("select sum(tarif) jumlah from tbl_tindakan where no_daftar='".$data[$i]['no_daftar']."' and nomr= '".$data[$i]['nomr']."' and status_delete='UD'", 0);
                            	$lab = $db->query("select sum(tarif) jumlah from tbl_lab_detail a  left join tbl_lab b on b.id=a.labId where b.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                            	$gigi = $db->query("select sum(tarif) jumlah from tbl_gigi_detail a  left join tbl_gigi b on b.id=a.gigiId where b.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                            	$obygn = $db->query("select sum(tarif) jumlah from tbl_obygn_detail a left join tbl_obygn b on b.id=a.obygnID where b.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                            	$bedah = $db->query("select sum(tarif) jumlah from tbl_bedah_detail a left join tbl_bedah b on b.id=a.bedahID where b.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                            	$rad = $db->query("select sum(tarif) jumlah from tbl_rad_detail a  left join tbl_rad b on b.id=a.radId where b.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                            	$fisT = $db->query("select sum(tarif) as jumlah from tbl_fisio_detail a  left join tbl_fisio b on b.id=a.fisioId where b.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                            	$perawat = $db->query("select sum(tarif) as jumlah from tbl_rawat_detail a  left join tbl_rawat b on b.id=a.rawatID where b.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);

                            	$data[$i]['totalNya'] = $biayaAdmin + $farm[0]['jumlah'] + $farm2[0]['jumlah'] + $dAlkes[0]['jumlah'] + $dTindakan[0]['jumlah'] + $lab[0]['jumlah'] + $gigi[0]['jumlah'] + $obygn[0]['jumlah'] + $bedah[0]['jumlah'] + $rad[0]['jumlah'] + $fisT[0]['jumlah'] + $perawat[0]['jumlah'];
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo date("d-M-Y", strtotime($data[$i]['tgl_daftar']))?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $pasien[0]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td style="text-align: right;"><?php echo $data[$i]['totalNya']?></td> 
						</tr> 
						<?php
								$ttlr = $ttlr + $data[$i]['rehabmedik'];
								$ttln = $ttln + $data[$i]['nebulizer'];
								$ttlm = $ttlm + $data[$i]['message'];
								$ttlSum = $ttlSum + $data[$i]['total_harga_fisio'];
							}
							if ($ttlSum > 0) {
								$totJasa = $ttlSum + $biayaJaga;
								$pajak = $totJasa * 50/100;
								
								$cash = $db->queryItem("select count(a.id) from tbl_fisio a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and (b.kode_perusahaan='PPP031' or b.kode_perusahaan='')", 0);
								$asuransi = $db->queryItem("select count(a.id) from tbl_fisio a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and b.kode_perusahaan <> 'PPP031' and b.kode_perusahaan <> 'JJJ030' and b.kode_perusahaan != ''", 0);
								$jamsostek = $db->queryItem("select count(a.id) from tbl_fisio a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and b.kode_perusahaan='JJJ030'", 0);
						?>
						<tr>
							<th colspan="10" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlSum)?>
							</th>
						</tr>
						<tr>
							<th colspan="10" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN CASH
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($cash)?>
							</th>
						</tr>
						<tr>
							<th colspan="10" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN ASURANSI
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($asuransi)?>
							</th>
						</tr>
						<tr>
							<th colspan="10" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN JAMSOSTEK
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($jamsostek)?>
							</th>
						</tr>
						<tr>
							<th colspan="10" style="text-align: right; font-weight: bold; background: #CCCCCC">
								REHABMEDIK
							</th>
							<th style="text-align: right; font-weight: bold; background: #CCCCCC">
								<?php echo number_format($ttlr)?>
							</th>
						</tr>
						<tr>
							<th colspan="10" style="text-align: right; font-weight: bold">
								UPK 35%
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlr*0.35)?>
							</th>
						</tr>
						<tr>
							<th colspan="10" style="text-align: right; font-weight: bold">
								TERAPIS 65%
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlr*0.65)?>
							</th>
						</tr>
						<tr>
							<th colspan="10" style="text-align: right; font-weight: bold; background: #CCCCCC">
								NEBULIZER
							</th>
							<th style="text-align: right; font-weight: bold; background: #CCCCCC">
								<?php echo number_format($ttln)?>
							</th>
						</tr>
						<tr>
							<th colspan="10" style="text-align: right; font-weight: bold">
								UPK 25%
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttln*0.25)?>
							</th>
						</tr>
						<tr>
							<th colspan="10" style="text-align: right; font-weight: bold">
								TERAPIS 75%
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttln*0.75)?>
							</th>
						</tr>
						<tr>
							<th colspan="10" style="text-align: right; font-weight: bold; background: #CCCCCC">
								MASSAGE
							</th>
							<th style="text-align: right; font-weight: bold; background: #CCCCCC">
								<?php echo number_format($ttlm)?>
							</th>
						</tr>
						<tr>
							<th colspan="10" style="text-align: right; font-weight: bold">
								UPK 10%
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlm*0.10)?>
							</th>
						</tr>
						<tr>
							<th colspan="10" style="text-align: right; font-weight: bold">
								TERAPIS 90%
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlm*0.90)?>
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