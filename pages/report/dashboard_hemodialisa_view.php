    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th style="width:20px">No</th> 
							<th>Obat/Alkes</th> 
							<th>Satuan</th> 
							<th>Stock Awal</th> 
							<th>Stock Masuk</th> 
							<th>Stock Keluar</th> 
							<th>Stock Akhir</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							include "../../3rdparty/engine.php";
							ini_set("display_errors", 0);

							//Nilai Tutup Pendapatan Harian
							$date1 = $_POST['d1'];
							$date2 = $_POST['d2'];

							//$data = $db->query("select * from tbl_fisio where tgl_insert >= '$date1' and tgl_insert < '$date2' and status_delete='UD'", 0);
							$data = $db->query("select kode_obat, sum(qty) jumlah from tbl_medication_detail where tgl_insert >= '$date1' and tgl_insert < '$date2' group by kode_obat", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$obat = $db->query("select * from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
								$obat[0]['stock_masuk'] = $obat[0]['stock_akhir'];
								$obat[0]['stock_akhir'] = $obat[0]['stock_masuk'] - $data[$i]['jumlah'];
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $obat[0]['nama_obat']?></td> 
							<td><?php echo $obat[0]['satuan_terkecil']?></td> 
							<td style="text-align: right;"><?php echo number_format($obat[0]['stock_awal'])?></td> 
							<td style="text-align: right;"><?php echo $obat[0]['stock_masuk']?></td> 
							<td style="text-align: right;"><?php echo $data[$i]['jumlah']?></td> 
							<td style="text-align: right;"><?php echo $obat[0]['stock_akhir']?></td> 
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