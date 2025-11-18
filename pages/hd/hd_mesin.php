<?php
	$next = date("Y-m-d", mktime(0, 0, 0, date("m")+1, 1, date("Y")));
	//$next = date("Y-m-01", strtotime('+ 29 day'));
	$nowAwal = date("Y-m-01");
	$nowAkhir = date("Y-m-d", strtotime($next.'- 1 day'));
	$awal = date("w", strtotime($nowAwal)) + 1; 
	$akhir = date("d", strtotime($next.'- 1 day'));
	$minggu1 = date("W", strtotime($nowAwal)) * 1;
	$minggu2 = date("W", strtotime($next)) * 1;
	$jml_minggu = $minggu2 - $minggu1 + 1;
	$jml_hari = 7 * $jml_minggu;
?>
<link rel="stylesheet" media="screen" href="theme/scripts/fullcalendar/fullcalendar/fullcalendar.css" />

<div class="widget">
	<div class="widget-head">
		<h4 class="heading">Penggunaan Mesin HD</h4>
	</div>
	<div class="widget-body">
		
		<div>
			<table class="fc-header" width="100%">
				<tbody>
				<tr>
					<td class="fc-header-left">
						<div class="btn-group">
							<button class="fc-button btn btn-small btn-primary fc-button-prev">&nbsp;<</button>
							<button class="fc-button btn btn-small btn-primary fc-button-today">Hari ini</button>
							<button class="fc-button btn btn-small btn-primary fc-button-next">&nbsp;></button>
						</div><span class="fc-header-space"></span>
					</td>
					<td class="fc-header-center"><span class="fc-header-title"><h2><?php echo date("F Y")?></h2></span></td>
					<td class="fc-header-right">&nbsp;</td>
				</tr>
				</tbody>
			</table>
			<div class="fc-content" style="position: relative; min-height: 1px;">
				<div unselectable="on" class="fc-view fc-view-month fc-grid" style="position: relative; -moz-user-select: none;">
					<table class="fc-border-separate table table-striped" style="width:100%" cellspacing="0">
						<thead>
						<tr class="fc-first fc-last" style="background-color: #FFCC99">
							<th style="width: 160px; border-top: 2px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;">Minggu</th>
							<th style="width: 160px; border-top: 2px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;">Senin</th>
							<th style="width: 160px; border-top: 2px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;">Selasa</th>
							<th style="width: 160px; border-top: 2px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;">Rabu</th>
							<th style="width: 160px; border-top: 2px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;">Kamis</th>
							<th style="width: 160px; border-top: 2px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;">Jumat</th>
							<th style="width: 160px; border-top: 2px solid #000000; border-right: 2px solid #000000; border-bottom: 1px solid #000000;">Sabtu</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<?php
								$baris_akhir = ($jml_minggu - 1) * 7;
								for ($i = 1; $i <= $jml_hari; $i++) {
									if ($i == 1 or (($i-1) % 7 == 0)) {
										$border = 'border-left: 2px #000000 solid; border-right: 1px #000000 solid;';
									}
									else {
										if ($i % 7 == 0) {
											$border = 'border-right: 2px #000000 solid;';
										}
										else {
											$border = 'border-right: 1px #000000 solid;';
										}
									}
									
									if ($i > $baris_akhir) {
										$border2 = 'border-bottom: 2px #000000 solid;';
									}
									else {
										$border2 = 'border-bottom: 1px #000000 solid;';
									}
									
									if ($i >= $awal and $i <= ($akhir + $awal - 1)) {
										$tgl = $i - $awal + 1;
										if ($tgl < 10) $tgl = '0'.$tgl;
										$tglSkr = date("Y-m-$tgl");
										$tanggalPojok = '<div style="float: right; width: 20px; background-color: #000000; color: #FFFFFF; text-align: center; cursor: pointer;" title="Add New Agenda" onclick="return window.location = \'#\';">'.$tgl.'</div>';
									}
									elseif ($i < $awal) {
										$tgl = date("j", strtotime($nowAwal.'- '.abs($i - $awal).' day'));
										$tglSkr = date("Y-m-$tgl", strtotime('- 1 month'));
										$tanggalPojok = '<div style="float: right; width: 20px; background-color: #CCCCCC; color: #666666; text-align: center; cursor: pointer;" title="Add New Agenda" onclick="return window.location = \'#\';">'.$tgl.'</div>';
									}
									elseif ($i > ($akhir + $awal - 1)) {
										$tambahan = $i - $awal;
										$tgl = date("j", strtotime($nowAwal.'+ '.$tambahan.' day'));
										$tglSkr = date("Y-m-$tgl", strtotime('+ 1 month'));
										$tanggalPojok = '<div style="float: right; width: 20px; background-color: #CCCCCC; color: #666666; text-align: center; cursor: pointer;" title="Add New Agenda" onclick="return window.location = \'#\';">'.$tgl.'</div>';
									}
									
									if (date("Y-m-d") == $tglSkr) {
										$bgNow = 'background-color: #7bf4ff';
							 		}
									else {
										$bgNow = '';
									}
									
									//$data = $db_master->query("select * from acc_agenda where tanggal='$tglSkr'");
							?>
							<td style="<?php echo $border.' '.$border2.' '.$bgNow?>" valign="bottom">
								<div style="min-height: 132px;"><?php echo $tanggalPojok?>
								<div class="fc-day-content">
									<?php
										$totUSD = 0;
										$totIDR = 0;
										for ($l = 0; $l < count($data); $l++) {
											if ($data[$l]['currency'] == 'IDR')	{
												$data[$l]['currency'] = 'Rp';
												$data[$l]['txtTot'] = number_format($data[$l]['total']);
												$totIDR = $totIDR + $data[$l]['total'];
											}
											elseif ($data[$l]['currency'] == 'USD')	{
												$data[$l]['currency'] = '$';
												$data[$l]['txtTot'] = number_format($data[$l]['total'], 2);
												$totUSD = $totUSD + $data[$l]['total'];
											}
											
											
										}
										$data = $db->query("select a.id, a.nomr, a.nama, a.mesinHD_nama, a.mesinHD_id, a.shift, a.status_pasien, b.nama nama_shift from tbl_perjanjian a left join tbl_shift_hd b on b.nilai=a.shift where a.tgl_daftar='".$tglSkr."'", 0);
										$mesinnoava1 = "";
										$mesinnoava2 = "";
            									for ($ii = 0; $ii < count($data); $ii++) {
                									$pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$data[$ii]['nomr']."'");
											if ($data[$ii]['status_pasien'] == "OPEN") {
												echo '<div style="font-size: 10px; border-bottom: 1px #000000 solid;">'.$data[$ii]['nomr'].' - '.$data[$ii][nama].' - '.$data[$ii]['mesinHD_nama'].' - '.$data[$ii]['nama_shift'].'</div>';
												if ($mesinnoava1 == "" and $data[$ii]['shift'] == 1) $mesinnoava1 = $data[$ii]['mesinHD_id'];
												elseif ($mesinnoava1 != "" and $data[$ii]['shift'] == 1) $mesinnoava1 = $mesinnoava1.', '.$data[$ii]['mesinHD_id'];

												if ($mesinnoava2 == "" and $data[$ii]['shift'] == 2) $mesinnoava2 = $data[$ii]['mesinHD_id'];
												elseif ($mesinnoava2 != "" and $data[$ii]['shift'] == 2) $mesinnoava2 = $mesinnoava2.', '.$data[$ii]['mesinHD_id'];
											}
											elseif ($data[$ii]['status_pasien'] == "CANCLE") {
												echo '<div style="font-size: 10px; border-bottom: 1px #000000 solid; color: red;"><strong>'.$data[$ii]['nomr'].' - '.$data[$ii][nama].' - '.$data[$ii]['mesinHD_nama'].' - '.$data[$ii]['nama_shift'].'</strong></div>';
											}
											elseif ($data[$ii]['status_pasien'] == "CLOSED") {
												echo '<div style="font-size: 10px; border-bottom: 1px #000000 solid; color: blue;"><strong>'.$data[$ii]['nomr'].' - '.$data[$ii][nama].' - '.$data[$ii]['mesinHD_nama'].' - '.$data[$ii]['nama_shift'].'</strong></div>';
											}
            									}
										$shifthd = $db->query("select nilai, nama from tbl_shift_hd order by nilai");
										for ($s = 0; $s < count($shifthd); $s++) {
											echo '<div style="font-size: 10px; border: 1px #000000 solid; color: green; margin-top: 10px; text-align: center;">Availabel <strong>'.$shifthd[$s]['nama'].'</strong><br>';
											$varMesin = 'mesinnoava'.$shifthd[$s]['nilai'];
											if ($$varMesin == "") {
												$mesinhd= $db->query("select id, merk_mesin, no_seri from tbl_mesinHD", 0);
											}
											else {
												$mesinhd= $db->query("select id, merk_mesin, no_seri from tbl_mesinHD where id not in (".$$varMesin.")", 0);
											}
											$nomesin = 0;
											for ($m = 0; $m < count($mesinhd); $m++) {
												$nomesin = $nomesin + 1;
												echo '<div style="text-align: left; margin-left: 5px;">'.$nomesin.'. '.$mesinhd[$m]['merk_mesin'].'</div>';
											}
											echo '</div>';
										}

	
										if ($i % 7 == 0) {
											if ($totUSD1 > 0 or $totIDR1 > 0) {
												echo '<div style="font-weight: bold; margin-top: 15px; font-size: 12px;">Total Weekly</div>';
											}
											
											if ($totUSD1 > 0) {
												echo '<span class="btn btn-block btn-primary" style="font-size: 12px; text-align: center; margin-top: 10px;">USD. '.number_format($totUSD1, 2).'</span>';
											}
											if ($totIDR1 > 0) {
												echo '<span class="btn btn-block btn-warning" style="font-size: 12px; text-align: center;">IDR '.number_format($totIDR1, 0).'</span>';
											}
											$totUSD1 = 0;
											$totIDR1 = 0;
										}

										echo '</div></div>';
										
										if ($totIDR > 0 or $totUSD > 0) {
											echo '<div style="border: 1px #000000 solid; background-color: #999999; height: 45px; margin-top: 10px; font-size: 11px; text-align: center; font-weight: bold;">USD.'.number_format($totUSD, 2).'<br>IDR.'.number_format($totIDR).'</div>';
										}
									?>
									
							</td>
							<?php
									if ($i % 7 == 0) {
										echo '</tr><tr>';
									}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function() 
	{
	
		/* initialize the external events
		-----------------------------------------------------------------*/
	
		$('#external-events ul li').each(function() 
		{
		
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};
			
			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);
			
			// make the event draggable using jQuery UI
			$(this).draggable(
			{
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0,  //  original position after the drag,
				start: function() { if (typeof mainYScroller != 'undefined') mainYScroller.disable(); },
				stop: function() { if (typeof mainYScroller != 'undefined') mainYScroller.enable(); }
			});
			
		});
	
		/* initialize the calendar
		-----------------------------------------------------------------*/
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			droppable: true,
			events: "ajax.php?section=calendarEvents",
			drop: function(date, allDay) 
			{
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
				
				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;
				
				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
				
				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}
				
			}
		});
		
		
	});

</script>		


<!-- Calendar -->
<script src="theme/scripts/fullcalendar/fullcalendar/fullcalendar.js"></script>