<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		$data = $db->query("select * from tbl_obat where kode_obat='".$_POST['obat']."'", 0);

		$tgl = date('Y-m-d');
		
		$tgl11 = date('Y-m-01', strtotime($tgl.' - 1 month'));
		$tgl12 = date('Y-m-01', strtotime($tgl.' - 0 month'));
	
		$tgl21 = date('Y-m-01', strtotime($tgl.' - 2 month'));
		$tgl22 = date('Y-m-01', strtotime($tgl.' - 1 month'));
	
		$tgl31 = date('Y-m-01', strtotime($tgl.' - 3 month'));
		$tgl32 = date('Y-m-01', strtotime($tgl.' - 2 month'));
		
		$bln1 = $db->queryItem("select sum(qty) from tbl_resep a left join tbl_resep_detail b on b.resep_id=a.id where a.tgl_input >= '$tgl11' and a.tgl_input < '$tgl12' and b.kode_obat='".$_POST['obat']."'", 0);
		$bln2 = $db->queryItem("select sum(qty) from tbl_resep a left join tbl_resep_detail b on b.resep_id=a.id where a.tgl_input >= '$tgl21' and a.tgl_input < '$tgl22' and b.kode_obat='".$_POST['obat']."'", 0);
		$bln3 = $db->queryItem("select sum(qty) from tbl_resep a left join tbl_resep_detail b on b.resep_id=a.id where a.tgl_input >= '$tgl31' and a.tgl_input < '$tgl32' and b.kode_obat='".$_POST['obat']."'", 0);
		$total = $bln1 + $bln2 + $bln3;
		$rata = $total / 3;
		$qty = ($rata * 1.2) - $data[0]['stock_akhir'];
		$total = $_POST['qty'] * $_POST['harga_beli'];
		
		$insert = $db->query("insert into tbl_ro_detail (roID, no_ro, kode_obat, nama_obat, sat, qty, harga, total, bln1, bln2, bln3, rata, stok_akhir) values ('".$_POST['id']."', '".$_POST['no_ro']."', '".$_POST['obat']."', '".$data[0]['nama_obat']."', '".$data[0]['satuan_besar']."', '".$_POST['qty']."', '".$data[0]['harga_beli']."', '".$total."', '".$bln1."', '".$bln2."', '".$bln3."', '".$rata."', '".$data[0]['stock_akhir']."')", 0);
		$id = mysql_insert_id();
		
		$jmlRequest = $db->queryItem("select sum(qty) from tbl_ro_detail where no_ro='".$_POST['no_ro']."'");
		$update = $db->query("update tbl_ro set total_permintaan='$jmlRequest' where no_ro='".$_POST['no_ro']."'");
	}
?>
<div id="data_pasien">
  <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
	<thead>
	  <tr>
		<th style="width:20px">No</th>
		<th>Nama Obat</th>
		<th style="width:50px">Satuan</th>
		<th style="width:80px">Jml Pesanan</th>
		<th>Harga</th>
		<th>Total Harga</th>
		<th style="width:30px">OPT</th>
	  </tr>
	</thead>
	<tbody>
	  <?php
			$data = $db->query("select * from tbl_ro_detail where status_delete='UD' and roID='".$_POST['id']."'", 0);
			for ($i = 0; $i < count($data); $i++) {
				$total = $data[$i]['harga'] * $data[$i]['qty'];
		?>
	  <tr>
		<td><?php echo $i+1?></td>
		<td><?php echo $data[$i]['nama_obat']?></td>
		<td><?php echo $data[$i]['sat']?></td>
		<td align="right"><div align="right"><?php echo number_format($data[$i]['qty'])?></div></td>
		<td align="right"><div align="right"><?php echo number_format($data[$i]['harga'])?></div></td>
		<td align="right"><div align="right"><?php echo number_format($total)?></div></td>
		<td class="text-center"><a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/inv/ro_detail_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_POST['id']?>';"> <span class="ui-icon ui-icon-circle-close"></span> </a> </td>
	  </tr>
	  <?php
				$tot1 = $tot1 + $data[$i]['qty'];
				$tot2 = $tot2 + $data[$i]['harga'];
				$tot3 = $tot3 + $total;
			}
		?>
	  <tr>
		<td colspan="3" style="font-weight: bold; text-align: right">Grand Total</td>
		<td><div align="right" style="font-weight: bold"><?php echo number_format($tot1)?></div></td>
		<td><div align="right" style="font-weight: bold"><?php echo number_format($tot2)?></div></td>
		<td><div align="right" style="font-weight: bold"><?php echo number_format($tot3)?></div></td>
		<td><div align="right" style="font-weight: bold">&nbsp;</div></td>
	  </tr>
	</tbody>
  </table>
</div>