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
							<th style="width:70px">NO.DAFTAR</th> 
							<th>NAMA</th> 
							<th>JAMINAN</th> 
							<th>Nama Tindakan</th> 
							<th style="width:120px">TOTAL PEMBAYARAN</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							include "../../3rdparty/engine.php";
							ini_set("display_errors", 0);
							$t1 = explode("/", $_POST['d1']);
							$t2 = explode("/", $_POST['d2']);
							//Nilai Tutup Pendapatan Harian
							$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
							$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
							//$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;

							$data = $db->query("select a.*, b.nama_perusahaan from tbl_rad a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' order by b.nama_perusahaan", 0);
							$dokter = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['dokter']."'");
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
								//$data[$i]['nama_perusahaan'] = $db->queryItem("select nama_perusahaan from tbl_pendaftaran where nomr='".$data[$i]['nomr']."'");
								$plusBiaya = $db->queryItem("select c.tarif from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
								$data[$i]['total'] = $data[$i]['total'] + $plusBiaya;
								$sub = $db->query("select nama_tindakan, tarif from tbl_rad_detail where radID='".$data[$i]['id']."' and status_delete='UD'");
								for ($j = 0; $j < count($sub); $j++) {
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $pasien[0]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td><?php echo $sub[$j]['nama_tindakan']?></td>
							<td style="text-align: right;"><?php echo number_format($sub[$j]['tarif'])?></td> 
						</tr> 
						<?php
								}
								$ttlSum = $ttlSum + $data[$i]['total_harga_rad'];
							}
							if ($ttlSum > 0) {
								$totJasa = $ttlSum + $biayaJaga;
								$pajak = $totJasa * 50/100;

								$cash = $db->queryItem("select count(a.id) from tbl_rad a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and b.kode_perusahaan='PPP031'", 0);
								$asuransi = $db->queryItem("select count(a.id) from tbl_rad a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and b.kode_perusahaan <> 'PPP031' and b.kode_perusahaan <> 'JJJ030'", 0);
								$jamsostek = $db->queryItem("select count(a.id) from tbl_rad a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and b.kode_perusahaan='JJJ030'", 0);
						?>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlSum)?>
							</th>
						</tr>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN CASH
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($cash)?>
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