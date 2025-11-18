<?php

	$data = $db->query("select * from tbl_ro_to_gudang where id='".$_GET['id']."'");
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
	
	function TampilHarga(kode) {
		document.getElementById('data_pasien').innerHTML = 'Tunggu....';
		var url = "pages/inv/info_obat_gudang.php";
		var data = {kode:kode};
		$('#data_pasien').load(url,data, function(){
			$('#data_pasien').fadeIn('fast');
		});
	
		var url = "pages/inv/obatQTY.php";
		var data = {kode:kode};
		$('#DataAdd').load(url,data, function(){
			$('#DataAdd').fadeIn('fast');
		});
	}
	
	function simpanTindakanGigi() {
		var id = document.getElementById('ro_gudangID').value;
		var no_ro = document.getElementById('no_ro_gudang').value;
		var obat = document.getElementById('obat').value;
		var qty = document.getElementById('qty').value;
		var url = "pages/inv/simpan_ApotikGudang_detail.php";
		var data = {id:id, no_ro:no_ro, obat:obat, qty:qty};
		
		document.getElementById('data_pasien').innerHTML = 'Tunggu....';
		$('#data_pasien').load(url,data, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}
	
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Detail Request from Apotik to Gudang</div>
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" width="310">
                <div align="left" style="margin-top: 20px; margin-bottom: 10px; margin-left: 5px; background-color: #E6E6E6;">
                    <table border="1" cellpadding="0" style="border-collapse: collapse; margin-top: 10px; margin-bottom: 5px;" width="310" bordercolor="#000000">
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px; margin-top: 5px;">No. Request </span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
							<?php echo $data[0]['no_ro_gudang']?>
                            <input type="hidden" id="no_ro_gudang" name="no_ro_gudang" value="<?php echo $data[0]['no_ro_gudang']?>" />
                            <input type="hidden" id="ro_gudangID" name="ro_gudangID" value="<?php echo $data[0]['id']?>" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Tanggal Input</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <?php echo date("d-m-Y", strtotime($data[0]['tgl_input_ro_gudang']))?>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px; margin-bottom: 0px;">Pilih Obat </span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 0px; margin-left: 0px;">
                            <select id="obat" name="obat" size="1" style="width: 190px;" tabindex="1" onchange="TampilHarga(this.value)" >
								<option value="">--Pilih Obat--</option>
								<?php
									$lab = $db->query("select kode_obat, nama_obat from tbl_obat where stock_akhir <= stock_min and status_delete='UD' and stock_min > 0 order by nama_obat");
									for ($i = 0; $i < count($lab); $i++) {
										$j = $i + 1;
										echo '<option value="'.$lab[$i]['kode_obat'].'">'.$lab[$i]['nama_obat'].'</option>';
									}
								?>
							</select>
                            </div>
							</td>
                        </tr>
						<tr>
							<td colspan="2">
                        		<div id="DataAdd">
									<table border="0" cellpadding="0" style="border-collapse: collapse;">
										<tr height="28">
											<td width="110"><span style="margin-left:10px">Qty</span></td>
											<td valign="middle" align="center">
											<div id="TarifTindakan" style="margin-bottom: 4px; margin-top: 4px;">
											<input type="text" name="qty" id="qty" size="5" value="0" style="text-align: right" tabindex="3" />
											</div></td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
						<tr height="28">
							<td valign="top" align="center" colspan="2" >
							<div style="margin-bottom: 14px; margin-top: 14px; margin-left: 15px;" align="center">
							 <input type="button" value="Simpan Detail Req" onclick="simpanTindakanGigi()" />
							 <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Request" onclick="simpanData(this.form, 'index.php?mod=inv&submod=ApotikGudang')" />
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
                            <th style="width:50px">Satuan</th>
                            <th style="width:80px">Jml Pesanan</th>
                            <th style="width:30px">OPT</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                                $data = $db->query("select * from tbl_ro_to_gudang_detail where status_delete='UD' and ro_gudangID='".$data[0]['id']."'", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$total = $data[$i]['harga'] * $data[$i]['qty'];
                            ?>
                          <tr>
                            <td><?php echo $i+1?></td>
                            <td><?php echo $data[$i]['nama_obat']?></td>
                            <td><?php echo $data[$i]['sat']?></td>
                            <td align="right"><div align="right"><?php echo number_format($data[$i]['qty'])?></div></td>
                            <td class="text-center"><a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/inv/ApotikGudang_detail_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';"> <span class="ui-icon ui-icon-circle-close"></span> </a> </td>
                          </tr>
                          <?php
                                	$tot1 = $tot1 + $data[$i]['qty'];
                                	$tot2 = $tot2 + $data[$i]['harga'];
                                	$tot3 = $tot3 + $total;
								}
                            ?>
                          <tr>
                            <td colspan="3" style="font-weight: bold; text-align: right">Grand Total</td>
                            <td><div align="right" style="font-weight: bold"><?php echo number_format($tot1)?></div></td>
                            <td><div align="right" style="font-weight: bold">&nbsp;</div></td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
				</td>
            </tr>
        </table>
    </div>
</form>
</div>
