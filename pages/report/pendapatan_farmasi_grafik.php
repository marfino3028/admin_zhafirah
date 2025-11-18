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
	$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1];
	//$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
	$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
	//$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;  
	//echo $date1." dan ".$date2;	
?>
<body>
<?php
    $data = $db->query("select * from tbl_resep where tgl_insert >= '$date1' and tgl_insert < '$date2' and status_delete='UD'", 0);
  for ($i = 0; $i < count($data); $i++) {
	$pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
	$data[$i]['nama_perusahaan'] = $db->queryItem("select nama_perusahaan from tbl_pendaftaran where nomr='".$data[$i]['nomr']."'");
	$non_racikan = $db->queryItem("select sum(a.total) from tbl_resep_detail a left join tbl_resep b on b.id=a.resep_id where b.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD'");
	$racikan[$i] = $db->queryItem("select sum(a.total) from tbl_racikan_detail a left join tbl_racikan b on b.id=a.racikanId where b.no_resep='".$data[$i]['no_resep']."' and a.status_delete='UD'");
	$racikannr = $db->queryItem("select count(a.total) from tbl_racikan_detail a left join tbl_racikan b on b.id=a.racikanId where b.no_resep='".$data[$i]['no_resep']."' and a.status_delete='UD'");
	$embalase = $db->queryItem("select nilai from tbl_config where tahun='".date("Y")."' and kode='RACIKAN'");
	if ($racikannr > 1) $racikannr = 1;
	$total_embalase = $embalase * $racikannr;
	$racikan[$i] = $racikan[$i] + $total_embalase;
	$total = $non_racikan + $racikan[$i];
								
	$nofr = $db->queryItem("select nofr from tbl_kasir where no_daftar='".$data[$i]['no_daftar']."'");
	$tgl_transaksi = $db->queryItem("select date(tgl_insert) from tbl_kasir where no_daftar='".$data[$i]['no_daftar']."'");
    	//$dokterGrafik[$i] = array($data[$i]['nama_perusahaan'], $data[$i]['total_harga_fisio']);
	$racikans = $racikans + $racikan[$i];
	$nonracikans = $nonracikans + $non_racikan;
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
          text: 'LAPORAN PENDAPATAN FARMASI-KLINIK UTAMA DIALISACARE',
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
                        	echo '
                               {
                                  name: \'Non Racikan\',
                                  y: '.$nonracikans.'
                              }';  
                        	echo '
                               , {
                                  name: \'Racikan\',
                                  y: '.$racikans.'
                              }';  
  			  ?>

			]
		}]
	});
</script>
  
</body>
</html>