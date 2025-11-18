<?php
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];
	//print_r($_SESSION);
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
	<div class="page-title ui-widget-content ui-corner-all">
		<h1><b>Informasi Stock Obat</b></h1>
		<div class="other">
			<div class="float-left">Informasi Stock Obat per Periode.</div>
			<div class="button float-right">&nbsp;</div>
			<div class="clearfix"></div>
		</div>
	</div>  
	<div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
		Tentukan Periode <input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y")?>" size="10" /> s/d <input type="text" value="<?php echo date("m/d/Y")?>" id="selesai" name="selesai" size="10" />
		<select id="obat" name="obat" size="1" style="width: 130px">
			<option value="">--Pilih Obat--</option>
			<?php
				$dt = $db->query("select kode_obat, nama_obat, jenis from tbl_obat where nama_obat <> '' order by nama_obat");
				for ($i = 0; $i < count($dt); $i++) {
					echo '<option value="'.$dt[$i]['kode_obat'].'">'.$dt[$i]['nama_obat'].' ('.$dt[$i]['jenis'].')'.'</option>';
				}
			?>
		</select>
		<select id="gudang" name="gudang" size="1" style="width: 130px">
			<option value="">--Pilih Gudang--</option>
			<option value="APOTIK">Apotik</option>
			<option value="GUDANG">Gudang Medik</option>
		</select>
		 &nbsp; &nbsp;<input type="submit" class="btn btn-darkblue rounded" value=" View!! "  onclick="TampilLaporan()"  />
	</div>
	<div id="DetailJasaDokter">&nbsp;</div>
</div>

<script language="javascript">
	function TampilLaporan() {
		var url = "pages/laporan/stock_view.php";
		var d1 = document.getElementById('mulai').value;
		var d2 = document.getElementById('selesai').value
		var obat = document.getElementById('obat').value
		var gudang = document.getElementById('gudang').value
		var data = {d1:d1, d2:d2, obat:obat, gudang:gudang};

		document.getElementById('DetailJasaDokter').innerHTML = 'Tunggu sebentar ....';
		$('#DetailJasaDokter').load(url,data, function(){
			$('#DetailJasaDokter').fadeIn('fast');
		});
	}
</script>