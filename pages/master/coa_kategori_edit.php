<?php
	$data = $db->query("select * from tbl_coa_category where md5(id)='".$_GET['id']."'");
	if ($data[0]['is_consignee'] == "YA") {
		$consignee_ya = "checked";
		$consignee_no = "";
	}
	else {
		$consignee_no = "checked";
		$consignee_ya = "";
	}

	if ($data[0]['is_fixed_asset'] == "YA") {
		$fixed_ya = "checked";
		$fixed_no = "";
	}
	else {
		$fixed_no = "checked";
		$fixed_ya = "";
	}

	if ($data[0]['is_logistic'] == "YA") {
		$logistic_ya = "checked";
		$logistic_no = "";
	}
	else {
		$logistic_no = "checked";
		$logistic_ya = "";
	}

	if ($data[0]['is_service'] == "YA") {
		$service_ya = "checked";
		$service_no = "";
	}
	else {
		$service_no = "checked";
		$service_ya = "";
	}

	if ($data[0]['is_stock'] == "YA") {
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
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Chart of Account (COA) Category
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
                            <div class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Edit Chart of Account (COA) Category
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/master/coa_kategori_update.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                            	<label>Nama Kategori</label>
                                                <input type="text" id="kategori" name="kategori" class="form-control" value="<?php echo $data[0]['kategori']?>" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                            	<label>COA ID Inventory</label>                                           
                                                <select class="form-control" id="id_inventory" name="id_inventory" required="required">
                                                	<option value="">--Pilih COA ID Inventory--</option>
                                        		<?php
                                        			$sub = $db->query("select id, kd_coa, nm_coa from tbl_coa");
                                        			for ($i = 0; $i < count($sub); $i++) {
                                        			    if ($sub[$i]['kd_coa'] == $data[0]['id_inventory_kode']) {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'" selected>'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			    else {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			}
                                        		?>
						</select>
                                            </div>
                                            <div class="col-sm-4">
                                            	<label>COA ID Inpatient</label>                                           
                                                <select class="form-control" id="id_inpatient" name="id_inpatient" required="required">
                                                	<option value="">--Pilih COA ID Inpatient--</option>
                                        		<?php
                                        			$sub = $db->query("select id, kd_coa, nm_coa from tbl_coa");
                                        			for ($i = 0; $i < count($sub); $i++) {
                                        			    if ($sub[$i]['kd_coa'] == $data[0]['id_inpatient_kode']) {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'" selected>'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			    else {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			}
                                        		?>
						</select>
                                            </div>
                                            <div class="col-sm-4">
                                            	<label>COA ID Outpatient</label>                                           
                                                <select class="form-control" id="id_outpatient" name="id_outpatient" required="required">
                                                	<option value="">--Pilih COA ID Outpatient--</option>
                                        		<?php
                                        			$sub = $db->query("select id, kd_coa, nm_coa from tbl_coa");
                                        			for ($i = 0; $i < count($sub); $i++) {
                                        			    if ($sub[$i]['kd_coa'] == $data[0]['id_outpatient_kode']) {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'" selected>'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			    else {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			}
                                        		?>
						</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                            	<label>COA ID COGS</label>                                           
                                                <select class="form-control" id="id_cogs" name="id_cogs" required="required">
                                                	<option value="">--Pilih COA ID COGS--</option>
                                        		<?php
                                        			$sub = $db->query("select id, kd_coa, nm_coa from tbl_coa");
                                        			for ($i = 0; $i < count($sub); $i++) {
                                        			    if ($sub[$i]['kd_coa'] == $data[0]['id_cogs_kode']) {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'" selected>'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			    else {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			}
                                        		?>
						</select>
                                            </div>
                                            <div class="col-sm-4">
                                            	<label>COA ID COGS Inpatient</label>                                           
                                                <select class="form-control" id="id_cogs_inpatient" name="id_cogs_inpatient" required="required">
                                                	<option value="">--Pilih COA ID COGS Inpatient--</option>
                                        		<?php
                                        			$sub = $db->query("select id, kd_coa, nm_coa from tbl_coa");
                                        			for ($i = 0; $i < count($sub); $i++) {
                                        			    if ($sub[$i]['kd_coa'] == $data[0]['id_cogs_inpatient_kode']) {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'" selected>'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			    else {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			}
                                        		?>
						</select>
                                            </div>
                                            <div class="col-sm-4">
                                            	<label>COA ID Adjusment</label>                                           
                                                <select class="form-control" id="id_adjusment" name="id_adjusment" required="required">
                                                	<option value="">--Pilih COA ID Adjusment--</option>
                                        		<?php
                                        			$sub = $db->query("select id, kd_coa, nm_coa from tbl_coa");
                                        			for ($i = 0; $i < count($sub); $i++) {
                                        			    if ($sub[$i]['kd_coa'] == $data[0]['id_cogs_inadjusment_kode']) {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'" selected>'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			    else {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			}
                                        		?>
						</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                            	<label>COA COGS AP Konsinyasi</label>                                           
                                                <select class="form-control" id="cogs_ap_konsinyasi" name="cogs_ap_konsinyasi" required="required">
                                                	<option value="">--Pilih COA COGS AP Konsinyasi--</option>
                                        		<?php
                                        			$sub = $db->query("select id, kd_coa, nm_coa from tbl_coa");
                                        			for ($i = 0; $i < count($sub); $i++) {
                                        			    if ($sub[$i]['kd_coa'] == $data[0]['cogs_ap_konsinyasi_kode']) {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'" selected>'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			    else {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			}
                                        		?>
						</select>
                                            </div>
                                            <div class="col-sm-4">
                                            	<label>COA COGS Inpatient Konsinyasi</label>                                           
                                                <select class="form-control" id="cogs_inpatient_konsinyasi" name="cogs_inpatient_konsinyasi" required="required">
                                                	<option value="">--Pilih COA COGS Inpatient Konsinyasi--</option>
                                        		<?php
                                        			$sub = $db->query("select id, kd_coa, nm_coa from tbl_coa");
                                        			for ($i = 0; $i < count($sub); $i++) {
                                        			    if ($sub[$i]['kd_coa'] == $data[0]['cogs_inpatient_konsinyasi_kode']) {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'" selected>'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			    else {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			}
                                        		?>
						</select>
                                            </div>
                                            <div class="col-sm-4">
                                            	<label>COA COGS Outpatient Konsinyasi</label>                                           
                                                <select class="form-control" id="cogs_outpatient_konsinyasi" name="cogs_outpatient_konsinyasi" required="required">
                                                	<option value="">--Pilih COA COGS Outpatient Konsinyasi--</option>
                                        		<?php
                                        			$sub = $db->query("select id, kd_coa, nm_coa from tbl_coa");
                                        			for ($i = 0; $i < count($sub); $i++) {
                                        			    if ($sub[$i]['kd_coa'] == $data[0]['cogs_outpatient_konsinyasi_kode']) {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'" selected>'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			    else {
                                        			    	echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			    }
                                        			}
                                        		?>
						</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
						<div class="col-sm-4">
							<label>Is Consignee?</label>
							<div class="radio">
								<label><input type="radio" value="YA" id="is_consignee" name="is_consignee" <?php echo $consignee_ya?>>Ya</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="TIDAK" id="is_consignee" name="is_consignee" <?php echo $consignee_no?>>TIDAK</label>
							</div>
						</div>
						<div class="col-sm-4">
							<label>Is Fixed Asset?</label>
							<div class="radio">
								<label><input type="radio" value="YA" id="is_fixed_asset" name="is_fixed_asset" <?php echo $fixed_ya?>>Ya</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="TIDAK" id="is_fixed_asset" name="is_fixed_asset" <?php echo $fixed_no?>>TIDAK</label>
							</div>
						</div>
						<div class="col-sm-4">
							<label>Is Service? (Untuk Jenis Berupa Jasa/Pelayanan)</label>
							<div class="radio">
								<label><input type="radio" value="YA" id="is_service" name="is_service" <?php echo $service_ya?>>Ya</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="TIDAK" id="is_service" name="is_service" <?php echo $service_no?>>TIDAK</label>
							</div>
						</div>
                                    	</div>
                                        <div class="form-group">
						<div class="col-sm-4">
							<label>Is Logistic?</label>
							<div class="radio">
								<label><input type="radio" value="YA" id="is_logistic" name="is_logistic" <?php echo $logistic_ya?>>Ya</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="TIDAK" id="is_logistic" name="is_logistic" <?php echo $logistic_no?>>TIDAK</label>
							</div>
						</div>
						<div class="col-sm-4">
							<label>Apakah Barang Dapat Dilakukan Stock Take?</label>
							<div class="radio">
								<label><input type="radio" value="YA" id="is_stock" name="is_stock" <?php echo $stock_ya?>>Ya</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="TIDAK" id="is_stock" name="is_stock" <?php echo $stock_no?>>TIDAK</label>
							</div>
						</div>
	                                            <div class="col-sm-4">
                                            	<label>Jenis Barang</label>                                           
                                                <select class="form-control" id="jenis_barang" name="jenis_barang" required="required">
                                                	<option value="">--Pilih Jenis Barang--</option>
							<?php
								if ($data[0]['jenis_barang'] == "Medis") {
									echo '<option value="Medis" selected>Medis</option> <option value="Non Medis">Non Medis</option>';
								}
								else {
									echo '<option value="Medis">Medis</option> <option value="Non Medis">Non Medis</option>';

								}

							?>
						</select>
                                            </div>
                                    	</div>
                                        <div class="form-actions">
					    <input type="hidden" name="id" value="<?php echo md5($data[0]['id'])?>">
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data" />
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