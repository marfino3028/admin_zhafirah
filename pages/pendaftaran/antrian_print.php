<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>INHOUSE CLINIC | INDOLAKTO</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- icheck -->
	<link rel="stylesheet" href="../css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="../css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="../css/themes.css">


	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>

	<!-- Nice Scroll -->
	<script src="../js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="../js/plugins/validation/jquery.validate.min.js"></script>
	<script src="../js/plugins/validation/additional-methods.min.js"></script>
	<!-- icheck -->
	<script src="../js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootstrap -->
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/eakroko.js"></script>

	<!--[if lte IE 9]>
		<script src="../js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->



	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="../../img/apple-touch-icon-precomposed.png" />

</head>
	
<body>
<?php
	date_default_timezone_set('Asia/Jakarta');  
  	//echo date("d F Y H:i:s");
  	//print_r($_GET);
  	include "../../3rdparty/engine.php";
  	
?>
    
  	<p align="center" style="align: center; margin-bottom: -10px;">
    	<img src="../../images/logo1.png" height="50">
  	</p>
    <hr style="border: 2px black solid;" />
  	<p align="center" style="align: center; margin-top: -10px; font-size: 22px; font-weight: bold; margin-bottom: 0px; font-family: 'Arial Narrow';">
    	<?php 
      		echo ucfirst(strtolower($data[0]['nama_kios'])).' '.ucfirst(strtolower($data[0]['nama_tombol']));
      	?>  
  	</p>
  	<p align="center" style="align: center; font-size: 12px; margin-top: 0px; font-family: 'Arial Narrow';">
    	<?php 
      		echo date("d-m-Y H:i:s");
      	?>  
  	</p>
  	<p align="center" style="align: center; font-size: 20px; font-weight: bold; margin-bottom: 0px; font-family: 'Arial Narrow';">
    	Nomor Antrian  
  	</p>
  	<p align="center" style="align: center; font-size: 100px; font-weight: bold; margin-top: 0px; margin-bottom: 0px; font-family: 'Arial';">
    	<?php
      		echo strtoupper($data[0]['kode_tombol']).$nourut;
        ?>
  	</p>
  	<p align="center" style="align: center; font-size: 15px; margin-bottom: 0px; font-family: 'Arial Narrow';">
    	Silahkan Menunggu Panggilan  
  	</p>
  	<?php
  		//insert into database
  		//$insert = $db->query("insert into tbl_kiosk_antrian (tanggal, kode, urutan, nomor) values ('".date("Y-m-d")."', '".$data[0]['kode_tombol']."', '".$nourut."', '".strtoupper($data[0]['kode_tombol']).$nourut."')", 0);
  	?>
</body>

</html>