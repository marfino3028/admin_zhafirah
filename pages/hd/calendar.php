
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
            $data = $db->query("select * from tbl_jadwal_hd where no_daftar='".$daftar[0]['no_daftar']."'", 0);
            for ($i = 0; $i < count($data); $i++) {
                if ($i == 0) {
                    echo "{ title: '".$data[$i]['nama']."', start: '".$data[$i]['jadwal']."', end: '".$data[$i]['jadwal']."', color: 'blue' }";
                }
                else {
                    echo ", { title: '".$data[$i]['nama']."', start: '".$data[$i]['jadwal']."', end: '".$data[$i]['jadwal']."', color: 'blue' }";
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
