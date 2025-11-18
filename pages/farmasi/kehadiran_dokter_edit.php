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
<?php
	$data = $db->query("select * from tbl_kehadiran_dokter where id='".$_GET['id']."'");
?>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Keuangan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Kehadiran Dokter</a>
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
                                        Form Edit Kehadiran Dokter
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Hadir</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y", strtotime($data[0]['tgl_insert']))?>" size="10" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Pilih Dokter</label>
                                                    <div class="col-sm-8">
                                                        <select id="dokter" name="dokter" size="1" class="form-control">
                                                            <?php
                                                            $poli = $db->query("select kode_dokter, nama_dokter from tbl_dokter where status_delete='UD'");
                                                            for ($i = 0; $i < count($poli); $i++) {
                                                                if ($poli[$i]['kode_dokter'] == $data[0]['kode_dokter']) {
                                                                    echo '<option value="'.$poli[$i]['kode_dokter'].'" selected>'.$poli[$i]['nama_dokter'].'</option>';
                                                                }
                                                                else {
                                                                    echo '<option value="'.$poli[$i]['kode_dokter'].'">'.$poli[$i]['nama_dokter'].'</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Pilih Waktu</label>
                                                    <div class="col-sm-8">
                                                        <select id="waktu" name="waktu" size="1" class="form-control" onchange="lihatBiaya(this.value)">
                                                            <?php
                                                            if ($data[0]['waktu_hadir'] == 'F') {
                                                                echo '<option value="F" selected>1 Hari Penuh</option>';
                                                                echo '<option value="H">Setengah Hari</option>';
                                                            }
                                                            else {
                                                                echo '<option value="F">1 Hari Penuh</option>';
                                                                echo '<option value="H" selected>Setengah Hari</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div style="margin-bottom: 4px; margin-top: 7px; font-size: 14px; font-weight: bold; float: left; width: 300px;" id="biayaDokter">Biaya Kehadiran : Rp. <?php echo number_format($data[0]['biaya'])?></div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" name="id" id="id" value="<?php echo $data[0]['id']?>" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Kehadiran Dokter" onclick="simpanData(this.form, 'pages/farmasi/kehadiran_dokter_update.php')" />
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