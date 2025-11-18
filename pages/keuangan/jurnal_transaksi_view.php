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
							<th style="width:70px">Tgl Transaksi</th> 
							<th style="width:70px">No. Jurnal</th> 
							<th>Detail</th> 
							<th>Kode Akun</th> 
							<th>Deskripsi</th> 
							<th>Debet</th> 
							<th>Kredit</th> 
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
							$date1a = $t1[2].'-'.$t1[0].'-'.$t1[1];
							$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
							//$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
							$date2a = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2]));
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;

							$data = $db->query("select a.* from tbl_kasir a where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' order by a.tgl_insert desc", 0);
							$total = 0;
							$totals = 0;
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								if ($no < 10)	$nos = '00'.$no;
								elseif ($no > 10 and $no < 100)	$nos = '0'.$no;
								
								$no_jurnal = 'KK/'.date("m", strtotime($data[$i]['tgl_insert'])).'/'.date("y", strtotime($data[$i]['tgl_insert'])).'/'.$nos;
								
								if ($data[$i]['metode_payment'] == 'CASH') {
									$met = 'PASIEN';
									$data[$i]['totalass'] = $data[$i]['total'];
									$kode_coa = '1';
									//$nama_coa = $db->queryItem("select nm_coa from tbl_coa where kd_coa='$kode_coa'");
								}
								elseif ($data[$i]['metode_payment'] == 'ASS') {
									$met = 'ASURANSI';
									$kode_coa = '5';
									$data[$i]['totalass'] = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$data[$i]['no_kwitansi']."' and payment_to='$met'");
								}
								$coa = $db->query("select kd_coa, nm_coa from tbl_coa where id='$kode_coa'");
								if ($data[$i]['nomr'] == "") {
									$daftarNya = $db->query("select a.nomr, b.nm_pasien, a.kode_dokter from tbl_pendaftaran a left join tbl_pasien b on b.nomr =a.nomr where a.no_daftar='".$data[$i]['no_daftar']."'");
									$data[$i]['nomr'] = $daftarNya[0]['nomr'];
									$data[$i]['nama'] = $daftarNya[0]['nm_pasien'];
									$data[$i]['nofr'] = $daftarNya[0]['kode_dokter'];
								}
						?>
						<tr>
							<td style="font-weight: bold"><?php echo $no?></td> 
							<td style="font-weight: bold"><?php echo date("d-m-Y", strtotime($data[$i]['tgl_insert']))?></td> 
							<td style="font-weight: bold"><?php echo $no_jurnal?></td>
							<td style="font-weight: bold"><?php echo $data[$i]['nomr'].' / '.$data[$i]['nama'].' / '.$data[$i]['nofr'].' / '.$data[$i]['nama_perusahaan']?></td>
							<td style="font-weight: bold"><?php echo $coa[0]['kd_coa']?></td>
							<td style="font-weight: bold"><?php echo $coa[0]['nm_coa']?></td>
							<td style="text-align: right; font-weight: bold"><?php echo number_format($data[$i]['totalass'])?></td>
							<td style="text-align: right; font-weight: bold">0</td> 
						</tr> 
						<?php
								$total = $total + $data[$i]['total'];
								$sub = $db->query("select *, sum(bayar) as jumlah from tbl_kasir_detail where no_kwitansi='".$data[$i]['no_kwitansi']."' and payment_to='$met' group by kategori", 0);
								$totalss = 0;
								for ($il = 0; $il < count($sub); $il++) {
									if ($sub[$il]['kategori'] == 'ADMINISTRASI') {
										$sub[$il]['admin'] = $db->queryItem("select bayar from tbl_kasir_detail where no_kwitansi='".$data[$i]['no_kwitansi']."' and payment_to='$met' and kategori='ADMINISTRASI' and nomor='1'");
										$adminPoli = $db->query("select b.nama_poli, b.tarif, c.nama_dokter from tbl_pendaftaran a left join tbl_poli b on b.kd_poli=a.kd_poli left join tbl_dokter c on c.kode_dokter=a.kode_dokter where a.no_daftar='".$data[$i]['no_daftar']."'");
										$adminPoli[0]['dokter'] = $sub[$il]['jumlah'] - $sub[$il]['admin'] - $adminPoli[0]['tarif'];
										$adm1 = $db->query("select kd_coa, nm_coa from tbl_coa where id='95'");
										$adm2 = $db->query("select kd_coa, nm_coa from tbl_coa where id='87'");
										if ($data[$i]['metode_payment'] == 'ASS') {
											$adm3 = $db->query("select kd_coa, nm_coa from tbl_coa where id='191'");
										}
										else {
											$adm3 = $db->query("select kd_coa, nm_coa from tbl_coa where id='185'");
										}
										
										if ($sub[$il]['admin'] > 0) {
						?>
						<tr>
							<td>&nbsp;</td> 
							<td>&nbsp;</td> 
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php echo $adm1[0]['kd_coa']?></td>
							<td>&nbsp;&nbsp;&nbsp;<?php echo $adm1[0]['nm_coa']?></td>
							<td style="text-align: right;">0</td>
							<td style="text-align: right;"><?php echo number_format($sub[$il]['admin'])?></td> 
						</tr> 
						<?php
										}
										if ($adminPoli[0]['tarif'] > 0) {
						?>
						<tr>
							<td>&nbsp;</td> 
							<td>&nbsp;</td> 
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php echo $adm2[0]['kd_coa']?></td>
							<td>&nbsp;&nbsp;&nbsp;<?php echo $adm2[0]['nm_coa']?></td>
							<td style="text-align: right;">0</td>
							<td style="text-align: right;"><?php echo number_format($adminPoli[0]['tarif'])?></td> 
						</tr> 
						<?php
										}
										if ($adminPoli[0]['dokter']) {
						?>
						<tr>
							<td>&nbsp;</td> 
							<td>&nbsp;</td> 
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php echo $adm3[0]['kd_coa']?></td>
							<td>&nbsp;&nbsp;&nbsp;<?php echo $adm3[0]['nm_coa']?></td>
							<td style="text-align: right;">0</td>
							<td style="text-align: right;"><?php echo number_format($adminPoli[0]['dokter'])?></td> 
						</tr> 
						<?php
										}
									}
									else {
										if ($sub[$il]['kategori'] == 'PHARMACY') {
											$coaID = '186';
										}
										elseif ($sub[$il]['kategori'] == 'LAB') {
											$coaID = '94';
										}
										elseif ($sub[$il]['kategori'] == 'FIS') {
											$coaID = '187';
										}
										elseif ($sub[$il]['kategori'] == 'alkes') {
											$coaID = '189';
										}
										elseif ($sub[$il]['kategori'] == 'GIGI') {
											$coaID = '89';
										}
										elseif ($sub[$il]['kategori'] == 'TINDAKAN') {
											$coaID = '88';
										}
										$coaNya = $db->query("select kd_coa, nm_coa from tbl_coa where id='$coaID'");
						?>
						<tr>
							<td>&nbsp;</td> 
							<td>&nbsp;</td> 
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php echo $coaNya[0]['kd_coa']?></td>
							<td>&nbsp;&nbsp;&nbsp;<?php echo $coaNya[0]['nm_coa']?></td>
							<td style="text-align: right;">0</td>
							<td style="text-align: right;"><?php echo number_format($sub[$il]['jumlah'])?></td> 
						</tr> 
						<?php			
									}
									$totals = $totals + $sub[$il]['jumlah'];
									$totalss = $totalss + $sub[$il]['jumlah'];
								}
								if ($totalss != $data[$i]['total']) {
									if ($met == 'PASIEN') $met = 'ASURANSI';
									elseif ($met == 'ASURANSI') $met = 'PASIEN';
									$subTotal = $db->queryItem("select sum(bayar) as jumlah from tbl_kasir_detail where no_kwitansi='".$data[$i]['no_kwitansi']."' and payment_to='$met'", 0);
									$kdcoa1 = 1;
									$coaks = $db->query("select kd_coa, nm_coa from tbl_coa where id='$kdcoa1'");
						?>
						<tr>
							<td style="font-weight: bold"><?php echo $no?></td> 
							<td style="font-weight: bold"><?php echo date("d-m-Y", strtotime($data[$i]['tgl_insert']))?></td> 
							<td style="font-weight: bold"><?php echo $no_jurnal?></td>
							<td style="font-weight: bold"><?php echo $data[$i]['nomr'].' / '.$data[$i]['nama'].' / '.$data[$i]['nofr'].' / '.$data[$i]['nama_perusahaan']?></td>
							<td style="font-weight: bold"><?php echo $coaks[0]['kd_coa']?></td>
							<td style="font-weight: bold"><?php echo $coaks[0]['nm_coa']?></td>
							<td style="text-align: right; font-weight: bold"><?php echo number_format($subTotal)?></td>
							<td style="text-align: right; font-weight: bold">0</td> 
						</tr> 
						<?php
									$sub = $db->query("select * from (select *, sum(bayar) as jumlah from tbl_kasir_detail where no_kwitansi='".$data[$i]['no_kwitansi']."' and payment_to='$met' group by kategori) p where p.jumlah > 0", 0);
									for ($il = 0; $il < count($sub); $il++) {
										if ($sub[$il]['kategori'] == 'ADMINISTRASI') {
											$coaID = '95';
										}
										elseif ($sub[$il]['kategori'] == 'PHARMACY') {
											$coaID = '186';
											//$coaID = '95';
										}
										elseif ($sub[$il]['kategori'] == 'LAB') {
											$coaID = '94';
										}
										elseif ($sub[$il]['kategori'] == 'FIS') {
											$coaID = '187';
										}
										elseif ($sub[$il]['kategori'] == 'alkes') {
											$coaID = '189';
										}
										elseif ($sub[$il]['kategori'] == 'GIGI') {
											$coaID = '89';
										}
										elseif ($sub[$il]['kategori'] == 'TINDAKAN') {
											$coaID = '88';
										}
										$coaNya = $db->query("select kd_coa, nm_coa from tbl_coa where id='$coaID'");
						?>
						<tr>
							<td>&nbsp;</td> 
							<td>&nbsp;</td> 
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php echo $coaNya[0]['kd_coa']?></td>
							<td>&nbsp;&nbsp;&nbsp;<?php echo $coaNya[0]['nm_coa']?></td>
							<td style="text-align: right;">0</td>
							<td style="text-align: right;"><?php echo number_format($sub[$il]['jumlah'])?></td> 
						</tr> 
						<?php			
										$totals = $totals + $sub[$il]['jumlah'];
										$totalss = $totalss + $sub[$il]['jumlah'];
									}
								}
						?>
						<tr>
							<td colspan="6" style="text-align: right; font-weight: bold">SubTotal</td>
							<td style="text-align: right;">0</td>
							<td style="text-align: right; font-weight: bold"><?php echo number_format($totalss)?></td> 
						</tr> 
						<?php
							}
							
							$polkar = $db->query("select * from tbl_polkar where tgl_bayar >= '$date1a' and tgl_bayar < '$date2a'");
							for ($i = 0; $i < count($polkar); $i++) {
								$no = $no + 1;
								$kdcoa1 = 1;
								$coa = $db->query("select kd_coa, nm_coa from tbl_coa where id='$kdcoa1'");
								$kdcoa2 = 190;
								$coa2 = $db->query("select kd_coa, nm_coa from tbl_coa where id='$kdcoa2'");
								
								if ($no < 10)	$nos = '00'.$no;
								elseif ($no > 10 and $no < 100)	$nos = '0'.$no;
								
								$no_jurnal = 'KK/'.date("m", strtotime($polkar[$i]['tgl_bayar'])).'/'.date("y", strtotime($polkar[$i]['tgl_bayar'])).'/'.$nos;
						?>
						<tr>
							<td style="font-weight: bold"><?php echo $no?></td> 
							<td style="font-weight: bold"><?php echo date("d-m-Y", strtotime($data[$i]['tgl_insert']))?></td> 
							<td style="font-weight: bold"><?php echo $no_jurnal?></td>
							<td style="font-weight: bold"><?php echo $polkar[$i]['nomr'].' / '.$polkar[$i]['nama']?></td>
							<td style="font-weight: bold"><?php echo $coa[0]['kd_coa']?></td>
							<td style="font-weight: bold"><?php echo $coa[0]['nm_coa']?></td>
							<td style="text-align: right; font-weight: bold"><?php echo number_format($polkar[$i]['total_harga_polkar'])?></td>
							<td style="text-align: right; font-weight: bold">0</td> 
						</tr> 
						<tr>
							<td style="font-weight: bold">&nbsp;</td> 
							<td style="font-weight: bold">&nbsp;</td> 
							<td style="font-weight: bold">&nbsp;</td>
							<td style="font-weight: bold">&nbsp;</td>
							<td><?php echo $coa2[0]['kd_coa']?></td>
							<td>&nbsp;&nbsp;&nbsp;<?php echo $coa2[0]['nm_coa']?></td>
							<td style="text-align: right;">0</td> 
							<td style="text-align: right;"><?php echo number_format($polkar[$i]['total_harga_polkar'])?></td>
						</tr> 
						<?php	
								$total = $total + $polkar[$i]['total_harga_polkar'];
								$totals = $totals + $polkar[$i]['total_harga_polkar'];
							}
							
							$langsung = $db->query("select * from tbl_penjualan_obat where tgl_insert >= '$date1' and tgl_insert < '$date2'");
							for ($i = 0; $i < count($langsung); $i++) {
								$no = $no + 1;
								$kdcoa1 = 1;
								$coa = $db->query("select kd_coa, nm_coa from tbl_coa where id='$kdcoa1'");
								$kdcoa2 = 186;
								$coa2 = $db->query("select kd_coa, nm_coa from tbl_coa where id='$kdcoa2'");
								
								if ($no < 10)	$nos = '00'.$no;
								elseif ($no > 10 and $no < 100)	$nos = '0'.$no;
								
								$no_jurnal = 'KK/'.date("m", strtotime($langsung[$i]['tgl_insert'])).'/'.date("y", strtotime($langsung[$i]['tgl_insert'])).'/'.$nos;
								$langsung[$i]['total'] = $db->queryItem("select sum(total) from tbl_penjualan_obat_detail where no_penjualan='".$langsung[$i]['no_penjualan']."'");
								$langsung[$i]['total2'] = $db->queryItem("select sum(total) from tbl_penjualan_obat_racikan where no_penjualan='".$langsung[$i]['no_penjualan']."'");
								$langsung[$i]['total'] = $langsung[$i]['total'] + $langsung[$i]['total2'];
								
						?>
						<tr>
							<td style="font-weight: bold"><?php echo $no?></td> 
							<td style="font-weight: bold"><?php echo date("d-m-Y", strtotime($data[$i]['tgl_insert']))?></td> 
							<td style="font-weight: bold"><?php echo $no_jurnal?></td>
							<td style="font-weight: bold"><?php echo $langsung[$i]['no_penjualan'].' / '.$langsung[$i]['nama']?></td>
							<td style="font-weight: bold"><?php echo $coa[0]['kd_coa']?></td>
							<td style="font-weight: bold"><?php echo $coa[0]['nm_coa']?></td>
							<td style="text-align: right; font-weight: bold"><?php echo number_format($langsung[$i]['total'])?></td>
							<td style="text-align: right; font-weight: bold">0</td> 
						</tr> 
						<tr>
							<td style="font-weight: bold">&nbsp;</td> 
							<td style="font-weight: bold">&nbsp;</td> 
							<td style="font-weight: bold">&nbsp;</td>
							<td style="font-weight: bold">&nbsp;</td>
							<td><?php echo $coa2[0]['kd_coa']?></td>
							<td>&nbsp;&nbsp;&nbsp;<?php echo $coa2[0]['nm_coa']?></td>
							<td style="text-align: right;">0</td> 
							<td style="text-align: right;"><?php echo number_format($langsung[$i]['total'])?></td>
						</tr> 
						<?php
								
								$total = $total + $langsung[$i]['total'];
								$totals = $totals + $langsung[$i]['total'];
							}
						?>
						<tr>
							<td colspan="6" style="text-align: right; font-weight: bold">Total</td>
							<td style="text-align: right;"><?php echo number_format($total)?></td>
							<td style="text-align: right;"><?php echo number_format($totals)?></td> 
						</tr> 
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
<script>
    // $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>