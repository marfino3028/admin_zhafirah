<?php
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];
	//print_r($_SESSION);
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Purchasing</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Laporan Stock Obat</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Laporan Stock Obat Apotik Per Bulan
                    </h3>
                </div>
                <div class="box-content">
                    <div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
                        Periode Bulan &nbsp; &nbsp;
                        <select id="bulan" name="bulan" size="1" style="width: 170px;">
                            <option value="">--pilih bulan--</option>
                            <?php
                            $bln = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agst', 'Sept', 'Okt', 'Nov', 'Des');
                            for ($i = 0; $i < count($bln); $i++) {
                                $no = $i + 1;
                                echo '<option value="'.$no.'">'.$bln[$i].'</option>';
                            }
                            ?>
                        </select> &nbsp; &nbsp;
                        <select id="tahun" name="tahun" size="1" style="width: 100px;">
                            <?php
                            $tahun_awal = date("Y") + 1;
                            for ($i = 2000; $i <= $tahun_awal; $i++) {
                                if ($i == date("Y")) {
                                    echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                }
                                else {
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
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
		var url = "pages/inv/lapporan_stock_obat_apotik_view.php";
		var bulan = document.getElementById('bulan').value;
		var tahun = document.getElementById('tahun').value
		var data = {bulan:bulan, tahun:tahun};

		document.getElementById('DetailJasaDokter').innerHTML = 'Tunggu sebentar ....';
		$('#DetailJasaDokter').load(url,data, function(){
			$('#DetailJasaDokter').fadeIn('fast');
		});
	}
</script>