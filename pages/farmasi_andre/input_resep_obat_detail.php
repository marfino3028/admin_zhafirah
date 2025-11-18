<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 1);
	//print_r($_SESSION);

	if ($_SESSION['rg_user'] != '') {
		//input ke tabel detail resep pasien
		$obat = explode('###', $_POST['obat']);
		$obt = $db->query("select * from tbl_obat where kode_obat='$obat[1]'");
		$no_mrNya = $db->queryItem("select nomr from tbl_resep where id='".$_POST['id']."'");
		$kode_pers = $db->queryItem("select kode_perusahaan from tbl_pendaftaran where nomr='$no_mrNya' and status_pasien='OPEN'");
		$naik = $db->queryItem("select harga_up from tbl_perusahaan where kode_perusahaan='$kode_pers'");
		$obt[0]['harga_jual'] = $obt[0]['harga_jual'] + ($obt[0]['harga_jual'] * $naik / 100);
		$insert = $db->query("insert into tbl_resep_detail (resep_id, no_resep, kode_obat, nama_obat, jenis, satuan, qty, harga, total) values ('".$_POST['id']."', '".$_POST['resep']."', '".$obat[1]."', '".$obt[0]['nama_obat']."', '".$obat[0]."', '".$obt[0]['nama_obat']."', '".$_POST['qty']."', '".$obt[0]['harga_jual']."', '$total')", 0);
		$sid = mysql_insert_id();
		$update = $db->query("update tbl_resep_detail set total = qty*harga where id='$sid'");
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
			$data = $db->query("select * from tbl_resep_detail where status_delete='UD' and resep_id='".$_POST['id']."'", 0);
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
		<tr>
			<td colspan="6" style="height: 10px;"><?php echo '<p align="left" style="margin-top: 0px; margin-bottom: 0px; margin-left: 5px; font-weight: bold">Obat Racikan : '.$resep[$j]['nama'].'</p>'?></td>
			<td class="text-center">
				<a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/resep_obatRacikans_delete.php?id=<?php echo $resep[$j]['id'].'&subid='.$_POST['id']?>';">
					<span class="ui-icon ui-icon-circle-close"></span>
				</a>
			</td> 
		</tr>
		<?php
			if (count($data) > 0) {
			$data = $db->query("select * from tbl_racikan_detail where status_delete='UD' and racikanId='".$resep[$j]['id']."'", 0);
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
				<a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/resep_obatRacikan_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_POST['id']?>';">
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
			<td colspan="5">&nbsp;</td>
			<td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($totalRacikan)?></div></td>
		</tr>
		<?php
			}
		?>
		</tbody>
	</table>
	&nbsp;
	<?php
		}
		$data = $db->query("select nomr, no_daftar from tbl_resep where status_delete='UD' and id='".$_POST['id']."'", 0);
		$tindakan = $db->query("select * from tbl_tindakan where no_daftar='".$data[0]['no_daftar']."' and nomr='".$data[0]['nomr']."' and status_delete='UD'", 0);
		if (count($tindakan) > 0) {
			echo '<p align="left" style="margin-top: 10px; margin-left: 5px; font-weight: bold">Daftar Tindakan Medis : </p>';
	?>
	<table id="sort-table" style="margin-bottom: 0px; margin-top: 0px" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
		<thead> 
		<tr>
			<th style="width:20px">No</th> 
			<th>Nama Tindakan</th> 
			<th style="width:40px">Tarif</th> 
			<th style="width:30px">OPT</th> 
		</tr> 
		</thead> 
		<tbody> 
		<?php
			for ($i = 0; $i < count($tindakan); $i++) {
		?>
		<tr>
			<td><?php echo $i+1?></td> 
			<td><?php echo $tindakan[$i]['nama_tindakan']?></td> 
			<td align="right"><div align="right"><?php echo number_format($tindakan[$i]['tarif'])?></div></td> 
			<td class="text-center">
				<a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/obat_tindakan_delete.php?id=<?php echo $tindakan[$i]['id'].'&ids='.$_POST['id']?>';">
					<span class="ui-icon ui-icon-circle-close"></span>
				</a>
			</td> 
		</tr> 
		<?php
					$tTindakan = $tTindakan + $tindakan[$i]['tarif'];
				}
		?>
		<tr>
			<td colspan="2">Sub Total</td>
			<td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($tTindakan)?></div></td>
		</tr>
		</tbody>
	</table>
	&nbsp;
	<?php
		}
	?>
</div>