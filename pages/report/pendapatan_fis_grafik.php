<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Pendapatan Fisio</title>
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
  if ($_GET['metode'] == 'ALL') {
    $data = $db->query("SELECT 
        ANY_VALUE(a.id) AS id,
        ANY_VALUE(a.no_daftar) AS no_daftar,
        ANY_VALUE(a.total_harga_fisio) AS total_harga_fisio_asli,
        SUM(a.total_harga_fisio) AS total_harga_fisio,
        c.nama_perusahaan,
        ANY_VALUE(b.metode_payment) AS metode_pembayaran,
        ANY_VALUE(b.kode_perusahaan) AS kodeNya
    FROM tbl_fisio a
    LEFT JOIN tbl_kasir b ON b.no_daftar = a.no_daftar
    LEFT JOIN tbl_pendaftaran c ON c.no_daftar = a.no_daftar
    WHERE a.tgl_insert >= '$date1'
    AND a.tgl_insert < '$date2'
    AND a.status_delete = 'UD'
    GROUP BY c.nama_perusahaan;
", 1);
  }
  elseif ($_GET['metode'] == 'CASH') {
    $data = $db->query("SELECT 
        c.nama_perusahaan,
        SUM(a.total_harga_fisio) AS total_harga_fisio,
        b.metode_payment AS metode_pembayaran,
        b.kode_perusahaan AS kodeNya
    FROM tbl_fisio a
    LEFT JOIN tbl_kasir b ON b.no_daftar = a.no_daftar
    LEFT JOIN tbl_pendaftaran c ON c.no_daftar = a.no_daftar
    WHERE a.tgl_insert >= '$date1'
    AND a.tgl_insert < '$date2'
    AND a.status_delete = 'UD'
    AND b.metode_payment = 'CASH'
    GROUP BY c.nama_perusahaan, b.metode_payment, b.kode_perusahaan;
", 1);
  }
  elseif ($_GET['metode'] == 'ASS') {
    $data = $db->query("SELECT 
        c.nama_perusahaan,
        SUM(a.total_harga_fisio) AS total_harga_fisio,
        b.metode_payment AS metode_pembayaran,
        b.kode_perusahaan AS kodeNya
    FROM tbl_fisio a
    LEFT JOIN tbl_kasir b ON b.no_daftar = a.no_daftar
    LEFT JOIN tbl_pendaftaran c ON c.no_daftar = a.no_daftar
    WHERE a.tgl_insert >= '2$date1'
    AND a.tgl_insert < '$date2'
    AND a.status_delete = 'UD'
    AND b.metode_payment = 'ASS'
    GROUP BY c.nama_perusahaan, b.metode_payment, b.kode_perusahaan;
", 1);
  }
  for ($i = 0; $i < count($data); $i++) {
    $dokterGrafik[$i] = array($data[$i]['nama_perusahaan'], $data[$i]['total_harga_fisio']);
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
          text: 'LAPORAN FISIOTERAPI-KLINIK UTAMA DIALISACARE',
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