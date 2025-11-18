<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Report Medik</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Timesheet Penggunaan Mesin Hemodialisis</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Timesheet Penggunaan Mesin Hemodialisis
                    </h3>
                </div>
                <div class="box-content">
                    <div style="text-align: left;">
			<div class="form-group">
				<div class="col-sm-1">&nbsp;</div>
				<label for="textfield" class="control-label col-sm-1" style="text-align: right; margin-top: 10px;">Tanggal</label>
				<div class="col-sm-2">
					<input type="date" id="tgl_mulai" name="tgl_mulai" class="form-control" value="<?php echo date("Y-m-d")?>" />
				</div>
				<div class="col-sm-2">
					<input type="date" id="tgl_selesai" name="tgl_selesai" class="form-control" value="<?php echo date("Y-m-d")?>" />
				</div>
				<div class="col-sm-1">
                        		<input type="button" class="form-control btn btn-darkblue rounded" value=" View!! "  onclick="TampilLaporan()"  />
				</div>
				<div class="col-sm-2">
                        		<input type="button" class="form-control btn btn-darkblue rounded" value="Export Excel"  onclick="ExportExcel()"  />
				</div>
				<div class="col-sm-1">&nbsp;</div>
			</div>
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
		var url = "pages/report/timesheed_hemodialisis_view.php";
		var d1 = document.getElementById('tgl_mulai').value;
		var d2 = document.getElementById('tgl_selesai').value;
		var data = {d1:d1, d2:d2};
		//alert("OK");

		document.getElementById('DetailJasaDokter').innerHTML = 'Tunggu sebentar ....';
		$('#DetailJasaDokter').load(url,data, function(){
			$('#DetailJasaDokter').fadeIn('fast');
		});
	}

	function ExportExcel() {
		var d1 = document.getElementById('tgl_mulai').value;
		var d2 = document.getElementById('tgl_selesai').value
		var URL = 'pages/report/timeSheed_hemodialisis_excel.php?d1=' + d1 + '&d2=' + d2;
		window.location = URL;
	}

</script>