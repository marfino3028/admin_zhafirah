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
							<th style="width:80px">No. Invoice</th> 
							<th>Nama Perusahaan</th> 
							<th style="width:60px">Jatuh Tempo</th> 
							<th style="width:60px">Tgl Bayar</th> 
							<th style="width:120px">TOTAL PAYMENT</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							include "../../3rdparty/engine.php";
							ini_set("display_errors", 0);
							$t1 = explode("/", $_POST['d1']);
							$t2 = explode("/", $_POST['d2']);
							$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1];
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2]));
							$data = $db->query("select * from tbl_invoice where tgl_jatuh_tempo >= '$date1' and tgl_jatuh_tempo < '$date2' and status_bayar='".$_POST['st']."'", 0);

							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['no_inv']?></td> 
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td><?php echo date("d-m-Y", strtotime($data[$i]['tgl_jatuh_tempo']))?></td>
							<td><?php echo date("d-m-Y", strtotime($data[$i]['tgl_bayar']))?></td>
							<td style="text-align: right;"><?php echo number_format($data[$i]['total'])?></td> 
						</tr> 
						<?php
								$ttlSum = $ttlSum + $data[$i]['total'];
							}
							if ($ttlSum > 0) {
								$totJasa = $ttlSum + $biayaJaga;
								$pajak = $totJasa * 50/100;
						?>
						<tr>
							<th colspan="5" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlSum)?>
							</th>
						</tr>
						<?php	
							}
							else {
						?>
						<tr>
							<th colspan="6" style="text-align: center; font-weight: bold">
								Tidak Ada Data Untuk Periode Tersebut
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
    // $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>