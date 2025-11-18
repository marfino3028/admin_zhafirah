<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	$data = $db->query("select * from tbl_pasien where id='".$_GET['id']."'");
	//print_r($data);
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Master Pasien</div>
	<form action="javascript:simpanData(this.form, 'pages/master/pasien_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
        <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                    <h3>
                         <i class="fa fa-table"></i>

                    </h3>

                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
                        
                    </div>
                </td>
           </tr>
           <tr height="28">
                <td valign="middle" colspan="2">
                <div align="left">
                    <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">No Medical Record</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nomr" name="nomr" class="form-control" style="50px" value="<?php echo $data[0]['nomr']?>" readonly="readonly" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nama Pasien</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $data[0]['nm_pasien']?>" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nama Keluarga</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="keluarga" name="keluarga" class="form-control" value="<?php echo $data[0]['nm_keluarga']?>" />
                            </div></td>
						</tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nomor Polis</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_polis" name="no_polis" class="form-control" value="<?php echo $data[0]['no_polis']?>" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nomor Peserta</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_peserta" name="no_peserta" class="form-control" value="<?php echo $data[0]['no_peserta']?>" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Umur</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="umur" name="umur" class="form-control" value="<?php echo $data[0]['umur']?>" />
                            </div></td>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Jenis Kelamin</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="jk" name="jk" size="1">
                            <?
								if ($data[0]['jk'] == 'Laki-Laki') {
									echo '<option value="Laki-Laki" selected="selected">Laki-Laki</option>';
									echo '<option value="Perempuan">Perempuan</option>';
								}
								elseif ($data[0]['jk'] == 'Perempuan') {
									echo '<option value="Laki-Laki">Laki-Laki</option>';
									echo '<option value="Perempuan" selected="selected">Perempuan</option>';
								}
								else {
									echo '<option value="" selected="selected">--Pilih Jenis Kelamin--</option>';
									echo '<option value="Laki-Laki">Laki-Laki</option>';
									echo '<option value="Perempuan">Perempuan</option>';
								}
								
							?>
                                
                            </select>
                            </div>                            
							</td>
						</tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nama Pegawai</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="peg_id" name="peg_id" size="1">
								<?php
									$dt = $db->query("select nomr id, nm_pasien nama, nomr_id from tbl_pasien where nomr_id='0' and hub='PEGAWAI' and nm_pasien <> '' order by nm_pasien");
									for ($i = 0; $i < count($dt); $i++) {
										if ($dt[$i]['id'] == $data[0]['nomr_id']) {
											echo '<option value="'.$dt[$i]['id'].'" selected>'.$dt[$i]['id'].'-'.$dt[$i]['nama'].'</option>';
										}
										else {
											echo '<option value="'.$dt[$i]['id'].'">'.$dt[$i]['id'].'-'.$dt[$i]['nama'].'</option>';
										}
									}
								?>
                            </select>
                            </div>                            
							</td>
						</tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Hubungan Dengan Pegawai</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="hub" name="hub" size="1">
                            <?
								if ($data[0]['hub'] == 'PEGAWAI') {
									echo '<option value="PEGAWAI" selected="selected">PEGAWAI</option>';
									echo '<option value="ISTRI">ISTRI</option>';
									echo '<option value="SUAMI">SUAMI</option>';
									echo '<option value="ANAK">ANAK</option>';
								}
								elseif ($data[0]['hub'] == 'ISTRI') {
									echo '<option value="PEGAWAI">PEGAWAI</option>';
									echo '<option value="ISTRI" selected="selected">ISTRI</option>';
									echo '<option value="SUAMI">SUAMI</option>';
									echo '<option value="ANAK">ANAK</option>';
								}
								elseif ($data[0]['hub'] == 'SUAMI') {
									echo '<option value="PEGAWAI">PEGAWAI</option>';
									echo '<option value="ISTRI">ISTRI</option>';
									echo '<option value="SUAMI" selected="selected">SUAMI</option>';
									echo '<option value="ANAK">ANAK</option>';
								}
								elseif ($data[0]['hub'] == 'ANAK') {
									echo '<option value="PEGAWAI">PEGAWAI</option>';
									echo '<option value="ISTRI">ISTRI</option>';
									echo '<option value="SUAMI">SUAMI</option>';
									echo '<option value="ANAK" selected="selected">ANAK</option>';
								}
							?>
                                
                            </select>
                            </div>                            
							</td>
						</tr>
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Tempat Lahir</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="tmpt_lahir" name="tmpt_lahir" class="form-control" value="<?php echo $data[0]['tmpt_lahir']?>" />
                            </div></td>     
						</tr>                       
                         <tr height="28">
                            <td width="200"><span style="margin-left:10px">Tanggal Lahir</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" value="<?php echo date("m/d/Y", strtotime($data[0]['tgl_lahir']))?>"  /> Format mm/dd/yyyy 
                            </div></td>
						</tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Pekerjaan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" value="<?php echo $data[0]['pekerjaan']?>" />
                            </div></td>
<tr height="28">
                            <td width="200"><span style="margin-left:10px">Alamat Pasien</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <textarea tabindex="2" cols="50" rows="3" class="field textarea small" id="alamat_pasien" name="alamat_pasien" ><?php echo trim($data[0]['alamat_pasien'])?>
                            </textarea>
<tr height="28">
                            <td width="200"><span style="margin-left:10px">Kelurahan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="kelurahan" name="kelurahan" class="form-control" value="<?php echo $data[0]['kelurahan']?>"  />
                            </div></td>
<tr height="28">
                            <td width="200"><span style="margin-left:10px">Kecamatan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="kecamatan" name="kecamatan" class="form-control" value="<?php echo $data[0]['kecamatan']?>" />
                            </div></td>                            
