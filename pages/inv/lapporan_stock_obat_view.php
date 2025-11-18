    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th rowspan="2" style="width:40px">NO</th> 
							<th rowspan="2">NAMA OBAT</th> 
							<th rowspan="2" style="width:50px">JML/<br />BOX</th> 
							<th rowspan="2" style="width:50px">HARGA/<br />BOX</th> 
							<th colspan="2" style="width:120px">HARGA</th> 
							<th colspan="7" style="width:440px">GUDANG</th> 
						</tr> 
						<tr>
							<th style="width:60px">BELI</th> 
							<th style="width:60px">JUAL</th> 
							<th style="width:60px">STOCK AWAL</th> 
							<th style="width:60px">OBAT MASUK</th> 
							<th style="width:60px">OBAT KELUAR</th> 
							<th style="width:60px">STOCK AKHIR</th> 
							<th style="width:60px">STOCK FISIK</th> 
							<th style="width:60px">SELISIH</th> 
							<th style="width:80px">PERSEDIAAN</th> 
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
							$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;

							$data = $db->query("select * from tbl_obat where status_delete='UD' order by nama_obat", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$data[$i]['stok_awal'] = $db->queryItem("select nilai from tbl_stock_awal where kode_obat='".$data[$i]['kode_obat']."' and bulan='".$_POST['bulan']."' and tahun='".$_POST['tahun']."'");
								$data[$i]['obat_masuk'] = $db->queryItem("select sum(a.qty) from tbl_penerimaan_detail a left join tbl_penerimaan b on b.no_penerimaan=a.no_penerimaan where b.status_delete='UD' and MONTH(b.tgl_insert)='".$_POST['bulan']."' and YEAR(b.tgl_insert)='".$_POST['tahun']."' and a.kode_obat='".$data[$i]['kode_obat']."'");
								$data[$i]['obat_keluar'] = '-';
								$data[$i]['stock_fisik'] = '-';
								$data[$i]['selisih'] = $data[$i]['stock_akhir'] - $data[$i]['stock_fisik'];
								$data[$i]['persediaan'] = $data[$i]['stock_fisik'] * $data[$i]['harga_beli'];
						?>
						<tr>
							<td style="text-align: center;"><?php echo $no?></td> 
							<td><?php echo $data[$i]['nama_obat'].' - '.$data[$i]['kode_obat']?></td>
							<td style="text-align: right;"><?php echo number_format($data[$i]['jml_per_box'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['harga_per_box'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['harga_beli'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['harga_jual'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['stok_awal'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['obat_masuk'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['obat_keluar'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['stock_akhir'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['stock_akhir'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['selisih'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['persediaan'])?></td> 
						</tr> 
						<?php
								$ttlSum = $ttlSum + $total;
								$TotalbiayaDokter = $TotalbiayaDokter + $biayaDokter;
								$TotalbiayaTindakan = $TotalbiayaTindakan + $biayaTindakan;
							}
						?>
						<tr>
							<td colspan="2" style="text-align: right; font-weight: bold">SUB TOTAL</td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaDokter)?></td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaTindakan)?></td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaLab)?></td> 
							<td style="text-align: right;"><?php echo number_format($TotalbiayaFis)?></td> 
							<td style="text-align: right;"><?php echo number_format($Totaltotal)?></td> 
							<td style="text-align: right;"><?php echo number_format($Totaltotal)?></td> 
							<td style="text-align: right;"><?php echo number_format($Totaltotal)?></td> 
							<td style="text-align: right;"><?php echo number_format($Totaltotal)?></td> 
							<td style="text-align: right;"><?php echo number_format($Totaltotal)?></td> 
							<td style="text-align: right;"><?php echo number_format($Totaltotal)?></td> 
							<td style="text-align: right;"><?php echo number_format($Totaltotal)?></td> 
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
