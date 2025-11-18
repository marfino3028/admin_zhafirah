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
							<th>Nama Obat</th> 
							<th>Satuan</th> 
							<th style="width:30px">Qty</th> 
							<th>Harga Jual</th> 
							<th style="width:150px">Total</th> 
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
							//$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;

							$data = $db->query("select a.kode_obat, sum(a.qty) jml_qty, sum(a.total) jml_total from tbl_resep_detail a left join tbl_resep b on b.id = a.resep_id where b.tgl_insert >= '$date1' and b.tgl_insert < '$date2' and b.status_delete='UD' and a.status_delete='UD' group by a.kode_obat", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $no + 1;
								$obat = $db->query("select nama_obat, satuan_terkecil, harga_jual from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['kode_obat'].' - '.$obat[0]['nama_obat']?></td>
							<td style="text-align: left;"><?php echo $obat[0]['satuan_terkecil']?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['jml_qty'])?></td> 
							<td style="text-align: right;"><?php echo number_format($obat[0]['harga_jual'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['jml_total'])?></td> 
						</tr> 
						<?php
								$tot_all = $tot_all + $data[$i]['jml_total'];
							}
							
							$data = $db->query("select a.kode_obat, sum(a.qty) jml_qty, sum(a.total) jml_total from tbl_racikan_detail a left join tbl_racikan b on b.id=a.racikanId where b.no_resep in (select no_resep from tbl_resep where tgl_insert >= '$date1' and tgl_insert < '$date2' and status_delete='UD') and a.status_delete='UD' group by a.kode_obat", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $no + 1;
								$obat = $db->query("select nama_obat, satuan_terkecil, harga_jual from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo 'Racikan - '.$data[$i]['kode_obat'].' - '.$obat[0]['nama_obat']?></td>
							<td style="text-align: left;"><?php echo $obat[0]['satuan_terkecil']?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['jml_qty'])?></td> 
							<td style="text-align: right;"><?php echo number_format($obat[0]['harga_jual'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['jml_total'])?></td> 
						</tr> 
						<?php
								$tot_all = $tot_all + $data[$i]['jml_total'];
							}

							//Penjualan Langsung
							$dl = $db->query("select * from tbl_penjualan_obat where tgl_input >= '$date1' and tgl_input < '$date2' and status_delete='UD' and status_kwitansi='CLOSED'", 0);
							for ($ii = 0; $ii < count($dl); $ii++) {
								$no = $no + 1;
								$dl[$ii]['total_racikan'] = $db->queryItem("select sum(total) from tbl_penjualan_obat_detail where no_penjualan='".$dl[$ii]['no_penjualan']."' and jenis='R'");
								$total = $dl[$ii]['total_harga'] + $dl[$ii]['total_racikan'];
								$tot_all = $tot_all + $total;
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $dl[$ii]['nama']?></td>
							<td>PRIBADI/LANGSUNG</td>
							<td style="text-align: right;"><?php echo number_format($dl[$ii]['total_harga'])?></td> 
							<td style="text-align: right;"><?php echo number_format($dl[$ii]['total_racikan'])?></td> 
							<td style="text-align: right;"><?php echo number_format($total)?></td> 
						</tr> 
						<?php	
							}
							
							//Poli Karyawan
							$pkyn = $db->query("select * from tbl_polkar where tgl_bayar >= '$date1' and tgl_bayar < '$date2' and status_delete='UD'", 0);
							for ($i = 0; $i < count($pkyn); $i++) {
						?>
						<tr>
							<td>PRIBADI/POLKAR</td>
							<td style="text-align: right;"><?php echo number_format($pkyn[$i]['total_harga_polkar'])?></td> 
							<td style="text-align: right;"><?php echo number_format($pkyn[$i]['total_racikan'])?></td> 
							<td style="text-align: right;"><?php echo number_format($total)?></td> 
						</tr> 
						<?php	
							}
						?>
						<tr style="background-color:">
							<th colspan="5" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($tot_all)?>
							</th>
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