<?php
	$mcumodul = $db->query("select * from tbl_modul_mcu where md5(id)='".$_GET['id']."'");
	if ($mcumodul[0]['butuhdokter'] == "YA") $butuhdokterya = "checked";
	else $butuhdokterya = "";

	if ($mcumodul[0]['butuhdokter'] == "TIDAK") $butuhdoktertidak = "checked";
	else $butuhdoktertidak = "";
//print_r($mcumodul);
?>
<div class="box box-color box-bordered box-small blue">
    <div class="box-title">
        <h3>
            <i class="fa fa-edit"></i>
            Form Edit Modul Medical Check Up (MCU)
    </div>
    <div class="box-content nopadding">
        <form action="pages/mcu/module_update.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Nama Modul</label>
                        <div class="col-sm-10">
                            <input type="text" id="nama" name="nama" placeholder="nama Modul MCU" class="form-control" required="required" value="<?php echo $mcumodul[0]['nama']?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Kategori Komponen</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="kategori_komponen" name="kategori_komponen" required="required">
                                <option value="">--Pilih Kategori Komponen--</option>
                                <?php
									if ($mcumodul[0]['kategori'] == 'Biaya Pemakaian Peralatan') {
										echo '<option value="Biaya Pemakaian Peralatan" selected>Biaya Pemakaian Peralatan</option><option value="Biaya Tindakan">Biaya Tindakan</option>';
									}
									elseif ($mcumodul[0]['kategori'] == 'Biaya Tindakan') {
										echo '<option value="Biaya Pemakaian Peralatan">Biaya Pemakaian Peralatan</option><option value="Biaya Tindakan" selected>Biaya Tindakan</option>';
									}
								?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Master Tarif</label>
                        <div class="col-sm-3">
			    <small>Tarif Dokter</small>
                            <input type="number" id="dokter" name="dokter" placeholder="Tarif Dokter" class="form-control" value="<?php echo $mcumodul[0]['dokter']?>" required="required" onkeyup="pilih_total()" />
                        </div>
                        <div class="col-sm-3">
			    <small>Tarif Rumah Sakit</small>
                            <input type="number" id="rs" name="rs" placeholder="Tarif Rumah Sakit" class="form-control" value="<?php echo $mcumodul[0]['rs']?>" required="required" onkeyup="pilih_total()" />
                        </div>
                        <div class="col-sm-4">
			    <small>Total Tarif</small>
                            <input type="number" id="total" name="total" placeholder="Total Tarif" class="form-control" value="<?php echo $mcumodul[0]['total']?>" required="required" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Atribut Lainnya</label>
                        <div class="col-sm-4">
			    <small>Komponen</small>
                            <select class="form-control" id="komponen" name="komponen" required="required">
                                <option value="">--Pilih Komponen--</option>
                                <?php
                                    $sub = $db->query("select * from tbl_jns_tarif where status_delete='UD' order by nama_jns_tarif", 0);
                                    for ($i = 0; $i < count($sub); $i++) {
										$subData = $db->query("select a.*, b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.status_delete='UD' and b.status_delete='UD' and a.kode_jns_tarif='".$sub[$i]['kode_jns_tarif']."' order by a.kode_kat_pelayanan");
										for ($j = 0; $j < count($subData); $j++) {
											if ($mcumodul[0]['komponen_id'] == $subData[$j]['id']) {
                                        		echo '<option value="'.$subData[$j]['id'].'" selected>'.$subData[$j]['nama_kat_pelayanan'].' - '.$subData[$j]['nama_pelayanan'].'</option>';
											}
											else {
												echo '<option value="'.$subData[$j]['id'].'">'.$subData[$j]['nama_kat_pelayanan'].' - '.$subData[$j]['nama_pelayanan'].'</option>';
											}
										}
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
			    <small>Urutan</small>
                            <input type="number" id="urutan" name="urutan" placeholder="Urutan" value="<?php echo $mcumodul[0]['urutan']?>" class="form-control" required="required" />
                        </div>
                        <div class="col-sm-4">
			    <div class="col-sm-12">
			    <small>Membutuhkan Dokter</small>
			    </div>
			    <div class="col-sm-2" style="margin-top: 5px;">
<div class="form-check">
  <input class="form-check-input" type="radio" name="butuhdokter" id="flexRadioDefault1" value="YA" <?php echo $butuhdokterya?>>
  <label class="form-check-label" for="flexRadioDefault1">
    YA
  </label>
</div>
			    </div>
			    <div class="col-sm-10" style="margin-top: 5px;">
<div class="form-check">
  <input class="form-check-input" type="radio" name="butuhdokter" id="flexRadioDefault2" value="TIDAK" <?php echo $butuhdoktertidak?>>
  <label class="form-check-label" for="flexRadioDefault2">
    TIDAK
  </label>
</div>
			    </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2" style="text-align: left;">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="4" placeholder="Keterangan untuk Modul ini"><?php echo $mcumodul[0]['keterangan']?></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                    	<input type="hidden" name="id" value="<?php echo md5($mcumodul[0]['id'])?>" />
                        <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Modul MCU" />
                        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-success rounded" value="List/Daftar Modul MCU" onclick="simpanData(this.form, 'index.php?mod=mcu&submod=module')" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script language="javascript">
	function pilih_total() {
		var dokter = document.getElementById('dokter').value;
		var rs = document.getElementById('rs').value;
		total = (dokter*1)+(rs*1);
		document.getElementById('total').value = total
	}
</script>
