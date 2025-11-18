<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	$obt = $db->query("select nama_obat, harga_jual from tbl_obat where kode_obat='".$_POST['obat']."'");
	$total = $obt[0]['harga_jual'] * $_POST['qty'];
	$insert = $db->query("insert into tbl_penjualan_obat_detail (racikan_id, penjualan_id, no_penjualan, kode_obat, nama_obat, qty, harga, total, jenis, satuan) values ('".$_POST['racikan']."', '".$_POST['id']."', '".$_POST['resep']."', '".$_POST['obat']."', '".$obt[0]['nama_obat']."', '".$_POST['qty']."', '".$obt[0]['harga_jual']."', '".$total."', 'R', '".$obt[0]['satuan_terkecil']."')", 0);
?>

<div id="data_pasien">
	
	<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
		<thead> 
		<tr>
			<th style="width:20px">No</th> 
			<th>Nama Obat</th> 
			<th style="width:30px">Sat</th> 
			<th style="width:30px">QTY</th> 
			<th style="width:40px">Harga</th> 
			<th style="width:40px">Total</th> 
			<th style="width:30px">OPT</th> 
		</tr> 
		</thead> 
		<tbody> 
		<?php
			 $data = $db->query("select * from  tbl_penjualan_obat_detail where status_delete='UD' and jenis='NR' and penjualan_id='".$_POST['id']."'", 0);
			for ($i = 0; $i < count($data); $i++) {
				$satuan = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
		?>
		<tr>
			<td><?php echo $i+1?></td> 
			<td><?php echo $data[$i]['nama_obat']?></td> 
			<td><?php echo $satuan?></td> 
			<td><?php echo $data[$i]['qty']?></td>
			<td align="right"><div align="right"><?php echo number_format($data[$i]['harga'])?></div></td> 
			<td align="right"><div align="right"><?php echo number_format($data[$i]['total'])?></div></td> 
			<td class="text-center">
				<a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/obat_delete.php?id=<?php echo $data[$i]['id']?>';">
					<span class="ui-icon ui-icon-circle-close"></span>
				</a>
			</td> 
		</tr> 
		<?php
				$sbttl = $sbttl + $data[$i]['total'];
			}
		?>
		<tr>
			<td colspan="5">Sub Total</td>
			<td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($sbttl)?></div></td>
		</tr>
		</tbody>
	</table>
	<?php
		$resep = $db->query("select * from  tbl_penjualan_obat_racikan where no_penjualan='".$_POST['resep']."' and status_delete='UD'", 0);
		for ($j = 0; $j < count($resep); $j++) {
			$data = $db->query("select * from tbl_penjualan_obat_detail where status_delete='UD' and jenis='R' and racikan_id='".$resep[$j]['id']."'", 0);
			echo '<p align="left" style="margin-top: 10px; margin-left: 5px; font-weight: bold">Obat Racikan : '.$resep[$j]['nama'].'</p>';
			if (count($data) > 0) {
	?>
	<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
		<thead> 
		<tr>
			<th style="width:20px">No</th> 
			<th>Nama Obat</th> 
			<th style="width:30px">Sat</th> 
			<th style="width:30px">QTY</th> 
			<th style="width:40px">Harga</th> 
			<th style="width:40px">Total</th> 
			<th style="width:30px">OPT</th> 
		</tr> 
		</thead> 
		<tbody> 
		<?php
			for ($i = 0; $i < count($data); $i++) {
				$satuan = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
		?>
		<tr>
			<td><?php echo $i+1?></td> 
			<td><?php echo $data[$i]['nama_obat']?></td> 
			<td><?php echo $satuan?></td> 
			<td><?php echo $data[$i]['qty']?></td>
			<td align="right"><div align="right"><?php echo number_format($data[$i]['harga'])?></div></td> 
			<td align="right"><div align="right"><?php echo number_format($data[$i]['total'])?></div></td> 
			<td class="text-center">
				<a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/jual_obatRacikan_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$data[$i]['penjualan_id']?>';">
					<span class="ui-icon ui-icon-circle-close"></span>
				</a>
			</td> 
		</tr> 
		<?php
					$sbttl2[$j] = $sbttl2[$j] + $data[$i]['total'];
				}
				$tambahan = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
				$totalRacikan = $tambahan + $sbttl2[$j];
		?>
		<tr>
			<td colspan="5">Sub Total</td>
			<td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($totalRacikan)?></div></td>
		</tr>
		</tbody>
	</table>
	<?php
			}
		}
	?>
</div>