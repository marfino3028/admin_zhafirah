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
                <a href="javascript:void(0)">Tambah Data</a>
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
                                        Form Tambah Data Jurnal Entri Saldo Awal
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/keuangan/jurnal_saldo_awal_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">tgl/Mata Uang</label>
                                            <div class="col-sm-2">
                                            	<label for="textfield" class="control-label">Tanggal</label>
                                                <input type="date" id="tanggals" name="tanggal" value="<?php echo date("Y-m-d")?>" size="10" class="form-control" />
                                            </div>
                                            <div class="col-sm-2">
                                            	<label for="textfield" class="control-label">Mata Uang</label>
                                                <select id="mata_uang" name="mata_uang" size="1" class="form-control">
                                                    <option value="IDR">IDR - Rupiah</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Keterangan</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="keterangan" name="keterangan" size="90" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Akun</label>
                                            <div class="col-sm-10">
                                                <select id="kode_akun" name="kode_akun" size="1" class="form-control">
                                                    <option value="">--Pilih Akun--</option>
                                                    <?php
                                                    $poli = $db->query("select kd_coa, nm_coa from tbl_coa where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        echo '<option value="'.$poli[$i]['kd_coa'].'">'.$poli[$i]['kd_coa'].' - '.$poli[$i]['nm_coa'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nilai</label>
                                            <div class="col-sm-10">
                                                <input type="number" id="nilai" name="nilai" class="form-control text-right" placeholder="0" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Jurnal Saldo awal" />
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