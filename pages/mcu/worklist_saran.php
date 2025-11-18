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
                <a href="javascript:void(0)">Input Kesimpulan & Saran Hasil MCU</a>
            </li>
        </ul>
    </div>
    <?php
	    $pasien = $db->query("select * from tbl_pasien where nomr='".$_GET['id']."'");
  		$daftarnr = $db->queryItem("select count(id) from tbl_pendaftaran where nomr='".$_GET['id']."'");
	    //print_r($pasien);
    ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="box">
              <div class="box-title">
                <h3 style="padding-right: 50px;">
                  <i class="fa fa-table"></i> Form Pengisian Kesimpulan & Saran Hasil MCU
                </h3>
              </div>
              <div class="box-content nopadding">
	      <form action="pages/mcu/inputHasil_saran.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-12"><strong>Kesimpulan & Saran Hasil MCU</strong></label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label style="text-align: left;">Kesimpulan Hasil MCU</label>
                            <textarea name="kesimpulan" id="kesimpulan" class="form-control" rows="3" placeholder="Kesimpulan Hasil MCU" required="required"	></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label style="text-align: left;">Saran Hasil MCU</label>
                            <textarea name="saran" id="saran" class="form-control" rows="3" placeholder="Saran dari Hasil MCU" required="required"></textarea>
                        </div>
                    </div>
                <div class="col-sm-12">
		</div>
	<div class="form-group">

	</div>
                <div class="form-actions">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
                        <input type="hidden" name="ids" value="<?php echo $_GET['ids']?>" />
                        <input type="hidden" name="key" value="<?php echo $_GET['key']?>" />
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