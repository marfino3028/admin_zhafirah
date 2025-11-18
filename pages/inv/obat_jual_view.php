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
							<th style="width:90px">NO.RESEP</th> 
							<th style="width:70px">KODE</th> 
							<th>NAMA OBAT</th> 
							<th style="width:70px">QTY</th> 
							<th style="width:70px">HARGA JUAL</th> 
							<th style="width:70px">TOTAL</th> 
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

							$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
							$date1a = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
							$date2a = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;

							if ($_POST['metode'] == 'ALL') {
								$data = $db->query("select no_resep, kode_obat, nama_obat, sum(qty) as qtys, harga_jual, harga_beli from lap_hpp where tgl_bayar >= '$date1' and tgl_bayar < '$date2' and metode_payment IN ('CASH', 'ASS', 'CC', 'DEBIT') group by kode_obat", 0);
							}
							else {
								$data = $db->query("select no_resep, kode_obat, nama_obat, sum(qty) as qtys, harga_jual, harga_beli from lap_hpp where tgl_bayar >= '$date1' and tgl_bayar < '$date2' and metode_payment='".$_POST['metode']."' group by kode_obat", 0);
							}
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$laba = $data[$i]['harga_jual'] - $data[$i]['harga_beli'];
								$hpp = $data[$i]['harga_beli'] * $data[$i]['qtys'];
								$data[$i]['total_jual'] = $data[$i]['harga_jual'] * $data[$i]['qtys'];
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['no_resep']?></td> 
							<td><?php echo $data[$i]['kode_obat']?></td> 
							<td><?php echo $data[$i]['nama_obat']?></td> 
							<td style="text-align: right"><?php echo $data[$i]['qtys']?></td>
							<td style="text-align: right"><?php echo number_format($data[$i]['harga_jual'])?></td>
							<td style="text-align: right"><?php echo number_format($data[$i]['total_jual'])?></td>
							<td style="text-align: right"><?php echo number_format($data[$i]['harga_beli'])?></td>
							<td style="text-align: right"><?php echo number_format($laba)?></td>
							<td style="text-align: right"><?php echo number_format($hpp)?></td>
						</tr> 
						<?php
								$ttllaba = $ttllaba + $laba;
								$ttlhpp = $ttlhpp + $hpp;
								$tjual = $tjual + $data[$i]['total_jual'];
							}
							
							//Obat Racikan
							//echo $date1a.' dan '.$date2a;
							if ($_POST['metode'] == 'ALL') {
								$data = $db->query("select d.racikanId, d.kode_obat, d.nama_obat, d.qty as qtys, e.harga_jual, (d.qty*e.harga_jual) as total_jual, e.harga_beli FROM tbl_racikan_detail d left join tbl_obat e on e.kode_obat=d.kode_obat where d.status_delete='UD' and racikanId in (select  id from (select a.no_resep, c.id FROM tbl_resep a left join tbl_racikan c on c.no_resep=a.no_resep left join tbl_kasir b on b.no_daftar=a.no_daftar where b.tgl_insert >= '".$date1a."' and b.tgl_insert < '".$date2a."' and b.metode_payment IN ('CASH', 'ASS', 'CC', 'DEBIT')) d where id > 0)");
							}
							else {
								$data = $db->query("select d.racikanId, d.kode_obat, d.nama_obat, d.qty as qtys, e.harga_jual, (d.qty*e.harga_jual) as total_jual, e.harga_beli FROM tbl_racikan_detail d left join tbl_obat e on e.kode_obat=d.kode_obat where d.status_delete='UD' and racikanId in (select  id from (select a.no_resep, c.id FROM tbl_resep a left join tbl_racikan c on c.no_resep=a.no_resep left join tbl_kasir b on b.no_daftar=a.no_daftar where b.tgl_insert >= '".$date1a."' and b.tgl_insert < '".$date2a."' and b.metode_payment='".$_POST['metode']."') d where id > 0)");
							}
							for ($i = 0; $i < count($data); $i++) {
								$no = $no + 1;
								$j = $i - 1;
								$laba = $data[$i]['harga_jual'] - $data[$i]['harga_beli'];
								$hpp = $data[$i]['harga_beli'] * $data[$i]['qtys'];
								$data[$i]['no_resep'] = $db->queryItem("select no_resep from tbl_racikan where id='".$data[$i]['racikanId']."'");
								if ($data[$i]['racikanId'] != $data[$j]['racikanId']) {
									$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
						?>
						<tr bgcolor="#999999">
							<td>&nbsp;</td> 
							<td colspan="3">Embalase untuk No. Resep <?php echo $data[$i]['no_resep']?></td> 
							<td style="text-align: right">1</td>
							<td style="text-align: right"><?php echo number_format($embalase)?></td>
							<td style="text-align: right"><?php echo number_format($embalase)?></td>
							<td style="text-align: right">&nbsp;</td>
							<td style="text-align: right">&nbsp;</td>
							<td style="text-align: right">&nbsp;</td>
						</tr> 
						<?php
									$tjual = $tjual + 2000;
								}
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['no_resep']?></td> 
							<td><?php echo $data[$i]['kode_obat']?></td> 
							<td><?php echo $data[$i]['nama_obat'].' / RACIKAN'?></td> 
							<td style="text-align: right"><?php echo $data[$i]['qtys']?></td>
							<td style="text-align: right"><?php echo number_format($data[$i]['harga_jual'])?></td>
							<td style="text-align: right"><?php echo number_format($data[$i]['total_jual'])?></td>
							<td style="text-align: right"><?php echo number_format($data[$i]['harga_beli'])?></td>
							<td style="text-align: right"><?php echo number_format($laba)?></td>
							<td style="text-align: right"><?php echo number_format($hpp)?></td>
						</tr> 
						<?php	
								$ttllaba = $ttllaba + $laba;
								$ttlhpp = $ttlhpp + $hpp;
								$tjual = $tjual + $data[$i]['total_jual'];
							}
							
							//Obat Jual Langsung
							$data = $db->query("select b.no_penjualan, a.kode_obat, a.nama_obat, a.qty as qtys, c.harga_jual, c.harga_beli, (a.qty*c.harga_jual) as total_jual from tbl_penjualan_obat_detail a left join tbl_penjualan_obat b on b.id=a.penjualan_id left join tbl_obat c on c.kode_obat=a.kode_obat where b.tgl_input >= '$date1' and b.tgl_input < '$date2' and b.status_delete='UD' and status_kwitansi='CLOSED' and a.status_delete='UD'", 0);
							
							for ($i = 0; $i < count($data); $i++) {
								$no = $no + 1;
								$laba = $data[$i]['harga_jual'] - $data[$i]['harga_beli'];
								$hpp = $data[$i]['harga_beli'] * $data[$i]['qtys'];
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['no_penjualan']?></td> 
							<td><?php echo $data[$i]['kode_obat']?></td> 
							<td><?php echo $data[$i]['nama_obat'].' / LANGSUNG'?></td> 
							<td style="text-align: right"><?php echo $data[$i]['qtys']?></td>
							<td style="text-align: right"><?php echo number_format($data[$i]['harga_jual'])?></td>
							<td style="text-align: right"><?php echo number_format($data[$i]['total_jual'])?></td>
							<td style="text-align: right"><?php echo number_format($data[$i]['harga_beli'])?></td>
							<td style="text-align: right"><?php echo number_format($laba)?></td>
							<td style="text-align: right"><?php echo number_format($hpp)?></td>
						</tr> 
						<?php	
								$ttllaba = $ttllaba + $laba;
								$ttlhpp = $ttlhpp + $hpp;
								$tjual = $tjual + $data[$i]['total_jual'];
							}

							if ($ttlhpp > 0) {
						?>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($tjual)?>
							</th>
							<th style="text-align: right; font-weight: bold">&nbsp;</th>
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