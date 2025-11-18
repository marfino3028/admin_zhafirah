    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th style="width:30px">NO</th> 
							<th style="width:70px">NO.MR</th> 
							<th style="width:70px">NO.DAFTAR</th> 
							<th>NAMA</th> 
							<th>JAMINAN</th> 
							<!--<th style="width:70px">B. ADMIN</th> 
							<th style="width:70px">B. POLI</th> -->
							<th style="width:70px">B. DOKTER</th> 
							<th style="width:80px">B. TINDAKAN</th> 
							<th style="width:70px">B. LAB</th> 
							<th style="width:70px">B. FISIO</th> 
							<th style="width:70px">TOTAL</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							include "../../3rdparty/engine.php";
							ini_set("display_errors", 0);
							$t1 = explode("/", $_POST['d1']);
							$t2 = explode("/", $_POST['d2']);
							$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1];
							$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];

							$dataID = $db->query("select * from tbl_bayar_dokter where id='".$_GET['id']."'", 0);
							$data = $db->query("select * from tbl_bayar_dokter_detail where bayar_dokter_id='".$_GET['id']."'", 0);
							$dokter = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['dokter']."'");
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $data[$i]['nama']?></td>
							<td><?php echo $data[$i]['jaminan']?></td>
							<td style="text-align: right;"><?php echo number_format($data[$i]['b_dokter'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['b_tindakan'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['b_lab'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['b_fisio'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['total'])?></td> 
						</tr> 
						<?php	
								$ttlSum = $ttlSum + $data[$i]['total'];
								$TotalbiayaDokter = $TotalbiayaDokter + $data[$i]['b_dokter'];
								$TotabiayaTindakan = $TotabiayaTindakan + $data[$i]['b_tindakan'];
								$TotalbiayaLab = $TotalbiayaLab + $data[$i]['b_lab'];
								$TotalbiayaFis = $TotalbiayaFis + $data[$i]['b_fisio'];
							}
							$biayaJaga = $db->queryItem("select sum(biaya) from tbl_kehadiran_dokter where tgl_hadir >= '".$dataID[0]['tgl_start']."' and tgl_hadir <= '".$dataID[0]['tgl_end']."' and kode_dokter='".$dataID[0]['kode_dokter']."'", 0);
							$totalAll1 = $ttlSum + $biayaJaga;
							$totalAll2 = $totalAll1 - $dataID[0]['npwp'];
						?>
						<tr>
							<th colspan="8" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlSum)?>
							</th>
						</tr>
						<tr>
							<th colspan="8" style="text-align: right; font-weight: bold">
								BIAYA JAGA
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($biayaJaga)?>
							</th>
						</tr>
						<tr>
							<th colspan="8" style="text-align: right; font-weight: bold">
								TOTAL JASA
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($totalAll1)?>
							</th>
						</tr>
						<tr>
							<th colspan="8" style="text-align: right; font-weight: bold">
								PAJAK
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($dataID[0][npwp])?>
							</th>
						</tr>
						<tr>
							<th colspan="8" style="text-align: right; font-weight: bold">
								Total Pendapatan Dokter
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($totalAll2)?>
							</th>
						</tr>
						</tbody>
					</table>
				</div>
			</td>
	   </tr>
	</table>
</div>
