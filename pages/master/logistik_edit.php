<?php
	$logData = $db->query("select * from tbl_logistik where md5(id)='".$_GET['id']."'", 0);
	if ($logData[0]['status_aktif'] == "YA") {
		$aktif_ya = "checked";
		$aktif_no = "";
	}
	else {
		$aktif_no = "checked";
		$aktif_ya = "";
	}

	if ($data[0]['status_stock'] == "STOCK") {
		$stock_ya = "checked";
		$stock_no = "";
	}
	else {
		$stock_no = "checked";
		$stock_ya = "";
	}
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Logistik</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Edit  Data</a>
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
                                        Form Tambah Data Master Logistik
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/logistik_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Kode & Nama</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" id="kode" name="kode" placeholder="Kode Logistik" class="form-control" value="<?php echo $logData[0]['kode']?>" readonly />
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nama" name="nama" placeholder="Nama Logistik" class="form-control" tabindex="2" value="<?php echo $logData[0]['nama']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Kategori Barang</label>
                                                    <div class="col-sm-10">
                                                        <select id="kategori_barang" name="kategori_barang" size="1" tabindex="18" class="form-control" >
                                                            <option value="">--Pilih Kategori Barang--</option>
                                                            <?php
                                                            $vendor = $db->query("select id, kategori from tbl_coa_category");
                                                            for ($i = 0; $i < count($vendor); $i++) {
								if ($logData[0]['kategori_id'] == $vendor[$i]['id']) {
                                                                	echo '<option value="'.$vendor[$i]['id'].'" selected>'.$vendor[$i]['kategori'].'</option>';
								}
								else {
                                                                	echo '<option value="'.$vendor[$i]['id'].'">'.$vendor[$i]['kategori'].'</option>';
								}
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Satuan Logistik</label>
                                                    <div class="col-sm-5">
							<label>Satuan Kecil</label>
                                                        <select id="satuan" name="satuan" size="1" class="form-control" tabindex="2">
                                                            <option value="">--Pilih Satuan--</option>
                                                            <?php
                                                            $satuan = $db->query("select * from tbl_satuan where status_delete='UD'");
                                                            for ($i = 0; $i < count($satuan); $i++) {
								if ($logData[0]['satuan_terkecil'] == $satuan[$i]['nama']) {
                                                                	echo '<option value="'.$satuan[$i]['nama'].'" selected>'.$satuan[$i]['kode'].' - '.$satuan[$i]['nama'].'</option>';
								}
								else {
                                                                	echo '<option value="'.$satuan[$i]['nama'].'">'.$satuan[$i]['kode'].' - '.$satuan[$i]['nama'].'</option>';
								}
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-5">
							<label>Satuan Besar</label>
                                                        <select id="satuan_besar" name="satuan_besar" size="1" class="form-control" tabindex="3">
                                                            <option value="">--Pilih Satuan--</option>
                                                            <?php
                                                            $satuan = $db->query("select * from tbl_satuan where status_delete='UD'");
                                                            for ($i = 0; $i < count($satuan); $i++) {
								if ($logData[0]['satuan_besar'] == $satuan[$i]['nama']) {
                                                                	echo '<option value="'.$satuan[$i]['nama'].'" selected>'.$satuan[$i]['kode'].' - '.$satuan[$i]['nama'].'</option>';
								}
								else {
                                                                	echo '<option value="'.$satuan[$i]['nama'].'">'.$satuan[$i]['kode'].' - '.$satuan[$i]['nama'].'</option>';
								}
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Golongan & Comodity</label>
                                                    <div class="col-sm-5">
							<label>Golongan Barang</label>
                                                        <select id="golongan" name="golongan" size="1" tabindex="8" class="form-control" >
                                                            <option value="">Pilih Golongan</option>
                                                            <?php
                                                            $vendor = $db->query("select kd_gol, golongan from tbl_gol_obt");
                                                            for ($i = 0; $i < count($vendor); $i++) {
								if ($logData[0]['golongan_kode'] == $vendor[$i]['kd_gol']) {
                                                                	echo '<option value="'.$vendor[$i]['kd_gol'].'" selected>'.$vendor[$i]['golongan'].'</option>';
								}
								else {
                                                                	echo '<option value="'.$vendor[$i]['kd_gol'].'">'.$vendor[$i]['golongan'].'</option>';
								}
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-5">
							<label>Comodity Barang</label>
                                                        <select id="comodity" name="comodity" size="1" tabindex="9" class="form-control" >
                                                            <option value="">Pilih Comodity</option>
                                                            <?php
                                                            $vendor = $db->query("select kd_comodity, comodity from tbl_comodity");
                                                            for ($i = 0; $i < count($vendor); $i++) {
								if ($logData[0]['comodity_kode'] == $vendor[$i]['kd_comodity']) {
                                                                	echo '<option value="'.$vendor[$i]['kd_comodity'].'" selected>'.$vendor[$i]['comodity'].'</option>';
								}
								else {
                                                                	echo '<option value="'.$vendor[$i]['kd_comodity'].'">'.$vendor[$i]['comodity'].'</option>';
								}
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
						    <?php
						        $ppn = $db->query("select nilai from tbl_config where kode='PPN' and tahun='".date("Y")."'");
						    ?>
                                                    <label for="textfield" class="control-label col-sm-2">HNA</label>
                                                    <div class="col-sm-5">
							<label>HNA</label>
                                                        <input type="number" id="hna" name="hna" class="form-control" tabindex="4" value="<?php echo $logData[0]['hna']?>" />
                                                    </div>
                                                    <div class="col-sm-5">
							<label>HNA + PPN <?php echo $ppn[0]['nilai'].'%'?></label>
                                                        <input type="number" id="nilai_hna" name="nilai_hna" value="<?php echo $logData[0]['hna_ppn']?>" placeholder="Terhitung secara Auto sesuai dengan PPN" class="form-control" tabindex="5" readonly />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Status Logistik</label>
						    <div class="col-sm-5">
							<label>Aktif</label>
							<div class="radio">
								<label><input type="radio" value="YA" id="aktif" name="aktif" <?php echo $aktif_ya?>>Ya</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="TIDAK" id="aktif" name="aktif" <?php echo $aktif_no?>>TIDAK</label>
							</div>
						    </div>
						    <div class="col-sm-5">
							<label>Tipe Stock</label>
							<div class="radio">
								<label><input type="radio" value="STOCK" id="tipe_stok" name="tipe_stok" <?php echo $stock_ya?>>Stock</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="NON" id="tipe_stok" name="tipe_stok" <?php echo $stock_no?>>Non Stock</label>
							</div>
						    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
					    <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Logistik" onclick="simpanData(this.form, 'pages/master/logistik_update.php')" tabindex="15" />
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