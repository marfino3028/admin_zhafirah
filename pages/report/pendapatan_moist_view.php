    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th rowspan="2" style="width:20px">NO</th> 
							<th rowspan="2" style="width:70px">NO.MR</th> 
							<th rowspan="2">Nama Pasien</th> 
							<th rowspan="2">Tindakan</th> 
							<th style="width:200px" colspan="2">Persentase</th> 
							<th rowspan="2">Obat</th> 
							<th style="width:200px" colspan="2">Persentase</th> 
							<th rowspan="2">Buku</th> 
							<th style="width:200px" colspan="2">Persentase</th> 
						</tr> 
						<tr>
							<th>Moist</th> 
							<th>UPK</th> 
							<th>Moist</th> 
							<th>UPK</th> 
							<th>Moist</th> 
							<th>UPK</th> 
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

							$data = $db->query("select * from tbl_moist where status_delete='UD' and tgl_input_moist >= '$date1' and tgl_input_moist < '$date2'", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $start + $i + 1;
								$tindakan = $db->query("select nama_tindakan, tarif, (tarif * pMoist / 100) as moist, (tarif * pUPK / 100) as UPK from tbl_moist_detail where moistID='".$data[$i]['id']."' and kode_tarif='118'");
								$buku = $db->query("select nama_tindakan, tarif, (tarif * pMoist / 100) as moist, (tarif * pUPK / 100) as UPK from tbl_moist_detail where moistID='".$data[$i]['id']."' and kode_tarif='119'");
								$obat = $db->query("select nama_tindakan, tarif, (tarif * pMoist / 100) as moist, (tarif * pUPK / 100) as UPK from tbl_moist_detail where moistID='".$data[$i]['id']."' and kode_tarif='120'");
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['nama']?></td>
							<td style="text-align: right;"><?php echo number_format($tindakan[0]['tarif'])?></td> 
							<td style="text-align: right;"><?php echo number_format($tindakan[0]['moist'])?></td> 
							<td style="text-align: right;"><?php echo number_format($tindakan[0]['UPK'])?></td> 
							<td style="text-align: right;"><?php echo number_format($obat[0]['tarif'])?></td> 
							<td style="text-align: right;"><?php echo number_format($obat[0]['moist'])?></td> 
							<td style="text-align: right;"><?php echo number_format($obat[0]['UPK'])?></td> 
							<td style="text-align: right;"><?php echo number_format($buku[0]['tarif'])?></td> 
							<td style="text-align: right;"><?php echo number_format($buku[0]['moist'])?></td> 
							<td style="text-align: right;"><?php echo number_format($buku[0]['UPK'])?></td> 
						</tr> 
						<?php
								$ttarif = $ttarif + $tindakan[0]['tarif'];
								$tmoist = $tmoist + $tindakan[0]['moist'];
								$tupk = $tupk + $tindakan[0]['UPK'];
								$otarif = $otarif + $obat[0]['tarif'];
								$omoist = $omoist + $obat[0]['moist'];
								$oupk = $oupk + $obat[0]['UPK'];
								$btarif = $btarif + $buku[0]['tarif'];
								$bmoist = $bmoist + $buku[0]['moist'];
								$bupk = $bupk + $buku[0]['UPK'];
							}
						?>
						<tr style="font-weight: bold; font-size: 12px">
							<th colspan="3" style="text-align: right">Total</th>
							<th style="text-align: right;"><?php echo number_format($ttarif)?></th> 
							<th style="text-align: right;"><?php echo number_format($tmoist)?></th> 
							<th style="text-align: right;"><?php echo number_format($tupk)?></th> 
							<th style="text-align: right;"><?php echo number_format($otarif)?></th> 
							<th style="text-align: right;"><?php echo number_format($omoist)?></th> 
							<th style="text-align: right;"><?php echo number_format($oupk)?></th> 
							<th style="text-align: right;"><?php echo number_format($btarif)?></th> 
							<th style="text-align: right;"><?php echo number_format($bmoist)?></th> 
							<th style="text-align: right;"><?php echo number_format($bupk)?></th> 
						</tr> 
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
<script>
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>