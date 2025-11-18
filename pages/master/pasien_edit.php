<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	$data = $db->query("select * from tbl_pasien where md5(id)='".$_GET['id']."'");
	//print_r($data);
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Edit Data</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Data Master Pasien
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/pasien_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No Medical Record</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nomr" name="nomr" class="form-control" style="50px" value="<?php echo $data[0]['nomr']?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">ID Membership</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nomr" name="nomr" class="form-control" style="50px" value="<?php echo $data[0]['idmember']?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Status Membership</label>
                                                    <div class="col-sm-8">
                                                        <select id="status_membership" name="status_membership" size="1" class="form-control">
                                                            <option value="">--Pilih Status Membership--</option>
                                                            <?php
                                                            if ($data[0]['status_membership'] == 'Aktif') {
                                                                echo '<option value="Aktif" selected="selected">Aktif</option>';
                                                                echo '<option value="Non Aktif">Non Aktif</option>';
                                                            }
                                                            elseif ($data[0]['status_membership'] == 'Non Aktif') {
                                                                echo '<option value="Aktif">Aktif</option>';
                                                                echo '<option value="Non Aktif" selected="selected">Non Aktif</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Keluarga</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="keluarga" name="keluarga" class="form-control" value="<?php echo $data[0]['nm_keluarga']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor Polis</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_polis" name="no_polis" class="form-control" value="<?php echo $data[0]['no_polis']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Pegawai</label>
                                                    <div class="col-sm-8">
                                                        <select id="peg_id" name="peg_id" size="1" class="form-control">
                                                            <?php
                                                            $dt = $db->query("select nomr id, nm_pasien nama, nomr_id from tbl_pasien where nomr_id='0' and hub='PEGAWAI' and nm_pasien <> '' order by nm_pasien");
                                                            for ($i = 0; $i < count($dt); $i++) {
                                                                if ($dt[$i]['id'] == $data[0]['nomr_id']) {
                                                                    echo '<option value="'.$dt[$i]['id'].'" selected>'.$dt[$i]['nama'].'</option>';
                                                                }
                                                                else {
                                                                    echo '<option value="'.$dt[$i]['id'].'">'.$dt[$i]['nama'].'</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tempat Lahir</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="tmpt_lahir" name="tmpt_lahir" class="form-control" value="<?php echo $data[0]['tmpt_lahir']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Pekerjaan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" value="<?php echo $data[0]['pekerjaan']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Propinsi</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="propinsi" name="propinsi" onchange="pilihProp(this.value)" required="required">
                                                            <option value="">--Pilih Provinsi--</option>
                                        					<?php
                                        					    $sub = $db->query("select id, name from tbl_daerah_prop");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        if ($data[0]['prop_kode'] == $sub[$i]['id']) {
                                        					            echo '<option value="'.$sub[$i]['id'].'" selected>'.$sub[$i]['name'].'</option>';
                                        					        }
                                        					        else {

                                        					            echo '<option value="'.$sub[$i]['id'].'">'.$sub[$i]['name'].'</option>';
                                        					        }
                                        					    }
                                        					?>
														</select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Kabupaten/Kota</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control custom-select-value" id="kotamadya" name="kotamadya" onchange="pilihKab(this.value)" required="required">
                                                            <option value="">--Pilih Kabupaten / Kota--</option>
                                        					<?php
                                        					    $sub = $db->query("select id, name from tbl_daerah_kab where province_id='".$data[0]['prop_kode']."'");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        if ($data[0]['kab_kode'] == $sub[$i]['id']) {
                                        					            echo '<option value="'.$sub[$i]['id'].'" selected>'.$sub[$i]['name'].'</option>';
                                        					        }
                                        					        else {
                                        					            echo '<option value="'.$sub[$i]['id'].'">'.$sub[$i]['name'].'</option>';
                                        					        }
                                        					    }
                                        					?>
														</select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Kode Pos</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="kode_pos_pasien" name="kode_pos_pasien" class="form-control" value="<?php echo $data[0]['kode_pos_pasien']?>"  />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Agama</label>
                                                    <div class="col-sm-8">
                                                        <select id="agama" name="agama" size="1" class="form-control">
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
                                                                echo '<option value="Katholik" selected="selected">Katholik</option>';
                                                                echo '<option value="Protestan">Protestan</option>';
                                                                echo '<option value="Hindhu">Hindhu</option>';
                                                                echo '<option value="Budha">Budha</option>';
                                                            }
                                                            elseif ($data[0]['agama'] == 'Protestan') {
                                                                echo '<option value="Islam">Islam</option>';
                                                                echo '<option value="Katholik">Katholik</option>';
                                                                echo '<option value="Protestan" selected="selected">Protestan</option>';
                                                                echo '<option value="Hindhu">Hindhu</option>';
                                                                echo '<option value="Budha">Budha</option>';
                                                            }
                                                            elseif ($data[0]['agama'] == 'Hindhu') {
                                                                echo '<option value="Islam">Islam</option>';
                                                                echo '<option value="Katholik">Katholik</option>';
                                                                echo '<option value="Protestan">Protestan</option>';
                                                                echo '<option value="Hindhu" selected="selected">Hindhu</option>';
                                                                echo '<option value="Budha">Budha</option>';
                                                            }
                                                            elseif ($data[0]['agama'] == 'Budha') {
                                                                echo '<option value="Islam">Islam</option>';
                                                                echo '<option value="Katholik">Katholik</option>';
                                                                echo '<option value="Protestan">Protestan</option>';
                                                                echo '<option value="Hindhu">Hindhu</option>';
                                                                echo '<option value="Budha" selected="selected">Budha</option>';
                                                            }
                                                           else {
                                                                echo '<option value="Islam">Islam</option>';
                                                                echo '<option value="Katholik">Katholik</option>';
                                                                echo '<option value="Protestan">Protestan</option>';
                                                                echo '<option value="Hindhu">Hindhu</option>';
                                                                echo '<option value="Budha">Budha</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Penjamin</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nm_penjamin" name="nm_penjamin" class="form-control" value="<?php echo $data[0]['nm_penjamin']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Hubungan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="hubungan" name="hubungan" class="form-control" value="<?php echo $data[0]['hubungan']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">E-mail</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="email" name="email" class="form-control" value="<?php echo $data[0]['email']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Daftar</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="tgLdaftar" name="tgLdaftar" class="form-control" value="<?=date('m-d-Y')?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Pasien</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $data[0]['nm_pasien']?>" />
                                                    </div>
                                             </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor Peserta</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_peserta" name="no_peserta" class="form-control" value="<?php echo $data[0]['no_peserta']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Jenis Kelamin</label>
                                                    <div class="col-sm-8">
                                                        <select id="jk" name="jk" size="1" class="form-control">
                                                            <?php
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
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Hubungan Dengan Pegawai</label>
                                                    <div class="col-sm-8">
                                                        <select id="hub" name="hub" size="1" class="form-control">
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
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Lahir</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" id="tgl_kelahiran" name="tgl_kelahiran" class="form-control" value="<?php echo $data[0]['tgl_lahir']?>"  /> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Alamat Pasien</label>
                                                    <div class="col-sm-8">
                                                        <textarea tabindex="2" cols="50" rows="3" class="form-control" id="alamat_pasien" name="alamat_pasien" ><?php echo trim($data[0]['alamat_pasien'])?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Kecamatan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control custom-select-value" id="kecamatan" name="kecamatan" onchange="pilihKec(this.value)" required="required">
                                                            <option value="">--Pilih Kecamatan--</option>
                                        					<?php
                                        					    $sub = $db->query("select id, name from tbl_daerah_kec where regency_id='".$data[0]['kab_kode']."'");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        if ($data[0]['kec_kode'] == $sub[$i]['id']) {
                                        					            echo '<option value="'.$sub[$i]['id'].'" selected>'.$sub[$i]['name'].'</option>';
                                        					        }
                                        					        else {
                                        					            echo '<option value="'.$sub[$i]['id'].'">'.$sub[$i]['name'].'</option>';
                                        					        }
                                        					    }
                                        					?>
														</select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Kelurahan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control custom-select-value" id="kelurahan" name="kelurahan" required="required">
                                                            <option value="">--Pilih Kecamatan--</option>
                                        					<?php
                                        					    $sub = $db->query("select id, name from tbl_daerah_kel where district_id='".$data[0]['kec_kode']."'");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        if ($data[0]['kel_kode'] == $sub[$i]['id']) {
                                        					            echo '<option value="'.$sub[$i]['id'].'" selected>'.$sub[$i]['name'].'</option>';
                                        					        }
                                        					        else {
                                        					            echo '<option value="'.$sub[$i]['id'].'">'.$sub[$i]['name'].'</option>';
                                        					        }
                                        					    }
                                        					?>
														</select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Telp</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="telp_pasien" name="telp_pasien" class="form-control" value="<?php echo $data[0]['telp_pasien']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No.KTP</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_ktp" name="no_ktp" class="form-control" value="<?php echo $data[0]['no_ktp']?>"  />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Alamat Penjamin</label>
                                                    <div class="col-sm-8">
                                                        <textarea tabindex="2" cols="50" rows="3" class="form-control" id="alamat_penjamin" name="alamat_penjamin"><?php echo trim($data[0]['alamat_penjamin'])?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Provider Asal</label>
                                                    <div class="col-sm-8">
                                                        <select id="rujukan" name="rujukan" size="1" class="form-control">
                                                            <option value="">--Pilih Klinik Asal--</option>
                                                            <?php
                                                            	$rujuk = $db->query("select kode_perusahaan, nama_perusahaan from tbl_perusahaan order by nama_perusahaan");
                                                            	for ($i = 0; $i < count($rujuk); $i++) {
                                                            		if ($data[0]['rujukan'] == $rujuk[$i]['nama_perusahaan']) {
                                                            			echo '<option value="'.$rujuk[$i]['nama_perusahaan'].'" selected>'.$rujuk[$i]['nama_perusahaan'].'</option>';
                                                            		}
                                                            		else {
                                                            			echo '<option value="'.$rujuk[$i]['nama_perusahaan'].'">'.$rujuk[$i]['nama_perusahaan'].'</option>';
                                                            		}
                                                            	}
							    ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Jenis Pendaftaran</label>
                                                    <div class="col-sm-8">
                                                        <select id="jenis_pendaftaran" name="jenis_pendaftaran" size="1" class="form-control">
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
                                                            else {
                                                                echo '<option value="Rawat Jalan">Rawat Jalan</option>';
                                                                echo '<option value="Rawat Inap">Rawat Inap</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Masa Berlaku</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" id="tgl_berlaku" name="tgl_berlaku" class="form-control" value="<?php echo $data[0]['tgl_berlaku']?>"  /> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tipe Pasien</label>
                                                    <div class="col-sm-8">
                                                        <select id="type_pasien" name="type_pasien" size="1" class="form-control">
                                                            <option value="">--Pilih Tipe Pasien--</option>
                                                            <?php
                                                            if ($data[0]['type_pasien'] == 'Klinik') {
                                                                echo '<option value="Klinik" selected="selected">Klinik</option>';
                                                                echo '<option value="Alat HD">Alat HD</option>';
                                                                echo '<option value="Corporated">Corporated</option>';
                                                                echo '<option value="Mandiri">Mandiri</option>';
                                                            }
                                                            elseif ($data[0]['type_pasien'] == 'Alat HD') {
                                                                echo '<option value="Klinik">Klinik</option>';
                                                                echo '<option value="Alat HD" selected="selected">Alat HD</option>';
                                                                echo '<option value="Corporated">Corporated</option>';
                                                                echo '<option value="Mandiri">Mandiri</option>';
                                                            }
                                                            elseif ($data[0]['type_pasien'] == 'Corporated') {
                                                                echo '<option value="Klinik">Klinik</option>';
                                                                echo '<option value="Alat HD">Alat HD</option>';
                                                                echo '<option value="Corporated" selected="selected">Corporated</option>';
                                                                echo '<option value="Mandiri">Mandiri</option>';
                                                            }
                                                            elseif ($data[0]['type_pasien'] == 'Mandiri') {
                                                                echo '<option value="Klinik">Klinik</option>';
                                                                echo '<option value="Alat HD">Alat HD</option>';
                                                                echo '<option value="Corporated">Corporated</option>';
                                                                echo '<option value="Mandiri" selected="selected">Mandiri</option>';
                                                            }
                                                            else {
                                                                echo '<option value="Klinik">Klinik</option>';
                                                                echo '<option value="Alat HD">Alat HD</option>';
                                                                echo '<option value="Corporated">Corporated</option>';
                                                                echo '<option value="Mandiri">Mandiri</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-actions">
                                                    <input type="hidden" id="id" name="id" value="<?php echo $data[0]['id']?>" />
                                                    <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Pasien" onclick="simpanData(this.form, 'pages/master/pasien_update.php')" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script language="javascript">
	function pilihProp(id) {
		var url = "pages/user/menu_kabupaten.php";
		var data = {id:id};
		
		$('#kotamadya').load(url,data, function(){
			$('#kotamadya').fadeIn('fast');
		});
		pilihKab("");
		pilihKec("");
	}
	function pilihKab(id) {
		var url = "pages/user/menu_kecamatan.php";
		var data = {id:id};
		
		$('#kecamatan').load(url,data, function(){
			$('#kecamatan').fadeIn('fast');
		});
		pilihKec("");
	}
	function pilihKec(id) {
		var url = "pages/user/menu_kelurahan.php";
		var data = {id:id};
		
		$('#kelurahan').load(url,data, function(){
			$('#kelurahan').fadeIn('fast');
		});
	}
</script>
