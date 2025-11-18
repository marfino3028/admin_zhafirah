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

</script>

<?php
	$data = $db->query("select * from tbl_jurnal where id='".$_GET['id']."'");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Keuangan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Jurnal Entri
                </a>
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
                            <div class="box box-color box-bordered box-small lightgrey">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Edit Data Jurnal Entri
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">No. Jurnal</label>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $data[0]['no_jurnal'];
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Jenis Jurnal</label>
                                            <div class="col-sm-10">
                                                <select id="jenis_jurnal" name="jenis_jurnal" size="1" class="form-control">
                                                    <?php
                                                    $poli = $db->query("select kode from tbl_kode_bukti where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        if ($poli[$i]['kode'] == $data[0]['kode_bukti']) {
                                                            echo '<option value="'.$poli[$i]['kode'].'" selected>'.$poli[$i]['kode'].'</option>';
                                                        }
                                                        else {
                                                            echo '<option value="'.$poli[$i]['kode'].'">'.$poli[$i]['kode'].'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Tanggal</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y", strtotime($data[0]['tanggal_transaksi']))?>" size="10" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Deskripsi</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="deskripsi" name="deskripsi" size="90" value="<?php echo $data[0]['deskripsi']?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Akun (Kode Akun)</label>
                                            <div class="col-sm-10">
                                                <select id="kode_akun" name="kode_akun" size="1" class="form-control">
                                                    <?php
                                                    $poli = $db->query("select kd_coa, nm_coa from tbl_coa where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        if ($data[0]['kode'] == $poli[$i]['kd_coa']) {
                                                            echo '<option value="'.$poli[$i]['kd_coa'].'" selected>'.$poli[$i]['nm_coa'].'</option>';
                                                        }
                                                        else {
                                                            echo '<option value="'.$poli[$i]['kd_coa'].'">'.$poli[$i]['nm_coa'].'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Mapping Akun (Kode Akun)</label>
                                            <div class="col-sm-10">
                                                <select id="mkode_akun" name="mkode_akun" size="1" class="form-control">
                                                    <?php
                                                    $poli = $db->query("select kd_coa, nm_coa from tbl_coa where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        if ($data[0]['kode_inv'] == $poli[$i]['kd_coa']) {
                                                            echo '<option value="'.$poli[$i]['kd_coa'].'" selected>'.$poli[$i]['nm_coa'].'</option>';
                                                        }
                                                        else {
                                                            echo '<option value="'.$poli[$i]['kd_coa'].'">'.$poli[$i]['nm_coa'].'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nilai Transaksi</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nilai" name="nilai" size="20" style="text-align: right" value="<?php echo $data[0]['nilai']?>" class="form-control text-right" />
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <input type="hidden" name="id" id="id" value="<?php echo $data[0]['id']?>" />
                                            <input type="hidden" name="no_jurnal" id="no_jurnal" value="<?php echo $data[0]['no_jurnal']?>" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Jurnal" onclick="simpanDataDaftar(this.form, 'pages/keuangan/jurnal_update.php')" />
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