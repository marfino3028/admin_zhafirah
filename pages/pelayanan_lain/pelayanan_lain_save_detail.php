<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	$data = $_GET;
	if ($_SESSION['rg_user'] != '') {
		
		//Input Data Detail tindakan pelayanan_lain
		$InsertDetail = $db->query("insert into tbl_pelayanan_lainnya_detail (			
			ParentId, 
			Tarif_Id, 
			Tarif, 
			Qty, 
			CreatedBy, 
			UpdatedBy
			)
			values (			
			'".$data['ParentId']."', 
			'".$data['Tarif_Id']."', 
			'".$data['Tarif']."', 
			'".$data['Qty']."', 
			'".$_SESSION['rg_user']."', 
			'".$_SESSION['rg_user']."'
			)"
			, 0
			);
		//Update Total di Parent
		$Total = $db->queryItem("select sum(Tarif * Qty) as Total from tbl_pelayanan_lainnya_detail where ParentId='".$_POST['ParentId']."'");
		$UpdateParent = $db->query("update tbl_pelayanan_lainnya set Total = ".$Total." where Id='".$data['ParentId']."'");
	}
?>

<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
<thead>
	  <tr>
		<th style="width:20px">No</th>
		<th>Tindakan</th>
		<th style="width:40px">Tarif</th>
		<th style="width:30px">OPT</th>
	  </tr>
</thead>
<tbody>
				<?php
							$table = $db->query("
							SELECT detail.Id, detail.ParentId, tarif.nama_pelayanan, detail.Tarif,  detail.Qty
							FROM tbl_pelayanan_lainnya_detail AS detail
							LEFT JOIN tbl_tarif AS tarif ON detail.Tarif_Id = tarif.kode_tarif
							
							WHERE detail.ParentId = {$data['ParentId']}
							", 0);
							$subtotal = 0;
							for ($i = 0; $i < count($table); $i++) {
							$no = $i +1;
							$tarif = number_format(($table[$i]['Tarif'] * $table[$i]['Qty']));
							  echo "<tr>
								<td>{$no}</td>
								<td>{$table[$i]['nama_pelayanan']}</td>
								<td align='right'>{$tarif}</td>
								<td align='center'>
									<a class='btn_no_text btn ui-state-default ui-corner-all' title='Delete' 
									href='pages/pelayanan_lain/pelayanan_lain_delete_detail.php?id={$table[$i]['Id']}&ParentId={$table[$i]['ParentId']}'> 
										<span class='ui-icon ui-icon-circle-close'></span> 
									</a> 
								</td>
							  </tr>";
							  $subtotal += ($table[$i]['Tarif'] * $table[$i]['Qty']);
							}
						?>
  <tr>
	<td colspan="2">SubTotal</td>
	<td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($subtotal)?></div></td>
  </tr>
</tbody>
</table>
