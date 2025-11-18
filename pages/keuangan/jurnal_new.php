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

	function cekBalance() {
		//alert("");
		var d1 = document.getElementById("nilai_debet1").value;
		var d2 = document.getElementById("nilai_debet2").value;
		var d3 = document.getElementById("nilai_debet3").value;
		var d4 = document.getElementById("nilai_debet4").value;
		var d5 = document.getElementById("nilai_debet5").value;

		var k1 = document.getElementById("nilai_kredit1").value;
		var k2 = document.getElementById("nilai_kredit2").value;
		var k3 = document.getElementById("nilai_kredit3").value;
		var k4 = document.getElementById("nilai_kredit4").value;
		var k5 = document.getElementById("nilai_kredit5").value;
		//alert("OK");
		debet = parseInt(d1)+parseInt(d2)+parseInt(d3)+parseInt(d4)+parseInt(d5);
		kredit = parseInt(k1)+parseInt(k2)+parseInt(k3)+parseInt(k4)+parseInt(k5);
		
		if (debet == kredit) {
			document.getElementById("notif_balancing").innerHTML = "<span style=\"float: right; font-weight: bold; font-size: 20px; margin-right: 20px; color: blue;\">Balance</span>";
		}
		else {
			document.getElementById("notif_balancing").innerHTML = "<span style=\"float: right; font-weight: bold; font-size: 20px; margin-right: 20px; color: red;\">Tidak Balance</span>";
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
                                        Form Tambah Data Jurnal Entri
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/keuangan/jurnal_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">tgl/Mata Uang/Tipe Dokumen</label>
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
                                            <div class="col-sm-2">
                                            	<label for="textfield" class="control-label">Tipe Dokumen</label>
                                                <select id="tipe_dok" name="tipe_dok" size="1" class="form-control" required="required">
                                                    <option value="">-Tipe Dokumen-</option>
                                                    <option value="Biaya Operasional Klinik">Biaya Operasional Klinik</option>
						    <option value="Patient UnBill">Patient UnBill</option>
                                                    <option value="A/R">A/R</option>
						    <option value="A/P Dokter">A/P Dokter</option>
						    <option value="A/P Purchasing">A/P Purchasing</option>
                                                    <option value="Payment From Patient">Payment From Patient</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Keterangan</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="keterangan" name="keterangan" size="90" class="form-control" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                            	<label for="textfield" class="control-label">Kode Akun</label>
                                                <select id="kode_akun1" name="kode_akun1" size="1" class="form-control">
                                                    <option value="">--Pilih Akun--</option>
                                                    <?php
                                                    $poli = $db->query("select kd_coa, nm_coa from tbl_coa where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        echo '<option value="'.$poli[$i]['kd_coa'].'">'.$poli[$i]['kd_coa'].' - '.$poli[$i]['nm_coa'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                            	<label for="textfield" class="control-label">Cost Center</label>
                                                <select id="cc1" name="cc1" size="1" class="form-control">
                                                    <option value="">--Pilih Cost Center--</option>
                                                    <?php
                                                    $poli = $db->query("select kd_profit, nm_profit, group_type from tbl_profit where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        echo '<option value="'.$poli[$i]['kd_profit'].'">'.$poli[$i]['nm_profit'].' '.$poli[$i]['group_type'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                            	<label for="textfield" class="control-label">Deskripsi</label>
                                                <input type="text" id="deskripsi1" name="deskripsi1" size="90" class="form-control" />
                                            </div>
                                            <div class="col-sm-2">
                                            	<label for="textfield" class="control-label">Debet</label>
                                                <input type="text" id="nilai_debet1" name="nilai_debet1" class="form-control text-right" value="0" onkeyup="cekBalance()" />
                                            </div>
                                            <div class="col-sm-2">
                                            	<label for="textfield" class="control-label">Kredit</label>
                                                <input type="text" id="nilai_kredit1" name="nilai_kredit1" class="form-control text-right" value="0" onkeyup="cekBalance()" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <select id="kode_akun2" name="kode_akun2" size="1" class="form-control">
                                                    <option value="">--Pilih Akun--</option>
                                                    <?php
                                                    $poli = $db->query("select kd_coa, nm_coa from tbl_coa where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        echo '<option value="'.$poli[$i]['kd_coa'].'">'.$poli[$i]['kd_coa'].' - '.$poli[$i]['nm_coa'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <select id="cc2" name="cc2" size="1" class="form-control">
                                                    <option value="">--Pilih Cost Center--</option>
                                                    <?php
                                                    $poli = $db->query("select kd_profit, nm_profit, group_type from tbl_profit where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        echo '<option value="'.$poli[$i]['kd_profit'].'">'.$poli[$i]['nm_profit'].' '.$poli[$i]['group_type'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" id="deskripsi2" name="deskripsi2" size="90" class="form-control" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" id="nilai_debet2" name="nilai_debet2" class="form-control text-right" value="0" onkeyup="cekBalance()" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" id="nilai_kredit2" name="nilai_kredit2" class="form-control text-right" value="0" onkeyup="cekBalance()" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <select id="kode_akun3" name="kode_akun3" size="1" class="form-control">
                                                    <option value="">--Pilih Akun--</option>
                                                    <?php
                                                    $poli = $db->query("select kd_coa, nm_coa from tbl_coa where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        echo '<option value="'.$poli[$i]['kd_coa'].'">'.$poli[$i]['kd_coa'].' - '.$poli[$i]['nm_coa'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <select id="cc3" name="cc3" size="1" class="form-control">
                                                    <option value="">--Pilih Cost Center--</option>
                                                    <?php
                                                    $poli = $db->query("select kd_profit, nm_profit, group_type from tbl_profit where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        echo '<option value="'.$poli[$i]['kd_profit'].'">'.$poli[$i]['nm_profit'].' '.$poli[$i]['group_type'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" id="deskripsi3" name="deskripsi3" size="90" class="form-control" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" id="nilai_debet3" name="nilai_debet3" class="form-control text-right" value="0" onkeyup="cekBalance()" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" id="nilai_kredit3" name="nilai_kredit3" class="form-control text-right" value="0" onkeyup="cekBalance()" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <select id="kode_akun4" name="kode_akun4" size="1" class="form-control">
                                                    <option value="">--Pilih Akun--</option>
                                                    <?php
                                                    $poli = $db->query("select kd_coa, nm_coa from tbl_coa where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        echo '<option value="'.$poli[$i]['kd_coa'].'">'.$poli[$i]['kd_coa'].' - '.$poli[$i]['nm_coa'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <select id="cc4" name="cc4" size="1" class="form-control">
                                                    <option value="">--Pilih Cost Center--</option>
                                                    <?php
                                                    $poli = $db->query("select kd_profit, nm_profit, group_type from tbl_profit where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        echo '<option value="'.$poli[$i]['kd_profit'].'">'.$poli[$i]['nm_profit'].' '.$poli[$i]['group_type'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" id="deskripsi4" name="deskripsi4" size="90" class="form-control" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" id="nilai_debet4" name="nilai_debet4" class="form-control text-right" value="0" onkeyup="cekBalance()" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" id="nilai_kredit4" name="nilai_kredit4" class="form-control text-right" value="0" onkeyup="cekBalance()" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <select id="kode_akun5" name="kode_akun5" size="1" class="form-control">
                                                    <option value="">--Pilih Akun--</option>
                                                    <?php
                                                    $poli = $db->query("select kd_coa, nm_coa from tbl_coa where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        echo '<option value="'.$poli[$i]['kd_coa'].'">'.$poli[$i]['kd_coa'].' - '.$poli[$i]['nm_coa'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <select id="cc5" name="cc5" size="1" class="form-control">
                                                    <option value="">--Pilih Cost Center--</option>
                                                    <?php
                                                    $poli = $db->query("select kd_profit, nm_profit, group_type from tbl_profit where status_delete='UD'");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        echo '<option value="'.$poli[$i]['kd_profit'].'">'.$poli[$i]['nm_profit'].' '.$poli[$i]['group_type'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" id="deskripsi5" name="deskripsi5" size="90" class="form-control" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" id="nilai_debet5" name="nilai_debet5" class="form-control text-right" value="0" onkeyup="cekBalance()" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" id="nilai_kredit5" name="nilai_kredit5" class="form-control text-right" value="0" onkeyup="cekBalance()" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
					    <div id="notif_balancing"></div>
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Jurnal" />
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