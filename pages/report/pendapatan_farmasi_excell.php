<?php
	// Fungsi header dengan mengirimkan raw data excel
	header("Content-type: application/vnd-ms-excel");
	 
	// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=PendapatanPharmacy.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Pendapatan Labn</title>
</head>

<body>
<?php
	
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";
	
?>

	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		Laporan Pendapatan Pharmacy<br />
		Periode : <?php echo $_GET['d1'].' s/d '.$_GET['d2']?><br />
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
							<th style="width:100px">Tgl Transaksi</th> 
							<th style="width:70px">NO.DAFTAR</th> 
							<th>NAMA</th> 
							<th>JAMINAN</th> 
							<th style="width:100px">NON RACIKAN</th> 
							<th style="width:100px">RACIKAN</th> 
							<th style="width:100px">TOTAL</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							$t1 = explode("/", $_GET['d1']);
							$t2 = explode("/", $_GET['d2']);
							//Nilai Tutup Pendapatan Harian
							$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
							$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
							//$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;

							$data = $db->query("select * from tbl_resep where tgl_insert >= '$date1' and tgl_insert < '$date2' and status_delete='UD'", 0);
							for ($i = 0; $i < count($data); $i++) {
								$pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
								$data[$i]['nama_perusahaan'] = $db->queryItem("select nama_perusahaan from tbl_pendaftaran where nomr='".$data[$i]['nomr']."'");
								$non_racikan = $db->queryItem("select sum(a.total) from tbl_resep_detail a left join tbl_resep b on b.id=a.resep_id where b.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD'");
								$racikan[$i] = $db->queryItem("select sum(a.total) from tbl_racikan_detail a left join tbl_racikan b on b.id=a.racikanId where b.no_resep='".$data[$i]['no_resep']."' and a.status_delete='UD'");
								$racikannr = $db->queryItem("select count(a.total) from tbl_racikan_detail a left join tbl_racikan b on b.id=a.racikanId where b.no_resep='".$data[$i]['no_resep']."' and a.status_delete='UD'");
								$embalase = $db->queryItem("select nilai from tbl_config where tahun='".date("Y")."' and kode='RACIKAN'");
								if ($racikannr > 1) $racikannr = 1;
								$total_embalase = $embalase * $racikannr;
								$racikan[$i] = $racikan[$i] + $total_embalase;
								$total = $non_racikan + $racikan[$i];
								//echo "$racikan[$i] = $racikan[$i] + $total_embalase;<br>";
								$nofr = $db->queryItem("select nofr from tbl_kasir where no_daftar='".$data[$i]['no_daftar']."'");
								$tgl_transaksi = $db->queryItem("select date(tgl_insert) from tbl_kasir where no_daftar='".$data[$i]['no_daftar']."'");
								if ($total > 0) {
									$no = $no + 1;
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['tgl_input']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $pasien[0]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td style="text-align: right;"><?php echo number_format($non_racikan)?></td> 
							<td style="text-align: right;"><?php echo number_format($racikan[$i])?></td> 
							<td style="text-align: right;"><?php echo number_format($total)?></td> 
						</tr> 
						<?php
									$tot_non_racikan = $tot_non_racikan + $non_racikan;
									$tot_racikan = $tot_racikan + $racikan[$i];
									$tot_all = $tot_all + $total;
								}
							}
							
							//Penjualan Langsung
							$dl = $db->query("select * from tbl_penjualan_obat where tgl_input >= '$date1' and tgl_input < '$date2' and status_delete='UD' and status_kwitansi='CLOSED'", 0);
							for ($ii = 0; $ii < count($dl); $ii++) {
								$no = $no + 1;
								$dl[$ii]['total_racikan'] = $db->queryItem("select sum(total) from tbl_penjualan_obat_detail where no_penjualan='".$dl[$ii]['no_penjualan']."' and jenis='R'");
								$total = $dl[$ii]['total_harga'] + $dl[$ii]['total_racikan'];
								$tot_all = $tot_all + $total;
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td colspan="3"><?php echo $dl[$ii]['no_penjualan']?></td>
							<td><?php echo $dl[$ii]['nama']?></td>
							<td>PRIBADI/LANGSUNG</td>
							<td style="text-align: right;"><?php echo number_format($dl[$ii]['total_harga'])?></td> 
							<td style="text-align: right;"><?php echo number_format($dl[$ii]['total_racikan'])?></td> 
							<td style="text-align: right;"><?php echo number_format($total)?></td> 
						</tr> 
						<?php	
							}
							if ($tot_all > 0) {
								$cash = $db->queryItem("select count(a.id) from tbl_resep a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and b.kode_perusahaan='PPP031'", 0);
								$asuransi = $db->queryItem("select count(a.id) from tbl_resep a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and b.kode_perusahaan <> 'PPP031' and b.kode_perusahaan <> 'JJJ030'", 0);
								$jamsostek = $db->queryItem("select count(a.id) from tbl_resep a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and b.kode_perusahaan='JJJ030'", 0);
						?>
						<tr style="background-color:">
							<th colspan="6" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($tot_non_racikan)?>
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($tot_racikan)?>
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($tot_all)?>
							</th>
						</tr>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN CASH
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($cash+$ii)?>
							</th>
						</tr>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN ASURANSI
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($asuransi)?>
							</th>
						</tr>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN JAMSOSTEK
							</th>
							<th style="text-align: right; font-weight: bold">
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