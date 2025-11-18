
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='fullcalendar.min.css' rel='stylesheet' />
<link href='fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='moment.min.js'></script>
<script src='jquery.min.js'></script>
<script src='fullcalendar.min.js'></script>
<?php
    include "../../3rdparty/engine.php";
    
    $daftar = $db->query("select * from tbl_pendaftaran where md5(no_daftar)='".$_GET['id']."'");
    $pasien = $db->query("select * from tbl_pasien where nomr='".$daftar[0]['nomr']."'");
    //echo "select * from tbl_pendaftaran where md5(no_daftar)='".$_GET['id']."'";
    //print_r($daftar);
    //print_r($pasien);
?>
<script>

  $(document).ready(function() {
    $('#calendar1').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      defaultDate: '<?php echo date("Y-m-d");?>',
      navLinks: true, // can click day/week names to navigate views
      selectable: false,
      selectHelper: true,
      select: function(start, end) {
        var title = prompt('Event Title:');
        var eventData;
        if (title) {
          eventData = {
            title: title,
            start: start,
            end: end
          };
          $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
        }
        $('#calendar').fullCalendar('unselect');
      },
      editable: false,
      eventLimit: "more", // allow "more" link when too many events
      events: [
        <?php
            $data = $db->query("select a.status_mesin, a.nomr, b.tgl_hd1, b.tgl_hd2, b.tipe_mesin, a.status_pasien, b.mulai_hd, b.durasi_hd from tbl_pendaftaran a left join tbl_catatan_dktr_hd b on b.no_daftar=a.no_daftar where a.status_delete='UD' and kd_poli='HE01' and b.tgl_hd2 is not NULL order by a.id desc", 0);
	    $mesin = array();
	    $last = date("t", strtotime(date("Y-m-d")));
	    $sekarang = date("Y-m-$last");
            for ($i = 0; $i < count($data); $i++) {
                $pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$data[$i]['nomr']."'");
                if ($i == 0) {
		    if ($data[$i]['status_pasien'] == 'CLOSED') {
                       echo "{ title: '".$data[$i]['nomr']." - ".$pasien[0]['nm_pasien']." - ".$data[$i]['tipe_mesin']."', start: '".$data[$i]['tgl_hd2']."', end: '".$data[$i]['tgl_hd2']."', color: 'green' }";
		    }
		    else {
		       if ($data[$i]['status_mesin'] == 'CLOSED') {
                          echo "{ title: '".$data[$i]['nomr']." - ".$pasien[0]['nm_pasien']." - ".$data[$i]['tipe_mesin']."', start: '".$data[$i]['tgl_hd2']."', end: '".$data[$i]['tgl_hd2']."', color: 'green' }";
		       }
		       else {
                          echo "{ title: '".$data[$i]['nomr']." - ".$pasien[0]['nm_pasien']." - ".$data[$i]['tipe_mesin']."', start: '".$data[$i]['tgl_hd2']."', end: '".$data[$i]['tgl_hd2']."', color: 'red' }";
		       }
		    }
                }
                else {
                    if ($data[$i]['status_pasien'] == 'CLOSED') {
                        echo ", { title: '".$data[$i]['nomr']." - ".$pasien[0]['nm_pasien']." - ".$data[$i]['tipe_mesin']."', start: '".$data[$i]['tgl_hd2']."', end: '".$data[$i]['tgl_hd2']."', color: 'green' }";
                    }
                    else {
                        if ($data[$i]['status_mesin'] == 'CLOSED') {
                            echo ", { title: '".$data[$i]['nomr']." - ".$pasien[0]['nm_pasien']." - ".$data[$i]['tipe_mesin']."', start: '".$data[$i]['tgl_hd2']."', end: '".$data[$i]['tgl_hd2']."', color: 'green' }";
                        }
                        else {
                            echo ", { title: '".$data[$i]['nomr']." - ".$pasien[0]['nm_pasien']." - ".$data[$i]['tipe_mesin']."', start: '".$data[$i]['tgl_hd2']." 12:00', end: '".$data[$i]['tgl_hd2']." 16:00', color: 'red' }";
                        }
                    }
                }
		if ($data[$i]['tipe_mesin'] != "" and $sekarang == $data[$i]['tgl_hd2']) {
			$hrni = date("j", strtotime($data[$i]['tgl_hd2']));
			if ($mes[$hrni] == 0) {
				$mesin[$hrni] = "'".$data[$i]['tipe_mesin']."'";
			}
			else {
				$mesin[$hrni] = $mesin[$hrni].", '".$data[$i]['tipe_mesin']."'";
			}
			$mes[$hrni] = $mes[$hrni] + 1;
			//echo ", { title: '".$data[$i]['tipe_mesin']."', start: '".$data[$i]['tgl_hd2']."', end: '".$data[$i]['tgl_hd2']."', color: 'black' }";
		}
            }

            $data = $db->query("select * from tbl_perjanjian where kd_poli='HE01' order by id desc", 0);
            for ($i = 0; $i < count($data); $i++) {
                $pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$data[$i]['nomr']."'");
		$cek_data = $db->query("select b.tgl_hd2 from tbl_pendaftaran a left join tbl_catatan_dktr_hd b on b.no_daftar=a.no_daftar where a.status_delete='UD' and kd_poli='HE01' and a.nomr='".$data[$i]['nomr']."' and b.tgl_hd2 is not NULL order by a.id desc", 0);
		if ($cek_data[0]['tgl_hd2'] == "") {
                	echo ", { title: '".$cek_data[0]['tgl_hd2']." - ".$pasien[0]['nm_pasien']." - ".$data[$i]['mesinHD_nama']."', start: '".$data[$i]['tgl_daftar']."', end: '".$data[$i]['tgl_daftar']."', color: 'blue' }";
			$hrni = date("j", strtotime($data[$i]['tgl_daftar']));
			if ($mes[$hrni] == 0) {
				$mesin[$hrni] = "'".$data[$i]['mesinHD_nama']."'";
			}
			else {
				$mesin[$hrni] = $mesin[$hrni].", '".$data[$i]['mesinHD_nama']."'";
			}
			$mes[$hrni] = $mes[$hrni] + 1;
		}
            }
	    
	    for ($j = 1; $j <= $last; $j++) {
	    	if ($mesin[$j] == "") $data = $db->query("select merk_mesin, no_seri from tbl_mesinHD");
		else $data = $db->query("select merk_mesin, no_seri from tbl_mesinHD where merk_mesin not in ($mesin[$j])");
		$tanggal = date("Y-m-$j");
	    	for ($i = 0; $i < count($data); $i++) {
			echo ", { title: '".$data[$i]['merk_mesin']." - Available', start: '".$tanggal."', end: '".$tanggal."', color: 'black' }";
	    	}
	    }

	    $next1 = date("n") + 1;
	    $tonext1 = date("Y-$next1-01");
	    $last = date("t", strtotime($tonext1));
	    for ($j = 1; $j <= $last; $j++) {
	    	if ($mesin[$j] == "") $data = $db->query("select merk_mesin, no_seri from tbl_mesinHD");
		else $data = $db->query("select merk_mesin, no_seri from tbl_mesinHD where merk_mesin not in ($mesin[$j])");
		$tanggal = date("Y-$next1-$j");
	    	for ($i = 0; $i < count($data); $i++) {
			echo ", { title: '".$data[$i]['merk_mesin']." - Available', start: '".$tanggal."', end: '".$tanggal."', color: 'black' }";
	    	}
	    }

	    $next1 = date("n") + 2;
	    $tonext1 = date("Y-$next1-01");
	    $last = date("t", strtotime($tonext1));
	    for ($j = 1; $j <= $last; $j++) {
	    	if ($mesin[$j] == "") $data = $db->query("select merk_mesin, no_seri from tbl_mesinHD");
		else $data = $db->query("select merk_mesin, no_seri from tbl_mesinHD where merk_mesin not in ($mesin[$j])");
		$tanggal = date("Y-$next1-$j");
	    	for ($i = 0; $i < count($data); $i++) {
			echo ", { title: '".$data[$i]['merk_mesin']." - Available', start: '".$tanggal."', end: '".$tanggal."', color: 'black' }";
	    	}
	    }

        ?>
	  ],
	  eventRender: function(event, element) {

			// To append if is assessment
			if(event.description != '' && typeof event.description  !== "undefined")
			{  
				element.find(".fc-title").append("<br/>"+event.description);
			}

			if(event.pic != '' && typeof event.pic  !== "undefined")
			{  
				element.find(".fc-title").append("<br/>"+event.pic);
			}
		}, 		
		timeFormat: 'H(:mm)' // uppercase H for 24-hour clock
    });

  });

</script>
<style nonce="dayakan">

  body {
    margin: 10px 10px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 100%;
    margin: 0 auto;
  }

</style>
</head>
<body>
  <div id='calendar1'></div>
</body>
</html>
