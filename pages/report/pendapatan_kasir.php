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
                <a href="javascript:void(0)">Pendapatan Kasir</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Pendapatan Kasir
                    </h3>
                </div>
                <div class="box-content">
                    <div class="container-fluid>">
                        <div class="float-left" style="padding-left: 10px;">Laporan Pendapatan Kasir per Periode.</div>
                        <div class="button float-right">&nbsp;</div>
                        <div class="clearfix"></div><br>
                    </div>
                    <div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
                        Periode <input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y")?>" size="7" /> s/d <input type="text" value="<?php echo date("m/d/Y")?>" id="selesai" name="selesai" size="7" /> &nbsp; &nbsp;
                        <select id="shiftUser" name="shiftUser" size="1">
                            <option value="">--pilih shift--</option>
                            <option value="ALL">All / Semua</option>
                            <option value="1">Shift 1</option>
                            <option value="2">Shift 2</option>
                            <option value="3">Shift 3</option>
                        </select> &nbsp; &nbsp;
                        <select id="metode" name="metode" size="1" style="width: 170px;">
                            <option value="">--metode pembayaran--</option>
                            <option value="ALL">All / Semua</option>
                            <option value="CASH">Cash</option>
                            <option value="ASS">Asuransi Perusahaan</option>
                            <option value="CC">Kartu Kredit</option>
                            <option value="DEBIT">Debit</option>
                        </select> &nbsp; &nbsp;
                        <input type="submit" class="btn btn-darkblue rounded" value=" View!! "  onclick="TampilLaporan()"  />
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
		var url = "pages/report/pendapatan_kasir_view.php";
		var d1 = document.getElementById('mulai').value;
		var d2 = document.getElementById('selesai').value
		var su = document.getElementById('shiftUser').value;
		var m = document.getElementById('metode').value;
		var data = {d1:d1, d2:d2, su:su, m:m};

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
		var su = document.getElementById('shiftUser').value;
		var m = document.getElementById('metode').value;
		if (su == "" || m == "") {
			alert('Silahkan Tentukan dan/atau metode pembayaran terlebih dahulu');
		}
		else {
			if (ids == 'NOL') { 
				document.getElementById('DetailJasaDokter').innerHTML = '';
			}
			else if (ids == 'PDF') {
				//var URL = 'pdf/pages/pendapatan_kasir_PDF.php?d1=' + d1 + '&d2=' + d2 + '&su=' + su + '&m=' + m;
				var URL = 'pages/report/pendapatan_kasir_print.php?d1=' + d1 + '&d2=' + d2 + '&su=' + su + '&m=' + m;
				popup = window.open(URL,"",windowprops);
			}
			else if (ids == 'EXC') { 
				var URL = 'excel/pages/pendapatan_kasir_xcl.php?d1=' + d1 + '&d2=' + d2 + '&su=' + su + '&m=' + m;
				popup = window.open(URL,"",windowprops);
			}
			else if (ids == 'GRAF') { 
				var URL = 'pages/report/pendapatan_kasir_grafik.php?d1=' + d1 + '&d2=' + d2 + '&su=' + su + '&m=' + m;
				popup = window.open(URL,"",windowprops);
			}
		}
	}

</script>