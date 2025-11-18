<p style="margin-left: 15px; font-size: 14px; margin-top: 0px; margin-bottom: 5px; font-weight: bold">
Detail dari Obat yang Dipilih</p>
<div class="hastable box box-content nopadding" align="center" style="margin-left: 10px; margin-right: 10px; width: 98%">
	<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
		<thead> 
		<tr>
			<th>Nama Obat</th> 
			<th style="width:70px">Stock Awal</th> 
			<th style="width:70px">Stock Akhir Gudang</th> 
			<th style="width:70px">Stock Min</th> 
			<th style="width:80px">Harga</th> 
		</tr> 
		</thead> 
		<tbody> 
		<?php
			date_default_timezone_set("Asia/Bangkok");
			include "../../3rdparty/engine.php";
			$data = $db->query("select * from tbl_obat where kode_obat='".$_POST['kode']."'", 0);
		?>
		<tr>
			<td><?php echo $data[0]['nama_obat']?></td> 
			<td><?php echo $data[0]['stock_awal']?></td> 
			<td><?php echo $data[0]['stock_akhir']?></td>
			<td><?php echo $data[0]['stock_min_gudang']?></td>
			<td align="right"><div align="right"><?php echo number_format($data[0]['harga_beli'])?></div></td> 
		</tr> 
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<?php
			$tgl = date('Y-m-d');
			$tgl11 = date('Y-m-01', strtotime($tgl.' - 1 month'));
			$tgl12 = date('Y-m-01', strtotime($tgl.' - 0 month'));
			$bulan1 = date("M", strtotime($tgl.' - 1 month'));
		
			$tgl21 = date('Y-m-01', strtotime($tgl.' - 2 month'));
			$tgl22 = date('Y-m-01', strtotime($tgl.' - 1 month'));
			$bulan2 = date("M", strtotime($tgl.' - 2 month'));
		
			$tgl31 = date('Y-m-01', strtotime($tgl.' - 3 month'));
			$tgl32 = date('Y-m-01', strtotime($tgl.' - 2 month'));
			$bulan3 = date("M", strtotime($tgl.' - 3 month'));
			
			$bln1 = $db->queryItem("select sum(qty) from tbl_resep a left join tbl_resep_detail b on b.resep_id=a.id where a.tgl_input >= '$tgl11' and a.tgl_input < '$tgl12' and b.kode_obat='".$_POST['kode']."'", 0);
			$bln2 = $db->queryItem("select sum(qty) from tbl_resep a left join tbl_resep_detail b on b.resep_id=a.id where a.tgl_input >= '$tgl21' and a.tgl_input < '$tgl22' and b.kode_obat='".$_POST['kode']."'", 0);
			$bln3 = $db->queryItem("select sum(qty) from tbl_resep a left join tbl_resep_detail b on b.resep_id=a.id where a.tgl_input >= '$tgl31' and a.tgl_input < '$tgl32' and b.kode_obat='".$_POST['kode']."'", 0);
			$total = $bln1 + $bln2 + $bln3;
			$rata = $total / 3;
			$qty = ($rata * 1.2) - $data[0]['stock_akhir'];
		?>
		</tbody>
		<tr>
			<td colspan="5" style="font-weight: bold">
				Pemakaian 3 Bulan Terakhir
			</td>
		</tr>
		<thead>
		<tr>
			<th>&nbsp;</th> 
			<th style="width:70px"><?php echo $bulan3?></th> 
			<th style="width:70px"><?php echo $bulan2?></th> 
			<th style="width:70px"><?php echo $bulan1?></th> 
			<th style="width:80px">Rata-Rata</th> 
		</tr>
		</thead>
		<tbody>
		<tr>
			<td style="text-align: right">Nilai</td> 
			<td style="text-align: right"><?php echo number_format($bln3)?></td> 
			<td style="text-align: right"><?php echo number_format($bln2)?></td> 
			<td style="text-align: right"><?php echo number_format($bln1)?></td> 
			<td style="text-align: right"><?php echo number_format($rata)?></td> 
		</tr> 
		</tbody>
	</table>
</div>
