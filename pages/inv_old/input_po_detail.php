<?php

	$data = $db->query("select * from tbl_ro where id='".$_GET['id']."'");
	$po = $db->query("select * from tbl_po where no_ro='".$data[0]['no_ro']."'");
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
		var url = "pages/inv/info_obat.php";
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
		var id = document.getElementById('roID').value;
		var no_ro = document.getElementById('no_ro').value;
		var obat = document.getElementById('obat').value;
		var qty = document.getElementById('qty').value;
		var url = "pages/inv/simpan_ro_detail.php";
		var data = {id:id, no_ro:no_ro, obat:obat, qty:qty};
		
		document.getElementById('data_pasien').innerHTML = 'Tunggu....';
		$('#data_pasien').load(url,data, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}
	
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form EditData Detail PO</div>
	<form action="pages/inv/po_update.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td>
                    <div class="hastable box box-content nopadding" id="data_pasien" align="center" style="margin-left: 5px; margin-right: 10px; width: 99%">
                      <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                        <thead>
                          <tr>
						  	<td colspan="6" style="background-color: #FFFFFF">
							<p align="left" style="margin-left: 10px; margin-top: 10px; margin-bottom: 0px">
								<label style="color:#0000FF; margin-bottom: 5px;">No. PO : <?php echo $po[0]['no_po']?></label><br />
								No. RO : <?php echo $data[0]['no_ro']?><br />
								Tanggal Input PO : <?php echo date("d F Y", strtotime($po[0]['tgl_input_po']))?><br />
								<label style="margin-top: 1px;">Vendor : 
                            	<select id="vendor" name="vendor" size="1" style="width: 130px;">
									<?php
										$daft = $db->query("select kode_vendor, nama_vendor from tbl_vendor where status_delete='UD'");
										for ($i = 0; $i < count($daft); $i++) {
											if ($daft[$i]['kode_vendor'] == $po[0]['kode_vendor'])
												echo '<option value="'.$daft[$i]['kode_vendor'].'" selected="selected">'.$daft[$i]['nama_vendor'].'</option>';
											else
												echo '<option value="'.$daft[$i]['kode_vendor'].'">'.$daft[$i]['nama_vendor'].'</option>';
										}
									?>
								</select></label>
								<br />
								<label style="margin-top: 1px;">Suplier : 
                            	<select id="suplier" name="suplier" size="1" style="width: 130px;">
									<?php
										$daft = $db->query("select kode_suplier, nama_suplier from tbl_suplier where status_delete='UD'");
										for ($i = 0; $i < count($daft); $i++) {
											if ($daft[$i]['kode_suplier'] == $po[0]['kode_suplier'])
												echo '<option value="'.$daft[$i]['kode_suplier'].'" selected="selected">'.$daft[$i]['nama_suplier'].'</option>';
											else
												echo '<option value="'.$daft[$i]['kode_suplier'].'">'.$daft[$i]['nama_suplier'].'</option>';
										}
									?>
								</select></label>
								<br />
							</p>
							</td>
						  </tr>
						  <tr>
                            <th style="width:20px">No</th>
                            <th>Nama Obat</th>
                            <th style="width:50px">Satuan</th>
                            <th style="width:80px">Jml Pesanan</th>
                            <th style="width:80px">Jml PO</th>
                            <th>Harga</th>
                            <th>Harga PO</th>
                            <th>Total Harga</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                                $data = $db->query("select * from tbl_ro_detail where status_delete='UD' and roID='".$data[0]['id']."'", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$total = $data[$i]['harga'] * $data[$i]['qty'];
                            ?>
                          <tr>
                            <td><?php echo $i+1?></td>
                            <td><?php echo $data[$i]['nama_obat']?></td>
                            <td><?php echo $data[$i]['sat']?></td>
                            <td align="right"><div align="right"><?php echo number_format($data[$i]['qty'])?></div></td>
                            <td align="right"><div align="right">
								<input type="text" id="qty[<?php echo $i?>]" name="qty[<?php echo $i?>]" value="<?php echo number_format($data[$i]['qty_po'])?>" style="text-align: right; width: 60px;" />
								<input type="hidden" id="id[<?php echo $i?>]" name="id[<?php echo $i?>]" value="<?php echo $data[$i]['id']?>" />
							</div></td>
                            <td align="right"><div align="right"><?php echo number_format($data[$i]['harga'])?></div></td>
                            <td align="right"><div align="right">
								<input type="text" id="harga[<?php echo $i?>]" name="harga[<?php echo $i?>]" value="<?php echo number_format($data[$i]['harga_po'])?>" style="text-align: right; width: 60px;" />
							</div></td>
                            <td align="right"><div align="right"><?php echo number_format($total)?></div></td>
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
                            <td><div align="right" style="font-weight: bold">-</div></td>
                            <td><div align="right" style="font-weight: bold"><?php echo number_format($tot2)?></div></td>
                            <td><div align="right" style="font-weight: bold">-</div></td>
                            <td><div align="right" style="font-weight: bold"><?php echo number_format($tot3)?></div></td>
                          </tr>
						<tr height="28">
							<td valign="top" align="center" colspan="2" >
							<div style="margin-bottom: 14px; margin-top: 14px; margin-left: 15px;" align="center">
							 <input type="hidden" id="no_po" name="no_po" value="<?php echo $po[0]['no_po']?>" />
							 <input type="hidden" id="no_po" name="no_ro" value="<?php echo $po[0]['no_ro']?>" />
							 <input type="submit" value="Simpan Detail PO" />
							 <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List PO" onclick="simpanData(this.form, 'index.php?mod=inv&submod=po')" />
							</div></td>
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
