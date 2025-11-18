<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Keuangan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Buku Besar</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Report Buku Besar per Periode
                    </h3>
                </div>
                <div class="box-content">
                    <div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
                        Tentukan Periode <input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y")?>" size="10" /> s/d <input type="text" value="<?php echo date("m/d/Y")?>" id="selesai" name="selesai" size="10" /> &nbsp; &nbsp;
                        <select id="akun" name="akun" size="1">
                            <option value="">--Pilih Akun--</option>
                            <option value="ALL">ALL/SEMUA</option>
                            <?php
                            $data = $db->query("select kd_coa, nm_coa from tbl_coa where status_delete='UD'");
                            for ($i = 0; $i < count($data); $i++) {
                                echo '<option value="'.$data[$i]['kd_coa'].'">'.$data[$i]['nm_coa'].'</option>';
                            }
                            ?>
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
		var url = "pages/keuangan/bukuBesar_view.php";
		var d1 = document.getElementById('mulai').value;
		var d2 = document.getElementById('selesai').value
		var akun = document.getElementById('akun').value;
		var data = {d1:d1, d2:d2, akun:akun};

		document.getElementById('DetailJasaDokter').innerHTML = 'Tunggu sebentar ....';
		$('#DetailJasaDokter').load(url,data, function(){
			$('#DetailJasaDokter').fadeIn('fast');
		});
	}
</script>