<?php

	$data = $db->query("select * from tbl_gigi where id='".$_GET['id']."'");
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
		document.getElementById('TarifTindakan').innerHTML = 'Tunggu....';
		var url = "pages/poli/info_Tarif.php";
		var data = {kode:kode};
		$('#TarifTindakan').load(url,data, function(){
			$('#TarifTindakan').fadeIn('fast');
		});
	
	}
	
	function simpanTindakanGigi() {
		var id = document.getElementById('gigiID').value;
		var no_gigi = document.getElementById('no_gigi').value;
		var nomr = document.getElementById('nomr').value;
		var nama = document.getElementById('nama_pasien').value;
		var gigi = document.getElementById('gigi').value;
		var tarif = document.getElementById('tarifNo').value;
		var url = "pages/poli/simpangigiTindakan.php";
		var data = {id:id, no_gigi:no_gigi, nomr:nomr, nama:nama, gigi:gigi, tarif:tarif};
		
		if (tarif > 0) {
			document.getElementById('data_pasien').innerHTML = 'Tunggu....';
			$('#data_pasien').load(url,data, function(){
				$('#data_pasien').fadeIn('fast');
			});
		}
		else {
			alert("Silahkan Pilih Tindakan Poli Gigi terlebih dahulu-" + tarif);
		}
	}
	
</script>
<script language="javascript">
	$(document).ready(function() {
		$("#gigi").select2({
		    minimumInputLength: 1,
		    ajax: {
				url : "pages/functions/poligigi.php",
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
    <div class="portlet-header ui-widget-header">Form Tambah Data Detail Tindakan Poli Gigi </div>
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" width="310">
                <div align="left" style="margin-top: 20px; margin-bottom: 10px; margin-left: 5px; background-color: #E6E6E6;">
                    <table border="1" cellpadding="0" style="border-collapse: collapse; margin-top: 10px; margin-bottom: 5px;" width="310" bordercolor="#000000">
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px; margin-top: 5px;">No. Gigi </span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
							<?php echo $data[0]['no_gigi']?>
                            <input type="hidden" id="no_gigi" name="no_gigi" value="<?php echo $data[0]['no_gigi']?>" />
                            <input type="hidden" id="gigiID" name="gigiID" value="<?php echo $data[0]['id']?>" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Nomor MR</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <?php echo $data[0]['nomr']?>
                            <input type="hidden" id="nomr" name="nomr" value="<?php echo $data[0]['nomr']?>" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Nama Pasien</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <?php echo $data[0]['nama']?>
                            <input type="hidden" id="nama_pasien" name="nama_pasien" value="<?php echo $data[0]['nama']?>" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Tanggal Input</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <?php echo date("d F Y", strtotime($data[0]['tgl_insert']))?>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px; margin-bottom: 0px;">Pilih Tindakan </span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 0px; margin-left: 0px;">
							<input type="text" id="gigi" name="gigi" onchange="TampilHarga(this.value)" style="width: 210px" >
                            </div>
							</td>
                        </tr>
						<tr>
							<td colspan="2">
                        		<div id="DataAdd">
									<table border="0" cellpadding="0" style="border-collapse: collapse;">
										<tr height="28">
											<td width="110"><span style="margin-left:10px">Tarif</span></td>
											<td valign="middle" align="center">
											<div id="TarifTindakan" style="margin-bottom: 4px; margin-top: 4px;">
											<input type="text" name="tarif" id="tarif" size="5" value="0" style="text-align: right" tabindex="3" readonly="" />
											<input type="hidden" name="tarifNo" id="tarifNo" value="0" />
											</div></td>
										</tr>
										<tr height="28">
											<td valign="top" align="center" colspan="2" >
											<div style="margin-bottom: 14px; margin-top: 14px; margin-left: 15px;" align="center">
											 <input type="button" value="Simpan Tindakan" onclick="simpanTindakanGigi()" />
											 <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List poli Gigi" onclick="simpanData(this.form, 'index.php?mod=poli&submod=gigiInput')" />
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
                            <th>Description</th>
                            <th style="width:70px">Tarif</th>
                            <th style="width:70px">% Dokter</th>
                            <th style="width:70px">Tarif Dokter</th>
                            <th style="width:30px">OPT</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                                $data = $db->query("select * from tbl_gigi_detail where status_delete='UD' and no_gigi='".$data[0]['no_gigi']."'", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$kategori = $db->queryItem("select b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.kode_tarif='".$data[$i]['kode_tarif']."'");
                            ?>
                          <tr>
                            <td><?php echo $i+1?></td>
                            <td><?php echo $data[$i]['nama_tindakan'].' - '.$kategori?></td>
                            <td align="right"><div align="right"><?php echo number_format($data[$i]['tarif'])?></div></td>
                            <td align="right"><div align="right"><?php echo number_format($data[$i]['dokter_persen'])?></div></td>
                            <td align="right"><div align="right"><?php echo number_format($data[$i]['dokter_tarif'])?></div></td>
                            <td class="text-center"><a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/poli/gigi_tindakan_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';"> <span class="ui-icon ui-icon-circle-close"></span> </a> </td>
                          </tr>
                          <?php
                                	$sbttl = $sbttl + $data[$i]['tarif'];
								}
								$sbdokter = $sbttl * 50 /100;
                            ?>
                          <tr>
                            <td colspan="2">SubTotal</td>
                            <td><div align="right" style="font-weight: bold"><?php echo number_format($sbttl)?></div></td>
							<td><div align="right" style="font-weight: bold">&nbsp;</div></td>
							<td><div align="right" style="font-weight: bold"><?php echo number_format($sbdokter)?></div></td>
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
