<script language="javascript">
	function simpanDataDaftar(t, url) {
		var jenis_jurnal = document.getElementById('jenis_jurnal').value;
		var kode_akun = document.getElementById('kode_akun').value;
		var mkode_akun = document.getElementById('mkode_akun').value;
		if (jenis_jurnal == "" || kode_akun == "" || mkode_akun == "") {
			alert("Silahkan lengkapi data yang sudah disediakan");
		}
		else {
			document.getElementById('form_karyawan').action = url;
			t.submit();
		}
	}
	
	function lihatBiaya(t) {
		var url = "pages/farmasi/biayaHadirDokter.php";
		var data = {t:t};

		//document.getElementById('biayaDokter').innerHTML = 'Tunggu sebentar ....';
		$('#biayaDokter').load(url,data, function(){
			$('#biayaDokter').fadeIn('fast');
		});
	}

</script>

<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Kehadiran Dokter</div>
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle">
                <div align="left" style="margin-top: 20px;">
                    <table border="1" cellpadding="0" style="border-collapse: collapse" bordercolor="#000000">
                        <tr height="28">
                            <td width="100"><span style="margin-left:10px">Tanggal Hadir</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            	<input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y")?>" size="10" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="100"><span style="margin-left:10px">Pilih Dokter</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="dokter" name="dokter" size="1" style="width: 140px; font-size: 12px;">
                            	<option value="">--Pilih Dokter--</option>
                                <?php
									$poli = $db->query("select kode_dokter, nama_dokter from tbl_dokter where status_delete='UD'");
									for ($i = 0; $i < count($poli); $i++) {
										echo '<option value="'.$poli[$i]['kode_dokter'].'">'.$poli[$i]['nama_dokter'].'</option>';
									}
								?>
                            </select>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="100"><span style="margin-left:10px; margin-top: 8px;">Pilih Waktu</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px; float: left; width: 120px;">
                            <select id="waktu" name="waktu" size="1" style="font-size: 12px;" onchange="lihatBiaya(this.value)">
                            	<option value="">--Pilih Waktu--</option>
                            	<option value="F">1 Hari Penuh</option>
                            	<option value="H">Setengah Hari</option>
                            </select>
                            </div> &nbsp;&nbsp;&nbsp;<div style="margin-bottom: 4px; margin-top: 7px; font-size: 14px; font-weight: bold; float: left; width: 300px;" id="biayaDokter">&nbsp;</div></td>
                        </tr>
                        <tr height="28">
                            <td width="100">&nbsp;</td>
							<td valign="top" align="center">
                            <div style="margin-bottom: 14px; margin-top: 24px; margin-left: 0px;">
                             <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Kehadiran Dokter" onclick="simpanData(this.form, 'pages/farmasi/kehadiran_dokter_insert.php')" />
                            </div></td>
                        </tr>
                    </table>
                </div>
                </td>
            </tr>
        </table>
    </div>
</form>
</div>