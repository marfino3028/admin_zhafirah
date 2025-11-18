    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th rowspan="2" style="width:20px">NO</th> 
							<th rowspan="2" style="width:70px">NO.MR</th> 
							<th rowspan="2">Nama Pasien</th> 
							<th rowspan="2">Nama Tindakan</th> 
							<th rowspan="2">Tindakan</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							include "../../3rdparty/engine.php";
							ini_set("display_errors", 0);
							$t1 = explode("/", $_POST['d1']);
							$t2 = explode("/", $_POST['d2']);
							//Nilai Tutup Pendapatan Harian
							$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
							$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
							//$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;

							$data = $db->query("select a.* from tbl_lab_detail a left join tbl_lab b on b.id=a.labID where a.status_delete='UD' and b.tgl_input_lab >= '$date1' and b.tgl_input_lab < '$date2' and a.kode_tarif in (select kode_tarif from tbl_tarif where kode_kat_pelayanan='".$_POST['lab']."')", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $start + $i + 1;
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['nama_pasien']?></td>
							<td style="text-align: left;"><?php echo $data[$i]['nama_tindakan']?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['tarif'])?></td> 
						</tr> 
						<?php
								$ttindakan = $ttindakan + $data[$i]['tarif'];
							}
						?>
						<tr style="font-weight: bold; font-size: 12px">
							<th colspan="4" style="text-align: right; font-weight: bold">Total</th>
							<th style="text-align: right; font-weight: bold"><?php echo number_format($ttindakan)?></th> 
						</tr> 
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
<script>
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>