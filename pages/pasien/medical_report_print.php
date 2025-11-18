<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Permintaan Obat</title>
	<link href="../../style.css" rel="stylesheet" media="all" />
</head>

<body>
<?php
	
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";

	$data = $db->query("select * from tbl_pasien where md5(nomr)='".$_GET['id']."'", 0);

?>
        <div class="ui-widget ui-widget-content ui-helper-clearfix form-container">
            <div class="page-title">
		<h1>Detail: Medical Report</h1>
		<div class="other">
			<div class="float-left">Detail Medical Record Pasien.</div>
			<div class="button float-right">
		
				
			</div>
			<div class="clearfix"></div>
		</div>
    
	<p style="margin-left: 12px; margin-top: 22px; margin-bottom: 5px;">
		Nomor MR : <?php echo $data[0]['nomr']?><br />
		Nama Pasien : <?php echo $data[0]['nm_pasien']?><br />
		Tgl Lahir : <?php echo $data[0]['tmpt_lahir'].', '.$data[0]['tgl_lahir']?><br />
	</p>
	</div>
	<div class="hastable box box-content nopadding" align="center" style="margin-left: 10px; margin-right: 10px; width: 98%">
		
		<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
			<thead> 
			<tr>
				<th>Dokter</th> 
				<th colspan="2">Diagnosa Perawat & Dokter</th> 
				<th>Pharmacy</th> 
				<th>Penunjang Medis</th> 
			</tr> 
			</thead> 
			<tbody> 
			<?php
				$data = $db->query("select * from tbl_pendaftaran where md5(nomr)='".$_GET['id']."' order by tgl_insert desc", 0);
				for ($i = 0; $i < count($data); $i++) {
					$dokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data[$i]['kode_dokter']."'");
					if ($data[$i]['kode_dokter'] == "LAB" or $data[$i]['kode_dokter'] == "RAD" or $data[$i]['kode_dokter'] == "FIS")	$dokter = 'DAFTAR LANGSUNG';
					
					$obat = $db->query("select a.nama_obat, a.qty from tbl_resep_detail a left join tbl_resep b on b.id=a.resep_id where b.no_daftar='".$data[$i]['no_daftar']."'", 0);
					$obt = "";
					for ($j = 0; $j < count($obat); $j++) {
						if ($j == 0) {
							$obt = '- '.$obat[$j]['nama_obat'].' ('.$obat[$j]['qty'].')';
						}
						else {
							$obt = $obt.'<br>- '.$obat[$j]['nama_obat'].' ('.$obat[$j]['qty'].')';
						}
					}

					$lab = $db->query("select a.nama_tindakan from tbl_lab_detail a left join tbl_lab b on b.id=a.labID where b.no_daftar='".$data[$i]['no_daftar']."'", 0);
					$pms = "";
					for ($j = 0; $j < count($lab); $j++) {
						if ($j == 0) {
							$pms = '- '.$lab[$j]['nama_tindakan'];
						}
						else {
							$pms = $pms.'<br>- '.$lab[$j]['nama_tindakan'];
						}
					}

					$rad = $db->query("select a.nama_tindakan from tbl_rad_detail a left join tbl_rad b on b.id=a.radID where b.no_daftar='".$data[$i]['no_daftar']."'", 0);
					for ($j = 0; $j < count($rad); $j++) {
						$pms = $pms.'<br>- '.$rad[$j]['nama_tindakan'];
					}
					$catatan = $db->query("select * from tbl_catatan_dktr where no_daftar='".$data[$i]['no_daftar']."'");

			?>
			<tr>
				<td>
				    <?php echo $dokter . '<br>' . date("d F Y", strtotime($data[$i]['tgl_insert'])) ?> <br>
					<a class="btn btn-success" target="_blank" href="print_resume.php?id=<?= $data[$i]['no_daftar']; ?>&ids=<?= $data[0]['nomr']; ?>"><i class="fa fa-fw fa-print"></i> Print Resume</a>
				</td>
				<td style="font-size: 12px;">
					<?php
						echo 'CC+HPI: '.$catatan[0]['cc_hpi'].'<br>';
						echo 'Sebelumnya : '.$catatan[0]['past_med_history'].'<br>';
						echo 'Vital-Weight: '.$catatan[0]['v_weight'].'<br>';
						echo 'Vital-Height: '.$catatan[0]['v_height'].'<br>';
						echo 'Vital-BMI: '.$catatan[0]['v_bmi'].'<br>';
						echo 'Vital-BP Sitolik: '.$catatan[0]['v_bp'].'<br>';
						echo 'Vital-BP Diastolik: '.$catatan[0]['v_bpd'].'<br>';
						echo 'Vital-PR: '.$catatan[0]['v_pr'].'<br>';
						echo 'Vital-RR: '.$catatan[0]['v_rr'].'<br>';
						echo 'Vital-Temp: '.$catatan[0]['v_temp'].'<br>';
						echo 'Lingkar Kepala: '.$catatan[0]['lingkar_k'].'<br>';
						echo 'SPO2: '.$catatan[0]['spo2'].'<br>';
						echo 'Pain Level: '.$catatan[0]['pain_l'].'<br>';
					?>
                		</td>
				<td style="font-size: 12px;">
					<?php
						echo 'Past Surgical History: '.$catatan[0]['past_surgical_histort'].'<br>';
						echo 'Allergies : '.$catatan[0]['alergi'].'<br>';
						echo 'Other: '.$catatan[0]['other_obj'].'<br>';
						echo 'Assesment Diagnosis: '.$catatan[0]['as_diagnosis'].'<br>';
						echo 'Assesment Problem: '.$catatan[0]['as_problems'].'<br>';
						echo 'Assesment Progress Note: '.$catatan[0]['as_progres'].'<br>';
						echo 'Assesment Other: '.$catatan[0]['other_as'].'<br>';
						echo 'Planning Order: '.$catatan[0]['plan_order'].'<br>';
						echo 'Planning Advice: '.$catatan[0]['plan_advice'].'<br>';
						echo 'Planning Konsul Internal: '.$catatan[0]['konsul_internal'].'<br>';
						echo 'Planning Order OK / VK: '.$catatan[0]['order_ok'].'<br>';
						echo 'Planning Prescription: '.$catatan[0]['prescrip'].'<br>';
						echo 'Planning Other: '.$catatan[0]['other_plan'].'<br>';
					?>
                		</td>
				<td style="font-size: 12px;"><?php echo $obt?></td>
				<td style="font-size: 12px;"><?php echo $pms?></td>
			</tr> 
			<?php
				}
			?>
			</tbody>
		</table>
	</div>

</div>