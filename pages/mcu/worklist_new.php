<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Layanan Medical CheckUp</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien MCU</a>
            </li>
            <li>
                <a href="javascript:void(0)">Input Hasil MCU</a>
            </li>
        </ul>
    </div>
    <?php
	    $pasien = $db->query("select * from tbl_pasien where md5(nomr)='".$_GET['nomr']."'");
  		$daftarnr = $db->queryItem("select count(id) from tbl_pendaftaran where md5(nomr)='".$_GET['nomr']."'");
	    //print_r($pasien);
    ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="box">
              <div class="box-title">
                <h3 style="padding-right: 50px;">
                  <i class="fa fa-table"></i> Formulir Pengisian Hasil MCU
                </h3>
              </div>
              <div class="box-content nopadding">
	      <form action="pages/mcu/inputHasil_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>I. ANAMNESIA</strong></label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Keluhan</label>
                        <div class="col-sm-10">
                            <textarea name="keluhan" id="keluhan" class="form-control" rows="3" placeholder="Keluhan Pasien" required="required"	></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>Riwayat Penyakit dahulu/Sebelumnya</strong></label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Diabetes Melitus</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="diabet" id="p1a" value="YA" required="required">
                          <label class="form-check-label" for="p1a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="diabet" id="p1b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p1b">TIDAK</label>
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Kecelakaan</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="kecelakaan" id="p5a" value="YA" required="required">
                          <label class="form-check-label" for="p5a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="kecelakaan" id="p5b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p5b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Hipertensi</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="hipertensi" id="p2a" value="YA" required="required">
                          <label class="form-check-label" for="p2a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="hipertensi" id="p2b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p2b">TIDAK</label>
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Dirawat di RS</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="rawat" id="p6a" value="YA" required="required">
                          <label class="form-check-label" for="p6a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="rawat" id="p6b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p6b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Penyakit Jantung</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="jantung" id="p3a" value="YA" required="required">
                          <label class="form-check-label" for="p3a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="jantung" id="p3b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p3b">TIDAK</label>
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Pengobatan</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="pengobatan" id="p7a" value="YA" required="required">
                          <label class="form-check-label" for="p7a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="pengobatan" id="p7b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p7b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Penyakit Paru-Paru</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="paru" id="p4a" value="YA" required="required">
                          <label class="form-check-label" for="p4a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="paru" id="p4b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p4b">TIDAK</label>
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Alergi</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="alergi" id="p8a" value="YA" required="required">
                          <label class="form-check-label" for="p8a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="alergi" id="p8b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p8b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Operasi</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="operasi" id="p9a" value="YA" required="required">
                          <label class="form-check-label" for="p9a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="operasi" id="p9b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p9b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                       <label for="textfield" class="control-label col-sm-3"style="text-align: right;">Pernah Menderita Penyakit</label>
                        <div class="col-sm-8">
                            <input type="text" id="nama" name="nama" placeholder="Pernah Menderita Penyakit" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>Riwayat Penyakit Keluarga - AYAH</strong></label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Diabetes Melitus</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="diabet_ayah" id="p10a" value="YA" required="required">
                          <label class="form-check-label" for="p10a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="diabet_ayah" id="p10b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p10b">TIDAK</label>
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Hipertensi</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="hipertensi_ayah" id="p12a" value="YA" required="required">
                          <label class="form-check-label" for="p12a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="hipertensi_ayah" id="p12b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p12b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Penyakit Jantung</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="jantung_ayah" id="p10a" value="YA" required="required">
                          <label class="form-check-label" for="p10a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="jantung_ayah" id="p10b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p10b">TIDAK</label>
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Penyakit Ginjal</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="ginjal_ayah" id="p12a" value="YA" required="required">
                          <label class="form-check-label" for="p12a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="ginjal_ayah" id="p12b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p12b">TIDAK</label>
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Gangguan Jiwa</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="jiwa_ayah" id="jiwa_ayah" value="YA" required="required">
                          <label class="form-check-label" for="p9a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="jiwa_ayah" id="jiwa_ayah" value="TIDAK" required="required">
                          <label class="form-check-label" for="p9b">TIDAK</label>
                    	</div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Penyakit Paru-paru</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="paru_ayah" id="p9a" value="YA" required="required">
                          <label class="form-check-label" for="p9a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="paru_ayah" id="p9b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p9b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                    </div>
                   <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Keganasan Tumor</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="tumor_ayah" id="tumor_ayah" value="YA" required="required">
                          <label class="form-check-label" for="p9a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="tumor_ayah" id="tumor_ayah" value="TIDAK" required="required">
                          <label class="form-check-label" for="p9b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                       <label for="textfield" class="control-label col-sm-3"style="text-align: right;">Penyakit Lain Pada Keluarga</label>
                        <div class="col-sm-8">
                            <input type="text" id="lain_ayah" name="lain_ayah" placeholder="Pernah Menderita Penyakit" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>Riwayat Penyakit Keluarga - IBU</strong></label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Diabetes Melitus</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="diabet_ibu" id="p10a" value="YA" required="required">
                          <label class="form-check-label" for="p10a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="diabet_ibu" id="p10b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p10b">TIDAK</label>
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Hipertensi</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="hipertensi_ibu" id="p12a" value="YA" required="required">
                          <label class="form-check-label" for="p12a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="hipertensi_ibu" id="p12b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p12b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Penyakit Jantung</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="jantung_ibu" id="p10a" value="YA" required="required">
                          <label class="form-check-label" for="p10a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="jantung_ibu" id="p10b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p10b">TIDAK</label>
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Penyakit Ginjal</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="ginjal_ibu" id="p12a" value="YA" required="required">
                          <label class="form-check-label" for="p12a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="ginjal_ibu" id="p12b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p12b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Penyakit Paru-paru</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="paru_ibu" id="p9a" value="YA" required="required">
                          <label class="form-check-label" for="p9a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="paru_ibu" id="p9b" value="TIDAK" required="required">
                          <label class="form-check-label" for="p9b">TIDAK</label>
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Gangguan Jiwa</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="jiwa_ibu" id="jiwa_ibu" value="YA" required="required">
                          <label class="form-check-label" for="p9a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="jiwa_ibu" id="jiwa_ibu" value="TIDAK" required="required">
                          <label class="form-check-label" for="p9b">TIDAK</label>
                    	</div>
                    </div>
                   <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Keganasan Tumor</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="tumor_ibu" id="tumor_ibu" value="YA" required="required">
                          <label class="form-check-label" for="p9a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="tumor_ibu" id="tumor_ibu" value="TIDAK" required="required">
                          <label class="form-check-label" for="p9b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                       <label for="textfield" class="control-label col-sm-3"style="text-align: right;">Penyakit Lain Pada Keluarga</label>
                        <div class="col-sm-8">
                            <input type="text" id="lain_ibu" name="lain_ibu" placeholder="Pernah Menderita Penyakit" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>Riwayat Penyakit Keluarga - Lainnya</strong></label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Diabetes Melitus</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="diabet_lain" id="diabet_lain" value="YA" required="required">
                          <label class="form-check-label" for="p10a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="diabet_lain" id="diabet_lain" value="TIDAK" required="required">
                          <label class="form-check-label" for="p10b">TIDAK</label>
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Hipertensi</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="hipertensi_lain" id="hipertensi_lain" value="YA" required="required">
                          <label class="form-check-label" for="p12a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="hipertensi_lain" id="hipertensi_lain" value="TIDAK" required="required">
                          <label class="form-check-label" for="p12b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Penyakit Jantung</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="jantung_lain" id="jantung_lain" value="YA" required="required">
                          <label class="form-check-label" for="p10a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="jantung_lain" id="jantung_lain" value="TIDAK" required="required">
                          <label class="form-check-label" for="p10b">TIDAK</label>
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Penyakit Ginjal</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="ginjal_lain" id="ginjal_lain" value="YA" required="required">
                          <label class="form-check-label" for="p12a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="ginjal_lain" id="ginjal_lain" value="TIDAK" required="required">
                          <label class="form-check-label" for="p12b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Penyakit Paru-paru</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="paru_lain" id="paru_lain" value="YA" required="required">
                          <label class="form-check-label" for="p9a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="paru_lain" id="paru_lain" value="TIDAK" required="required">
                          <label class="form-check-label" for="p9b">TIDAK</label>
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Gangguan Jiwa</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="jiwa_lain" id="jiwa_lain" value="YA" required="required">
                          <label class="form-check-label" for="p9a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="jiwa_lain" id="jiwa_lain" value="TIDAK" required="required">
                          <label class="form-check-label" for="p9b">TIDAK</label>
                    	</div>
                    </div>
                   <div class="form-group">
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Keganasan Tumor</label>
                        <div class="col-sm-3">
                          <input class="form-check-input" type="radio" name="tumor_lain" id="tumor_lain" value="YA" required="required">
                          <label class="form-check-label" for="p9a">YA</label> &nbsp;
                          <input class="form-check-input" type="radio" name="tumor_lain" id="tumor_lain" value="TIDAK" required="required">
                          <label class="form-check-label" for="p9b">TIDAK</label>
                        </div>
                    </div>
                    <div class="form-group">
                       <label for="textfield" class="control-label col-sm-3"style="text-align: right;">Penyakit Lain Pada Keluarga</label>
                        <div class="col-sm-8">
                            <input type="text" id="lain_lain" name="lain_lain" placeholder="Pernah Menderita Penyakit" class="form-control" required="required" />
                        </div>
                    </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>II. KEBIASAAN</strong></label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Makan</label>
                        <div class="col-sm-10">
                            <textarea name="makan" id="makan" class="form-control" rows="3" placeholder="Makan" required="required"	></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Merokok</label>
                        <div class="col-sm-10">
                            <textarea name="merokok" id="merokok" class="form-control" rows="3" placeholder="Merokok" required="required"	></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Alkohol</label>
                        <div class="col-sm-10">
                            <textarea name="alkohol" id="alkohol" class="form-control" rows="3" placeholder="Alkohol" required="required"	></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Kopi</label>
                        <div class="col-sm-10">
                            <textarea name="kopi" id="kopi" class="form-control" rows="3" placeholder="Kopi" required="required"	></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Olahraga</label>
                        <div class="col-sm-10">
                            <textarea name="olahraga" id="olahraga" class="form-control" rows="3" placeholder="Olah Raga" required="required"	></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Pola Devikasi</label>
                        <div class="col-sm-10">
                            <textarea name="devikasi" id="devikasi" class="form-control" rows="3" placeholder="Pola Devikasi" required="required"	></textarea>
                        </div>
                    </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>III. PEMERIKSAAN FISIK</strong></label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>Keadaan Umum</label>
                    </div>
		</div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Tekanan Darah</label>
                        <div class="col-sm-8">
                            <input type="text" id="tekan_darah" name="tekan_darah" placeholder="Tekanan Darah" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">MmHg</label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Denyut Nadi</label>
                        <div class="col-sm-8">
                            <input type="text" id="nadi" name="nadi" placeholder="Denyut Nadi" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">X/Menit</label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Berat Badan</label>
                        <div class="col-sm-8">
                            <input type="text" id="berat" name="berat" placeholder="Berat Badan" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Kg</label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Lingkar Perut</label>
                        <div class="col-sm-8">
                            <input type="text" id="l_perut" name="l_perut" placeholder="Lingkar Perut" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Cm</label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">BMI</label>
                        <div class="col-sm-8">
                            <input type="text" id="bmi" name="bmi" placeholder="BMI" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Kg/M2</label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Respirasi</label>
                        <div class="col-sm-8">
                            <input type="text" id="respirasi" name="respirasi" placeholder="Respirasi" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">X/Menit</label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Suhu</label>
                        <div class="col-sm-8">
                            <input type="text" id="suhu" name="suhu" placeholder="Suhu" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">&deg;C</label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>Pemeriksaan Telinga, Hidung dan Tenggorokan</label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Telinga</label>
                        <div class="col-sm-8">
                            <input type="text" id="telinga" name="telinga" placeholder="Telinga" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Auricula Extema </label>
                        <div class="col-sm-7">
                            <input type="text" id="auricula" name="auricula" placeholder="Auricula Extema " class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">MT</label>
                        <div class="col-sm-7">
                            <input type="text" id="mt" name="mt" placeholder="MT" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Sekret</label>
                        <div class="col-sm-7">
                            <input type="text" id="sekret" name="sekret" placeholder="Sekret" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Hidung</label>
                        <div class="col-sm-8">
                            <input type="text" id="hidung" name="hidung" placeholder="Hidung" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Bentuk</label>
                        <div class="col-sm-7">
                            <input type="text" id="bentuk" name="bentuk" placeholder="Bentuk" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Deviasi</label>
                        <div class="col-sm-7">
                            <input type="text" id="deviasi" name="deviasi" placeholder="Deviasi" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Sekret</label>
                        <div class="col-sm-7">
                            <input type="text" id="sekret_hidung" name="sekret_hidung" placeholder="Sekret" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Tenggorokan</label>
                        <div class="col-sm-8">
                            <input type="text" id="tenggorokan" name="tenggorokan" placeholder="Tenggorokan" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Faring Hiperemis</label>
                        <div class="col-sm-7">
                            <input type="text" id="faring" name="faring" placeholder="Faring Hiperemis" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Faring Granula</label>
                        <div class="col-sm-7">
                            <input type="text" id="granula" name="granula" placeholder="Faring Granula" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Tonsil</label>
                        <div class="col-sm-7">
                            <input type="text" id="tonsil" name="tonsil" placeholder="Tonsil" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>Kepala</label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Benjolan</label>
                        <div class="col-sm-8">
                            <input type="text" id="benjolan" name="benjolan" placeholder="Benjolan" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Bentuk</label>
                        <div class="col-sm-8">
                            <input type="text" id="bentuk" name="bentuk" placeholder="Bentuk" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Warna Rambut</label>
                        <div class="col-sm-8">
                            <input type="text" id="warna_rambut" name="warna_rambut" placeholder="Warna Rambut" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Kulit Kepala</label>
                        <div class="col-sm-8">
                            <input type="text" id="kulit_kepala" name="kulit_kepala" placeholder="Kulit Kepala" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>Pemeriksaan Mata</label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Visus</label>
                        <div class="col-sm-8">
                            <input type="text" id="visus" name="visus" placeholder="Visus" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Seklera</label>
                        <div class="col-sm-8">
                            <input type="text" id="seklera" name="seklera" placeholder="Seklera" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Konjungtiva</label>
                        <div class="col-sm-8">
                            <input type="text" id="konjungtiva" name="konjungtiva" placeholder="Konjungtiva" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Buta Warna</label>
                        <div class="col-sm-8">
                            <input type="text" id="buta_warna" name="buta_warna" placeholder="Buta Warna" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Tonometri</label>
                        <div class="col-sm-8">
                            <input type="text" id="tonometri" name="tonometri" placeholder="Tonometri" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Lapang Pandang</label>
                        <div class="col-sm-8">
                            <input type="text" id="lapang" name="lapang" placeholder="Lapang Pandang" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>Pemeriksaan Rongga Dada</label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Pergerakan Dinding Dada</label>
                        <div class="col-sm-8">
                            <input type="text" id="dinding_dada" name="dinding_dada" placeholder="Pergerakan Dinding Dada" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Vokal Fremitus Kanan dan Kiri</label>
                        <div class="col-sm-8">
                            <input type="text" id="fremitus" name="fremitus" placeholder="Vokal Fremitus Kanan dan Kiri" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Jantung</label>
                        <div class="col-sm-8">
                            <input type="text" id="jantung_2" name="jantung_2" placeholder="Jantung" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Bunyi Jantung I/II</label>
                        <div class="col-sm-7">
                            <input type="text" id="bunyi_jantung" name="bunyi_jantung" placeholder="Bunyi Jantung I/II" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Murmur</label>
                        <div class="col-sm-7">
                            <input type="text" id="murmur" name="murmur" placeholder="Murmur" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Gallop</label>
                        <div class="col-sm-7">
                            <input type="text" id="gallop" name="gallop" placeholder="Gallop" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Paru-paru</label>
                        <div class="col-sm-8">
                            <input type="text" id="paru2" name="paru2" placeholder="Paru-paru" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Sonor</label>
                        <div class="col-sm-7">
                            <input type="text" id="sonor" name="sonor" placeholder="Sonor" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Vesikuler</label>
                        <div class="col-sm-7">
                            <input type="text" id="vesikuler" name="vesikuler" placeholder="Vesikuler" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Ronchi</label>
                        <div class="col-sm-7">
                            <input type="text" id="ronchi" name="ronchi" placeholder="Ronchi" class="form-control" required="required" />
                        </div>
                        <label for="textfield" class="control-label col-sm-3" style="text-align: right;"> Wheezing </label>
                        <div class="col-sm-7">
                            <input type="text" id="wheezing" name="wheezing" placeholder=" Wheezing " class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>Pemeriksaan Rongga Perut</label>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Abdomen</label>
                        <div class="col-sm-8">
                            <input type="text" id="Abdomen" name="Abdomen" placeholder="Abdomen" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Lingkar Perut</label>
                        <div class="col-sm-8">
                            <input type="text" id="perut" name="perut" placeholder="Lingkar Perut" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Hepar/Lien</label>
                        <div class="col-sm-8">
                            <input type="text" id="hepar" name="hepar" placeholder="Hepar/Lien" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Ginjal</label>
                        <div class="col-sm-8">
                            <input type="text" id="ginjal" name="ginjal" placeholder="Ginjal" class="form-control" required="required" />
                        </div>
                    </div>
		</div>
	<div class="form-group">

	</div>
                <div class="form-actions">
                        <input type="hidden" name="nomr" value="<?php echo $_GET['nomr']?>" />
                        <input type="hidden" name="no_daftar" value="<?php echo $_GET['no_daftar']?>" />
                        <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Hasil MCU" />
                        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-success rounded" value="List/Daftar Pasien MCU" onclick="simpanData(this.form, 'index.php?mod=mcu&submod=list')" />
                    </div>
                </div>
            </div>
        </form>
              </div>                
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box">
              <div class="box-title">
                <h3>
                  <i class="fa fa-user"></i>
                  Profile Pasien Layanan Medical CheckUp
                </h3>
              </div>
              <div class="box-content">
                <blockquote>
                  <p>
                    <?php echo $pasien[0]['nomr'].' - '.$pasien[0]['nm_pasien']?>
                  </p>
                  <small>Jenis Kelamin : <?php echo $pasien[0]['jk']?></small>
                  <small>Alamat / Asal : <?php echo $pasien[0]['alamat_pasien']?></small>
                  <small>Tempat, Tanggal Lahir : <?php echo $pasien[0]['tmpt_lahir'].', '.date("d F Y", strtotime($pasien[0]['tgl_lahir']))?></small>
                  <small>Berobat ditempat ini sebanyak : <?php echo $daftarnr?> Kali</small>
                  <small>No. Telp: <?php echo $pasien[0]['telp_pasien']?></small>
                </blockquote>
              </div>
            </div>
        </div>
        </div>
    </div>
</div>

    <script>
        $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
    </script>