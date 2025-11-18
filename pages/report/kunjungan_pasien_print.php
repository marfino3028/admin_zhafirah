<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Pembayaran Pasien</title>
	<link href="../../style.css" rel="stylesheet" media="all" />
</head>

<body>

<p style="text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
	LAPORAN KUNJUNGAN PASIEN<br />Tanggal : <?php echo $_GET['start'].' s/d '.$_GET['end']?>
</p>
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
							$t1 = explode("/", $_GET['start']);
							$t2 = explode("/", $_GET['end']);
							//Nilai Tutup Pendapatan Harian
							$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
							$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
							//$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;
							if ($_GET['sp'] == 'ALL') {
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
									if ($data[$i]['status_pasien'] == 'BARU') {
										$br = $br + 1;
									}
									elseif ($data[$i]['status_pasien'] == 'LAMA') {
										$lm = $lm + 1;
									}
							}
							if ($i > 0) {
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

</body>
</html>
