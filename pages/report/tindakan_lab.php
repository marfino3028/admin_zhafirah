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
                <a href="javascript:void(0)">Tindakan Lab</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Laporan Tindakan Lab per Periode.
                    </h3>
                </div>
                <div class="box-content">
                    <div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
                        Tentukan Periode <input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y")?>" size="10" /> s/d <input type="text" value="<?php echo date("m/d/Y")?>" id="selesai" name="selesai" size="10" />
                        <select id="lab" name="lab" size="1" style="width: 190px;" tabindex="1" onchange="TampilHarga(this.value)" >
                            <option value="">--Pilih Tindakan & Grafik--</option>
                            <option value="GRAF">Grafik Semua Tindakan Lab</option>
                            <?php
                            $lab = $db->query("select * from tbl_kat_pelayanan where kode_jns_tarif='3' and status_delete='UD' order by kode_kat_pelayanan");
                            for ($i = 0; $i < count($lab); $i++) {
                                $j = $i + 1;
                                $kategori[$j] = $db->queryItem("select b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.kode_tarif='".$lab[$i]['kode_tarif']."'");
                                echo '<option value="'.$lab[$i]['kode_kat_pelayanan'].'">'.$lab[$i]['nama_kat_pelayanan'].'</option>';
                            }
                            ?>
                        </select>
                        &nbsp; &nbsp;<input type="submit" class="btn btn-darkblue rounded" value=" View!! "  onclick="TampilLaporan()"  />
                    </div>
                    <div id="DetailJasaDokter">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script language="javascript">
	function TampilLaporan() {
		var d1 = document.getElementById('mulai').value;
		var d2 = document.getElementById('selesai').value
		var lab = document.getElementById('lab').value
		var data = {d1:d1, d2:d2, lab:lab};
      	if (lab == 'GRAF') {
			var url = "pages/report/tindakan_lab_grafik.php";
        }
      	else {
          	var url = "pages/report/tindakan_lab_view.php";
        }

		document.getElementById('DetailJasaDokter').innerHTML = 'Tunggu sebentar ....';
		$('#DetailJasaDokter').load(url,data, function(){
			$('#DetailJasaDokter').fadeIn('fast');
		});
	}
</script>