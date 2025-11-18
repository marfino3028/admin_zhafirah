<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Laporan Keuangan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Laporan Umur Piutang Asuransi / Perusahaan</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Laporan Umur Piutang Asuransi / Perusahaan
                    </h3>
                </div>
                <div class="box-content">
                    <div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
                        Tentukan Periode <input type="date" id="tgl_mulai" name="tgl_mulai" value="<?php echo date("Y-m-d")?>" size="10" /> s/d <input type="date" value="<?php echo date("Y-m-d")?>" id="tgl_selesai" name="tgl_selesai" size="10" />
                        <select id="penjamin" name="penjamin" size="1"style="height: 38px;" >
                            <option value="">--pilih Penjamin--</option>
                            <?php
                            	$dokter = $db->query("select nama_perusahaan from tbl_invoice group by nama_perusahaan");
                            	for ($i = 0; $i < count($dokter); $i++) {
                                	echo '<option value="'.$dokter[$i]['nama_perusahaan'].'">'.$dokter[$i]['nama_perusahaan'].'</option>';
                            	}
                            ?>
                        </select>
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
		var url = "pages/report/invoice_aging_view.php";
		var d1 = document.getElementById('tgl_mulai').value;
		var d2 = document.getElementById('tgl_selesai').value;
		var jamin = document.getElementById('penjamin').value;
		var data = {d1:d1, d2:d2, jamin:jamin};

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
		var URL = 'pages/report/hemodialisa_excel.php?d1=' + d1 + '&d2=' + d2;
		window.location = URL;
	}
</script>