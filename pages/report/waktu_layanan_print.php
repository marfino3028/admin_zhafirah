<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>MH.THAMRIN HEALTH CARE | Radjak Group</title>
	<link href="style.css" rel="stylesheet" media="all" />
	<script type="text/javascript" src="../../js/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="../../js/superfish.js"></script>
	<script type="text/javascript" src="../../js/jquery-ui-1.8.18.custom.min.js"></script>
	<script type="text/javascript" src="../../js/tooltip.js"></script>
	<script type="text/javascript" src="../../js/cookie.js"></script>
	<script type="text/javascript" src="../../js/custom.js"></script>
	<script type="text/javascript" src="../../js/utama.js"></script>
	<link href="../../style.css" rel="stylesheet" media="all" />

</head>
<body>

	<p style="text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 2px; margin-top: 10px;">
		Daftar Waktu Layana Pasien<br>
		PERIODE : <?php echo $_GET['d1'].' s/d '.$_GET['d2']?>
	</p>
<?php

	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	//print_r($_POST)
	//Nilai Tutup Pendapatan Harian
	$date1 = $_GET['d1'];
	$date2 = $_GET['d2'];
?>
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th style="width:20px" rowspan="2">No</th> 
							<th rowspan="2">No. MR</th> 
							<th rowspan="2">No. Registrasi</th> 
							<th rowspan="2">Nama Pasien</th> 
							<th rowspan="2">Dokter</th> 
							<th rowspan="2">Layanan</th> 
							<th colspan="2">Pendaftaran</th> 
							<th colspan="2">Tindakan Hemodialisa</th> 
							<th rowspan="2">Total Wktu Layanan</th> 
							<th rowspan="2">Option</th> 
						</tr> 
						<tr>
							<th>Tgl Daftar</th> 
							<th>Jam</th> 
							<th>Mulai</th> 
							<th>Selesai</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php

							//$data = $db->query("select * from tbl_fisio where tgl_insert >= '$date1' and tgl_insert < '$date2' and status_delete='UD'", 0);
							$data = $db->query("select a.id, a.nomr, a.no_daftar, a.tgl_daftar, a.tgl_insert, a.kd_poli, b.nm_pasien, c.nama_dokter, d.nama_poli, e.tgl_insert selesai from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_dokter c on c.kode_dokter=a.kode_dokter left join tbl_poli d on d.kd_poli=a.kd_poli left join tbl_kasir e on e.no_daftar=a.no_daftar where a.tgl_daftar >= '$date1' and a.tgl_daftar < '$date2' and a.kd_poli='HE01' order by a.id", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
                      						$waktu1 = new DateTime($data[$i]['tgl_insert']);
								$waktu2 = new DateTime($data[$i]['selesai']);
					                      	$selisih_waktu = $waktu1->diff($waktu2);
				        	              	$selisih_jam = $selisih_waktu->h;
								if ($selisih_jam < 10) $selisih_jam = '0'.$selisih_jam;
                      						$selisih_menit = $selisih_waktu->i;
					                      	if ($selisih_menit < 10) $selisih_menit = '0'.$selisih_menit;
					                      	$selisi_menit_nr = $selisih_waktu->i / 60;
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['nomr']?></td> 
							<td><?php echo $data[$i]['no_daftar']?></td>
							<td><?php echo $data[$i]['nm_pasien']?></td>
							<td><?php echo $data[$i]['nama_dokter']?></td>
							<td><?php echo $data[$i]['nama_poli']?></td>
							<td><?php echo date("d-F-Y", strtotime($data[$i]['tgl_daftar']))?></td> 
							<td><?php echo date("H:i", strtotime($data[$i]['tgl_insert']))?></td> 
							<td><?php echo date("H:i", strtotime($data[$i]['tgl_insert']))?></td> 
							<td><?php echo date("H:i", strtotime($data[$i]['selesai']))?></td> 
							<td><?php echo $selisih_jam.':'.$selisih_menit?></td>
							<td>Pasien Journey</td>
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