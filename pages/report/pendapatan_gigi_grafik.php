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
<?php
  $data = $db->query("select a.*, sum(a.total_harga_gigi) total_harga_gigi, b.nama_perusahaan from tbl_gigi a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' group by b.nama_perusahaan", 0);
  $dokter = $db->query("select * from tbl_dokter where kode_dokter='".$_GET['dokter']."'");
  for ($i = 0; $i < count($data); $i++) {
    $dokterGrafik[$i] = array($data[$i]['nama_perusahaan'], $data[$i]['total_harga_gigi']);
  }
?>

  <div class="row">
      <div class="col-sm-12">
          <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
      </div>
    </div>
  
<script type="text/javascript">
	Highcharts.chart('container', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
          text: 'Poli Gigi Klinik, Apotek dan Laboratorium Semesta Medika',
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
					format: '<b>{point.name} ({point.percentage:.2f}%)</b><br>Total: Rp. {point.y:.0f}',
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
  
</body>
</html>