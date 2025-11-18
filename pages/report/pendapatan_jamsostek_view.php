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
							<th style="width:70px">NO.KPJ</th> 
							<th>NAMA</th> 
							<th>DIAGNOOSA</th> 
							<th>NAMA DOKTER</th> 
							<th>BIAYA DOKTER</th> 
							<th>BIAYA OBAT</th> 
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

							$data = $db->query("select * from tbl_kasir where date(tgl_insert) >= '$date1' and date(tgl_insert) < '$date2' and kode_perusahaan='JJJ030'", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$pasien = $db->query("select b.diagnosa, c.nama_dokter, c.tarif_jamsostek from tbl_pendaftaran_jamsostek a left join tbl_resepjams b on b.nomr = a.nomr and b.no_daftar=a.no_daftar left join tbl_dokter c on c.kode_dokter=a.kode_dokter where a.nomr='".$data[$i]['nomr']."' and concat('JAM-', a.no_daftar)='".$data[$i]['no_daftar']."'", 0);
								$farm = $db->queryItem("select a.total from tbl_resepjams_detail a left join tbl_resepjams b on b.no_resep=a.no_resep where concat('JAM-', b.no_daftar)='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
								$farm2 = $db->queryItem("select sum(total) as jml1 from tbl_racikanjams_detail a  left join tbl_racikanjams b on b.id=a.racikanId where concat('JAM-', b.no_daftar)='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
								$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
								
								if ($farm2 > 0) {
									$obat = $farm + $farm2 + $embalase;
								}
								else {
									$obat = $farm;
								}
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['nama']?></td>
							<td><?php echo $pasien[0]['diagnosa']?></td>
							<td><?php echo $pasien[0]['nama_dokter']?></td>
							<td style="text-align: right"><?php echo number_format($pasien[0]['tarif_jamsostek'])?></td>
							<td style="text-align: right"><?php echo number_format($obat)?></td>
						</tr> 
						<?php
								$ttlDok = $ttlDok + $pasien[0]['tarif_jamsostek'];
								$ttlObat = $ttlObat + $obat;
							}
							if ($ttlDok > 0) {
								$totJasa = $ttlSum + $biayaJaga;
								$pajak = $totJasa * 50/100;
						?>
						<tr>
							<th colspan="5" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlDok)?>
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlObat)?>
							</th>
						</tr>
						<tr>
							<th colspan="5" style="text-align: right; font-weight: bold">
								JUMLAH PASIEN
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($no)?>
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