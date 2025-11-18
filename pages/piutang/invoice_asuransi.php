    <?php
		include "../../3rdparty/engine.php";
		ini_set("display_errors", 0);
        //include "../../header_sub.php";
    ?>
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-content" style="overflow-x:auto;">
                    <table class="table table-striped" id="sort-table">
						<thead> 
						<tr>
							<th>&nbsp</th> 
							<th style="width:20px">NO</th> 
							<th style="width:70px">NO.MR</th> 
							<th style="width:70px">NO.DAFTAR</th> 
							<th>NAMA</th> 
							<th>PENJAMIN</th> 
							<th style="text-align: right;">TOTAL PEMBAYARAN</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							$data = $db->query("select * from tbl_kasir where kode_perusahaan='".$_POST['id']."' and status_inv='BLM' order by tgl_insert desc", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
								$plusBiaya = $db->queryItem("select c.tarif from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
								$data[$i]['total'] = $data[$i]['total'] + $plusBiaya;
								$biaya = $db->queryItem("select sum(bayar) from tbl_kasir_detail where payment_to='ASURANSI' and no_kwitansi='".$data[$i]['no_kwitansi']."'");
								$totaBiaya = $biaya;
						?>
						<tr>
							<td><input type="checkbox" name="kasir<?php echo $data[$i]['id']?>" value="<?php echo $data[$i]['id']?>"></td> 
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $pasien[0]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td style="text-align: right;"><?php echo number_format($totaBiaya)?></td> 
						</tr> 
						<?php
								$ttlSum = $ttlSum + $totaBiaya;
							}
							if ($ttlSum > 0) {
								$totJasa = $ttlSum + $biayaJaga;
								$pajak = $totJasa * 50/100;
						?>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlSum)?>
							</th>
						</tr>
						<?php	
							}
						?>
						<input type="hidden" id="total" name="total" value="<?php echo $ttlSum?>" />
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
<script>
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>