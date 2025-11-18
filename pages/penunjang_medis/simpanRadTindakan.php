<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data tindakan laboratorium
		$nama_tindakan = $db->queryItem("select nama_pelayanan from tbl_tarif where kode_tarif='".$_POST['lab']."'");
		$total_tarif = $_POST['tarif'] * $_POST['qty'];
		$insert = $db->query("insert into tbl_rad_detail (radID, nomr, nama_pasien, no_rad, kode_tarif, tarif, nama_tindakan, qty, tarif_dasar) values ('".$_POST['id']."', '".$_POST['nomr']."', '".$_POST['nama']."', '".$_POST['no_rad']."', '".$_POST['lab']."', '".$total_tarif."', '$nama_tindakan', '".$_POST['qty']."', '".$_POST['tarif']."')", 0);
		
		$totalNya = $db->queryItem("select sum(tarif) from tbl_rad_detail where  no_rad='".$_POST['no_rad']."' and status_delete='UD'");
		$update = $db->query("update tbl_rad set total_harga_rad=".$totalNya." where no_rad='".$_POST['no_rad']."'");

		//simpan ke jurnal
		$dataRawat = $db->query("select nomr, no_daftar from tbl_lab where id='".$_POST['id']."'");
		$dataUmum = $db->query("select a.nomr, b.nm_pasien, a.kode_perusahaan, a.nama_perusahaan, a.kode_dokter, a.kd_poli from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$dataRawat[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
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
		$pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$dataUmum[0]['nomr']."'");
		$dokter = $db->query("select nama_dokter, tarif_dokter from tbl_dokter where kode_dokter='".$dataUmum[0]['kode_dokter']."'");
		$keterangan = 'Patient Transaction:  No. Reg.'.$dataRawat[0]['no_daftar'].', Tindakan Radiologi: ['.$dokter[0]['nama_dokter'].'] PS: '.$pasien[0]['nm_pasien'];
		$deskripsi = 'Tidakan Radiologi ['.$nama_tindakan.'] PS: '.$pasien[0]['nm_pasien'];
		$dtarif = $db->query("select * from tbl_poli where kd_poli='".$dataUmum[0]['kd_poli']."'");
		$reg_no = $dataRawat[0]['no_daftar'];
		$cost_center_kode = $dtarif[0]['kd_profit'];
		$cost_center_nama = $dtarif[0]['nm_profit'];
		$coa = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='11030106'");
		$gl_kode = $coa[0]['kd_coa'];
		$gl_nama = $coa[0]['nm_coa'];
		$debit = $total_tarif;
		$kredit = 0;

		$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

		$deskripsi = 'Tidakan Radiologi ['.$nama_tindakan.'] PS: '.$pasien[0]['nm_pasien'];
		$dtarif = $db->query("select * from tbl_poli where kd_poli='".$dataUmum[0]['kd_poli']."'");
		$reg_no = $dataRawat[0]['no_daftar'];
		$cost_center_kode = $dtarif[0]['kd_profit'];
		$cost_center_nama = $dtarif[0]['nm_profit'];
		$coa = $db->query("select kd_coa, nm_coa from tbl_coa where kd_coa='41010516'");
		$gl_kode = $coa[0]['kd_coa'];
		$gl_nama = $coa[0]['nm_coa'];
		$debit = 0;
		$kredit = $total_tarif;

		$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);
	}
?>

<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
<thead>
	  <tr>
		<th style="width:20px">No</th>
		<th>Description</th>
		<th style="width:40px">Qty</th>
		<th style="width:40px">Tarif</th>
		<th style="width:40px">Total</th>
		<th style="width:30px">OPT</th>
	  </tr>
</thead>
<tbody>
  <?php
		$data = $db->query("select * from tbl_rad_detail where status_delete='UD' and no_rad='".$_POST['no_rad']."'", 0);
		for ($i = 0; $i < count($data); $i++) {
			$kategori = $db->queryItem("select b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.kode_tarif='".$data[$i]['kode_tarif']."'");
	?>
	  <tr>
		<td><?php echo $i+1?></td>
		<td><?php echo $data[$i]['nama_tindakan'].' - '.$kategori?></td>
		<td align="right"><div align="right"><?php echo number_format($data[$i]['qty'])?></div></td>
		<td align="right"><div align="right"><?php echo number_format($data[$i]['tarif_dasar'])?></div></td>
		<td align="right"><div align="right"><?php echo number_format($data[$i]['tarif'])?></div></td>
		 <td class="text-center"><a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/penunjang_medis/rad_tindakan_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$data[$i]['radID']?>';"> <span class="ui-icon ui-icon-circle-close"></span> </a> </td>
	  </tr>
  <?php
			$sbttl = $sbttl + $data[$i]['tarif'];
		}
	?>
  <tr>
	<td colspan="4">SubTotal</td>
	<td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($sbttl)?></div></td>
  </tr>
</tbody>
</table>
