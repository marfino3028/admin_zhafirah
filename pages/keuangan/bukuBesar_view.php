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
							<th style="width:70px">Tgl Transaksi</th> 
							<th style="width:70px">No. Jurnal</th> 
							<th>Deskripsi</th> 
							<th style="width:50px">Kode Akun</th> 
							<th>Nama Akun</th> 
							<th>Debet</th> 
							<th>Kredit</th> 
							<th>Saldo</th> 
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
							$date1a = $t1[2].'-'.$t1[0].'-'.$t1[1];
							$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
							//$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
							$date2a = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2]));
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;

							if ($_POST['akun'] == 'ALL') {
								$data = $db->query("select * from tbl_jurnal where tanggal_transaksi >= '$date1a' and tanggal_transaksi < '$date2a' order by tanggal_transaksi", 0);
							}
							else {
								$data = $db->query("select * from tbl_jurnal where tanggal_transaksi >= '$date1a' and tanggal_transaksi < '$date2a' and (kode = '".$_POST['akun']."' or kode_inv = '".$_POST['akun']."') order by tanggal_transaksi", 0);
							}
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$data[$i]['kode_nama'] = $db->queryItem("select nm_coa from tbl_coa where kd_coa='".$data[$i]['kode']."'");
								$data[$i]['kode_inv_nama'] = $db->queryItem("select nm_coa from tbl_coa where kd_coa='".$data[$i]['kode_inv']."'");
						?>
						<tr>
							<td style="" rowspan="2"><?php echo $no?></td> 
							<td style="" rowspan="2"><?php echo date("d-m-Y", strtotime($data[$i]['tanggal_transaksi']))?></td> 
							<td style="" rowspan="2"><?php echo $data[$i]['no_jurnal']?></td>
							<td style="" rowspan="2"><?php echo $data[$i]['deskripsi']?></td>
							<td style="; text-align: center"><?php echo $data[$i]['kode']?></td>
							<td style=""><?php echo $data[$i]['kode_nama']?></td>
							<td style="text-align: right; "><?php echo number_format($data[$i]['nilai'])?></td>
							<td style="text-align: right; ">0</td>
							<td style="text-align: right;" rowspan="2"><?php echo number_format($data[$i]['nilai'])?></td>
						</tr> 
						<tr>
							<td style="; text-align: center"><?php echo $data[$i]['kode_inv']?></td>
							<td style="">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data[$i]['kode_inv_nama']?></td>
							<td style="text-align: right; ">0</td>
							<td style="text-align: right; "><?php echo number_format($data[$i]['nilai'])?></td>
						</tr> 
						<?php
							}

							if ($_POST['akun'] == 'ALL') {
								$data = $db->query("select * from tbl_jurnal_otm where tanggal_transaksi >= '$date1a' and tanggal_transaksi < '$date2a' order by tanggal_transaksi", 0);
							}
							else {
								$data = $db->query("select * from tbl_jurnal_otm where tanggal_transaksi >= '$date1a' and tanggal_transaksi < '$date2a' and (kode = '".$_POST['akun']."' or kode_inv = '".$_POST['akun']."') order by tanggal_transaksi", 0);
							}
							for ($i = 0; $i < count($data); $i++) {
								$no = $no + 1;
								$data[$i]['kode_nama'] = $db->queryItem("select nm_coa from tbl_coa where kd_coa='".$data[$i]['kode']."'");
								$data[$i]['kode_inv_nama'] = $db->queryItem("select nm_coa from tbl_coa where kd_coa='".$data[$i]['kode_inv']."'");
						?>
						<tr>
							<td style="" rowspan="2"><?php echo $no?></td> 
							<td style="" rowspan="2"><?php echo date("d-m-Y", strtotime($data[$i]['tanggal_transaksi']))?></td> 
							<td style="" rowspan="2"><?php echo $data[$i]['no_jurnal']?></td>
							<td style="" rowspan="2"><?php echo $data[$i]['deskripsi']?></td>
							<td style="; text-align: center"><?php echo $data[$i]['kode']?></td>
							<td style=""><?php echo $data[$i]['kode_nama']?></td>
							<td style="text-align: right; "><?php echo number_format($data[$i]['nilai'])?></td>
							<td style="text-align: right; ">0</td>
							<td style="text-align: right;" rowspan="2"><?php echo number_format($data[$i]['nilai'])?></td>
						</tr> 
						<tr>
							<td style="; text-align: center"><?php echo $data[$i]['kode_inv']?></td>
							<td style="">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data[$i]['kode_inv_nama']?></td>
							<td style="text-align: right; ">0</td>
							<td style="text-align: right; "><?php echo number_format($data[$i]['nilai'])?></td>
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
    // $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>