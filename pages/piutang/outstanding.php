<?php
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];
	//print_r($_SESSION);
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Piutang</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Outstanding Invoice</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Rekapitulasi Outstanding Invoice per Periode
                    </h3>
                </div>
                <div class="box-content">
                    <div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
                        Tentukan Periode <input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y")?>" size="10" /> s/d <input type="text" value="<?php echo date("m/d/Y")?>" id="selesai" name="selesai" size="10" /> &nbsp; &nbsp;
                        <select id="statusBayar" name="statusBayar" size="1">
                            <option value="">--Pilih Status--</option>
                            <option value="SDH">Sudah Dibayarkan (Paid)</option>
                            <option value="BLM">Belum Dibayarkan (Unpaid)</option>
                        </select> &nbsp; &nbsp;
                        <input type="submit" class="btn btn-darkblue rounded" value=" View!! "  onclick="TampilLaporan()"  />
                    </div>
                    <div id="DetailJasaDokter">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script language="javascript">
	function TampilLaporan() {
		var url = "pages/piutang/outstanding_view.php";
		var d1 = document.getElementById('mulai').value;
		var d2 = document.getElementById('selesai').value
		var st = document.getElementById('statusBayar').value;
		var data = {d1:d1, d2:d2, st:st};

		document.getElementById('DetailJasaDokter').innerHTML = 'Tunggu sebentar ....';
		$('#DetailJasaDokter').load(url,data, function(){
			$('#DetailJasaDokter').fadeIn('fast');
		});
	}
</script>