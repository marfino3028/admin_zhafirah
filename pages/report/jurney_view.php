    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th style="width:20px">No</th> 
							<th style="width:70px">Np. WhatsApp</th> 
							<th style="width:70px">Ambil Antrian</th> 
							<th style="width:70px">Kedatangan Poli</th> 
							<th>Konfirmasi Resep</th> 
							<th>Lab</th> 
							<th>Rad</th> 
							<th>Total Waktu</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							include "../../3rdparty/engine.php";
							ini_set("display_errors", 0);

							//Nilai Tutup Pendapatan Harian
							$date1 = $_POST['d1'];
							$date2 = $_POST['d2'];

							//$data = $db->query("select * from tbl_fisio where tgl_insert >= '$date1' and tgl_insert < '$date2' and status_delete='UD'", 0);
							$data = $db->query("select id, no_wa, tgl_insert, tanggal from tbl_kiosk_antrian where tanggal >= '$date1' and tanggal < '$date2' and no_wa <> '' and kode not in ('SL', 'SR', 'R')", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$datang = $db->query("select tgl_insert from tbl_kiosk_kedatangan where no_wa='".$data[$i]['no_wa']."'");
								$resep = $db->query("select tgl_insert from tbl_kiosk_resep where no_wa='".$data[$i]['no_wa']."'");
								$lab = $db->query("select tgl_insert from tbl_kiosk_lab where no_wa='".$data[$i]['no_wa']."'");
								$rad = $db->query("select tgl_insert from tbl_kiosk_rad where no_wa='".$data[$i]['no_wa']."'");
								$awal  = date_create($data[$i]['tgl_insert']);
								$akhir = date_create($rad[0]['tgl_insert']); // waktu sekarang
								$diff  = date_diff($awal, $akhir);
								if ($diff->h > 0) {
								  $total_waktu = $diff->h.' jam, '.$diff->i.' menit';
								}
								else {
								  $total_waktu = $diff->i.' menit';
								}

						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['no_wa']?></td> 
							<td><?php echo date("d-M-Y H:i:s", strtotime($data[$i]['tgl_insert']))?></td> 
							<td><?php echo date("d-M-Y H:i:s", strtotime($datang[0]['tgl_insert']))?></td> 
							<td><?php echo date("d-M-Y H:i:s", strtotime($resep[0]['tgl_insert']))?></td> 
							<td><?php echo date("d-M-Y H:i:s", strtotime($lab[0]['tgl_insert']))?></td> 
							<td><?php echo date("d-M-Y H:i:s", strtotime($rad[0]['tgl_insert']))?></td> 
							<td><?php echo $total_waktu; ?></td> 
						</tr> 
						<?php
								$ttlr = $ttlr + $data[$i]['rehabmedik'];
								$ttln = $ttln + $data[$i]['nebulizer'];
								$ttlm = $ttlm + $data[$i]['message'];
								$ttlSum = $ttlSum + $data[$i]['total_harga_fisio'];
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