<tr height="28">
                            <td width="200"><span style="margin-left:10px">Kotamadya</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="kotamadya" name="kotamadya" class="form-control" value="<?php echo $data[0]['kotamadya']?>" />
                            </div></td>
<tr height="28">
                            <td width="200"><span style="margin-left:10px">Propinsi</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="propinsi" name="propinsi" class="form-control" value="<?php echo $data[0]['propinsi']?>"  />
                            </div></td>                            
<tr height="28">
                            <td width="200"><span style="margin-left:10px">Kode Pos</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="kode_pos_pasien" name="kode_pos_pasien" class="form-control" value="<?php echo $data[0]['kode_pos_pasien']?>"  /> 
                            </div></td>                            
<tr height="28">
                            <td width="200"><span style="margin-left:10px">Telp</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="telp_pasien" name="telp_pasien" class="form-control" value="<?php echo $data[0]['telp_pasien']?>" />
                            </div></td>                            
<tr height="28">
                            <td width="200"><span style="margin-left:10px">Agama</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="agama" name="agama" size="1">
                            <option value="">--Pilih Agama--</option>
                            <?php
								if ($data[0]['agama'] == 'Islam') {
									echo '<option value="Islam" selected="selected">Islam</option>';
									echo '<option value="Katholik">Katholik</option>';
									echo '<option value="Protestan">Protestan</option>';
									echo '<option value="Hindhu">Hindhu</option>';
									echo '<option value="Budha">Budha</option>';
								}
								elseif ($data[0]['agama'] == 'Katholik') {
									echo '<option value="Islam">Islam</option>';
									echo '<option value="Katholik" selected="selected"></option>';
									echo '<option value="Protestan">Protestan</option>';
									echo '<option value="Hindhu">Hindhu</option>';
									echo '<option value="Budha">Budha</option>';
								}
								elseif ($data[0]['agama'] == 'Protestan') {
									echo '<option value="Islam">Islam</option>';
									echo '<option value="Katholik"></option>';
									echo '<option value="Protestan" selected="selected">Protestan</option>';
									echo '<option value="Hindhu">Hindhu</option>';
									echo '<option value="Budha">Budha</option>';
								}
								elseif ($data[0]['agama'] == 'Hindhu') {
									echo '<option value="Islam">Islam</option>';
									echo '<option value="Katholik"></option>';
									echo '<option value="Protestan">Protestan</option>';
									echo '<option value="Hindhu" selected="selected">Hindhu</option>';
									echo '<option value="Budha">Budha</option>';
								}
								elseif ($data[0]['agama'] == 'Budha') {
									echo '<option value="Islam">Islam</option>';
									echo '<option value="Katholik"></option>';
									echo '<option value="Protestan">Protestan</option>';
									echo '<option value="Hindhu">Hindhu</option>';
									echo '<option value="Budha" selected="selected">Budha</option>';
								}
							?>
                            </select>
                            </div>                              
<tr height="28">
                            <td width="200"><span style="margin-left:10px">No.KTP</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_ktp" name="no_ktp" class="form-control" value="<?php echo $data[0]['no_ktp']?>"  />
                            </div></td>                            
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nama Penjamin</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nm_penjamin" name="nm_penjamin" class="form-control" value="<?php echo $data[0]['nm_penjamin']?>" />
                            </div></td>                            
<tr height="28">
                            <td width="200"><span style="margin-left:10px">Alamat Penjamin</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <textarea tabindex="2" cols="50" rows="3" class="field textarea small" id="alamat_penjamin" name="alamat_penjamin"><?php echo trim($data[0]['alamat_penjamin'])?>
                            </textarea>                            
                            </div></td>
<tr height="28">
                            <td width="200"><span style="margin-left:10px">Hubungan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="hubungan" name="hubungan" class="form-control" value="<?php echo $data[0]['hubungan']?>" />                                                                                </tr>
<tr height="28">
                            <td width="200"><span style="margin-left:10px">Rujukan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="rujukan" name="rujukan" class="form-control" value="<?php echo $data[0]['rujukan']?>" />                                                                                </tr> 
<tr height="28">
                            <td width="200"><span style="margin-left:10px">Tanggal Daftar</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <?
							$tgLdaftar=date('m-d-Y');
							?>
                            <input type="text" id="tgLdaftar" name="tgLdaftar" class="form-control" value="<?php echo $tgLdaftar?>" readonly="readonly"  /> 
                            </div></td>                            
<tr height="28">
                            <td width="200"><span style="margin-left:10px">Jenis Pendaftaran</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="jenis_pendaftaran" name="jenis_pendaftaran" size="1">
                            <option value="">--Pilih Jenis Pendaftaran--</option>
                            <?php
								if ($data[0]['jenis_pendaftaran'] == 'Rawat Jalan') {
									echo '<option value="Rawat Jalan" selected="selected">Rawat Jalan</option>';
									echo '<option value="Rawat Inap">Rawat Inap</option>';
								}
								elseif ($data[0]['jenis_pendaftaran'] == 'Rawat Inap') {
									echo '<option value="Rawat Jalan">Rawat Jalan</option>';
									echo '<option value="Rawat Inap" selected="selected">Rawat Inap</option>';
								}
							?>
                            </select>
                            </div>                                     </tr>
                        </tr>
                    </table>
                </div>
                </td>
            </tr>
        </table>
    </div>
    <div align="center" style="margin-right: 15px; margin-top: 10px; margin-bottom: 10px;">
        <input type="hidden" id="id" name="id" value="<?php echo $data[0]['id']?>" />
        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Pasien" onclick="simpanData(this.form, 'pages/master/pasien_update.php')" />
    </div>
	</form>
</div>