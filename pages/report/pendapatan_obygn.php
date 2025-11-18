<?php
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];
	//print_r($_SESSION);
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
	<div class="page-title ui-widget-content ui-corner-all">
		<h1>Laporan:<b> Pendapatan Poli Obygn</b></h1>
		<div class="other">
			<div class="float-left">Laporan Pendapatan Poli Obygn per Periode.</div>
			<div class="button float-right">&nbsp;</div>
			<div class="clearfix"></div>
		</div>
	</div>  
	<div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
		Tentukan Periode <input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y")?>" size="10" /> s/d <input type="text" value="<?php echo date("m/d/Y")?>" id="selesai" name="selesai" size="10" /> &nbsp; &nbsp;<input type="submit" class="btn btn-darkblue rounded" value=" View!! "  onclick="TampilLaporan()"  />
		&nbsp;&nbsp;&nbsp;
		<select id="cetak" name="cetak" size="1" onchange="PDFFile(this.value)" style="width: 70px;">
			<option value="NOL">--Print--</option>
			<option value="PDF">PDF/Cetak</option>
			<option value="EXC">Excell</option>
		</select>
	</div>
	<div id="DetailJasaDokter">&nbsp;</div>
</div>

<script language="javascript">
	function TampilLaporan() {
		var url = "pages/report/pendapatan_obygn_view.php";
		var d1 = document.getElementById('mulai').value;
		var d2 = document.getElementById('selesai').value
		var data = {d1:d1, d2:d2};

		document.getElementById('DetailJasaDokter').innerHTML = 'Tunggu sebentar ....';
		$('#DetailJasaDokter').load(url,data, function(){
			$('#DetailJasaDokter').fadeIn('fast');
		});
	}

	function PDFFile(ids) {
		var w = 850;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var d1 = document.getElementById('mulai').value;
		var d2 = document.getElementById('selesai').value

		if (ids == 'NOL') { 
			document.getElementById('DetailJasaDokter').innerHTML = '';
		}
		else if (ids == 'PDF') {
			var URL = 'pdf/pages/pendapatan_obygn_PDF.php?d1=' + d1 + '&d2=' + d2;
			popup = window.open(URL,"",windowprops);
		}
		else if (ids == 'EXC') { 
			popup = window.open(URL,"",windowprops);
		}
	}
</script>