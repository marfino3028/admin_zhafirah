<?php
	$data = $db->query("select * from tbl_penjualan_obat where id='".$_GET['id']."'");
	$dataTdk = $db->query("select no_daftar, nomr from tbl_resep where id='".$_GET['id']."'", 0);
?>
<script language="javascript">
	function CariPasien(id) {
		var url = "pages/pendaftaran/view_pasien.php";
		var data = {id:id};
		
		$('.loading').fadeIn();
		$('#data_pasien').fadeOut();
		$('#data_pasien').load(url,data, function(){
			$('.loading').fadeOut('fast');
			$('#data_pasien').fadeIn('fast');
		});
	}
	
	function simpanObat() {
		var id = '<?php echo $_GET['id']?>';
		var jual = document.getElementById('no_penjualan').value;
		var nama = document.getElementById('nama').value;
		var telp = document.getElementById('telp').value;
		var obat = document.getElementById('obat').value;
		var qty = document.getElementById('qty').value;
		var url = "pages/farmasi/input_jual_obat_detail.php";
		var data = {id:id, jual:jual, nama:nama, telp:telp, obat:obat, qty:qty};
		
		$('.loading').fadeIn();
		$('#data_pasien').fadeOut();
		$('#data_pasien').load(url,data, function(){
			$('.loading').fadeOut('fast');
			$('#data_pasien').fadeIn('fast');
		});
	
	}
	
	function CreateRacikan(id) {
		if (id == 'RACIK') {
			var ids = '<?php echo $_GET['id']?>';
			var resep = document.getElementById('no_penjualan').value;
			var url = "pages/farmasi/input_resep_obat_detail_racik.php";
			var data = {id:ids, resep:resep};
			
			$('.loading').fadeIn();
			$('#DataAdd').load(url,data, function(){
				$('#DataAdd').fadeIn('fast');
			});
		}
		else if (id == 'MEDIS') {
			var ids = '<?php echo $_GET['id']?>';
			var resep = document.getElementById('no_penjualan').value;
			var url = "pages/farmasi/input_resep_obat_tindakan.php";
			var data = {id:ids, resep:resep};
			
			$('.loading').fadeIn();
			$('#DataAdd').load(url,data, function(){
				$('#DataAdd').fadeIn('fast');
			});
		}
		else if (id == 'ALKES') {
			var ids = '<?php echo $_GET['id']?>';
			var resep = document.getElementById('no_penjualan').value;
			var url = "pages/farmasi/input_resep_obat_alkes.php";
			var data = {id:ids, resep:resep};
			
			$('.loading').fadeIn();
			$('#DataAdd').load(url,data, function(){
				$('#DataAdd').fadeIn('fast');
			});
		}
		else {
			var url = "pages/farmasi/input_jual_obat_qty.php";
			var data = {id:id};
			
			$('.loading').fadeIn();
			$('#DataAdd').load(url,data, function(){
				$('#DataAdd').fadeIn('fast');
			});
		}
	}

	function TambahTindakan() {
		var ids = '<?php echo $_GET['id']?>';
		var resep = document.getElementById('no_penjualan').value;
		var obat = document.getElementById('obat_tindakan').value;
		var tarif = document.getElementById('tTindakan').value;
		var qty = document.getElementById('qty').value;
		var url = "pages/farmasi/input_langsung_obat_tindakan_insert.php";
		var data = {id:ids, resep:resep, obat:obat, tarif:tarif, qty:qty};
		
		$('#data_pasien').load(url,data, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}
	
	function TambahRacikan() {
		var ids = '<?php echo $_GET['id']?>';
		var resep = document.getElementById('no_penjualan').value;
		var racikan = document.getElementById('nRacikan').value;
		var url = "pages/farmasi/input_jual_obat_detail_racik_insert.php";
		var data = {id:ids, resep:resep, racikan:racikan};
		
		$('.loading').fadeIn();
		$('#DataAdd').load(url,data, function(){
			$('#DataAdd').fadeIn('fast');
		});
		
		var data1 = {id:ids, resep:resep};
		var url1 = "pages/farmasi/input_jual_obat_detail2.php";
		$('#data_pasien').load(url1,data1, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}
	
	function simpanObatRacikan() {
		var ids = '<?php echo $_GET['id']?>';
		var resep = document.getElementById('no_penjualan').value;
		var obat = document.getElementById('obatR').value;
		var qty = document.getElementById('qty').value;
		var racikan = document.getElementById('id_racikan').value;
		var url = "pages/farmasi/input_jual_obat_detail_racik_obat_insert.php";
		var data = {id:ids, resep:resep, obat:obat, qty:qty, racikan:racikan};
		
		$('#data_pasien').load(url,data, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}

	function PilihTindakan(id) {
		var url = "pages/farmasi/input_resep_obat_tindakan_tarif.php";
		var data = {id:id};
		
		$('#TarifTindakan').load(url,data, function(){
			$('#TarifTindakan').fadeIn('fast');
		});
	}	

</script>
<script language="javascript">
	$(document).ready(function() {
		$("#obat").select2({
		    minimumInputLength: 1,
		    ajax: {
				url : "pages/functions/obat.php",
		        dataType: 'json',
		        type: "GET",
		        quietMillis: 50,
		        data: function (term) {
		            return {
		                term: term
		            };
		        },
		        results: function (data) {
		            return {
		                results: $.map(data, function (item) {
		                    return {
		                        text: item.itemName,
		                        id: item.id
		                    }
		                })
		            };
		        }, 
		    }
		});
	});

</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Detail Penjualan Obat</div>
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" width="310">
                <div align="left" style="margin-top: 20px; margin-bottom: 10px; margin-left: 5px; background-color: #E6E6E6;">
                    <table border="1" cellpadding="0" style="border-collapse: collapse; margin-top: 10px; margin-bottom: 5px;" width="310" bordercolor="#000000">
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px; margin-top: 5px;">No. Penjualan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
							<?php echo $data[0]['no_penjualan']?>
                            <input type="hidden" id="no_penjualan" name="no_penjualan" class="form-control"  value="<?php echo $data[0]['no_penjualan']?>" readonly="readonly" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Nomor Telp</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <?php echo $data[0]['telp']?>
							<input type="hidden" id="telp" name="telp" class="form-control"  value="<?php echo $data[0]['telp']?>" readonly="readonly" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Nama Pasien</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <?php echo $data[0]['nama']?>
							<input type="hidden" id="nama" name="nama" class="form-control"  value="<?php echo $data[0]['nama']?>" readonly="readonly" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Tanggal Input</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <?php echo date("d F Y", strtotime($data[0]['tgl_input']))?>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px; margin-bottom: 0px;">Obat/Tindakan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 0px; margin-left: 0px;">
							<input type="text" id="obat" name="obat" onchange="CreateRacikan(this.value)" style="width: 210px" >
                            </div>
							</td>
                        </tr>
						<tr>
							<td colspan="2">
                        		<div id="DataAdd">
									<table border="0" cellpadding="0" style="border-collapse: collapse;">
										<tr height="28">
											<td width="110"><span style="margin-left:10px">Qty / Jumlah</span></td>
											<td valign="middle" align="center">
											<div style="margin-bottom: 4px; margin-top: 4px;">
											<input type="text" name="qty" id="qty" size="5" style="text-align: right" tabindex="3" />
											</div></td>
										</tr>
										<tr height="28">
											<td valign="top" align="center" colspan="2" >
											<div style="margin-bottom: 14px; margin-top: 14px; margin-left: 15px;" align="center">
											 <input type="button" value="Simpan Obat" onclick="simpanObat()" class="btn btn-sm btn-small btn-primary rounded" />
											 <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Penjualan Obat" onclick="simpanData(this.form, 'index.php?mod=farmasi&submod=jual_langsung')" />
											</div></td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
                    </table>
                </div>
                </td>
                <td>
                    <div id="data_pasien">
                        
                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
                            <thead> 
                            <tr>
                                <th style="width:20px">No</th> 
                                <th>Nama Obat</th> 
                                <th style="width:30px">Sat</th> 
                                <th style="width:30px">QTY</th> 
                                <th style="width:40px">Harga</th> 
                                <th style="width:40px">Total</th> 
                                <th style="width:30px">OPT</th> 
                            </tr> 
                            </thead> 
                            <tbody> 
                            <?php
                                $data = $db->query("select * from  tbl_penjualan_obat_detail where status_delete='UD' and jenis='NR' and penjualan_id='".$_GET['id']."'", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$satuan = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'", 0);
                            ?>
                            <tr>
                                <td><?php echo $i+1?></td> 
                                <td><?php echo $data[$i]['nama_obat']?></td> 
                                <td><?php echo $satuan?></td> 
                                <td><div align="right"><?php echo $data[$i]['qty']?></div></td>
                                <td align="right"><div align="right"><?php echo number_format($data[$i]['harga'])?></div></td> 
                                <td align="right"><div align="right"><?php echo number_format($data[$i]['total'])?></div></td> 
                                <td class="text-center">
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/jual_obat_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';">
                                        <span class="ui-icon ui-icon-circle-close"></span>
                                    </a>
                                </td> 
                            </tr> 
                            <?php
                                	$sbttl = $sbttl + $data[$i]['total'];
								}
                            ?>
							<tr>
								<td colspan="5">SubTotal</td>
								<td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($sbttl)?></div></td>
							</tr>
                            </tbody>
                        </table>
						&nbsp;
						<?php
							$resep = $db->query("select * from  tbl_penjualan_obat_racikan where no_penjualan='".$data[0]['no_penjualan']."' and status_delete='UD'", 0);
							for ($j = 0; $j < count($resep); $j++) {
								
						?>
						<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
							<thead> 
							<tr>
								<th style="width:20px">No</th> 
								<th>Nama Obat</th> 
								<th style="width:30px">Sat</th> 
								<th style="width:30px">QTY</th> 
								<th style="width:40px">Harga</th> 
								<th style="width:40px">Total</th> 
								<th style="width:30px">OPT</th> 
							</tr> 
							</thead> 
							<tbody> 
							<tr>
								<td colspan="6" style="height: 10px;"><?php echo '<p align="left" style="margin-top: 0px; margin-bottom: 0px; margin-left: 5px; font-weight: bold">Obat Racikan : '.$resep[$j]['nama'].'</p>'?></td>
								<td class="text-center">
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/jual_obatRacikans_delete.php?id=<?php echo $resep[$j]['id'].'&subid='.$_GET['id']?>';">
										<span class="ui-icon ui-icon-circle-close"></span>
									</a>
								</td> 
							</tr>
							<?php
								$data = $db->query("select * from tbl_penjualan_obat_detail where status_delete='UD' and jenis='R' and racikan_id='".$resep[$j]['id']."'", 0);
								for ($i = 0; $i < count($data); $i++) {
									$satuan = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
							?>
							<tr>
								<td><?php echo $i+1?></td> 
								<td><?php echo $data[$i]['nama_obat']?></td> 
								<td><?php echo $satuan?></td> 
								<td><?php echo $data[$i]['qty']?></td>
								<td align="right"><div align="right"><?php echo number_format($data[$i]['harga'])?></div></td> 
								<td align="right"><div align="right"><?php echo number_format($data[$i]['total'])?></div></td> 
								<td class="text-center">
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/jual_obatRacikan_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';">
										<span class="ui-icon ui-icon-circle-close"></span>
									</a>
								</td> 
							</tr> 
							<?php
									$sbttl2[$j] = $sbttl2[$j] + $data[$i]['total'];
								}
								$tambahan = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
								$totalRacikan = $tambahan + $sbttl2[$j];
							?>
							<tr>
								<td colspan="5">&nbsp;</td>
								<td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($totalRacikan)?></div></td>
							</tr>
							</tbody>
						</table>
						<?php
							}
							$tindakan = $db->query("select * from tbl_tindakan_langsung where no_penjualan='".$data[0]['no_penjualan']."' and status_delete='UD'", 0);
							if (count($tindakan) > 0) {
								echo '<p align="left" style="margin-top: 10px; margin-left: 5px; font-weight: bold">Daftar Tindakan Medis : </p>';
						?>
	<table id="sort-table" style="margin-bottom: 0px; margin-top: 0px" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
		<thead> 
		<tr>
			<th style="width:20px">No</th> 
			<th>Nama Tindakan</th> 
			<th style="width:40px">Tarif</th> 
			<th style="width:30px">OPT</th> 
		</tr> 
		</thead> 
		<tbody> 
		<?php
			for ($i = 0; $i < count($tindakan); $i++) {
		?>
		<tr>
			<td><?php echo $i+1?></td> 
			<td><?php echo $tindakan[$i]['nama_tindakan']?></td> 
			<td align="right"><div align="right"><?php echo number_format($tindakan[$i]['tarif'])?></div></td> 
			<td class="text-center">
				<a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/obat_tindakan_langsung_delete.php?id=<?php echo $tindakan[$i]['id'].'&ids='.$_GET['id']?>';">
					<span class="ui-icon ui-icon-circle-close"></span>
				</a>
			</td> 
		</tr> 
		<?php
					$tTindakan = $tTindakan + $tindakan[$i]['tarif'];
				}
		?>
		<tr>
			<td colspan="2">Sub Total</td>
			<td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($tTindakan)?></div></td>
		</tr>
		</tbody>
	</table>
						<?php
							}
						?>
                    </div>
				</td>
            </tr>
        </table>
    </div>
</form>
</div>
