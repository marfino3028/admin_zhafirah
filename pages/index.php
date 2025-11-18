<!--<div class="other-box yellow-box ui-corner-all">
    <div class="cont tooltip ui-corner-all" title="Selamat Datang">
        <h3>Selamat Datang</h3>
        <p>Anda Login Sebagai <b><?php echo $_SESSION['rg_nama']?></b>, Silahkan gunakan Feature yang telah kami sediakan. Apabila ada pertanyaan, Silahkan Hubungi Kami.</p>

    </div>
</div>-->
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Formulir Input Data Karyawan</div>
	<form action="javascript:simpan_data_pegawai(this.form)" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
            <tr height="28">
                <td width="200"><span style="margin-left:10px">NIP/NIK</span></td>
                <td valign="middle" align="center">
                <div style="margin-bottom: 4px; margin-top: 4px;"><input type="text" id="nip" name="nip" class="form-control" /></div></td>
            </tr>
            <tr height="28">
                <td width="200"><span style="margin-left:10px">Nama</span></td>
                <td valign="middle" align="center">
                <div style="margin-bottom: 4px; margin-top: 4px;"><input type="text" id="nama" name="nama" class="form-control" /></div></td>
            </tr>
            <tr height="28">
                <td width="200"><span style="margin-left:10px">Jenis Kelamin</span></td>
                <td valign="middle" align="center">
                <div style="margin-bottom: 4px; margin-top: 4px;">
                <select tabindex="3" class="field select small" name="gender" id="gender" > 
                    <option value="">--pilih jenis kelamin--</option>
                    <option value="M">Laki-Laki</option>
                    <option value="F">Perempuan</option>
                </select>
                </div></td>
            </tr>
            <tr height="28">
                <td width="200"><span style="margin-left:10px">Tempat dan Tanggal Lahir</span></td>
                <td valign="middle" align="center">
                <div style="margin-bottom: 4px; margin-top: 4px;">
                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" /> &nbsp; <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" />
                </div></td>
            </tr>
            <tr height="28">
                <td width="200"><span style="margin-left:10px">Tanggal Masuk</span></td>
                <td valign="middle" align="center">
                <div style="margin-bottom: 4px; margin-top: 4px;">
                <input type="text" id="tgl_masuk" name="tgl_masuk" class="form-control" />
                </div></td>
            </tr>
            <tr height="28">
                <td width="200"><span style="margin-left:10px">Agama</span></td>
                <td valign="middle" align="center">
                <div style="margin-bottom: 4px; margin-top: 4px;">
                <select tabindex="3" class="field select small" name="agama" id="agama" > 
                    <option value="">--pilih agama--</option>
                    <?php
						$gender = $db->query("select * from tbl_agama");
						for ($i = 0; $i < count($gender); $i++) {
							echo '<option value="'.$gender[$i]['nama'].'">'.$gender[$i]['nama'].'</option>';
						}
					?>
                </select>
                </div></td>
            </tr>
            <tr height="28">
                <td width="200"><span style="margin-left:10px">Alamat Rumah</span></td>
                <td valign="middle" align="center">
                <div style="margin-bottom: 4px; margin-top: 4px;">
                <textarea tabindex="2" cols="50" rows="2" class="form-control" name="alamat" id="alamat" ></textarea>
                </div></td>
            </tr>
            <tr height="28">
                <td width="200"><span style="margin-left:10px">Alamat Email</span></td>
                <td valign="middle" align="center">
                <div style="margin-bottom: 4px; margin-top: 4px;">
                <input type="text" id="email" name="email" class="form-control" />
                </div></td>
            </tr>
            <tr height="28">
                <td width="200"><span style="margin-left:10px">Nomor Telephone</span></td>
                <td valign="middle" align="center">
                <div style="margin-bottom: 4px; margin-top: 4px;">
                <input type="text" id="telp" name="telp" class="form-control" />
                </div></td>
            </tr>
            <tr height="28">
                <td width="200"><span style="margin-left:10px">Nomor Handphone</span></td>
                <td valign="middle" align="center">
                <div style="margin-bottom: 4px; margin-top: 4px;">
                <input type="text" id="hp" name="hp" class="form-control" />
                </div></td>
            </tr>
            <tr height="28">
                <td width="200"><span style="margin-left:10px">SBU</span></td>
                <td valign="middle" align="center">
                <div style="margin-bottom: 4px; margin-top: 4px;">
                <select tabindex="3" class="field select small" name="sbu" id="sbu" > 
                    <option value="">--pilih sbu--</option>
                    <?php
						$gender = $db->query("select * from tbl_sbu");
						for ($i = 0; $i < count($gender); $i++) {
							echo '<option value="'.$gender[$i]['id'].'">'.$gender[$i]['nama'].'</option>';
						}
					?>
                </select>
                </div></td>
            </tr>
            <tr height="28">
                <td width="200"><span style="margin-left:10px">Status Perkawinan</span></td>
                <td valign="middle" align="center">
                <div style="margin-bottom: 4px; margin-top: 4px;">
                <select tabindex="3" class="field select small" name="kawin" id="kawin" > 
                    <option value="">--pilih status perkawinan--</option>
                    <option value="KAWIN">Menikah</option>
                    <option value="BELUM KAWIN">Belum Menikah</option>
                </select>
                </div></td>
            </tr>
            <tr height="28">
                <td width="200"><span style="margin-left:10px">Foto</span></td>
                <td valign="middle" align="center">
                <div style="margin-bottom: 4px; margin-top: 4px;">
                <input type="file" name="foto" id="foto" size="20">
                </div></td>
            </tr>
        </table>
    </div>
    <div align="center" style="margin-right: 15px; margin-top: 10px; margin-bottom: 10px;">
        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Pegawai" onclick="simpan_data_pegawai(this.form)" />
    </div>
	</form>
</div>