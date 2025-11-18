    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th style="width:70px">NO.MR</th> 
							<th style="width:70px">NO.DAFTAR</th> 
							<th>NAMA</th> 
							<th>JAMINAN</th> 
							<th style="width:70px">STATUS</th> 
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
							//Nilai Tutup Pendapatan Harian
							$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
							$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
							$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;

							$data = $db->query("select a.*, b.biayaAdmin, b.kode_dokter, b.kd_poli from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and b.kode_dokter='".$_POST['dokter']."' order by tgl_insert desc", 0);

							$dokter = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['dokter']."'");
							for ($i = 0; $i < count($data); $i++) {
								$pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
								$biayaAdmin = $data[$i]['biayaAdmin'];
								if ($data[$i]['kd_poli'] == 'P002') {
									$biayaDokter = $db->queryItem("select sum(a.dokter_tarif) from tbl_gigi_detail a left join tbl_gigi b on b.id=a.gigiID where b.no_daftar='".$data[$i]['no_daftar']."'");
								}
								else {
									$biayaDokter = $db->queryItem("select tarif_dokter from tbl_dokter where kode_dokter='".$data[$i]['kode_dokter']."'");
								}
								$biayaTindakan = $db->queryItem("select sum(tarif) from tbl_tindakan where no_daftar='".$data[$i]['no_daftar']."'");
								$poli = $db->queryItem("select tarif from tbl_poli where kd_poli='".$data[$i]['kd_poli']."'");
								$biayaLab = $db->queryItem("select total_harga_lab from tbl_lab where no_daftar='".$data[$i]['no_daftar']."'");
								$biayaFis = $db->queryItem("select total_harga_fisio from tbl_fisio where no_daftar='".$data[$i]['no_daftar']."'");
								//$total = $biayaAdmin + $poli + $biayaDokter + $biayaTindakan;
								$persenTDK = $db->queryItem("select nilai from tbl_config where kode='HON-TDK'");
								$persenLAB = $db->queryItem("select nilai from tbl_config where kode='HON-LAB'");
								$persenFIS = $db->queryItem("select nilai from tbl_config where kode='HON-FIS'");
								$biayaTindakan = $biayaTindakan * $persenTDK /100;
								$biayaLab = $biayaLab * $persenLAB / 100;
								$biayaFis = $biayaFis * $persenFIS / 100;
								$total = $biayaDokter + $biayaTindakan + $biayaLab + $biayaFis;
						?>
						<tr>
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $pasien[0]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td style="text-align: right;"><?php echo $data[$i]['status_bayar_dokter']?></td> 
							<!--<td style="text-align: right;"><?php echo number_format($biayaAdmin)?></td>
							<td style="text-align: right;"><?php echo number_format($poli)?></td>--> 
							<td style="text-align: right;"><?php echo number_format($biayaDokter)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaTindakan)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaLab)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaFis)?></td> 
							<td style="text-align: right;"><?php echo number_format($total)?></td> 
						</tr> 
						<?php
								$ttlSum = $ttlSum + $total;
								$TotalbiayaDokter = $TotalbiayaDokter + $biayaDokter;
								$TotalbiayaTindakan = $TotalbiayaTindakan + $biayaTindakan;
							}
						?>
						<tr>
							<td colspan="5" style="text-align: right; font-weight: bold">SUB TOTAL</td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaDokter)?></td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaTindakan)?></td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaLab)?></td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaFis)?></td> 
							<td style="text-align: right;"><?php echo number_format($Totaltotal)?></td> 
						</tr> 
						<?php
							if ($date1 == $date2) {
								$data = $db->query("select a.*, b.biayaAdmin, b.kode_dokter, b.kd_poli from tbl_kasir a left join tbl_pendaftaran_jamsostek b on concat('JAM-', b.no_daftar)=a.no_daftar where date(a.tgl_insert) >= '$date1' and b.kode_dokter='".$_POST['dokter']."' order by a.tgl_insert desc", 0);
							}
							else {
								$data = $db->query("select a.*, b.biayaAdmin, b.kode_dokter, b.kd_poli from tbl_kasir a left join tbl_pendaftaran_jamsostek b on concat('JAM-', b.no_daftar)=a.no_daftar where date(a.tgl_insert) >= '$date1' and date(a.tgl_insert) <= '$date2' and b.kode_dokter='".$_POST['dokter']."' order by tgl_insert desc", 0);
							}
							$dokter = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['dokter']."'");
							for ($i = 0; $i < count($data); $i++) {
								$pasien = $db->query("select * from tbl_pasien_jamsostek where nomr='".$data[$i]['nomr']."'");
								$biayaAdmin = $data[$i]['biayaAdmin'];
								$biayaDokter = $db->queryItem("select tarif_jamsostek from tbl_dokter where kode_dokter='".$data[$i]['kode_dokter']."'");
								$biayaTindakan = $db->queryItem("select sum(tarif) from tbl_tindakan where no_daftar='".$data[$i]['no_daftar']."'");
								$poli = $db->queryItem("select tarif from tbl_poli where kd_poli='".$data[$i]['kd_poli']."'");
								$biayaLab = $db->queryItem("select total_harga_lab from tbl_lab where no_daftar='".$data[$i]['no_daftar']."'");
								$biayaFis = $db->queryItem("select total_harga_fisio from tbl_fisio where no_daftar='".$data[$i]['no_daftar']."'");
								//$total = $biayaAdmin + $poli + $biayaDokter + $biayaTindakan;
								$persenTDK = $db->queryItem("select nilai from tbl_config where kode='HON-TDK'");
								$persenLAB = $db->queryItem("select nilai from tbl_config where kode='HON-LAB'");
								$persenFIS = $db->queryItem("select nilai from tbl_config where kode='HON-FIS'");
								$biayaTindakan = $biayaTindakan * $persenTDK /100;
								$biayaLab = $biayaLab * $persenLAB / 100;
								$biayaFis = $biayaFis * $persenFIS / 100;
								$total = $biayaDokter + $biayaTindakan + $biayaLab + $biayaFis;
						?>
						<tr>
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $pasien[0]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<!--<td style="text-align: right;"><?php echo number_format($biayaAdmin)?></td>
							<td style="text-align: right;"><?php echo number_format($poli)?></td>--> 
							<td style="text-align: right;"><?php echo number_format($biayaDokter)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaTindakan)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaLab)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaFis)?></td> 
							<td style="text-align: right;"><?php echo number_format($total)?></td> 
							<td style="text-align: right;"><?php echo $data[$i]['status_bayar_dokter']?></td> 
						</tr> 
						<?php
								$ttlSum = $ttlSum + $total;
								//$TotalbiayaDokter = $TotalbiayaDokter + $biayaDokter;
								//$TotalbiayaTindakan = $TotalbiayaTindakan + $biayaTindakan;
							}
						?>
						<!--<tr>
							<td colspan="5" style="text-align: right; font-weight: bold">SUB TOTAL</td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaDokter)?></td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaTindakan)?></td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaLab)?></td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaFis)?></td> 
							<td style="text-align: right;"><?php echo number_format($Totaltotal)?></td> 
						</tr> -->
						<?php

							if ($ttlSum > 0) {
								$biayaJaga = $db->queryItem("select sum(biaya) from tbl_kehadiran_dokter where tgl_hadir >= '$date1' and tgl_hadir <= '$date2' and kode_dokter='".$_POST['dokter']."'", 0);
								$totJasa = $ttlSum + $biayaJaga;
								$pajak = $totJasa * 50/100;
								$tunai = $db->queryItem("select count(a.id) from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert <= '$date2' and b.kode_dokter='".$_POST['dokter']."' and a.kode_perusahaan='PPP031' order by tgl_insert desc", 0);
								$asuransi = $db->queryItem("select count(a.id) from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert <= '$date2' and b.kode_dokter='".$_POST['dokter']."' and a.kode_perusahaan <> 'PPP031' and a.kode_perusahaan <> 'JJJ030' order by tgl_insert desc", 0);
								$jamsostek = $db->queryItem("select count(a.id) from tbl_kasir a left join tbl_pendaftaran_jamsostek b on concat('JAM-', b.no_daftar)=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert <= '$date2' and b.kode_dokter='".$_POST['dokter']."' and a.kode_perusahaan = 'JJJ030' order by tgl_insert desc", 0);
						?>
						<tr>
							<th colspan="2" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN TUNAI
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($tunai)?>
							</th>
							<th colspan="5" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlSum)?>
							</th>
						</tr>
						<tr>
							<th colspan="2" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN ASURANSI
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($asuransi)?>
							</th>
							<th colspan="5" style="text-align: right; font-weight: bold">
								BIAYA JAGA
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($biayaJaga)?>
							</th>
						</tr>
						<tr>
							<th colspan="2" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN JAMSOSTEK
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($jamsostek)?>
							</th>
							<th colspan="5" style="text-align: right; font-weight: bold">
								TOTAL JASA
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($totJasa)?>
							</th>
						</tr>
						<tr>
							<th colspan="8" style="text-align: right; font-weight: bold">
								PAJAK
							</th>

							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo "0"?>
							</th>
						</tr>
						<tr>
							<th colspan="8" style="text-align: right; font-weight: bold">
								<?php
									if ($dokter[0]['npwp'] == "") {
										echo 'Jika Non NPWP (3%)';
										$npwp = $totJasa * 3/100;
									}
									else {
										echo 'Jika Punya NPWP (2,5%)';
										$npwp = $totJasa * 2.5/100;
									}
									$totPajak = $pajak + $npwp;
									$totalAll = $totJasa - $totPajak;
								?>
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($npwp)?>
							</th>
						</tr>
						<tr>
							<th colspan="8" style="text-align: right; font-weight: bold">
								Total PAJAK
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($totPajak)?>
							</th>
						</tr>
						<tr>
							<th colspan="8" style="text-align: right; font-weight: bold">
								Total Pendapatan Dokter
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($totalAll)?>
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
