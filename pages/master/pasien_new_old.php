<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	//$nsbu = $db->queryItem("select nama from tbl_sbu where id='".$sub[0]['kode_']."'");
	$ceknmr = $db->queryItem("select max(right(nomr, 3)*1) from tbl_pasien where left(nomr, 4)='".date("ym")."'", 0);
       $ceknmr2 = $db->queryItem("select a.panjang from (select LENGTH(nomr) as panjang from tbl_pasien where left(nomr, 4)='".date("ym")."' group by LENGTH(nomr)) a order by a.panjang desc", 0);

	if ($ceknmr2 > 7) {
		$ceknmr = $db->queryItem("select max(right(nomr, 5)*1) from tbl_pasien where left(nomr, 4)='".date("ym")."'", 0);
	}
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '000'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 1000) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 10000) $ceknmr = $ceknmr;
	$nomr = date("ym").$ceknmr;
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Master Pasien</div>
	<form action="javascript:simpanData(this.form, 'pages/master/pasien_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" colspan="2">
                    <div class="hastable box box-content nopadding" align="center" style="margin-left: 10px; margin-right: 10px; width: 100%">
                        
                    </div>
                </td>
           </tr>
           <tr height="28">
                <td valign="middle" colspan="2">
                <div align="left">
                    <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
                        <tr height="40">
                            <td width="20"><span style="margin-left:10px">No Medical Record</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nomr" name="nomr" class="form-control" style="10px" value="<?php echo $nomr?>" readonly="readonly" />
							<td width="200"><span style="margin-left:10px">Nama Pasien</span></td>
                            <td valign="middle" align="center">
                            <input type="text" id="nama" name="nama" class="form-control" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nama Pasien</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nama" name="nama" class="form-control" />
                            </div></td>
                            <td width="200"><span style="margin-left:10px">Nama Keluarga</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="keluarga" name="keluarga" class="form-control" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nomor Polis</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_polis" name="no_polis" class="form-control" />
                            </div></td>
                            <td width="200"><span style="margin-left:10px">Nomor Peserta</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_peserta" name="no_peserta" class="form-control" />
                            </div></td>
                        </tr>
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Umur</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="umur" name="umur" class="form-control" />
                            </div></td>
						    <td width="200"><span style="margin-left:10px">Jenis Kelamin</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="jk" name="jk" size="1">
                            <option value="">--Pilih Jenis Kelamin--</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                                
                            </select>
                            </div>                            
						</td>
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Nama Pegawai</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="peg_id" name="peg_id" size="1" style="width: 200px;">
								<option value="">--Pilih Pegawai--</option>
								<?php
									$data = $db->query("select nomr id, nm_pasien nama from tbl_pasien where nomr_id='0' and hub='PEGAWAI'");
									for ($i = 0; $i < count($data); $i++) {
										echo '<option value="'.$data[$i]['id'].'">'.$data[$i]['id'].'-'.$data[$i]['nama'].'</option>';
									}
								?>
                            </select>
                            </div></td>
						    <td width="200"><span style="margin-left:10px">Hubungan Dengan Pegawai</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="hub" name="hub" size="1">
                            <option value="">--Pilih Hubungan dengan Pegawai--</option>
                            <option value="PEGAWAI">PEGAWAI</option>
                            <option value="ISTRI">ISTRI</option>
                            <option value="SUAMI">SUAMI</option>
                            <option value="ANAK">ANAK</option>
                            </select>
                            </div>                            
						</td>
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Tempat Lahir</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="tmpt_lahir" name="tmpt_lahir" class="form-control" />
                            </div></td>                            
                            <td width="200"><span style="margin-left:10px">Tanggal Lahir</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" /> Format mm/dd/yyyy
                            </div></td>
                        </tr>
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Pekerjaan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" />
                            </div></td>
					        <td width="200"><span style="margin-left:10px">Alamat Pasien</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <textarea tabindex="2" cols="50" rows="3" class="field textarea small" id="alamat_pasien" name="alamat_pasien" >
                            </textarea>
							</div>
							</td>
						</tr>
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Kelurahan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="kelurahan" name="kelurahan" class="form-control" />
                            </div></td>
                            <td width="200"><span style="margin-left:10px">Kecamatan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="kecamatan" name="kecamatan" class="form-control" />
                            </div></td>                            
						</tr>
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Kotamadya</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="kotamadya" name="kotamadya" class="form-control" />
                            </div></td>
                            <td width="200"><span style="margin-left:10px">Propinsi</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="propinsi" name="propinsi" class="form-control" />
                            </div></td>                            
						</tr>
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Kode Pos</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="kode_pos_pasien" name="kode_pos_pasien" class="form-control" />
                            </div></td>                            
                            <td width="200"><span style="margin-left:10px">Telp</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="telp_pasien" name="telp_pasien" class="form-control" />
                            </div></td>                            
						</tr>
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Agama</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="agama" name="agama" size="1">
                            <option value="">--Pilih Agama--</option>
                            <option value="Islam">Islam</option>
                            <option value="Katholik">Katholik</option>
                            <option value="Protestan">Protestan</option>
                            <option value="Hindhu">Hindhu</option>
                            <option value="Budha">Budha</option>
                                
                            </select>
                            </div>                              
							</td>
                            <td width="200"><span style="margin-left:10px">No.KTP</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_ktp" name="no_ktp" class="form-control" />
                            </div></td>                            
						</tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nama Penjamin</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nm_penjamin" name="nm_penjamin" class="form-control" />
                            </div></td>                            
                            <td width="200"><span style="margin-left:10px">Alamat Penjamin</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <textarea tabindex="2" cols="50" rows="3" class="field textarea small" id="alamat_penjamin" name="alamat_penjamin" >
                            </textarea>                            
                            </div></td>
						</tr>
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Hubungan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="hubungan" name="hubungan" class="form-control" />
							</div>
							</td>
                            <td width="200"><span style="margin-left:10px">Rujukan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="rujukan" name="rujukan" class="form-control" />
						</tr> 
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Tanggal Daftar</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <?
							$tgLdaftar=date('m-d-Y');
							?>
                            <input type="text" id="tgLdaftar" name="tgLdaftar" class="form-control" value="<?php echo $tgLdaftar?>" readonly="readonly"  /> 
                            </div></td>                            
                            <td width="200"><span style="margin-left:10px">Jenis Pendaftaran</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="jenis_pendaftaran" name="jenis_pendaftaran" size="1">
                            <option value="">--Pilih Jenis Pendaftaran--</option>
                            <option value="Rawat Jalan">Rawat Jalan</option>
                            <option value="Rawat Inap">Rawat Inap</option>                              
                            </select>
                            </div> 
                        </tr>
                    </table>
                </div>
                </td>
            </tr>
        </table>
    </div>
    <div align="center" style="margin-right: 15px; margin-top: 10px; margin-bottom: 10px;">
        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Pasien" onclick="simpanData(this.form, 'pages/master/pasien_insert.php')" />
    </div>
</form>
</div>
