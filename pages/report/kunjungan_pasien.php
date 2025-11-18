<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Report Medik</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Kunjungan Pasien</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Laporan Kunjungan Pasien.
                    </h3>
                </div>
                <div class="box-content">
                    <div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
                        Tentukan Periode <input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y")?>" size="10" onclick="resetTombol()" /> s/d <input type="text" value="<?php echo date("m/d/Y")?>" id="selesai" name="selesai" size="10" onclick="resetTombol()" />
                        <select id="status_pasien" name="status_pasien" size="1" onchange="JasaDokter(this.value)">
                            <option value="">--pilih status pasien & Grafik--</option>
                            <option value="GRAF">Grafik Pasien</option>
                            <option value="ALL">All/Semua</option>
                            <option value="NEW">Pasien Baru</option>
                            <option value="OLD">Pasien Lama</option>
                        </select>
                        <div id="PrintOut" style="float: right; width: 275px; margin-right: 15px;" align="right">&nbsp;</div>
                    </div>
                    <div id="DetailJasaDokter">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script language="javascript">
	function JasaDokter(status_pasien) {
      	if (status_pasien == 'GRAF') {
			var url = "pages/report/kunjungan_pasien_grafik.php";
        }
      	else {
          	var url = "pages/report/kunjungan_pasien_view.php";
        }
		var d1 = document.getElementById('mulai').value;
		var d2 = document.getElementById('selesai').value
		var data = {d1:d1, d2:d2, status_pasien:status_pasien};

		document.getElementById('DetailJasaDokter').innerHTML = 'Tunggu sebentar ....';
		$('#DetailJasaDokter').load(url,data, function(){
			$('#DetailJasaDokter').fadeIn('fast');
		});
	}
	
	function resetTombol() {
		document.getElementById('status_pasien').value = "";
		document.getElementById('DetailJasaDokter').innerHTML = "";
		document.getElementById('PrintOut').innerHTML = "";
	}
	
	function PrintDokument() {
		var w = 1100;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var d1 = document.getElementById('mulai').value;
		var d2 = document.getElementById('selesai').value
		var sp = document.getElementById('status_pasien').value
		var URL = 'pages/report/kunjungan_pasien_print.php?start=' + d1 + '&end=' + d2 + '&sp=' + sp;
		popup = window.open(URL,"",windowprops);
	}
</script>