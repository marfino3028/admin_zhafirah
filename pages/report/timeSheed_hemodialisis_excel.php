<?php
	// Fungsi header dengan mengirimkan raw data excel
	header("Content-type: application/vnd-ms-excel");
	 
	// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=TimeSheed_Hemodialisis".date("YmdHis").".xls");

	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	//print_r($_POST)
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
					<th style="width:20px">No</th> 
					<th>Tanggal</th> 
					<th>Nama Pasien</th> 
					<th>Nomor ID Mesin</th> 
					<th>Waktu Mulai</th> 
					<th>Waktu Selesai</th> 
					<th>Durasi Penggunaan</th> 
					<th>Teknisi Bertugas</th> 
					<th>Perawat Bertugas</th> 
					<th>Catatan Khusus</th> 
				</tr> 
				</thead> 
				<tbody> 
				<?php
					//Nilai Tutup Pendapatan Harian
					$date1 = $_GET['d1'];
					$date2 = $_GET['d2'];

					$data = $db->query("select a.* from tbl_catatan_dktr_hd a where a.tgl_data >= '$date1' and a.tgl_data <= '$date2'", 0);
					for ($i = 0; $i < count($data); $i++) {
						$no = $i + 1;
						$data[$i]['selesai_hd'] = $data[$i]['mulai_hd'] + $data[$i]['durasi_hd'];
				?>
				<tr>
					<td><?php echo $no?></td> 
					<td><?php echo date("d-M-Y", strtotime($data[$i]['tgl_data']))?></td> 
					<td><?php echo $data[$i]['nama']?></td> 
					<td><?php echo $data[$i]['tipe_mesin']?></td> 
					<td style="text-align: center;"><?php echo $data[$i]['mulai_hd'].':00'?></td> 
					<td style="text-align: center;"><?php echo $data[$i]['selesai_hd'].':00'?></td> 
					<td style="text-align: center;"><?php echo $data[$i]['durasi_hd'].' jam'?></td> 
					<td><?php echo $data[$i]['nama']?></td> 
					<td><?php echo $data[$i]['user_insert']?></td> 
					<td><?php echo $data[$i]['catatan']?></td> 
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