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
    <div class="portlet-header ui-widget-header">Form Tambah Master Data Pasien</div>
    <form method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
        <div align="left">
            <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">No.Medical Record </span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;"><input type="text" id="nip" name="nip" class="form-control" value="<?php echo $sub[0]['nip'] ?>" style="width: 100px;" /></div></td>
                    <td width="200"><span style="margin-left:10px">ID Finger</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;"><input type="text" id="uid" name="uid" class="form-control" value="<?php echo $sub[0]['uid'] ?>" style="width: 50px;" /></div></td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Nama Lengkap Pasien </span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;"><input type="text" id="nama" name="nama" class="form-control" value="<?php echo $sub[0]['nama'] ?>" /></div></td>
                    <td width="200"><span style="margin-left:10px">Tempat dan Tanggal Lahir</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" value="<?php echo $sub[0]['tempat_lahir'] ?>" /> &nbsp; <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" style="width: 70px;" value="<?php echo $sub[0]['tgl_lahir'] ?>" /> &nbsp; mm/dd/yyyy
                        </div></td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Jenis Kelamin </span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select tabindex="3" class="field select" name="gender" id="gender" > 
                                <?php
                                $lt = $db->query("select id, nama from tbl_lantai");
                                for ($i = 0; $i < count($lt); $i++) {
                                    if ($sub[0]['lantai_id'] == $lt[$i]['id']) {
                                        echo '<option value="' . $lt[$i]['id'] . '" selected>' . $lt[$i]['nama'] . '</option>';
                                    } else {
                                        echo '<option value="' . $lt[$i]['id'] . '">' . $lt[$i]['nama'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div></td>
                    <td width="200"><span style="margin-left:10px">Unit / Bagian</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select tabindex="3" class="field select" name="unit" id="unit" > 
                                <?php
                                $lt = $db->query("select id, nama_unit from tbl_unit order by lantai_id, nama_unit");
                                for ($i = 0; $i < count($lt); $i++) {
                                    if ($sub[0]['unit_id'] == $lt[$i]['id']) {
                                        echo '<option value="' . $lt[$i]['id'] . '" selected>' . $lt[$i]['nama_unit'] . '</option>';
                                    } else {
                                        echo '<option value="' . $lt[$i]['id'] . '">' . $lt[$i]['nama_unit'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
					</td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Golongan</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select tabindex="3" class="field select" name="golongan" id="golongan" > 
                                <option value="">--Pilih Golongan--</option>
								<?php
                                $lt = $db->query("select nama, nama_pangkat from tbl_golongan");
                                for ($i = 0; $i < count($lt); $i++) {
                                    if ($sub[0]['golongan'] == $lt[$i]['nama']) {
										echo '<option value="' . $lt[$i]['nama'] . '" selected>' . $lt[$i]['nama'].' - '.$lt[$i]['nama_pangkat'] . '</option>';
									}
									else {
										echo '<option value="' . $lt[$i]['nama'] . '">' . $lt[$i]['nama'].' - '.$lt[$i]['nama_pangkat'] . '</option>';
									}
                                }
                                ?>
                            </select>
                        </div></td>
                    <td width="200"><span style="margin-left:10px">Alamat</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="alamat" name="alamat" class="form-control" value="<?php echo $sub[0]['jabatan'] ?>" />
                        </div></td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Nama Keluarga Pasien</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="jabatan" name="jabatan" class="form-control" value="<?php echo $sub[0]['jabatan'] ?>" />
                        </div></td>
                    <td width="200"><span style="margin-left:10px">Foto</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                           <input type="file" name="foto" id="foto" size="20">
                        </div></td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Bagian</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="BAGIAN" name="BAGIAN" class="form-control" value="<?php echo $sub[0]['BAGIAN'] ?>" />
                        </div>
                    </td>
                    <td width="200"><span style="margin-left:10px">Status kerja</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
							<select tabindex="3" class="field select" name="STATUS_KERJA" id="STATUS_KERJA" > 
                                <option value="">--Pilih Status Kerja--</option>
								<?php
                                $lt = $db->query("select status_tetap jenjang_pndk from tbl_karyawan_tetap");
                                for ($i = 0; $i < count($lt); $i++) {
                                    if ($sub[0]['STATUS_KERJA'] == $lt[$i]['jenjang_pndk']) {
										echo '<option value="' . $lt[$i]['jenjang_pndk'] . '" selected>' . $lt[$i]['jenjang_pndk'].'</option>';
									}
									else {
										echo '<option value="' . $lt[$i]['jenjang_pndk'] . '">' . $lt[$i]['jenjang_pndk']. '</option>';
									}
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Pendidikan</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select tabindex="3" class="field select" name="PENDIDIKAN" id="PENDIDIKAN" > 
                                <option value="">--Pilih Pendidikan--</option>
								<?php
                                $lt = $db->query("select jenjang_pndk from tbl_karyawan_jenjang");
                                for ($i = 0; $i < count($lt); $i++) {
                                    if ($sub[0]['PENDIDIKAN'] == $lt[$i]['jenjang_pndk']) {
										echo '<option value="' . $lt[$i]['jenjang_pndk'] . '" selected>' . $lt[$i]['jenjang_pndk'].'</option>';
									}
									else {
										echo '<option value="' . $lt[$i]['jenjang_pndk'] . '">' . $lt[$i]['jenjang_pndk']. '</option>';
									}
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                    <td width="200"><span style="margin-left:10px">Jurusan</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="JURUSAN" name="JURUSAN" class="form-control" value="<?php echo $sub[0]['JURUSAN'] ?>" />
                        </div>
                    </td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Tahun</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="TAHUN" name="TAHUN" class="form-control" value="<?php echo $sub[0]['TAHUN'] ?>" />
                        </div>
                    </td>
                    <td width="200"><span style="margin-left:10px">Marital status</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
							<select tabindex="3" class="field select" name="MARITAL_STATUS" id="MARITAL_STATUS" > 
                                <option value="">--Pilih Marital Status--</option>
								<?php
                                $lt = $db->query("select status_martial jenjang_pndk from tbl_karyawan_martial");
                                for ($i = 0; $i < count($lt); $i++) {
                                    if ($sub[0]['MARITAL_STATUS'] == $lt[$i]['jenjang_pndk']) {
										echo '<option value="' . $lt[$i]['jenjang_pndk'] . '" selected>' . $lt[$i]['jenjang_pndk'].'</option>';
									}
									else {
										echo '<option value="' . $lt[$i]['jenjang_pndk'] . '">' . $lt[$i]['jenjang_pndk']. '</option>';
									}
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Agama</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
							<select tabindex="3" class="field select" name="AGAMA" id="AGAMA" > 
                                <option value="">--Pilih Agama--</option>
								<?php
                                $lt = $db->query("select agama jenjang_pndk from tbl_karyawan_agama");
                                for ($i = 0; $i < count($lt); $i++) {
                                    if ($sub[0]['AGAMA'] == $lt[$i]['jenjang_pndk']) {
										echo '<option value="' . $lt[$i]['jenjang_pndk'] . '" selected>' . $lt[$i]['jenjang_pndk'].'</option>';
									}
									else {
										echo '<option value="' . $lt[$i]['jenjang_pndk'] . '">' . $lt[$i]['jenjang_pndk']. '</option>';
									}
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                    <td width="200"><span style="margin-left:10px">Tanggal Masuk</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="TGL_MASUK" name="TGL_MASUK" class="tanggal field text medium" style="width: 70px;" value="<?php echo $sub[0]['TGL_MASUK'] ?>" /> &nbsp; yyyy-mm-dd
                        </div>
                    </td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">No. Handphone</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="NO_HP" name="NO_HP" class="form-control" value="<?php echo $sub[0]['NO_HP'] ?>" />
                        </div>
                    </td>
                    <td width="200"><span style="margin-left:10px">No. Handphone 2</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="NO_HP2" name="NO_HP2" class="form-control" value="<?php echo $sub[0]['NO_HP2'] ?>" />
                        </div>
                    </td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Username</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="username" name="username" class="form-control"  value="<?php echo $sub[0]['username'] ?>"/>
                        </div>
                    </td>
                    <td width="200"><span style="margin-left:10px">Password</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="password" id="password" name="password" class="form-control"  value="<?php echo $sub[0]['password'] ?>"/>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div align="center" style="margin-right: 15px; margin-top: 10px; margin-bottom: 10px;">
            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Karyawan" onclick="simpanData(this.form, 'pages/master/employe_insert.php')" />
        </div>
    </form>
</div>
