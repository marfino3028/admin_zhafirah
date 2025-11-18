<div class="box box-color box-bordered box-small blue">
    <div class="box-title">
        <h3>
            <i class="fa fa-edit"></i>
            Form Tambah Paket Medical Check Up (MCU)
    </div>
    <?php
		$paket = $db->query("select * from tbl_paketmcu_header where md5(id)='".$_GET['id']."'");
		//print_r($paket);
	?>
    <div class="box-content nopadding">
        <form action="pages/mcu/paket_update.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Nama Paket</label>
                        <div class="col-sm-10">
                            <input type="text" id="nama" name="nama" placeholder="nama Modul MCU" value="<?php echo $paket[0]['nama']?>" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Detail COA</label>
                        <div class="col-sm-5">
			    <small>COA</small>
                            <select class="form-control" id="coa" name="coa" required="required">
                                <option value="">--Pilih COA--</option>
                                <?php
                                    $data = $db->query("select * from tbl_coa", 0);
                                    for ($i = 0; $i < count($data); $i++) {
										if ($paket[0]['coa_kode'] == $data[$i]['kd_coa']) {
											echo '<option value="'.$data[$i]['kd_coa'].'" selected>'.$data[$i]['kd_coa'].' - '.$data[$i]['nm_coa'].'</option>';
										}
										else {
											echo '<option value="'.$data[$i]['kd_coa'].'">'.$data[$i]['kd_coa'].' - '.$data[$i]['nm_coa'].'</option>';
										}
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-5">
			    <small>COA Beban</small>
                            <select class="form-control" id="coa_beban" name="coa_beban" required="required">
                                <option value="">--Pilih COA Beban--</option>
                                <?php
                                    $data = $db->query("select * from tbl_coa", 0);
                                    for ($i = 0; $i < count($data); $i++) {
										if ($paket[0]['coa_beban_kode'] == $data[$i]['kd_coa']) {
											echo '<option value="'.$data[$i]['kd_coa'].'" selected>'.$data[$i]['kd_coa'].' - '.$data[$i]['nm_coa'].'</option>';
										}
										else {
											echo '<option value="'.$data[$i]['kd_coa'].'">'.$data[$i]['kd_coa'].' - '.$data[$i]['nm_coa'].'</option>';
										}
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Group</label>
                        <div class="col-sm-10">
                            <input type="text" id="grup" name="grup" placeholder="Group" class="form-control" value="<?php echo $paket[0]['grup']?>" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Masa Berlaku</label>
                        <div class="col-sm-2">
			    <small>Mulai</small>
                            <input type="date" id="mulai" name="mulai" value="<?php echo date("Y-m-d", strtotime($paket[0]['mulai']))?>" class="form-control" required="required" />
                        </div>
                        <div class="col-sm-2">
			    <small>Hingga</small>
                            <input type="date" id="sampai" name="sampai" value="<?php echo date("Y-m-d", strtotime($paket[0]['sampai']))?>" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-actions">
                    	<input type="hidden" name="id" value="<?php echo md5($paket[0]['id'])?>">
                        <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Paket MCU" />
                        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-success rounded" value="List/Daftar Paket MCU" onclick="simpanData(this.form, 'index.php?mod=mcu&submod=paket')" />
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
