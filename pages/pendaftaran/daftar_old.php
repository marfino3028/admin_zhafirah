<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	$ceknmr = $db->queryItem("select max(right(no_daftar, 3)*1) from tbl_pendaftaran where left(no_daftar, 4)='".date("ym")."'", 0);
	$ceknmr2 = $db->queryItem("select a.panjang from (select LENGTH(no_daftar) as panjang from tbl_pendaftaran where left(no_daftar, 4)='".date("ym")."' group by LENGTH(no_daftar)) a order by a.panjang desc", 0);
	if ($ceknmr2 > 7) {
		$ceknmr = $db->queryItem("select max(right(no_daftar, 5)*1) from tbl_pendaftaran where left(no_daftar, 4)='".date("ym")."'", 0);
	}
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '000'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 1000) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 10000) $ceknmr = $ceknmr;
	$nomr = date("ym").$ceknmr;
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

function simpanDataDaftar(t, url) {
	var poli = document.getElementById('kd_poli').value;
	var prsh = document.getElementById('kode_perusahaan').value;
	if (poli == "" || prsh == "") {
		alert("Silahkan lengkapi data yang sudah disediakan");
	}
	else {
		document.getElementById('form_karyawan').action = url;
		t.submit();
	}
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
                            <input type="text" id="no_daftar" name="no_daftar" class="form-control" style="width: 130px; background-color:#CCC" value="<?php echo $nomr?>" readonly="readonly" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Nomor MR</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nomr" name="nomr" class="form-control" onblur="CariPasien(this.value)" style="width: 130px" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Pilih Poli</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="kd_poli" name="kd_poli" size="1" style="width: 140px; font-size: 12px;" onchange="pilihPoli(this.value)">
                            	<option value="">--Pilih Poli--</option>
                                <?php
									$poli = $db->query("select * from tbl_poli where status_delete='UD'");
									for ($i = 0; $i < count($poli); $i++) {
										echo '<option value="'.$poli[$i]['kd_poli'].'">'.$poli[$i]['nama_poli'].'</option>';
									}
									echo '<option value="LANGSUNG">PENUNJANG MEDIS</option>';
								?>
                            </select>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td valign="middle" align="center" colspan="2">
                            <div style="margin-bottom: 4px; margin-top: 4px;" id="langsung">
                            &nbsp;
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110" valign="bottom" colspan="2">
                            <span style="margin-left:10px; margin-bottom: 5px;">Pilih Jaminan</span>
                            <div style="margin-bottom: 15px; margin-top: 10px; margin-left: 15px;">
                            <select id="kode_perusahaan" name="kode_perusahaan" size="1" style="width: 190px;">
                            	<option value="">Pilih Jaminan</option>
                                <?php
									$prsh = $db->query("select * from tbl_perusahaan where status_delete='UD'");
									for ($i = 0; $i < count($prsh); $i++) {
										echo '<option value="'.$prsh[$i]['id'].'">'.$prsh[$i]['nama_perusahaan'].'</option>';
									}
								?>
                            </select>
                            </div>
                            </td>
                        </tr>
                        <tr height="28">
                            <td valign="top" align="center" colspan="2" >
                            <div style="margin-bottom: 14px; margin-top: 4px; margin-left: 15px;">
                             <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Pendaftaran" onclick="simpanDataDaftar(this.form, 'pages/pendaftaran/daftar_insert.php')" />
                            </div></td>
                        </tr>
                    </table>
                </div>
                </td>
                <td><div id="data_pasien"></div></td>
            </tr>
        </table>
    </div>
</form>
</div>
