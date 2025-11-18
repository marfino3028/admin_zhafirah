<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	$obt = $db->queryItem("select nama_pelayanan from tbl_tarif where kode_tarif='".$_POST['obat']."' and kode_jns_tarif='2'", 0);
	$resepS = $db->query("select nomr, no_daftar from tbl_resep where no_resep='".$_POST['resep']."'");
	$totTarif = $_POST['tarif'] * $_POST['qty'];
	$insert = $db->query("insert into tbl_tindakan (no_daftar, nomr, kode_tarif, nama_tindakan, tarif_asli, tarif, qty) values ('".$resepS[0]['no_daftar']."', '".$resepS[0]['nomr']."', '".$_POST['obat']."', '".$obt."', '".$_POST['tarif']."', '".$totTarif."', '".$_POST['qty']."')", 0);

	//masukkan ke jurnal
	$no_daftar = $resepS[0]['no_daftar'];
		$dataUmum = $db->query("select a.nomr, b.nm_pasien, a.kode_perusahaan, a.nama_perusahaan, a.kode_dokter, a.kd_poli from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$no_daftar."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
		$no_do = $db->query("select no_dokumen_nr from tbl_jurnal order by no_dokumen_nr desc");
		$nodok = $no_do[0]['no_dokumen_nr'] + 1;
		if ($nodok < 10) $nodokumen = '00000'.$nodok;
		elseif ($nodok >= 10 and $nodok < 100) $nodokumen = '0000'.$nodok;
		elseif ($nodok >= 100 and $nodok < 1000) $nodokumen = '000'.$nodok;
		elseif ($nodok >= 1000 and $nodok < 10000) $nodokumen = '00'.$nodok;
		elseif ($nodok >= 10000 and $nodok < 100000) $nodokumen = '0'.$nodok;
		elseif ($nodok >= 100000 and $nodok < 1000000) $nodokumen = $nodok;
		$no_dokumen = date("y-m-d-").$nodokumen;
		$no_dokumen_nr = $nodokumen * 1;
		$tanggal = date("Y-m-d");
		$statuss = 'NOT POSTED';
		$tipe_dokumen = 'Patient UnBill';
		$petugas = $_SESSION['rg_user'];
		$mata_uang = 'Rupiah';
		$rate = 1;
		$supplier = '';
		$pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$resepS[0]['nomr']."'");
		$dokter = $db->query("select nama_dokter, tarif_dokter from tbl_dokter where kode_dokter='".$dataUmum[0]['kode_dokter']."'");
		$keterangan = 'Patient Transaction:  No. Reg.'.$no_daftar.', Konsultasi Dokter: ['.$dokter[0]['nama_dokter'].'] PS: '.$pasien[0]['nm_pasien'];
		$deskripsi = 'Tidakan Medis ['.$obt.'] PS: '.$pasien[0]['nm_pasien'];
		$dtarif = $db->query("select * from tbl_poli where kd_poli='".$dataUmum[0]['kd_poli']."'");
		$reg_no = $no_daftar;
		$cost_center_kode = $dtarif[0]['kd_profit'];
		$cost_center_nama = $dtarif[0]['nm_profit'];
		$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='11030106'");
		$gl_kode = $coa[0]['kd_coa'];
		$gl_nama = $coa[0]['nm_coa'];
		if ($coa[0]['default_pos'] == 'Debit') {
			$debit = $totTarif;
			$kredit = 0;
		)
		elseif ($coa[0]['default_pos'] == 'Credit') {
			$debit = 0;
			$kredit = $totTarif;
		)

		$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

		$deskripsi = 'Tidakan Keperawatan ['.$obt.'] PS: '.$pasien[0]['nm_pasien'];
		$dtarif = $db->query("select * from tbl_poli where kd_poli='".$dataUmum[0]['kd_poli']."'");
		$reg_no = $no_daftar;
		$cost_center_kode = $dtarif[0]['kd_profit'];
		$cost_center_nama = $dtarif[0]['nm_profit'];
		$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='41010106'");
		$gl_kode = $coa[0]['kd_coa'];
		$gl_nama = $coa[0]['nm_coa'];
		if ($coa[0]['default_pos'] == 'Debit') {
			$debit = $totTarif;
			$kredit = 0;
		)
		elseif ($coa[0]['default_pos'] == 'Credit') {
			$debit = 0;
			$kredit = $totTarif;
		)

		$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

		$deskripsi = 'Tidakan Keperawatan ['.$obt.'] PS: '.$pasien[0]['nm_pasien'];
		$dtarif = $db->query("select * from tbl_poli where kd_poli='".$dataUmum[0]['kd_poli']."'");
		$reg_no = $no_daftar;
		$cost_center_kode = $dtarif[0]['kd_profit'];
		$cost_center_nama = $dtarif[0]['nm_profit'];
		$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='51010105'");
		$gl_kode = $coa[0]['kd_coa'];
		$gl_nama = $coa[0]['nm_coa'];
		if ($coa[0]['default_pos'] == 'Debit') {
			$debit = $totTarif;
			$kredit = 0;
		)
		elseif ($coa[0]['default_pos'] == 'Credit') {
			$debit = 0;
			$kredit = $totTarif;
		)

		$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

		$deskripsi = 'Tidakan Keperawatan ['.$obt.'] PS: '.$pasien[0]['nm_pasien'];
		$dtarif = $db->query("select * from tbl_poli where kd_poli='".$dataUmum[0]['kd_poli']."'");
		$reg_no = $no_daftar;
		$cost_center_kode = $dtarif[0]['kd_profit'];
		$cost_center_nama = $dtarif[0]['nm_profit'];
		$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='21020013'");
		$gl_kode = $coa[0]['kd_coa'];
		$gl_nama = $coa[0]['nm_coa'];
		if ($coa[0]['default_pos'] == 'Debit') {
			$debit = $totTarif;
			$kredit = 0;
		)
		elseif ($coa[0]['default_pos'] == 'Credit') {
			$debit = 0;
			$kredit = $totTarif;
		)

		$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

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
		$resep = $db->query("select * from tbl_racikan where no_resep='".$_POST['resep']."' and status_delete='UD'", 0);
		for ($j = 0; $j < count($resep); $j++) {
			$data = $db->query("select * from tbl_racikan_detail where status_delete='UD' and racikanId='".$resep[$j]['id']."'", 0);
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
				<a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/obat_delete.php?id=<?php echo $data[$i]['id']?>';">
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

		$tindakan = $db->query("select * from tbl_tindakan where no_daftar='".$resepS[0]['no_daftar']."' and nomr='".$resepS[0]['nomr']."' and status_delete='UD'", 0);
		if (count($tindakan) > 0) {
			echo '<p align="left" style="margin-top: 10px; margin-left: 5px; font-weight: bold">Daftar Tindakan Medis : </p>';
	?>
	<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
		<thead> 
		<tr>
			<th style="width:20px">No</th> 
			<th>Nama Tindakan</th> 
                        <th style="width:30px">QTY</th>
                        <th style="width:40px">Harga</th>
                        <th style="width:40px">Total</th>
			<th style="width:30px">OPT</th> 
		</tr> 
		</thead> 
		<tbody> 
		<?php
			for ($i = 0; $i < count($tindakan); $i++) {
				$tindakan[$i]['nama_tindakans'] = $db->queryItem("select nama_pelayanan from tbl_tarif where kode_tarif='".$tindakan[$i]['kode_tarif']."'", 0);

		?>
		<tr>
			<td><?php echo $i+1?></td> 
			<td><?php echo $tindakan[$i]['nama_tindakans']?></td> 
			<td align="right"><div align="right"><?php echo number_format($tindakan[$i]['qty'])?></div></td> 
			<td align="right"><div align="right"><?php echo number_format($tindakan[$i]['tarif_asli'])?></div></td> 
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
			<td colspan="4">Sub Total</td>
			<td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($tTindakan)?></div></td>
		</tr>
		</tbody>
	</table>
	<?php
		}
	?>
</div>
&nbsp;