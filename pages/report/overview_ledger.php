<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Report Medik</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Overview Ledger</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Overview Ledger
                    </h3>
                </div>
                <div class="box-content">
                    <div style="text-align: left;">
			<div class="form-group">
				<div class="col-sm-2">
					<label for="textfield" class="control-label">Periode Awal</label>
					<input type="date" id="tgl_mulai" name="tgl_mulai" class="form-control" value="<?php echo date("Y-m-d")?>" />
					<br>
					<label for="textfield" class="control-label">Periode Akhir</label>
					<input type="date" value="<?php echo date("Y-m-d")?>" class="form-control" id="tgl_selesai" name="tgl_selesai" />
				</div>
				<div class="col-sm-5">
					<label for="textfield" class="control-label">Dari COA</label>
                        		<select id="coa1" name="coa1" class='form-control'>
                            			<option value="">--pilih COA--</option>
                            			<?php
                            				$dokter = $db->query("select kd_coa, nm_coa from tbl_coa where status_delete='UD' order by kd_coa");
                            				for ($i = 0; $i < count($dokter); $i++) {
                                				echo '<option value="'.$dokter[$i]['kd_coa'].'">'.$dokter[$i]['kd_coa'].' - '.$dokter[$i]['nm_coa'].'</option>';
                            				}
                            			?>
                        		</select>
					<br>
					<label for="textfield" class="control-label">Sampai  COA</label>
                        		<select id="coa2" name="coa2" class='form-control'>
                            			<option value="">--pilih COA--</option>
                            			<?php
                            				$dokter = $db->query("select kd_coa, nm_coa from tbl_coa where status_delete='UD' order by kd_coa");
                            				for ($i = 0; $i < count($dokter); $i++) {
                                				echo '<option value="'.$dokter[$i]['kd_coa'].'">'.$dokter[$i]['kd_coa'].' - '.$dokter[$i]['nm_coa'].'</option>';
                            				}
                            			?>
                        		</select>

				</div>
				<div class="col-sm-5">
					<label for="textfield" class="control-label">Tipe Laporan</label>
					<div class="radio"><label><input id="tipe1" type="radio" name="tipe" value="WITHOUT">Without Balance (Faster)</label></div>
					<div class="radio" style="margin-bottom: -0px"><label><input type="radio" id="tipe2" name="tipe" value="WITH">With Balance (Slow)</label></div>
                        		<br>
                        		<input type="button" class="btn btn-darkblue rounded" value=" View!! "  onclick="TampilLaporan()"  />
                        		<input type="button" class="btn btn-darkblue rounded" value=" Export Excel!! "  onclick="Excel()"  />
				</div>
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
		var url = "pages/report/overviewLedger_view.php";
		var d1 = document.getElementById('tgl_mulai').value;
		var d2 = document.getElementById('tgl_selesai').value;
		var coa1 = document.getElementById('coa1').value;
		var coa2 = document.getElementById('coa2').value;
		var tipe1 = document.getElementById('tipe1').checked;
		var tipe2 = document.getElementById('tipe2').checked;
		var t1 = document.getElementById('tipe1').value;
		var t2 = document.getElementById('tipe2').value;
		var data = {d1:d1, d2:d2, coa1:coa1, coa2:coa2, tipe1:tipe1, tipe2:tipe2, t1:t1, t2:t2};
		//alert("OK");

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
		var coa1 = document.getElementById('coa1').value;
		var coa2 = document.getElementById('coa2').value;
		var tipe1 = document.getElementById('tipe1').checked;
		var tipe2 = document.getElementById('tipe2').checked;
		var t1 = document.getElementById('tipe1').value;
		var t2 = document.getElementById('tipe2').value;
		var URL = 'pages/report/overviewLedger_excel.php?d1=' + d1 + '&d2=' + d2 + '&coa1=' + coa1 + '&coa2=' + coa2 + '&tipe1=' + tipe1 + '&tipe2=' + tipe2 + '&t1=' + t1 + '&t2=' + t2;
		window.location = URL;
	}

	function Detail_Jurnal(id) {
		var w = 850;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/keuangan/jurnal_print.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}	
</script>