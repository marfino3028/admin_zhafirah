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

	if ($_GET['metode'] == 'ALL') {
		$no = 0;
		$nu = 0;
		$data = $db->query("select a.*, c.nama_perusahaan, b.metode_payment as metode_pembayaran, b.kode_perusahaan as kodeNya from tbl_lab a left join tbl_kasir b on b.no_daftar=a.no_daftar left join tbl_pendaftaran c on c.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' order by c.nama_perusahaan", 0);
		for ($i = 0; $i < count($data); $i++) {
			$no = $i + 1;
			$pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
			$kdokter = $db->queryItem("select kode_dokter from tbl_pendaftaran where nomr='".$data[$i]['nomr']."'");
			$dokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$kdokter."'");
			$plusBiaya = $db->queryItem("select c.tarif from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
			$data[$i]['total'] = $data[$i]['total'] + $plusBiaya;
			$ttlSum = $ttlSum + $data[$i]['total_harga_lab'];
			$sub = $db->query("select nama_tindakan, tarif_qty from tbl_lab_detail where labID='".$data[$i]['id']."'", 0);
			for ($j = 0; $j < count($sub); $j++) {
				$bahan[$nu]['nama'] = $sub[$j]['nama_tindakan'];
				$bahan[$nu]['nilai'] = $sub[$j]['tarif_qty'];
				$nu = $nu + 1;
			}
		}
		$upkPersen = $db->queryItem("select nilai from tbl_config where kode='UPK-LAB'");
		$vendorPersen = $db->queryItem("select nilai from tbl_config where kode='VENDOR-LAB'");
		$nilaiUPK = $upkPersen/100 * $ttlSum;
		$nilaiVendor = $vendorPersen/100 * $ttlSum;		
		//$bahan[0]['nama'] = 'PERSENTASE UPK';
		//$bahan[1]['nama'] = 'PERSENTASE VENDOR ';
		//$bahan[0]['nilai'] = $nilaiUPK;
		//$bahan[1]['nilai'] = $nilaiVendor;
	}	
	else {
		$no = 0;
		$nu = 0;
		$data = $db->query("select a.*, c.nama_perusahaan, b.metode_payment as metode_pembayaran, b.kode_perusahaan as kodeNya from tbl_lab a left join tbl_kasir b on b.no_daftar=a.no_daftar left join tbl_pendaftaran c on c.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' order by c.nama_perusahaan", 0);
		for ($i = 0; $i < count($data); $i++) {
			$no = $i + 1;
			$pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
			$kdokter = $db->queryItem("select kode_dokter from tbl_pendaftaran where nomr='".$data[$i]['nomr']."'");
			$dokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$kdokter."'");
			$plusBiaya = $db->queryItem("select c.tarif from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$data[$i]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
			$data[$i]['total'] = $data[$i]['total'] + $plusBiaya;
			$ttlSum = $ttlSum + $data[$i]['total_harga_lab'];
			$sub = $db->query("select nama_tindakan, tarif_qty from tbl_lab_detail where labID='".$data[$i]['id']."'");
			for ($j = 0; $j < count($sub); $j++) {
				$bahan[$nu]['nama'] = $sub[$j]['nama_tindakan'];
				$bahan[$nu]['nilai'] = $sub[$j]['tarif_qty'];
				$nu = $nu + 1;
			}
		}
		$upkPersen = $db->queryItem("select nilai from tbl_config where kode='UPK-LAB'");
		$vendorPersen = $db->queryItem("select nilai from tbl_config where kode='VENDOR-LAB'");
		$nilaiUPK = $upkPersen/100 * $ttlSum;
		$nilaiVendor = $vendorPersen/100 * $ttlSum;
		//$bahan[0]['nama'] = 'PERSENTASE UPK';
		//$bahan[1]['nama'] = 'PERSENTASE VENDOR ';
		//$bahan[0]['nilai'] = $nilaiUPK;
		//$bahan[1]['nilai'] = $nilaiVendor;
	}
	//echo '<pre>';
	//$bhn = array_multisort($bahan);
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
          text: 'LAPORAN TINDAKAN LABORATORIUM',
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