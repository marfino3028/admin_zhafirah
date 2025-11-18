<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Report Hemodialisa</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Patient Jouney</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Report Patient Journey
                    </h3>
                </div>
                <div class="box-content">
                    <div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
                        Tentukan Periode <input type="date" id="tgl_mulai" name="tgl_mulai" value="<?php echo date("Y-m-d")?>" size="10" /> s/d <input type="date" value="<?php echo date("Y-m-d")?>" id="tgl_selesai" name="tgl_selesai" size="10" />
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" class="btn btn-darkblue rounded" value=" View!! "  onclick="TampilLaporan()"  />
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" class="btn btn-darkblue rounded" value=" Export Excel!! "  onclick="Excel()"  />

                    </div>
                    <div id="DetailJasaDokter">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<script language="javascript">
	function TampilLaporan() {
		var url = "pages/report/jurney_view.php";
		var d1 = document.getElementById('tgl_mulai').value;
		var d2 = document.getElementById('tgl_selesai').value
		var data = {d1:d1, d2:d2};

		document.getElementById('DetailJasaDokter').innerHTML = 'Tunggu sebentar ....';
		$('#DetailJasaDokter').load(url,data, function(){
			$('#DetailJasaDokter').fadeIn('fast');
		});
	}

	function Excel() {
		var w = 850;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var d1 = document.getElementById('tgl_mulai').value;
		var d2 = document.getElementById('tgl_selesai').value
		var URL = 'pages/report/jurney_excel.php?d1=' + d1 + '&d2=' + d2;
		window.location = URL;
	}
</script>