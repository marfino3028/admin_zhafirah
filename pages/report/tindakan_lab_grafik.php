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
	$t1 = explode("/", $_POST['d1']);
	$t2 = explode("/", $_POST['d2']);
	//Nilai Tutup Pendapatan Harian
	$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
	$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
	$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
	$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;  

   $dokterGrafik = $db->query("select * from tbl_kat_pelayanan where kode_jns_tarif='3' and status_delete='UD' order by kode_kat_pelayanan");
   for ($i = 0; $i < count($dokterGrafik); $i++) {
   	$ttindakan = 0;
	$datass = $db->query("select a.* from tbl_lab_detail a left join tbl_lab b on b.id=a.labID where a.status_delete='UD' and b.tgl_input_lab >= '$date1' and b.tgl_input_lab < '$date2' and a.kode_tarif in (select kode_tarif from tbl_tarif where kode_kat_pelayanan='".$dokterGrafik[$i]['kode_kat_pelayanan']."')", 0);
	for ($j = 0; $j < count($datass); $j++) {
		$ttindakan = $ttindakan + $datass[$j]['tarif'];
	}
	$bahan[$i]['nama'] = $dokterGrafik[$i]['nama_kat_pelayanan'];
	$bahan[$i]['nilai'] = $ttindakan;
   }
	//print_r($bahan);
?>
<body>

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
          text: 'Tindakan Lab Klinik, Apotek dan Laboratorium Semesta Medika',
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
		   //$dokterGrafik = $db->query("select * from tbl_kat_pelayanan where kode_jns_tarif='3' and status_delete='UD' order by kode_kat_pelayanan");
  		   for ($i = 0; $i < count($bahan); $i++) {

                    	if ($i == 0) {
                        	echo '
                               {
                                  name: \''.$bahan[$i]['nama'].'\',
                                  y: '.$bahan[$i]['nilai'].'
                              }';  
                        }
                      	else {
                        	echo '
                               , {
                                  name: \''.$bahan[$i]['nama'].'\',
                                  y: '.$bahan[$i]['nilai'].'
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