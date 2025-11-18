<?php
	//print_r($_POST);
?>

    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th style="width:20px">NO</th> 
							<th>Description</th> 
							<th style="width:150px">Stock Masuk</th> 
							<th style="width:150px">Stock Keluar</th> 
							<th style="width:150px">Stock Akhir</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							include "../../3rdparty/engine.php";
							ini_set("display_errors", 0);
							$t1 = explode("/", $_POST['d1']);
							$t2 = explode("/", $_POST['d2']);
							$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1];
							//$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2]));
							$daftar = $db->query("select a.no_resep from tbl_resep a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where b.status_pasien='CLOSED'");
							$stok = $db->queryItem("select stock_akhir from tbl_obat where kode_obat='".$_POST['obat']."'");
							$datanr = $db->queryItem("select sum(c.qty) from tbl_resep_detail c left join tbl_resep d on d.no_resep=c.no_resep where c.no_resep in (select a.no_resep from tbl_resep a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where b.status_pasien='CLOSED') and c.status_delete='UD' and c.kode_obat='".$_POST['obat']."' and d.tgl_input >= '$date1' and tgl_input <= '$date2'", 0);
							$stok = $stok + $datanr;
							$data = $db->query("select sum(c.qty) keluar, d.nomr, d.nama from tbl_resep_detail c left join tbl_resep d on d.no_resep=c.no_resep where c.no_resep in (select a.no_resep from tbl_resep a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where b.status_pasien='CLOSED') and c.status_delete='UD' and c.kode_obat='".$_POST['obat']."' and d.tgl_input >= '$date1' and tgl_input <= '$date2' group by c.no_resep", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$stok = $stok - $data[$i]['keluar'];
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo 'Apotik Farmasi | '.$data[$i]['nama'].' | '.$data[$i]['nomr']?></td> 
							<td style="text-align: right">0</td>
							<td style="text-align: right"><?php echo number_format($data[$i]['keluar'])?></td>
							<td style="text-align: right"><?php echo number_format($stok)?></td>
						</tr> 
                        <?php
							}
						?>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
<script>
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>