<?php
	$data = $db->query("select * from tbl_pendaftaran where id='".$_GET['id']."'");
?>
<script language="javascript">
	function CariPasien(id) {
		var url = "pages/pendaftaran/view_pasien.php";
		id = '1###' + id;
		var data = {id:id};
		
		$('.loading').fadeIn();
		$('#data_pasien').fadeOut();
		$('#data_pasien').load(url,data, function(){
			$('.loading').fadeOut('fast');
			$('#data_pasien').fadeIn('fast');
		});
	}
	
	function pilihPoli(id) {
		var data = {id:id};
		
		if (id == 'LANGSUNG') { 
			var url = "pages/pendaftaran/view_langsung.php";
		}
		else {
			var url = "pages/pendaftaran/view_not_langsung.php";
		}
		$('#langsung').load(url,data, function(){
			$('#langsung').fadeIn('fast');
		});
	}
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Pendaftaran Pasien</div>
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" width="270">
                <div align="left" style="margin-top: 20px; width: 270px; overflow: inherit">
                    <table border="1" cellpadding="0" style="border-collapse: collapse" width="270" bordercolor="#000000">
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">No. Pendaftaran</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_daftar" name="no_daftar" class="form-control" style="width: 130px; background-color:#CCC" value="<?php echo $data[0]['no_daftar']?>" readonly="readonly" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Nomor MR</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nomr" name="nomr" class="form-control" onblur="CariPasien(this.value)" style="width: 130px" value="<?php echo $data[0]['nomr']?>" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Pilih Poli</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="kd_poli" name="kd_poli" size="1" style="width: 140px; font-size: 12px;" onchange="pilihPoli(this.value)">
                                <?php
									$poli = $db->query("select * from tbl_poli where status_delete='UD'");
									for ($i = 0; $i < count($poli); $i++) {
										if ($poli[$i]['kd_poli'] == $data[0]['kd_poli']) echo '<option value="'.$poli[$i]['kd_poli'].'" selected="selected">'.$poli[$i]['nama_poli'].'</option>';
										else echo '<option value="'.$poli[$i]['kd_poli'].'">'.$poli[$i]['nama_poli'].'</option>';
									}
									echo '<option value="LANGSUNG">PENUNJANG MEDIS</option>';
								?>
                            </select>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td valign="middle" align="center" colspan="2">
                            <div style="margin-bottom: 4px; margin-top: 4px;" id="langsung">
								<table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
									<tr height="28">
										<td width="110"><span style="margin-left:10px">Pilih Dokter</span></td>
										<td valign="middle" align="center">
										<div style="margin-bottom: 4px; margin-top: 4px;">
										<select id="kd_dokter" name="kd_dokter" size="1" style="width: 140px; font-size: 12px">
											<?php
												$poli = $db->query("select * from tbl_dokter where status_delete='UD'");
												for ($i = 0; $i < count($poli); $i++) {
													if ($poli[$i]['kode_dokter'] == $data[0]['kode_dokter'])	echo '<option value="'.$poli[$i]['kode_dokter'].'" selected="selected">'.$poli[$i]['nama_dokter'].'</option>';
													else	echo '<option value="'.$poli[$i]['kode_dokter'].'">'.$poli[$i]['nama_dokter'].'</option>';
												}
											?>
										</select>
										</div></td>
									</tr>
								</table>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110" valign="bottom" colspan="2">
                            <span style="margin-left:10px; margin-bottom: 5px;">Pilih Jaminan</span>
                            <div style="margin-bottom: 15px; margin-top: 10px; margin-left: 15px;">
                            <select id="kode_perusahaan" name="kode_perusahaan" size="1" style="width: 190px;">
                                <?php
									$prsh = $db->query("select * from tbl_perusahaan where status_delete='UD'");
									for ($i = 0; $i < count($prsh); $i++) {
										if ($prsh[$i]['kode_perusahaan'] == $data[0]['kode_perusahaan']) echo '<option value="'.$prsh[$i]['id'].'" selected="selected">'.$prsh[$i]['nama_perusahaan'].'</option>';
										else echo '<option value="'.$prsh[$i]['id'].'">'.$prsh[$i]['nama_perusahaan'].'</option>';
									}
								?>
                            </select>
                            </div>
                            </td>
                        </tr>
                        <tr height="28">
                            <td valign="top" align="center" colspan="2" >
                            <div style="margin-bottom: 14px; margin-top: 4px; margin-left: 15px;">
                             <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Pendaftaran" onclick="simpanData(this.form, 'pages/pendaftaran/daftar_update.php')" />
                            </div></td>
                        </tr>
                    </table>
                </div>
                </td>
                <td><div id="data_pasien">
<?php
	$data = $db->query("select * from tbl_pasien where nomr='".$data[0]['nomr']."' and status_delete='UD'", 0);
	if (count($data) == 0) {
		echo '<label style="margin-left: 25px; margin-top: 25px; font-weight: bold;">Tidak Ada Data ditemukan</label>';
		die();
	}
	
	echo '<input type="hidden" id="idmr" name="idmr" value="'.$data[0]['id'].'">';
?>

<div class="hastable box box-content nopadding" align="center" style="margin-left: 10px; margin-right: 10px; width: 90%;">
    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
        <thead>
        	<td colspan="2">Detail Pasien</td>
        </thead>
        <tr>
            <td style="width:140px">Nama Pasien</td> 
            <td><?php echo $data[0]['nm_pasien']?></td>
        </tr> 
        <tr>
            <td style="width:140px">Jenis Kelamin</td> 
            <td><?php echo $data[0]['jk']?></td>
        </tr> 
        <tr>
            <td style="width:140px">Tempat Lahir</td> 
            <td><?php echo $data[0]['tmpt_lahir']?></td>
        </tr> 
        <tr>
            <td style="width:140px">Tanggal Lahir</td> 
            <td><?php echo date("d F Y", strtotime($data[0]['tgl_lahir']))?></td>
        </tr> 
        <tr>
            <td style="width:140px">Alamat</td> 
            <td><?php echo $data[0]['alamat_pasien']?></td>
        </tr> 
    </table>
</div>
				</div></td>
            </tr>
        </table>
    </div>
</form>
</div>
