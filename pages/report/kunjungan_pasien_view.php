    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th style="width:30px">NO</th> 
							<th style="width:70px">NO.MR</th> 
							<th>NAMA PASIEN</th> 
							<th>JAMINAN</th> 
							<th style="width:70px">STATUS</th> 
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
							if ($_POST['status_pasien'] == 'ALL') {
								$st_pasien = "1";
							}
							else {
								$st_pasien = "b.status_pasien='".$_POST['status_pasien']."'";
							}

							$data = $db->query("select distinct a.nama_perusahaan, b.nomr, b.nm_pasien, if (b.status_pasien = 'NEW', 'BARU', 'LAMA') as status_pasien from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_kasir c on c.no_daftar=a.no_daftar where c.tgl_insert >= '$date1' and c.tgl_insert < '$date2' and $st_pasien and a.status_pasien='CLOSED'", 0);
							$br = 0;
							$lm = 0;
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
						?>
						<tr>
							<td style="text-align: center"><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td>
							<td><?php echo $data[$i]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_perusahaan']?></td>
							<td><?php echo $data[$i]['status_pasien']?></td>
						</tr> 
						<?php
								//if ($_POST['status_pasien'] == 'ALL') {
									if ($data[$i]['status_pasien'] == 'BARU') {
										$br = $br + 1;
									}
									elseif ($data[$i]['status_pasien'] == 'LAMA') {
										$lm = $lm + 1;
									}
								//}
							}
							if ($i > 0) {
								/*if ($_POST['status_pasien'] == 'ALL') {
									$br = $db->queryItem("select count(ps.id) from (select distinct a.nama_perusahaan as id, b.nomr, b.nm_pasien, if (b.status_pasien = 'NEW', 'BARU', 'LAMA') as status_pasien from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr where b.tgLdaftar >= '$date1' and b.tgLdaftar < '$date2' and b.status_pasien='NEW') as ps", 0);
									$lm = $db->queryItem("select count(ps.id) from (select distinct a.nama_perusahaan as id, b.nomr, b.nm_pasien, if (b.status_pasien = 'NEW', 'BARU', 'LAMA') as status_pasien from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr where b.tgLdaftar >= '$date1' and b.tgLdaftar < '$date2' and b.status_pasien='OLD') as ps", 0);
								}
								elseif ($_POST['status_pasien'] == 'NEW') {
									$br = $db->queryItem("select count(ps.id) from (select distinct a.nama_perusahaan as id, b.nomr, b.nm_pasien, if (b.status_pasien = 'NEW', 'BARU', 'LAMA') as status_pasien from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr where b.tgLdaftar >= '$date1' and b.tgLdaftar < '$date2' and b.status_pasien='NEW') as ps", 0);
									$lm = 0;
								}
								elseif ($_POST['status_pasien'] == 'OLD') {
									$br = 0;
									$lm = $db->queryItem("select count(ps.id) from (select distinct a.nama_perusahaan as id, b.nomr, b.nm_pasien, if (b.status_pasien = 'NEW', 'BARU', 'LAMA') as status_pasien from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr where b.tgLdaftar >= '$date1' and b.tgLdaftar < '$date2' and b.status_pasien='OLD') as ps", 0);
								}*/
						?>
						<tr>
							<th colspan="4" style="text-align: right; font-weight: bold">
								TOTAL PASIEN BARU
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($br)?>
							</th>
						</tr>
						<tr>
							<th colspan="4" style="text-align: right; font-weight: bold">
								TOTAL PASIEN LAMA
							</th>
							<th style="text-align: right; font-weight: bold">
								<?php echo number_format($lm)?>
							</th>
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
<script language="javascript">
	document.getElementById('PrintOut').innerHTML = '<input type="button" value="Print Laporan Kunjungan Pasien" onclick="PrintDokument()">';
</script>