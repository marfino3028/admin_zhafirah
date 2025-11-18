    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

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

							$data = $db->query("select distinct a.nama_perusahaan, b.nomr, b.nm_pasien, if (b.status_pasien = 'NEW', 'BARU', 'LAMA') as status_pasien from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_kasir c on c.no_daftar=a.no_daftar where c.tgl_insert >= '$date1' and c.tgl_insert < '$date2' and a.status_pasien='CLOSED'", 0);
							$br = 0;
							$lm = 0;
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;

                              //if ($_POST['status_pasien'] == 'ALL') {
									if ($data[$i]['status_pasien'] == 'BARU') {
										$br = $br + 1;
									}
									elseif ($data[$i]['status_pasien'] == 'LAMA') {
										$lm = $lm + 1;
									}
								//}
							}

							$dokterGrafik[0] = array('PASIEN BARU', $br);
                          	$dokterGrafik[1] = array('PASIEN LAMA', $lm);
						?>
 <div class="row">
      <div class="col-sm-12">
          <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
      </div>
    </div>
  
<script type="text/javascript">
	document.getElementById('PrintOut').innerHTML = '<input type="button" value="Print Laporan Kunjungan Pasien" onclick="PrintDokument()">';
	Highcharts.chart('container', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
          text: 'Kunjungan Pasien Klinik, Apotek dan Laboratorium Semesta Medika',
          style: {
            fontSize: '24px'
          }
		},
        subtitle: {
          text: 'Periode : <?php echo date("d F Y", strtotime($_POST['d1'])).' s/d '.date("d F Y", strtotime($_POST['d2']))?>',
          style: {
            fontSize: '14px'
          }
        },
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>',
            style: {
              fontSize: '13px'
            }
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name} ({point.percentage:.2f}%)</b><br>Total: {point.y:.0f} Pasien',
					style: {
						color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                        fontSize: '11px'
					}
				}
			}
		},
		series: [{
			name: 'Total',
			colorByPoint: true,
			data: [
              <?php
  					for ($i = 0; $i < count($dokterGrafik); $i++) {
                    	if ($i == 0) {
                        	echo '
                               {
                                  name: \''.$dokterGrafik[$i][0].'\',
                                  y: '.$dokterGrafik[$i][1].'
                              }';  
                        }
                      	else {
                        	echo '
                               , {
                                  name: \''.$dokterGrafik[$i][0].'\',
                                  y: '.$dokterGrafik[$i][1].'
                              }';  
                        }
                    }
  			  ?>

			]
		}]
	});
</script>
<script language="javascript">
	document.getElementById('PrintOut').innerHTML = '<input type="button" value="Print Laporan Kunjungan Pasien" onclick="PrintDokument()">';
</script>