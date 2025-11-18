<?php
	$data = $db->query("select * from tbl_kasir where id='".$_GET['id']."'", 0);
?>
<script language="javascript">
	function CariPasien(id) {
		var url = "pages/kasir/detail_bayar.php";
		var data = {id:id};
		
		if (id == "") {
			document.getElementById('data_pasien').innerHTML = '';
		}
		else {
			document.getElementById('data_pasien').innerHTML = 'Tunggu sebentar ....';
			$('#data_pasien').load(url,data, function(){
				$('#data_pasien').fadeIn('fast');
			});
		}
	}
	
	function inputTotalBayar(total, total_text) {
		document.getElementById('total_bayar').value = total;
		document.getElementById('total_bayar_text').value = total_text;
	}
	
	function TotalAllBayar() {
		var url = "pages/kasir/totalAll_bayar.php";
		var metode = document.getElementById('metode').value;
		var diskon = document.getElementById('diskon').value
		var subtotal = document.getElementById('total_bayar').value;
		var pembulatan = document.getElementById('pembulatan').value;
		var data = {metode:metode, subtotal:subtotal, diskon:diskon, pembulatan: pembulatan};

		if (metode == "") {
			document.getElementById('totalAll').innerHTML = '';
		}
		else {
			document.getElementById('totalAll').innerHTML = 'Tunggu sebentar ....';
			$('#totalAll').load(url,data, function(){
				$('#totalAll').fadeIn('fast');
			});
		}
	}

	function simpanDataKasir(t, url) {
		var nofr = document.getElementById('nofr').value;
		var nodaftar = document.getElementById('nodaftar').value;
		var metode = document.getElementById('metode').value;
		
		if (nofr == "" || nodaftar == "" || metode == "") {
			alert("Silahkan Lengkapi isian yang sudah disediakan");
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
                <a href="javascript:void(0)">Poli</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Poli Umum</a>
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
                            <div class="box box-color box-bordered box-small lightgrey">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Kwitansi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_kwitansi" name="no_kwitansi" class="form-control" value="<?php echo $data[0]['no_kwitansi']?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">NO. FR</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nofr" name="nofr" value="<?php echo $data[0]['nofr']?>" class="form-control" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Pendaftaran</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nodaftar" name="nodaftar" value="<?php echo $data[0]['no_daftar']?>" class="form-control" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Total Bayar</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="total_bayar_text" name="total_bayar_text" value="<?php echo number_format($data[0]['total'])?>" class="form-control text-right" readonly=""/>
                                                        <input type="hidden" id="total_bayar" name="total_bayar" value="<?php echo $data[0]['total']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Penjamin</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="penjamin" name="penjamin" value="<?php echo $data[0]['penjamin']?>" class="form-control" readonly="readonly" />
                                                        <input type="hidden" id="pembulatan" name="pembulatan" class="form-control" style="width: 120px; text-align: right; font-weight: bold" value="0" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Potongan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="diskon" name="diskon" class="form-control text-right" value="0" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Metode Bayar</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="metode" name="metode" value="<?php echo $data[0]['metode_payment']?>" class="form-control" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tgl Transaksi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y", strtotime($data[0]['tgl_insert']))?>" class="form-control" />
                                                        <input type="hidden" id="idNya" name="idNya" value="<?php echo $data[0]['id']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Pembayaran" onclick="simpanData(this.form, 'pages/kasir/input_kasir_tgl.php')" />
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div id="data_pasien">
                                                        <?php
                                                        //$tst = explode("JAMSOSTEK", $_POST['id']);
                                                        if ($data[0]['nama_perusahaan'] == 'JAMSOSTEK') {
                                                            $data1 = $db->query("select a.nomr, b.nm_pasien, a.kode_dokter, a.nama_perusahaan, 0 biayaAdmin, c.nama_poli, c.tarif as biayaPoli from tbl_pendaftaran_jamsostek a left join tbl_pasien_jamsostek b on b.id=a.idNomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
                                                            //$lab = $db->queryItem("select sum(tarif) as jml1 from tbl_lab_detail a  left join tbl_lab b on b.id=a.labId where b.no_daftar='".$_POST['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);

                                                            //$rad = $db->queryItem("select sum(tarif) as jml1 from tbl_rad_detail a  left join tbl_rad b on b.id=a.radId where b.no_daftar='".$_POST['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                            $embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
                                                            $total = $biayaAdmin + $farmasi1[0]['jml1'] + $farmasi2[0]['jml1'] + $embalase + $lab + $rad;
                                                            $namaDokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
                                                            $biayaDokter = $db->queryItem("select tarif_jamsostek from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
                                                            //$biayaDokter = $biayaDokter + $data1[0]['biayaPoli'];
                                                            $biayaAdmin = $biayaDokter + $data1[0]['biayaAdmin'];
                                                        }
                                                        else {
                                                            $data1 = $db->query("select a.nomr, b.nm_pasien, a.kode_dokter, a.nama_perusahaan, a.biayaAdmin biayaAdmin, c.nama_poli, c.tarif as biayaPoli from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD'", 0);
                                                            $lab = $db->queryItem("select sum(tarif) as jml1 from tbl_lab_detail a  left join tbl_lab b on b.id=a.labId where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                            $gigi = $db->queryItem("select sum(tarif) as jml1 from tbl_gigi_detail a  left join tbl_gigi b on b.id=a.gigiId where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                            $obygn = $db->queryItem("select sum(tarif) as jml1 from tbl_obygn_detail a  left join tbl_obygn b on b.id=a.obygnID where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                            $bedah = $db->queryItem("select sum(tarif) as jml1 from tbl_bedah_detail a  left join tbl_bedah b on b.id=a.bedahID where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);

                                                            $rad = $db->queryItem("select sum(tarif) as jml1 from tbl_rad_detail a  left join tbl_rad b on b.id=a.radId where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                            $embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
                                                            $total = $biayaAdmin + $farmasi1[0]['jml1'] + $farmasi2[0]['jml1'] + $embalase + $lab + $rad;
                                                            $namaDokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
                                                            //Cek untuk meliat Poi Bedah maka Biaya poli dan Biaya Dokter Nol
                                                            if ($data1[0]['nama_poli'] == 'POLI BEDAH') {
                                                                $biayaDokter = 0;
                                                            }
                                                            else {
                                                                $biayaDokter = $db->queryItem("select tarif_dokter from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
                                                                $biayaDokter = $biayaDokter + $data1[0]['biayaPoli'];
                                                            }
                                                            $biayaAdmin = $biayaDokter + $data1[0]['biayaAdmin'];
                                                        }
                                                        ?>
                                                        <div align="left">
                                                            <p style="margin-left: 12px; margin-top: 15px; margin-bottom: 5px;">
                                                                NoMR : <?php echo $data1[0]['nomr']?><br />
                                                                Nama Pasien : <?php echo $data1[0]['nm_pasien']?><br />
                                                                Penjamin Pasien : <?php echo $data1[0]['nama_perusahaan']?>
                                                            </p>

                                                            <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                                <tr height="28">
                                                                    <td valign="middle" colspan="2">
                                                                        <div>
                                                                            <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th colspan="2" style="text-align: left">
                                                                                        Administrasi
                                                                                    </th>
                                                                                    <th style="width: 75px">
                                                                                        Biaya
                                                                                    </th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td style="width: 15px; text-align: right">-</td>
                                                                                    <td style="text-align: left">
                                                                                        Biaya Administrasi
                                                                                        <input type="hidden" id="admin[0][nama]" name="admin[0][nama]" value="Biaya Administrasi"  />
                                                                                    </td>
                                                                                    <td style="text-align: right">
                                                                                        <input type="hidden" id="admin[0][nilai]" name="admin[0][nilai]" value="<?php echo $data1[0]['biayaAdmin']?>"  />
                                                                                        <?php echo number_format($data1[0]['biayaAdmin'])?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="width: 15px; text-align: right">-</td>
                                                                                    <td style="text-align: left">
                                                                                        <input type="hidden" id="admin[1][nama]" name="admin[1][nama]" value="<?php echo $data1[0]['nama_poli'].' - '.$namaDokter?>"  />
                                                                                        <?php echo $data1[0]['nama_poli'].' - '.$namaDokter?>
                                                                                    </td>
                                                                                    <td style="text-align: right; width: 75px;">
                                                                                        <input type="hidden" id="admin[1][nilai]" name="admin[1][nilai]" value="<?php echo $biayaDokter?>"  />
                                                                                        <?php echo number_format($biayaDokter)?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Administrasi</th>
                                                                                    <th style="text-align: right; font-weight: bold"><?php echo number_format($biayaAdmin)?></th>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <?php
                                                                            if ($tst[0] == 1) {
                                                                                ?>
                                                                                <table id="sort-table" style="margin-bottom: 2px; margin-top: 7px;" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: left">Pharmacy</th>
                                                                                        <th style="width: 75px">
                                                                                            Biaya
                                                                                        </th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <?php
                                                                                    if ($tst[0] == 1) {
                                                                                        $farm = $db->query("select a.no_resep, a.nama_obat, a.total from tbl_resepjams_detail a  left join tbl_resepjams b on b.no_resep=a.no_resep where b.no_daftar='".$tst[1]."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                                                    }
                                                                                    else {
                                                                                        $farm = $db->query("select a.no_resep, a.nama_obat, a.total from tbl_resep_detail a  left join tbl_resep b on b.no_resep=a.no_resep where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                                                    }
                                                                                    for ($i = 0; $i < count($farm); $i++) {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td style="width: 15px; text-align: right">-</td>
                                                                                            <td style="text-align: left"><?php echo $farm[$i]['nama_obat']?></td>
                                                                                            <td style="text-align: right; width: 75px;"><?php echo number_format($farm[$i]['total'])?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                        $totFarm = $totFarm + $farm[$i]['total'];
                                                                                    }
                                                                                    $farm2 = $db->query("select b.nama, sum(total) as jml1 from tbl_racikan_detail a  left join tbl_racikan b on b.id=a.racikanId where b.no_resep='".$farm[0]['no_resep']."' and a.status_delete='UD' and b.status_delete='UD' group by racikanId", 0);

                                                                                    if (count($farm2) > 0 and $farm2[0]['nama'] != NULL) {
                                                                                        //$o = $i + 1;
                                                                                        $embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
                                                                                        $nilai_racikan = $farm2[0]['jml1'] + $embalase;
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td style="width: 15px; text-align: right">-</td>
                                                                                            <td style="text-align: left"><?php echo $farm2[0][nama]?></td>
                                                                                            <td style="text-align: right; width: 75px;"><?php echo number_format($nilai_racikan)?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                        $totFarm = $totFarm + $farm2[0]['jml1'] + $embalase;
                                                                                    }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Pharmacy</th>
                                                                                        <th style="text-align: right; font-weight: bold"><?php echo number_format($totFarm)?></th>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <?php
                                                                            }
                                                                            else {
                                                                                $farmnr = $db->queryItem("select sum(a.total) from tbl_resep_detail a  left join tbl_resep b on b.no_resep=a.no_resep where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                                                $farmnr2 = $db->queryItem("select sum(total) as jml1 from tbl_racikan_detail a  left join tbl_racikan b on b.id=a.racikanId where b.no_resep='".$farm[0]['no_resep']."' and a.status_delete='UD' and b.status_delete='UD' group by racikanId", 0);
                                                                                $farmnr = $farmnr + $farmnr2;
                                                                                if ($farmnr > 0) {
                                                                                    ?>
                                                                                    <table id="sort-table" style="margin-bottom: 2px; margin-top: 7px;" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th colspan="2" style="text-align: left">Pharmacy</th>
                                                                                            <th style="width: 75px">
                                                                                                Biaya
                                                                                            </th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        <?php
                                                                                        if ($tst[0] == 1) {
                                                                                            $farm = $db->query("select a.no_resep, a.nama_obat, a.total from tbl_resepjams_detail a  left join tbl_resepjams b on b.no_resep=a.no_resep where b.no_daftar='".$tst[1]."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                                                        }
                                                                                        else {
                                                                                            $farm = $db->query("select a.no_resep, a.nama_obat, a.total from tbl_resep_detail a  left join tbl_resep b on b.no_resep=a.no_resep where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                                                        }
                                                                                        for ($i = 0; $i < count($farm); $i++) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td style="width: 15px; text-align: right">-</td>
                                                                                                <td style="text-align: left"><?php echo $farm[$i]['nama_obat']?></td>
                                                                                                <td style="text-align: right; width: 75px;"><?php echo number_format($farm[$i]['total'])?></td>
                                                                                            </tr>
                                                                                            <?php
                                                                                            $totFarm = $totFarm + $farm[$i]['total'];
                                                                                        }
                                                                                        $farm2 = $db->query("select b.nama, sum(total) as jml1 from tbl_racikan_detail a  left join tbl_racikan b on b.id=a.racikanId where b.no_resep='".$farm[0]['no_resep']."' and a.status_delete='UD' and b.status_delete='UD' group by racikanId", 0);

                                                                                        if (count($farm2) > 0 and $farm2[0]['nama'] != NULL) {
                                                                                            //$o = $i + 1;
                                                                                            $embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");

                                                                                            for ($i = 0; $i < count($farm2); $i++) {
                                                                                                $nilai_racikan = $farm2[$i]['jml1'] + $embalase;
                                                                                                ?>
                                                                                                <tr>
                                                                                                    <td style="width: 15px; text-align: right">-</td>
                                                                                                    <td style="text-align: left"><?php echo $farm2[$i]['nama']?></td>
                                                                                                    <td style="text-align: right; width: 75px;"><?php echo number_format($nilai_racikan)?></td>
                                                                                                </tr>
                                                                                                <?php
                                                                                                //echo "$totFarm = $totFarm + ".$farm2[0]['jml1']." + $embalase;<br>";
                                                                                                $totFarm = $totFarm + $farm2[$i]['jml1'] + $embalase;
                                                                                            }
                                                                                        }
                                                                                        //echo $totFarm;
                                                                                        ?>
                                                                                        <tr>
                                                                                            <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Pharmacy</th>
                                                                                            <th style="text-align: right; font-weight: bold"><?php echo number_format($totFarm)?></th>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <?php
                                                                                }
                                                                            }

                                                                            $dAlkes = $db->query("select * from tbl_alkes where no_daftar='".$data[0]['no_daftar']."' and nomr= '".$data1[0]['nomr']."' and status_delete='UD'", 0);
                                                                            if ($dAlkes > 0) {
                                                                                ?>
                                                                                <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: left">Alkes</th>
                                                                                        <th style="width: 75px;">Biaya</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <?php
                                                                                    for ($i = 0; $i < count($dAlkes); $i++) {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td style="width: 15px; text-align: right">-</td>
                                                                                            <td style="text-align: left"><?php echo $dAlkes[$i]['nama_alkes']?></td>
                                                                                            <td style="text-align: right; width: 75px;"><?php echo number_format($dAlkes[$i]['tarif'])?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                        $totAlkes = $totAlkes + $dAlkes[$i]['tarif'];
                                                                                    }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Alkes</th>
                                                                                        <th style="text-align: right; font-weight: bold"><?php echo number_format($totAlkes)?></th>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <?php
                                                                            }

                                                                            $dTindakan = $db->query("select * from tbl_tindakan where no_daftar='".$data[0]['no_daftar']."' and nomr= '".$data1[0]['nomr']."' and status_delete='UD'", 0);
                                                                            if ($dTindakan > 0) {
                                                                                ?>
                                                                                <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: left">Tindakan Medis</th>
                                                                                        <th style="width: 75px;">Biaya</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <?php
                                                                                    for ($i = 0; $i < count($dTindakan); $i++) {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td style="width: 15px; text-align: right">-</td>
                                                                                            <td style="text-align: left"><?php echo $dTindakan[$i]['nama_tindakan']?></td>
                                                                                            <td style="text-align: right; width: 75px;"><?php echo number_format($dTindakan[$i]['tarif'])?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                        $totTdk = $totTdk + $dTindakan[$i]['tarif'];
                                                                                    }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Tindakan Medis</th>
                                                                                        <th style="text-align: right; font-weight: bold"><?php echo number_format($totTdk)?></th>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <?php
                                                                            }
                                                                            if ($lab > 0) {
                                                                                ?>
                                                                                <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: left">Laboratorium</th>
                                                                                        <th style="width: 75px;">Biaya</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <?php
                                                                                    $lab = $db->query("select nama_tindakan, tarif from tbl_lab_detail a  left join tbl_lab b on b.id=a.labId where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                                                    for ($i = 0; $i < count($lab); $i++) {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td style="width: 15px; text-align: right">-</td>
                                                                                            <td style="text-align: left"><?php echo $lab[$i]['nama_tindakan']?></td>
                                                                                            <td style="text-align: right; width: 75px;"><?php echo number_format($lab[$i]['tarif'])?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                        $totLab = $totLab + $lab[$i]['tarif'];
                                                                                    }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Laboratorium</th>
                                                                                        <th style="text-align: right; font-weight: bold"><?php echo number_format($totLab)?></th>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <?php
                                                                            }
                                                                            if  ($gigi > 0) {
                                                                                ?>
                                                                                <!--Input Data tindakan Poli Gigi	-->
                                                                                <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: left">Poli Gigi</th>
                                                                                        <th style="width: 75px;">&nbsp;</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <?php
                                                                                    $gigi = $db->query("select nama_tindakan, tarif from tbl_gigi_detail a  left join tbl_gigi b on b.id=a.gigiId where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                                                    for ($i = 0; $i < count($gigi); $i++) {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td style="width: 15px; text-align: right">-</td>
                                                                                            <td style="text-align: left"><?php echo $gigi[$i]['nama_tindakan']?></td>
                                                                                            <td style="text-align: right; width: 75px;"><?php echo number_format($gigi[$i]['tarif'])?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                        $totgigi = $totgigi + $gigi[$i]['tarif'];
                                                                                    }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Poli Gigi</th>
                                                                                        <th style="text-align: right; font-weight: bold"><?php echo number_format($totgigi)?></th>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <?php
                                                                            }
                                                                            if ($obygn > 0) {
                                                                                ?>
                                                                                <!--Input Data tindakan Poli Obygn	-->
                                                                                <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th colspan="3" style="text-align: left">Poli Obgyn/Kandungan</th>
                                                                                        <th style="width: 75px;">&nbsp;</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <?php
                                                                                    $obygn = $db->query("select nama_tindakan, tarif from tbl_obygn_detail a left join tbl_obygn b on b.id=a.obygnID where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                                                    for ($i = 0; $i < count($obygn); $i++) {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td style="width: 15px; text-align: right">-</td>
                                                                                            <td style="text-align: left"><?php echo $obygn[$i]['nama_tindakan']?></td>
                                                                                            <td style="text-align: right; width: 75px;"><?php echo number_format($obygn[$i]['tarif'])?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                        $totobygn = $totobygn + $obygn[$i]['tarif'];
                                                                                    }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Poli Obygn/Kandungan</th>
                                                                                        <th style="text-align: right; font-weight: bold"><?php echo number_format($totobygn)?></th>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <?php
                                                                            }
                                                                            if ($bedah > 0) {
                                                                                ?>
                                                                                <!--Input Data tindakan Poli Bedah	-->
                                                                                <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: left">Poli Bedah</th>
                                                                                        <th style="width: 75px;">&nbsp;</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <?php
                                                                                    $bedah = $db->query("select nama_tindakan, tarif from tbl_bedah_detail a left join tbl_bedah b on b.id=a.bedahID where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                                                    for ($i = 0; $i < count($bedah); $i++) {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td style="width: 15px; text-align: right">-</td>
                                                                                            <td style="text-align: left"><?php echo $bedah[$i]['nama_tindakan']?></td>
                                                                                            <td style="text-align: right; width: 75px;"><?php echo number_format($bedah[$i]['tarif'])?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                        $totbedah = $totbedah + $bedah[$i]['tarif'];
                                                                                    }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Poli Bedah</th>
                                                                                        <th style="text-align: right; font-weight: bold"><?php echo number_format($totbedah)?></th>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <?php
                                                                            }
                                                                            if ($rad > 0) {
                                                                                ?>
                                                                                <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: left">Radiologi</th>
                                                                                        <th style="width: 75px;">Biaya</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <?php
                                                                                    $lab = $db->query("select nama_tindakan, tarif from tbl_rad_detail a  left join tbl_rad b on b.id=a.radId where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                                                    for ($i = 0; $i < count($lab); $i++) {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td style="width: 15px; text-align: right">-</td>
                                                                                            <td style="text-align: left"><?php echo $lab[$i]['nama_tindakan']?></td>
                                                                                            <td style="text-align: right; width: 75px;"><?php echo number_format($lab[$i]['tarif'])?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                        $totRad = $totRad + $lab[$i]['tarif'];
                                                                                    }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Radiologi</th>
                                                                                        <th style="text-align: right; font-weight: bold"><?php echo number_format($totRad)?></th>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <?php
                                                                            }
                                                                            $fisT = $db->queryItem("select sum(tarif) as jml1 from tbl_fisio_detail a  left join tbl_fisio b on b.id=a.fisioId where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                                            if ($fisT > 0) {
                                                                                ?>
                                                                                <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: left">Fisioterapi</th>
                                                                                        <th style="width: 75px;">Biaya</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <?php
                                                                                    $lab = $db->query("select nama_tindakan, tarif from tbl_fisio_detail a  left join tbl_fisio b on b.id=a.fisioId where b.no_daftar='".$data[0]['no_daftar']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
                                                                                    for ($i = 0; $i < count($lab); $i++) {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td style="width: 15px; text-align: right">-</td>
                                                                                            <td style="text-align: left"><?php echo $lab[$i]['nama_tindakan']?></td>
                                                                                            <td style="text-align: right; width: 75px;"><?php echo number_format($lab[$i]['tarif'])?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                        $totFis = $totFis + $lab[$i]['tarif'];
                                                                                    }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Fisioterapi</th>
                                                                                        <th style="text-align: right; font-weight: bold"><?php echo number_format($totFis)?></th>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <?php
                                                                            }
                                                                            $total = $biayaAdmin + $totFarm + $totLab + $totRad + $totTdk + $totFis + $totgigi + $totAlkes + $totobygn + $totbedah;
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>

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