<?php
	// Fungsi header dengan mengirimkan raw data excel
	header("Content-type: application/vnd-ms-excel");
	 
	// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=ReportRujukan".date("YmdHis").".xls");
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
		Laporan Rujukan Klinik Pasien<br />
		Periode : <?php echo date("d F Y", strtotime($_GET['d1'])).' s/d '.date("d F Y", strtotime($_GET['d2']))?><br />
	</p>
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                        <?php
							//$data = $db->query("select * from tbl_fisio where tgl_insert >= '$date1' and tgl_insert < '$date2' and status_delete='UD'", 0);
							$data = $db->query("select a.*, b.nama_dokter from tbl_pendaftaran a left join tbl_dokter b on b.kode_dokter=a.kode_dokter where a.tgl_daftar >= '".$_GET['d1']."' and a.tgl_daftar < '".$_GET['d2']."' and rujukan_kode != '' order by a.no_daftar", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo date("d-M-Y", strtotime($data[$i]['tgl_daftar']))?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $pasien[0]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_dokter']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td><?php echo $data[$i]['rujukan_nama'].' - '.$data[$i]['rujukan_rsnama']?></td>
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