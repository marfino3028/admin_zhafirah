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


	<script language="javascript">
		function penting() {
			document.getElementById('userid').focus();
		}
	</script>

	<style>
		.bg {
		  position: fixed; 
		  top: -50%; 
		  left: -50%; 
		  width: 200%; 
		  height: 200%;
		}
		.bg img {
		  position: absolute; 
		  top: 0; 
		  left: 0; 
		  right: 0; 
		  bottom: 0; 
		  margin: auto; 
		  min-width: 50%;
		  min-height: 50%;
		  opacity:0.6;
		}
	</style>

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="../img/apple-touch-icon-precomposed.png" />

    <script language="javascript">
        function CetakKartu(id) {
            var w = 300;
            var h = 350;
            var l = (screen.width - w) / 2;
            var t = (screen.height - h) / 2;
            var windowprops = "location=no,scrollbars=no,menubars=no,toolbars=no, toolbox=no,resizable=no" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;

            var URL = 'index_print.php?id=' + id;
            if (id != 0) {
                popup = window.open(URL,"",windowprops);
            }
        }
	  </script>
  
</head>
  
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">
    <table border="0" cellpadding="0" width="100%" style="border-collapse: collapse; background-image: url('../images/technocareBack.jpg'); background-repeat: no-repeat; background-size: 100% 100%; background-attachment: fixed; background-position: center;" height="100%">
    	<tr>
    		<td style="vertical-align: top; opacity: 0.9; width: 50%;">
                <div align="center">
                	<table border="0" cellpadding="0" cellspacing="1" width="100%" height="100%">
                		<tr>
                			<td height="100" style="background-color: #FFFFFF;">
                			    <img src="../images/logo1.png" height="100">
                			</td>
                		</tr>
                		<tr>
                			<td>
                                <video controls loop="true" autoplay style="width: 100%">
                                    <source src="alur_pengambilan_obat.mp4" type="video/mp4" />
                                    Browsermu tidak mendukung tag ini, upgrade donk!
                                </video>                			    
                			</td>
                		</tr>
                	</table>
                </div>
    		</td>
    		<td style="background-color: white; width: 50%; vertical-align: top; opacity: 0.8;">
    		    <p style="font-size: 24px; font-weight: bold; margin-left: 15px; margin-top: 15px;">
    		        Daftar Antrian
    		    </p>
                <div align="center">
                	<table border="0" width="100%">
                      	<?php
                        	ini_set('display_errors', 0);
                      		include "../3rdparty/engine.php";
                      		$data = $db->query("select a.kode, a.nomor from tbl_kiosk_antrian a left join tbl_kiosk_tombol b on b.kode_tombol=a.kode where a.status_antri='BUAT' and md5(b.kiosk_id)='".$_GET['id']."' group by a.kode order by a.urutan desc");
                      		for ($i = 0; $i < count($data); $i++) {
                      		    $loket = $db->query("select nama_kios, nama_tombol from tbl_kiosk_tombol where kode_tombol='".$data[$i]['kode']."'");
                      	?>
                		<tr>
                			<td>
                			    <div align="center" style="margin-top: 3px; margin-bottom: 3px;">
                                	<table border="0" width="98%">
                                		<tr>
                                			<td style="background-color: #0000FF; color: #FFFFFF;">
                                			    <?php
                                			        echo '<p align="left" style="margin-left: 15px; margin-top: 5px; margin-bottom: 5px; font-weight: bold; font-size: 36px;">'.$loket[0]['nama_kios'].' '.$loket[0]['nama_tombol'].'</p>';
                                			    ?>
                                			</td>
                                		</tr>
                                	</table>
                            	</div
                			</td>
                			<td width="75">
                			    <div align="left" style="margin-top: 3px; margin-bottom: 3px;">
                                	<table border="0" width="72">
                                		<tr>
                                			<td style="background-color: #0000FF; color: #FFFFFF;">
                                			    <?php
                                			        echo '<p align="center" style="margin-top: 5px; margin-bottom: 5px; font-weight: bold; font-size: 36px;">'.$data[$i]['nomor'].'</p>';
                                			    ?>
                                			</td>
                                		</tr>
                                	</table>
                            	</div
                			</td>
                		</tr>
                		<?php
                      		}
                		?>
                	</table>
                </div>
    		</td>
    	</tr>
    </table>
</body>

</html>
