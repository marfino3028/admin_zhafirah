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
                <a href="javascript:void(0)">Rekapitulasi Pendapatan</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Rekapitulasi Pendapatan
                    </h3>
                    <a href="#" class="btn btn-sm btn-small btn-inverse rounded pull-right" onclick="PrintPendapatan()"><span class="fa fa-print"></span>Print Rekapitulasi Pendapatan</a>
                </div>
                <div class="box-content">
                    <div class="page-title ui-widget-content ui-corner-all" style="border: 0;">
                        <h1>Laporan:<b> Pendapatan Kasir</b></h1>
                        <div class="other">
                            <div class="float-left">Laporan Rekapitulasi Pendapatan Kasir per Periode (CASH & ASURANSI).</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
                        Periode <input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y")?>" size="8" /> s/d <input type="text" value="<?php echo date("m/d/Y")?>" id="selesai" name="selesai" size="8" /> &nbsp; &nbsp;
                        <input type="submit" class="btn btn-darkblue rounded" value=" View!! "  onclick="TampilLaporan()"  />
                        &nbsp;&nbsp;&nbsp;
                        <!--<select id="cetak" name="cetak" size="1" onchange="PDFFile(this.value)" style="width: 70px;">
                            <option value="NOL">--Print--</option>
                            <option value="PDF">PDF/Cetak</option>
                            <option value="EXC">Excell</option>
                        </select>-->
                    </div>
                    <div id="DetailJasaDokter">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>


<script language="javascript">
	function TampilLaporan() {
		var url = "pages/report/rekap_pendapatan_view.php";
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
				var URL = 'pdf/pages/pendapatan_kasir_PDF.php?d1=' + d1 + '&d2=' + d2 + '&su=' + su + '&m=' + m;
				popup = window.open(URL,"",windowprops);
			}
			else if (ids == 'EXC') { 
				var URL = 'excel/pages/pendapatan_kasir_xcl.php?d1=' + d1 + '&d2=' + d2 + '&su=' + su + '&m=' + m;
				popup = window.open(URL,"",windowprops);
			}
		}
	}

	function PrintPendapatan() {
		var w = 850;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var d1 = document.getElementById('mulai').value;
		var d2 = document.getElementById('selesai').value;

		var URL = 'pages/report/rekap_pendapatan_print.php?d1=' + d1 + '&d2=' + d2;
		popup = window.open(URL,"",windowprops);
	}

</script>