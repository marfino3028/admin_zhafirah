<?php
	if ($_POST['dokter'] == '')	die("&nbsp; &nbsp; Pilih Dokter Terlebih Dahulu");
?>
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th>NO</th> 
							<th>Profile Pasien</th> 
							<th>Profesional Fee</th> 
							<th>B. DOKTER</th> 
							<th>B. TINDAKAN</th> 
							<th>B. LAB</th> 
							<th>B. FISIO</th> 
							<th>TOTAL</th> 
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
							if ($date1 == $date2) {
								$data = $db->query("select a.*, b.biayaAdmin, b.kode_dokter, b.kd_poli from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where date(a.tgl_insert) = '$date1' and (b.kode_dokter='".$_POST['dokter']."' or b.dokter_pengirim_kode='".$_POST['dokter']."') and a.status_bayar_dokter='BLM' order by a.tgl_insert desc", 0);
							}
							else {
								$data = $db->query("select a.*, b.biayaAdmin, b.kode_dokter, b.kd_poli from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert <= '$date2' and (b.kode_dokter='".$_POST['dokter']."' or b.dokter_pengirim_kode='".$_POST['dokter']."') and a.status_bayar_dokter='BLM' order by tgl_insert desc", 0);
							}
							$dokter = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['dokter']."'");
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
								$biayaAdmin = $data[$i]['biayaAdmin'];
								if ($data[$i]['kode_dokter'] == $data[$i]['dokter_pengirim_kode']) {
									$biayaDokter = $db->queryItem("select tarif_dokter from tbl_dokter where kode_dokter='".$data[$i]['kode_dokter']."'");
								}
								else {
									$biayaDokter = 0;
								}
								$feeDokter = $db->queryItem("select sum(dokter_pengirim_fee) from tbl_pendaftaran a where dokter_pengirim_kode = '".$_POST['dokter']."' and tgl_daftar >= '$date1' and tgl_daftar <= '$date2'", 0);
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
								$total = $biayaDokter + $biayaTindakan + $biayaLab + $biayaFis + $feeDokter;
								if ($total > 0) {
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td>
							<?php 
                                echo '<small>NoMR : '.$data[$i]['nomr'].'</small><br>';
                                echo '<small>No Daftar : '.$data[$i]['no_daftar'].'</small><br>';
                                echo '<small>Nama Pasien : '.$pasien[0]['nm_pasien'].'</small><br>';
                                echo '<small>Jaminan : '.$data[$i]['nama_perusahaan'].'</small><br>';
                            ?>
                            </td>
							<td style="text-align: right;"><?php echo number_format($feeDokter)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaDokter)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaTindakan)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaLab)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaFis)?></td> 
							<td style="text-align: right;"><?php echo number_format($total)?>
							</td> 
						</tr> 
						<input type="hidden" id="nomrs<?php echo $no?>" name="nomrs[<?php echo $no?>]" value="<?php echo $data[$i]['nomr']?>" />
						<input type="hidden" id="no_daftar<?php echo $no?>" name="no_daftar[<?php echo $no?>]" value="<?php echo $data[$i]['no_daftar']?>" />
						<input type="hidden" id="nama_pasien<?php echo $no?>" name="nama_pasien[<?php echo $no?>]" value="<?php echo $pasien[0]['nm_pasien']?>" />
						<input type="hidden" id="jaminan<?php echo $no?>" name="jaminan[<?php echo $no?>]" value="<?php echo $data[$i]['nama_perusahaan']?>" />
						<input type="hidden" id="bDokter<?php echo $no?>" name="bDokter[<?php echo $no?>]" value="<?php echo $biayaDokter?>" />
						<input type="hidden" id="bTindakan<?php echo $no?>" name="bTindakan[<?php echo $no?>]" value="<?php echo $biayaTindakan?>" />
						<input type="hidden" id="bLab<?php echo $no?>" name="bLab[<?php echo $no?>]" value="<?php echo $biayaLab?>" />
						<input type="hidden" id="bFisio<?php echo $no?>" name="bFisio[<?php echo $no?>]" value="<?php echo $biayaFis?>" />
						<input type="hidden" id="bFeedokter<?php echo $no?>" name="bFeedokter[<?php echo $no?>]" value="<?php echo $feeDokter?>" />
						<input type="hidden" id="bTotal<?php echo $no?>" name="bTotal[<?php echo $no?>]" value="<?php echo $total?>" />
						<?php
								$ttlSum = $ttlSum + $total;
								$TotalbiayaDokter = $TotalbiayaDokter + $biayaDokter;
								$TotabiayaTindakan = $TotabiayaTindakan + $biayaTindakan;
								$TotalbiayaLab = $TotalbiayaLab + $biayaLab;
								$TotalbiayaFis = $TotalbiayaFis + $biayaFis;
								$TotalbiayaFis = $TotalbiayaFis + $biayaFis;
								$TotalFee = $TotalFee + $feeDokter;
								}
							}

							if ($date1 == $date2) {
								$data = $db->query("select a.*, b.biayaAdmin, b.kode_dokter, b.kd_poli from tbl_kasir a left join tbl_pendaftaran_jamsostek b on concat('JAM-', b.no_daftar)=a.no_daftar where a.tgl_insert >= '$date1' and b.kode_dokter='".$_POST['dokter']."' and a.status_bayar_dokter='BLM' order by a.tgl_insert desc", 0);
							}
							else {
								$data = $db->query("select a.*, b.biayaAdmin, b.kode_dokter, b.kd_poli from tbl_kasir a left join tbl_pendaftaran_jamsostek b on concat('JAM-', b.no_daftar)=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert <= '$date2' and b.kode_dokter='".$_POST['dokter']."' and a.status_bayar_dokter='BLM' order by tgl_insert desc", 0);
							}
							$dokter = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['dokter']."'");
							for ($i = 0; $i < count($data); $i++) {
								$no = $no + 1;
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
								if ($total > 0) {
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td>
							<?php 
                                echo '<small>NoMR : '.$data[$i]['nomr'].'</small><br>';
                                echo '<small>No Daftar : '.$data[$i]['no_daftar'].'</small><br>';
                                echo '<small>Nama Pasien : '.$pasien[0]['nm_pasien'].'</small><br>';
                                echo '<small>Jaminan : '.$data[$i]['nama_perusahaan'].'</small><br>';
                            ?>
                            </td>
							<td style="text-align: right;"><?php echo number_format($feeDokter)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaDokter)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaTindakan)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaLab)?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaFis)?></td> 
							<td style="text-align: right;"><?php echo number_format($total)?></td> 
						</tr> 
						<input type="hidden" id="nomrs<?php echo $no?>" name="nomrs[<?php echo $no?>]" value="<?php echo $data[$i]['nomr']?>" />
						<input type="hidden" id="no_daftar<?php echo $no?>" name="no_daftar[<?php echo $no?>]" value="<?php echo $data[$i]['no_daftar']?>" />
						<input type="hidden" id="nama_pasien<?php echo $no?>" name="nama_pasien[<?php echo $no?>]" value="<?php echo $pasien[0]['nm_pasien']?>" />
						<input type="hidden" id="jaminan<?php echo $no?>" name="jaminan[<?php echo $no?>]" value="<?php echo $data[$i]['nama_perusahaan']?>" />
						<input type="hidden" id="bDokter<?php echo $no?>" name="bDokter[<?php echo $no?>]" value="<?php echo $biayaDokter?>" />
						<input type="hidden" id="bTindakan<?php echo $no?>" name="bTindakan[<?php echo $no?>]" value="<?php echo $biayaTindakan?>" />
						<input type="hidden" id="bLab<?php echo $no?>" name="bLab[<?php echo $no?>]" value="<?php echo $biayaLab?>" />
						<input type="hidden" id="bFisio<?php echo $no?>" name="bFisio[<?php echo $no?>]" value="<?php echo $biayaFis?>" />
						<input type="hidden" id="bTotal<?php echo $no?>" name="bTotal[<?php echo $no?>]" value="<?php echo $total?>" />
						<?php
								$ttlSum = $ttlSum + $total;
								$TotalbiayaDokter = $TotalbiayaDokter + $biayaDokter;
								$TotabiayaTindakan = $TotabiayaTindakan + $biayaTindakan;
								$TotalbiayaLab = $TotalbiayaLab + $biayaLab;
								$TotalbiayaFis = $TotalbiayaFis + $biayaFis;
								}
							}
						?>
						<?php
							echo '<input type="hidden" nama="no_daftar" id="" value="'.$no.'">';
							if ($ttlSum > 0) {
								$biayaJaga = $db->queryItem("select sum(biaya) from tbl_kehadiran_dokter where tgl_hadir >= '$date1' and tgl_hadir <= '$date2' and kode_dokter='".$_POST['dokter']."' and status_delete='UD'", 0);
								$hrJaga = $db->queryItem("select count(biaya) from tbl_kehadiran_dokter where tgl_hadir >= '$date1' and tgl_hadir <= '$date2' and kode_dokter='".$_POST['dokter']."' and status_delete='UD'", 0);
								$totJasa = $ttlSum + $biayaJaga;
								//$pajak = $totJasa * 50/100;
								$pajak = 0;
						?>
						<input type="hidden" id="hari_jaga" name="hari_jaga" value="<?php echo $hrJaga?>" />
						<input type="hidden" id="jml_data" name="jml_data" value="<?php echo $no?>" />
						<input type="hidden" id="total_kotor" name="total_kotor" value="<?php echo $ttlSum?>" />
						<input type="hidden" id="biaya_jaga" name="biaya_jaga" value="<?php echo $biayaJaga?>" />
						<input type="hidden" id="totJasa" name="totJasa" value="<?php echo $totJasa?>" />
						<input type="hidden" id="pajak" name="pajak" value="<?php echo $pajak?>" />
						<tr>
							<td colspan="2" style="text-align: right; font-weight: bold">SUB TOTAL</td> 
							<td style="text-align: right;"><?php echo number_format($TotalfeeDokter)?></td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaDokter)?></td> 
							<td style="text-align: right;"><?php echo number_format($TotabiayaTindakan)?></td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaLab)?></td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaFis)?></td> 
							<td style="text-align: right;"><?php echo number_format($ttlSum)?></td> 
						</tr> 
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlSum)?>
							</th>
						</tr>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								BIAYA JAGA
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($biayaJaga)?>
							</th>
						</tr>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								TOTAL JASA
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($totJasa)?>
							</th>
						</tr>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								Total Pendapatan Dokter
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php 
									$totalAll = $totJasa;
									echo number_format($totalAll);
								?>
							</th>
						</tr>
						<?php	
							}
							else {
						?>
						<tr>
							<th colspan="8" style="text-align: center; font-weight: bold">
								Data di periode ini kemungkinan sudah dibayarkan
							</th>
						</tr>
						<?php	
							}
						?>
						<input type="hidden" id="npwp" name="npwp" value="<?php echo $npwp?>" />
						<input type="hidden" id="totPajak" name="totPajak" value="<?php echo $totPajak?>" />
						<input type="hidden" id="totalAll" name="totalAll" value="<?php echo $totalAll?>" />
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
