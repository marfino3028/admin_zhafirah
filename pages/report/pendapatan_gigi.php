<?php
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];
	//print_r($_SESSION);
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Report Medik</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pendapatan Poli Gigi</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Pendapatan Poli Gigi per Periode
                    </h3>
                </div>
                <div class="box-content">
                    <div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
                        Tentukan Periode <input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y")?>" size="10" /> s/d <input type="text" value="<?php echo date("m/d/Y")?>" id="selesai" name="selesai" size="10" /> &nbsp; &nbsp;<input type="submit" class="btn btn-darkblue rounded" value=" View!! "  onclick="TampilLaporan()"  />
                        &nbsp;&nbsp;&nbsp;
                        <select id="cetak" name="cetak" size="1" onchange="PDFFile(this.value)" style="width: 70px;">
                            <option value="NOL">--Print--</option>
                            <option value="PDF">Cetak</option>
                            <option value="EXC">Excell</option>
                            <option value="GRAF">Grafik</option>
                        </select>
                    </div>
                    <div id="DetailJasaDokter">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script language="javascript">
	function TampilLaporan() {
		var url = "pages/report/pendapatan_gigi_view.php";
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
			//var URL = 'pdf/pages/pendapatan_gigi_PDF.php?d1=' + d1 + '&d2=' + d2;
			var URL = 'pages/report/pendapatan_gigi_print.php?d1=' + d1 + '&d2=' + d2;
			popup = window.open(URL,"",windowprops);
		}
		else if (ids == 'EXC') { 
			var URL = 'pages/report/pendapatan_gigi_excel.php?d1=' + d1 + '&d2=' + d2;
			popup = window.open(URL,"",windowprops);
		}
		else if (ids == 'GRAF') { 
			var URL = 'pages/report/pendapatan_gigi_grafik.php?d1=' + d1 + '&d2=' + d2;
			popup = window.open(URL,"",windowprops);
		}
	}
</script>