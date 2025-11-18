<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		//input ke tabel detail resep pasien
		$obat = explode('###', $_POST['obat']);
		$obt = $db->query("select * from tbl_obat where kode_obat='$obat[1]'");
		$insert = $db->query("insert into tbl_penjualan_obat_detail (penjualan_id, no_penjualan, kode_obat, nama_obat, jenis, satuan, qty, harga, total) values ('".$_POST['id']."', '".$_POST['jual']."', '".$obat[1]."', '".$obt[0]['nama_obat']."', '".$obat[0]."', '".$obt[0]['satuan_terkecil']."', '".$_POST['qty']."', '".$obt[0]['harga_jual']."', '$total')", 0);
		$sid = mysql_insert_id();
		$update = $db->query("update tbl_penjualan_obat_detail set total = qty*harga where id='$sid'");
		$total_harga = $db->queryItem("select sum(total) from tbl_penjualan_obat_detail where no_penjualan='".$_POST['jual']."' and status_delete='UD'");
		$update = $db->query("update tbl_penjualan_obat set total_harga='".$total_harga."' where no_penjualan='".$_POST['jual']."'");
	}
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
			<th style="width:30px">OPT</th> 
		</tr> 
		</thead> 
		<tbody> 
		<?php
			$data = $db->query("select * from tbl_penjualan_obat_detail where status_delete='UD' and penjualan_id='".$_POST['id']."'", 0);
			for ($i = 0; $i < count($data); $i++) {
				$satuan = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
		?>
		<tr>
			<td><?php echo $i+1?></td> 
			<td><?php echo $data[$i]['nama_obat']?></td> 
			<td><?php echo $satuan?></td> 
			<td><?php echo $data[$i]['qty']?></td>
			<td align="right"><div align="right"><?php echo number_format($data[$i]['harga'])?></div></td> 
			<td class="text-center">
				<a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/resep_obat_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_POST['id']?>';">
					<span class="ui-icon ui-icon-circle-close"></span>
				</a>
			</td> 
		</tr> 
		<?php
				$sbttl = $sbttl + $data[$i]['total'];
			}
		?>
		<tr>
			<td colspan="5"><div align="right" style="font-weight: bold"><?php echo number_format($sbttl)?></div></td>
			<td>&nbsp;</td>
		</tr>
		</tbody>
	</table>
	<?php
		$resep = $db->query("select * from tbl_racikan where no_resep='".$data[0]['no_resep']."' and status_delete='UD'", 0);
		for ($j = 0; $j < count($resep); $j++) {
			$data = $db->query("select * from tbl_racikan_detail where status_delete='UD' and racikanId='".$resep[$j]['id']."'", 0);
			
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
	</table>
	&nbsp;
	<?php
		}
	?>
</div>