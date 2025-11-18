<div class="box box-bordered box-color">
	<div class="box-title">
		<h3>
			<i class="fa fa-table"></i>
			Form Input Data Karyawan
		</h3>
	</div>
	<div class="box-content nopadding">
	<form id="form_karyawan" method="POST" class='form-horizontal form-bordered' enctype="multipart/form-data" >
		<div style="padding-top: 20px;">
            <table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">NRK</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;"><input type="text" id="nip" name="nip"  value="<?php echo $sub[0]['nip'] ?>" /></div></td>
                    <td width="200"><span style="margin-left:10px">ID Finger</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;"><input type="text" id="uid" name="uid" class="field text large" value="<?php echo $sub[0]['uid'] ?>" style="width: 50px;" /></div></td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">No. KTP</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;"><input type="text" id="no_ktp" name="no_ktp" class="field text small" value="<?php echo $sub[0]['no_ktp'] ?>" style="width: 100px;" /></div></td>
                    <td width="200"><span style="margin-left:10px">Exp. Date KTP</span></td>
                    <td valign="middle" align="left">
                        <div class="col-sm-2" align="left">
                        	<input type="text" id="tgl_exp" name="tgl_exp" class="form-control datepick" style="height: 25px;" value="<?php echo $sub[0]['tgl_exp'] ?>" />
                        </div>
                        <div class="col-sm-10">
                            <input type="checkbox" id="tgl_exp_su" name="tgl_exp_su" class="field text large" value="<?php echo $sub[0]['tgl_exp_su'] ?>" style="width: 50px;" />Seumur Hidup
                        </div></td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Nama</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;"><input type="text" id="nama" name="nama" class="field text medium" value="<?php echo $sub[0]['nama'] ?>" /></div></td>
                    <td width="200"><span style="margin-left:10px">Tempat dan Tanggal Lahir</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="field text small" value="<?php echo $sub[0]['tempat_lahir'] ?>" /> &nbsp; <input type="text" id="tgl_lahir" name="tgl_lahir" class="field text" style="width: 70px;" value="<?php echo $sub[0]['tgl_lahir'] ?>" /> &nbsp; mm/dd/yyyy
                        </div></td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Lantai</span></td>
                    <td valign="middle" align="left">
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
                    <td valign="middle" align="left">
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
                    <td valign="middle" align="left">
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
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="alamat" name="alamat" class="field text medium" value="<?php echo $sub[0]['jabatan'] ?>" />
                        </div></td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Jabatan</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="jabatan" name="jabatan" class="field text medium" value="<?php echo $sub[0]['jabatan'] ?>" />
                        </div></td>
                    <td width="200"><span style="margin-left:10px">Foto</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                           <input type="file" name="foto" id="foto" size="20">
                        </div></td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Bagian</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="BAGIAN" name="BAGIAN" class="field text medium" value="<?php echo $sub[0]['BAGIAN'] ?>" />
                        </div>
                    </td>
                    <td width="200"><span style="margin-left:10px">Status kerja</span></td>
                    <td valign="middle" align="left">
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
                    <td valign="middle" align="left">
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
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="JURUSAN" name="JURUSAN" class="field text medium" value="<?php echo $sub[0]['JURUSAN'] ?>" />
                        </div>
                    </td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Tahun</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="TAHUN" name="TAHUN" class="field text medium" value="<?php echo $sub[0]['TAHUN'] ?>" />
                        </div>
                    </td>
                    <td width="200"><span style="margin-left:10px">Marital status</span></td>
                    <td valign="middle" align="left">
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
                    <td valign="middle" align="left">
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
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="mulai" name="TGL_MASUK" class="field text medium" style="width: 70px;" value="<?php echo $sub[0]['TGL_MASUK'] ?>" /> &nbsp; yyyy-mm-dd
                        </div>
                    </td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Email 1</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="email_1" name="email_1" class="field text medium" value="<?php echo $sub[0]['email_1'] ?>" />
                        </div>
                    </td>
                    <td width="200"><span style="margin-left:10px">Email 2</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="email_2" name="email_2" class="field text medium" value="<?php echo $sub[0]['email_2'] ?>" />
                        </div>
                    </td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">No. Handphone</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="NO_HP" name="NO_HP" class="field text medium" value="<?php echo $sub[0]['NO_HP'] ?>" />
                        </div>
                    </td>
                    <td width="200"><span style="margin-left:10px">No. Handphone 2</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="NO_HP2" name="NO_HP2" class="field text medium" value="<?php echo $sub[0]['NO_HP2'] ?>" />
                        </div>
                    </td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">No. Telepon Keadaan Darurat</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_darurat" name="no_darurat" class="field text medium" value="<?php echo $sub[0]['no_darurat'] ?>" />
                        </div>
                    </td>
                    <td width="200"><span style="margin-left:10px">Nama Keadaan Darurat</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nama_darurat" name="nama_darurat" class="field text medium" value="<?php echo $sub[0]['nama_darurat'] ?>" />
                        </div>
                    </td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Alamat Tempat Tinggal</span></td>
                    <td valign="middle" align="left"
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="alamat" name="alamat" class="field text large" style="width: 85%;" value="<?php echo $sub[0]['alamat'] ?>" />
                        </div>
                    </td>
                    <td width="200"><span style="margin-left:10px">Jenis Kelamin</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
							<select tabindex="3" class="field select" name="gender" id="jender" > 
                                <?php
									if ($sub[0]['gender'] == 'L') {
										echo '<option value="L" selected="selected">Laki-Laki</option><option value="P">Perempuan</option>';
									}
									elseif ($sub[0]['gender'] == 'P') {
										echo '<option value="L">Laki-Laki</option><option value="P" selected="selected">Perempuan</option>';
									}
									else {
										echo '<option value="" selected="selected">--Pilih Jenis Kelamin--</option><option value="L">Laki-Laki</option><option value="P">Perempuan</option>';
									}
								?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Username</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="username" name="username" class="field text medium"  value="<?php echo $sub[0]['username'] ?>"/>
                        </div>
                    </td>
                    <td width="200"><span style="margin-left:10px">Password</span></td>
                    <td valign="middle" align="left">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="password" id="password" name="password" class="field text medium"  value="<?php echo $sub[0]['password'] ?>"/>
                        </div>
                    </td>
                </tr>
            </table>
		<div class="form-actions col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-primary" name="simpan" id="simpan" onclick="simpanData(this.form, 'pages/master/employe_insert.php')">Simpan Data</button>
		</div>
		</div>
	</form>	
	</div>
</div>

<script language="javascript">

	function simpanData(t, url) {
		document.getElementById('form_karyawan').action = url;
		t.submit();
	}

</script>