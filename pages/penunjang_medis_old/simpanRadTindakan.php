<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data tindakan laboratorium
		$nama_tindakan = $db->queryItem("select nama_pelayanan from tbl_tarif where kode_tarif='".$_POST['lab']."'");
		$insert = $db->query("insert into tbl_rad_detail (radID, nomr, nama_pasien, no_rad, kode_tarif, tarif, nama_tindakan) values ('".$_POST['id']."', '".$_POST['nomr']."', '".$_POST['nama']."', '".$_POST['no_rad']."', '".$_POST['lab']."', '".$_POST['tarif']."', '$nama_tindakan')", 0);
		
		$totalNya = $db->queryItem("select sum(tarif) from tbl_rad_detail where  no_rad='".$_POST['no_rad']."' and status_delete='UD'");
		$update = $db->query("update tbl_rad set total_harga_rad=".$totalNya." where no_rad='".$_POST['no_rad']."'");
	}
?>

<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
<thead>
	  <tr>
		<th style="width:20px">No</th>
		<th>Description</th>
		<th style="width:40px">Tarif</th>
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
		<td align="right"><div align="right"><?php echo number_format($data[$i]['tarif'])?></div></td>
		 <td class="text-center"><a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/penunjang_medis/rad_tindakan_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$data[$i]['radID']?>';"> <span class="ui-icon ui-icon-circle-close"></span> </a> </td>
	  </tr>
  <?php
			$sbttl = $sbttl + $data[$i]['tarif'];
		}
	?>
  <tr>
	<td colspan="2">SubTotal</td>
	<td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($sbttl)?></div></td>
  </tr>
</tbody>
</table>
