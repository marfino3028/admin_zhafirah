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
							<th>No.Poli Bedah </th> 
							<th style="width:70px">NO.MR</th> 
							<th>Nama Pasien</th> 
							<th>JAMINAN</th> 
							<th style="width:100px">Tarif Dokter</th> 
							<th style="width:60px">%Dokter</th> 
							<th style="width:100px">UPK</th> 
							<th style="width:100px">Total Harga</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							include "../../3rdparty/engine.php";
							ini_set("display_errors", 0);
							$t1 = explode("/", $_POST['d1']);
							$t2 = explode("/", $_POST['d2']);
							$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1];
							//$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2]));

							$data = $db->query("select a.no_bedah, a.nomr, a.nama, a.id, a.total_harga_bedah from tbl_bedah a where a.status_delete='UD' and tgl_input_bedah >= '$date1' and tgl_input_bedah < '$date2'", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $start + $i + 1;
								$data[$i]['nama_perusahaan'] = $db->queryItem("select nama_perusahaan from tbl_pendaftaran where nomr='".$data[$i]['nomr']."'");
								$tarif = $db->query("select sum(tarif) as tarif, sum(biaya_dokter) as dokter, sum((tarif-biaya_dokter)) as upk, pDokter from tbl_bedah_detail where bedahID='".$data[$i]['id']."' group by nomr");
								$pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['no_bedah']?></td>
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $pasien[0]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td style="text-align: right;"><?php echo number_format($tarif[0]['dokter'])?></td> 
							<td style="text-align: right;"><?php echo number_format($tarif[0]['pDokter'])?>%</td> 
							<td style="text-align: right;"><?php echo number_format($tarif[0]['upk'])?></td> 
							<td style="text-align: right;"><?php echo number_format($tarif[0]['tarif'])?></td> 
						</tr> 
						<?php
								$ttlDkt = $ttlDokt + $tarif[0]['dokter'];
								$ttlUpk = $ttlUpk + $tarif[0]['upk'];
								$ttlTarif = $ttlTarif + $tarif[0]['tarif'];
							}
							if ($ttlDkt > 0) {
								$cash = $db->queryItem("select count(a.id) from tbl_bedah a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_input_bedah >= '$date1' and a.tgl_input_bedah < '$date2' and a.status_delete='UD' and b.kode_perusahaan='PPP031'", 0);
								$asuransi = $db->queryItem("select count(a.id) from tbl_bedah a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_input_bedah >= '$date1' and a.tgl_input_bedah < '$date2' and a.status_delete='UD' and b.kode_perusahaan <> 'PPP031' and b.kode_perusahaan <> 'JJJ030'", 0);
								$jamsostek = $db->queryItem("select count(a.id) from tbl_bedah a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_input_bedah >= '$date1' and a.tgl_input_bedah < '$date2' and a.status_delete='UD' and b.kode_perusahaan='JJJ030'", 0);
						?>
						<tr>
							<th colspan="5" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlDkt)?>
							</th>
							<th style="text-align: right; font-weight: bold">&nbsp;</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlUpk)?>
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlTarif)?>
							</th>
						</tr>
						<tr>
							<th colspan="8" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN CASH
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($cash)?>
							</th>
						</tr>
						<tr>
							<th colspan="8" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN ASURANSI
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($asuransi)?>
							</th>
						</tr>
						<tr>
							<th colspan="8" style="text-align: right; font-weight: bold">
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