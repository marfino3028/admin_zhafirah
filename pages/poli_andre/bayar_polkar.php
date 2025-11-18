<?php

	$data = $db->query("select * from tbl_polkar where id='".$_GET['id']."'", 0);
	$noPolkar = $data[0]['no_polkar'];
?>
<script language="javascript">
	function GetData(id) {
		//var no_inv = document.getElementById('no_inv').value;
		//var tgl_input = document.getElementById('tgl_input').value;
		//var kirim = document.getElementById('kirim').value;
		//var jatuh_tempo = document.getElementById('jatuh_tempo').value;
		var url = "pages/piutang/invoice_asuransi.php";
		var data = {id:id};
		
		$('.loading').fadeIn();
		$('#data_pasien').fadeOut();
		$('#data_pasien').load(url,data, function(){
			$('.loading').fadeOut('fast');
			$('#data_pasien').fadeIn('fast');
		});
	}
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Pembayaran Poli Karyawan</div>
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" width="260">
                <div align="left" style="margin-top: 20px;">
                    <table border="1" cellpadding="0" style="border-collapse: collapse" width="260" bordercolor="#000000">
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">No. PolKar</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_polkar" name="no_polkar" class="form-control" style="width: 130px; background-color:#CCC" value="<?php echo $data[0]['no_polkar']?>" readonly="readonly" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Total Bayar</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            	<input type="text" id="total_txt" name="total_txt" class="form-control" style="width: 130px; text-align: right; font-weight: bold" value="<?php echo number_format($_GET['total'])?>" />
								<input type="hidden" id="total" name="total" class="form-control" style="width: 130px; text-align: right; font-weight: bold" value="<?php echo $_GET['total']?>" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Tanggal Bayar</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            	<input type="text" id="tgl_bayar" name="tgl_bayar" class="form-control" style="width: 130px;" value="<?php echo date("m/d/Y")?>" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td valign="top" align="center" colspan="2" >
                            <div style="margin-bottom: 14px; margin-top: 14px; margin-left: 15px;">
                             <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Pembayaran" onclick="simpanData(this.form, 'pages/poli/bayar_polkar_insert.php')" />
                            </div></td>
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
                                $data = $db->query("select * from  tbl_polkar_detail where status_delete='UD' and jenis='NR' and polkar_id='".$_GET['id']."'", 0);
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
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/poli/polkar_obat_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';">
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
							$resep = $db->query("select * from  tbl_polkar_racikan where no_polkar='".$noPolkar."' and status_delete='UD'", 0);
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
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/poli/polkar_obatRacikanH_delete.php?id=<?php echo $resep[$j]['id'].'&subid='.$_GET['id']?>';">
										<span class="ui-icon ui-icon-circle-close"></span>
									</a>
								</td> 
							</tr>
							<?php
								$data = $db->query("select * from tbl_polkar_detail where status_delete='UD' and jenis='R' and racikan_id='".$resep[$j]['id']."'", 0);
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
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/poli/polkar_obatRacikan_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';">
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
						?>
                    </div>
				</td>
            </tr>
        </table>
    </div>
</form>
</div>
