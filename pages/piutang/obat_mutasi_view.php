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
							<th style="width:70px">KODE</th> 
							<th>NAMA OBAT</th> 
							<th style="width:70px">QTY</th> 
							<th style="width:70px">HARGA JUAL</th> 
							<th style="width:70px">HARGA BELI</th> 
							<th style="width:70px">LABA</th> 
							<th style="width:70px">HPP</th> 
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

							$data = $db->query("select kode_obat, nama_obat, sum(qty) as qtys, harga_jual, harga_beli from lap_hpp where tgl_bayar >= '$date1' and tgl_bayar < '$date2' and metode_payment='".$_POST['metode']."' group by kode_obat", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$laba = $data[$i]['harga_jual'] - $data[$i]['harga_beli'];
								$hpp = $data[$i]['harga_beli'] * $data[$i]['qtys'];
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['kode_obat']?></td> 
							<td><?php echo $data[$i]['nama_obat']?></td> 
							<td style="text-align: right"><?php echo $data[$i]['qtys']?></td>
							<td style="text-align: right"><?php echo number_format($data[$i]['harga_jual'])?></td>
							<td style="text-align: right"><?php echo number_format($data[$i]['harga_beli'])?></td>
							<td style="text-align: right"><?php echo number_format($laba)?></td>
							<td style="text-align: right"><?php echo number_format($hpp)?></td>
						</tr> 
						<?php
								$ttllaba = $ttllaba + $laba;
								$ttlhpp = $ttlhpp + $hpp;
							}
							if ($ttlhpp > 0) {
						?>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttllaba)?>
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlhpp)?>
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