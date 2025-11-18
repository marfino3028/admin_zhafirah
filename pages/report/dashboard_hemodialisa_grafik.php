
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Grafik Dashboard Stock Consumble / BHP Hemodialisa</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
	</head>
	<body>

<?php
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);

	//Nilai Tutup Pendapatan Harian
	$date1 = $_POST['d1'];
	$date2 = $_POST['d2'];
	//print_r($_POST);
?>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>



		<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Dashboard Stock Consumble / BHP Hemodialisa',
        style: {
           fontSize: '24px'
	}
    },
    xAxis: {
        categories: [
		<?php
			$data = $db->query("select kode_obat from tbl_medication_detail where tgl_insert >= '$date1' and tgl_insert < '$date2' group by kode_obat");
			for ($i = 0; $i < count($data); $i++) {
				$obat = $db->query("select * from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
				if ($i == 0) {
					echo "'".$obat[0]['nama_obat']."'";
				}
				else {
					echo ", '".$obat[0]['nama_obat']."'";
				}
			}
		?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rainfall (mm)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    legend: {
        itemStyle: {
            "color": "#333333",
            "cursor": "pointer",
            "fontSize": "14px",
            "textOverflow": "ellipsis"
        }
    },
    series: [{
        name: 'Stock Awal',
        data: [
		<?php
			$data = $db->query("select kode_obat, sum(qty) jumlah from tbl_medication_detail where tgl_insert >= '$date1' and tgl_insert < '$date2' group by kode_obat");
			for ($i = 0; $i < count($data); $i++) {
				$obat = $db->query("select * from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
				if ($obat[0]['stock_awal'] < 1) $obat[0]['stock_awal'] = 0;
				$obat[0]['stock_masuk'] = $obat[0]['stock_akhir'];
				$obat[0]['stock_akhir'] = $obat[0]['stock_masuk'] - $data[$i]['jumlah'];
				if ($i == 0) {
					echo $obat[0]['stock_awal'];
				}
				else {
					echo ', '.$obat[0]['stock_awal'];
				}
			}
		?>
		],
	dataLabels: {
           enabled: true,
	   rotation: 0,
	   align: 'center',
	   format: '{point.y}', // one decimal
	   y: 3, // 10 pixels down from the top
	   style: {
		fontSize: '10px'
	   }
	}
    }, {
        name: 'Stock Masuk',
        data: [
		<?php
			$data = $db->query("select kode_obat, sum(qty) jumlah from tbl_medication_detail where tgl_insert >= '$date1' and tgl_insert < '$date2' group by kode_obat");
			for ($i = 0; $i < count($data); $i++) {
				$obat = $db->query("select * from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
				if ($obat[0]['stock_awal'] < 1) $obat[0]['stock_awal'] = 0;
				$obat[0]['stock_masuk'] = $obat[0]['stock_akhir'];
				$obat[0]['stock_akhir'] = $obat[0]['stock_masuk'] - $data[$i]['jumlah'];
				if ($i == 0) {
					echo $obat[0]['stock_masuk'];
				}
				else {
					echo ', '.$obat[0]['stock_masuk'];
				}
			}
		?>
	       ],
	dataLabels: {
           enabled: true,
	   rotation: 0,
	   align: 'center',
	   format: '{point.y}', // one decimal
	   y: 3, // 10 pixels down from the top
	   style: {
		fontSize: '10px'
	   }
	}
    }, {
        name: 'Stock Keluar',
        data: [
		<?php
			$data = $db->query("select kode_obat, sum(qty) jumlah from tbl_medication_detail where tgl_insert >= '$date1' and tgl_insert < '$date2' group by kode_obat");
			for ($i = 0; $i < count($data); $i++) {
				$obat = $db->query("select * from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
				if ($obat[0]['stock_awal'] < 1) $obat[0]['stock_awal'] = 0;
				$obat[0]['stock_masuk'] = $obat[0]['stock_akhir'];
				$obat[0]['stock_akhir'] = $obat[0]['stock_masuk'] - $data[$i]['jumlah'];
				if ($i == 0) {
					echo $data[$i]['jumlah'];
				}
				else {
					echo ', '.$data[$i]['jumlah'];
				}
			}
		?>

	       ],
	dataLabels: {
           enabled: true,
	   rotation: 0,
	   align: 'center',
	   format: '{point.y}', // one decimal
	   y: 3, // 10 pixels down from the top
	   style: {
		fontSize: '10px'
	   }
	}
    }, {
        name: 'Stock Akhir',
        data: [
		<?php
			$data = $db->query("select kode_obat, sum(qty) jumlah from tbl_medication_detail where tgl_insert >= '$date1' and tgl_insert < '$date2' group by kode_obat");
			for ($i = 0; $i < count($data); $i++) {
				$obat = $db->query("select * from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
				if ($obat[0]['stock_awal'] < 1) $obat[0]['stock_awal'] = 0;
				$obat[0]['stock_masuk'] = $obat[0]['stock_akhir'];
				$obat[0]['stock_akhir'] = $obat[0]['stock_masuk'] - $data[$i]['jumlah'];
				if ($i == 0) {
					echo $obat[0]['stock_akhir'];
				}
				else {
					echo ', '.$obat[0]['stock_akhir'];
				}
			}
		?>

	       ],
	dataLabels: {
           enabled: true,
	   rotation: 0,
	   align: 'center',
	   format: '{point.y}', // one decimal
	   y: 3, // 10 pixels down from the top
	   style: {
		fontSize: '10px'
	   }
	}
    }]
});
		</script>
	</body>
</html>
