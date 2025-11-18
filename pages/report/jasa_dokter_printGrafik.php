<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Pendapatan Labn</title>
	<link href="../../style.css" rel="stylesheet" media="all" />
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
</head>
<?php
	ini_set("display_errors", 0);

	include "../../3rdparty/engine.php";
	$t1 = explode("/", $_GET['d1']);
	$t2 = explode("/", $_GET['d2']);
	//Nilai Tutup Pendapatan Harian
	$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
	$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
	$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
	$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;  	
?>
<body>

	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		Laporan Jasa Dokter dalam Bentuk Grafik<br />
		Periode : <?php echo date("d F Y", strtotime($_GET['d1'])).' s/d '.date("d F Y", strtotime($_GET['d2']))?><br />
		Dokter : Keseluruhan Dokter<br />
	</p>
	<?php
  		$jmlDokter = $db->query("select kode_dokter from tbl_dokter where status_delete='UD'");
  		for ($ii = 0; $ii < count($jmlDokter); $ii++) {
         //echo $jmlDokter[$ii]['kode_dokter']."<br>"; 
          
          $data = $db->query("select a.*, b.biayaAdmin, b.kode_dokter, b.kd_poli from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and b.kode_dokter='".$jmlDokter[$ii]['kode_dokter']."' order by tgl_insert desc", 0);

          $dokter = $db->query("select * from tbl_dokter where kode_dokter='".$jmlDokter[$ii]['kode_dokter']."'");
		  $biayaTindakan = 0;
          $biayaLab = 0;
          $biayaFis = 0;
          $ttlSum = 0;
          $TotalbiayaDokter = 0;
          $TotalbiayaTindakan = 0;
          $TotalbiayaLab = 0;
          $TotalbiayaFis = 0;
          $totalAll = 0;
          $totPajak = 0;
          for ($i = 0; $i < count($data); $i++) {
            $pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
            $biayaAdmin = $data[$i]['biayaAdmin'];
            if ($data[$i]['kd_poli'] == 'P002') {
              $biayaDokter = $db->queryItem("select sum(a.dokter_tarif) from tbl_gigi_detail a left join tbl_gigi b on b.id=a.gigiID where b.no_daftar='".$data[$i]['no_daftar']."'");
            }
            else {
              $biayaDokter = $db->queryItem("select tarif_dokter from tbl_dokter where kode_dokter='".$data[$i]['kode_dokter']."'");
            }
            $biayaTindakan = $db->queryItem("select sum(tarif) from tbl_tindakan where no_daftar='".$data[$i]['no_daftar']."'");
            $poli = $db->queryItem("select tarif from tbl_poli where kd_poli='".$data[$i]['kd_poli']."'");
            $biayaLab = $db->queryItem("select total_harga_lab from tbl_lab where no_daftar='".$data[$i]['no_daftar']."'");
            $biayaFis = $db->queryItem("select total_harga_fisio from tbl_fisio where no_daftar='".$data[$i]['no_daftar']."'");
            //$total = $biayaAdmin + $poli + $biayaDokter + $biayaTindakan;
            $persenTDK = $db->queryItem("select nilai from tbl_config where kode='HON-TDK'");
            $persenLAB = $db->queryItem("select nilai from tbl_config where kode='HON-LAB'");
            $persenFIS = $db->queryItem("select nilai from tbl_config where kode='HON-FIS'");
            $biayaTindakan = $biayaTindakan * $persenTDK /100;
            $biayaLab = $biayaLab * $persenLAB / 100;
            $biayaFis = $biayaFis * $persenFIS / 100;
            $total = $biayaDokter + $biayaTindakan + $biayaLab + $biayaFis;

            $ttlSum = $ttlSum + $total;
            $TotalbiayaDokter = $TotalbiayaDokter + $biayaDokter;
            $TotalbiayaTindakan = $TotalbiayaTindakan + $biayaTindakan;
            $TotalbiayaLab = $TotalbiayaLab + $biayaLab;
            $TotalbiayaFis = $TotalbiayaFis + $biayaFis;
          }

          if ($date1 == $date2) {
            $data = $db->query("select a.*, b.biayaAdmin, b.kode_dokter, b.kd_poli from tbl_kasir a left join tbl_pendaftaran_jamsostek b on concat('JAM-', b.no_daftar)=a.no_daftar where date(a.tgl_insert) >= '$date1' and b.kode_dokter='".$_GET['dokter']."' order by a.tgl_insert desc", 0);
          }
          else {
            $data = $db->query("select a.*, b.biayaAdmin, b.kode_dokter, b.kd_poli from tbl_kasir a left join tbl_pendaftaran_jamsostek b on concat('JAM-', b.no_daftar)=a.no_daftar where date(a.tgl_insert) >= '$date1' and date(a.tgl_insert) <= '$date2' and b.kode_dokter='".$_GET['dokter']."' order by tgl_insert desc", 0);
          }

          for ($i = 0; $i < count($data); $i++) {
            $pasien = $db->query("select * from tbl_pasien_jamsostek where nomr='".$data[$i]['nomr']."'");
            $biayaAdmin = $data[$i]['biayaAdmin'];
            $biayaDokter = $db->queryItem("select tarif_jamsostek from tbl_dokter where kode_dokter='".$data[$i]['kode_dokter']."'");
            $biayaTindakan = $db->queryItem("select sum(tarif) from tbl_tindakan where no_daftar='".$data[$i]['no_daftar']."'");
            $poli = $db->queryItem("select tarif from tbl_poli where kd_poli='".$data[$i]['kd_poli']."'");
            $biayaLab = $db->queryItem("select total_harga_lab from tbl_lab where no_daftar='".$data[$i]['no_daftar']."'");
            $biayaFis = $db->queryItem("select total_harga_fisio from tbl_fisio where no_daftar='".$data[$i]['no_daftar']."'");
            //$total = $biayaAdmin + $poli + $biayaDokter + $biayaTindakan;
            $persenTDK = $db->queryItem("select nilai from tbl_config where kode='HON-TDK'");
            $persenLAB = $db->queryItem("select nilai from tbl_config where kode='HON-LAB'");
            $persenFIS = $db->queryItem("select nilai from tbl_config where kode='HON-FIS'");
            $biayaTindakan = $biayaTindakan * $persenTDK /100;
            $biayaLab = $biayaLab * $persenLAB / 100;
            $biayaFis = $biayaFis * $persenFIS / 100;
            $total = $biayaDokter + $biayaTindakan + $biayaLab + $biayaFis;

            $ttlSum = $ttlSum + $total;
            $TotalbiayaDokter = $TotalbiayaDokter + $biayaDokter;
            $TotalbiayaTindakan = $TotalbiayaTindakan + $biayaTindakan;
            $TotalbiayaLab = $TotalbiayaLab + $biayaLab;
            $TotalbiayaFis = $TotalbiayaFis + $biayaFis;
          }

          if ($ttlSum > 0) {
            $biayaJaga = $db->queryItem("select sum(biaya) from tbl_kehadiran_dokter where tgl_hadir >= '$date1' and tgl_hadir <= '$date2' and kode_dokter='".$_GET['dokter']."'", 0);
            $totJasa = $ttlSum + $biayaJaga;
            //$pajak = $totJasa * 50/100;
            $tunai = $db->queryItem("select count(a.id) from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert <= '$date2' and b.kode_dokter='".$_GET['dokter']."' and a.kode_perusahaan='PPP031' order by tgl_insert desc", 0);
            $asuransi = $db->queryItem("select count(a.id) from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert <= '$date2' and b.kode_dokter='".$_GET['dokter']."' and a.kode_perusahaan <> 'PPP031' and a.kode_perusahaan <> 'JJJ030' order by tgl_insert desc", 0);
            $jamsostek = $db->queryItem("select count(a.id) from tbl_kasir a left join tbl_pendaftaran_jamsostek b on concat('JAM-', b.no_daftar)=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert <= '$date2' and b.kode_dokter='".$_GET['dokter']."' and a.kode_perusahaan = 'JJJ030' order by tgl_insert desc", 0);

            if ($dokter[0]['npwp'] == "") {
              //echo 'Jika Non NPWP (3%)';
              $npwp = $totJasa * 3/100;
            }
            else {
              //echo 'Jika Punya NPWP (2,5%)';
              $npwp = $totJasa * 2.5/100;
            }
            $totPajak = $pajak + $npwp;
            $totalAll = $totJasa - $totPajak;
          }
          //echo "Nama Dokter : Rp. ".$dokter[0]['nama_dokter']."<br>";
          //echo "Total Pendapan Dokter Kotor : Rp. ".number_format($ttlSum).'<br>';
          //echo "Total Pajak : Rp. ".number_format($totPajak).'<br>';
          //echo "Total Pendapan Dokter Bersih : Rp. ".number_format($totalAll).'<br><br><br>';
          
          $dokterGrafik[$ii] = array($dokter[0]['nama_dokter'], $ttlSum, $totPajak, $totalAll);
        }
  		//echo '<pre>';
  		//print_r($dokterGrafik);
  	?>
    <div class="row">
      <div class="col-sm-12">
          <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
      </div>
    </div>
  
		<script type="text/javascript">

			Highcharts.chart('container', {
				chart: {
					type: 'column'
				},
				title: {
					text: 'Jasa Dokter Klinik, Apotek dan Laboratorium Semesta Medika',
            		style: {
            			fontSize: '24px'
            		}
				},
				subtitle: {
					text: 'Periode : <?php echo date("d F Y", strtotime($_GET['d1'])).' s/d '.date("d F Y", strtotime($_GET['d2']))?>',
            		style: {
            			fontSize: '14px'
            		}
				},
				xAxis: {
					type: 'category',
					labels: {
						rotation: 0,
						style: {
							fontSize: '12px',
							fontFamily: 'Verdana, sans-serif'
						}
					}
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Nilai Pendapatan (RP)'
					}
				},
				legend: {
					enabled: false
				},
				tooltip: {
					pointFormat: 'Total Pendapatan: <b>Rp. {point.y:.0f}</b>',
						style: {
							fontSize: '12px',
							fontFamily: 'Verdana, sans-serif'
						}
				},
				series: [{
					name: 'Pasien',
					data: [
                      <?php
                      	$bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                      	for ($i = 0; $i < count($dokterGrafik); $i++) {
                        	if ($i == 0) {
                              echo '[\''.$dokterGrafik[$i][0].'\', '.$dokterGrafik[$i][3].']';
                            }
                            else {
                              echo ', [\''.$dokterGrafik[$i][0].'\', '.$dokterGrafik[$i][3].']';
                            }
                        }
                      ?>
					],
					dataLabels: {
						enabled: true,
						rotation: 0,
						align: 'center',
						format: '{point.y:.0f}', // one decimal
						y: 3, // 10 pixels down from the top
						style: {
							fontSize: '10px',
							fontFamily: 'Verdana, sans-serif'
						}
					}
				}]
			});
		</script>
  
</body>
</html>