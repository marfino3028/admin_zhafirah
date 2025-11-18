<?php

	$data = $db->query("select * from tbl_bedah where id='".$_GET['id']."'");
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
		document.getElementById('TarifTindakanMin').innerHTML = 'Tunggu....';
		var url = "pages/poli/info_Tarif_obygn.php";
		var data = {kode:kode};
		$('#TarifTindakanMin').load(url,data, function(){
			$('#TarifTindakanMin').fadeIn('fast');
		});

		var url = "pages/poli/info_Tarif_obygnMax.php";
		var data = {kode:kode};
		$('#TarifTindakanMax').load(url,data, function(){
			$('#TarifTindakanMax').fadeIn('fast');
		});
	
	}
	
	function simpanTindakanBedah() {
		var id = document.getElementById('bedahID').value;
		var no_bedah = document.getElementById('no_bedah').value;
		var nomr = document.getElementById('nomr').value;
		var nama = document.getElementById('nama_pasien').value;
		var bedah = document.getElementById('bedah').value;
		var tarif = document.getElementById('tarif_costum').value;
		var pDokter = document.getElementById('pDokter').value;
		var url = "pages/poli/simpanBedahTindakan.php";
		var data = {id:id, no_bedah:no_bedah, nomr:nomr, nama:nama, bedah:bedah, tarif:tarif, pDokter:pDokter};
		
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
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Detail Tindakan Poli Bedah </div>
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" width="310">
                <div align="left" style="margin-top: 20px; margin-bottom: 10px; margin-left: 5px; background-color: #E6E6E6;">
                    <table border="1" cellpadding="0" style="border-collapse: collapse; margin-top: 10px; margin-bottom: 5px;" width="310" bordercolor="#000000">
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px; margin-top: 5px;">No. Obygn </span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
							<?php echo $data[0]['no_bedah']?>
                            <input type="hidden" id="no_bedah" name="no_bedah" value="<?php echo $data[0]['no_bedah']?>" />
                            <input type="hidden" id="bedahID" name="bedahID" value="<?php echo $data[0]['id']?>" />
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
                            <select id="bedah" name="bedah" size="1" style="width: 190px;" tabindex="1" >
								<option value="">--Pilih Tindakan Poli Bedah--</option>
								<?php
									$lab = $db->query("select * from tbl_tarif where kode_jns_tarif='09' and status_delete='UD' order by kode_kat_pelayanan");
									for ($i = 0; $i < count($lab); $i++) {
										$j = $i + 1;
										$kategori[$j] = $db->queryItem("select b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.kode_tarif='".$lab[$i]['kode_tarif']."'");
										if ($kategori[$j] != $kategori[$i] and $i > 0) echo '<option value="'.$lab[$i]['kode_tarif'].'" disabled="disabled">'.$kategori[$j].'</option>';
										echo '<option value="'.$lab[$i]['kode_tarif'].'"> &nbsp; &nbsp; &nbsp;'.$lab[$i]['nama_pelayanan'].'</option>';
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
											<td width="110"><span style="margin-left:10px">Tarif</span></td>
											<td valign="middle" align="center">
											<input type="text" name="tarif_costum" id="tarif_costum" size="7" value="0" style="text-align: right" tabindex="5" />
											</td>
										</tr>
										<tr height="28">
											<td width="110"><span style="margin-left:10px; margin-bottom: 0px;">% Dokter </span></td>
											<td valign="middle" align="center">
											<div style="margin-bottom: 4px; margin-top: 0px; margin-left: 0px;">
											<input type="text" name="pDokter" id="pDokter" size="7" value="0" style="text-align: right" tabindex="5" />
											</div>
											</td>
										</tr>
										<tr height="28">
											<td valign="top" align="center" colspan="2" >
											<div style="margin-bottom: 14px; margin-top: 14px; margin-left: 15px;" align="center">
											 <input type="button" value="Simpan Tindakan" onclick="simpanTindakanBedah()" />
											 <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Poli Bedah" onclick="simpanData(this.form, 'index.php?mod=poli&submod=bedah')" />
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
                            <th style="width:40px">Tarif</th>
                            <th style="width:40px">Tarif Dokter</th>
                            <th style="width:30px">OPT</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                                $data = $db->query("select * from tbl_bedah_detail where status_delete='UD' and no_bedah='".$data[0]['no_bedah']."'", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$kategori = $db->queryItem("select b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.kode_tarif='".$data[$i]['kode_tarif']."'");
                            ?>
                          <tr>
                            <td><?php echo $i+1?></td>
                            <td><?php echo $data[$i]['nama_tindakan'].' - '.$kategori?></td>
                            <td align="right"><div align="right"><?php echo number_format($data[$i]['tarif'])?></div></td>
                            <td align="right"><div align="right"><?php echo number_format($data[$i]['biaya_dokter'])?></div></td>
                            <td class="text-center"><a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/poli/bedah_tindakan_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';"> <span class="ui-icon ui-icon-circle-close"></span> </a> </td>
                          </tr>
                          <?php
                                	$sbttl = $sbttl + $data[$i]['tarif'];
								}
                            ?>
                          <tr>
                            <td colspan="2">SubTotal</td>
                            <td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($sbttl)?></div></td>
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
