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
                                        Form Tambah Chart of Account (COA) Category
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/master/coa_kategori_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                            	<label>Nama Kategori</label>
                                                <input type="text" id="kategori" name="kategori" class="form-control" required="required" />
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
                                        			    echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
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
                                        			    echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
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
                                        			    echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
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
                                        			    echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
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
                                        			    echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
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
                                        			    echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
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
                                        			    echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
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
                                        			    echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
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
                                        			    echo '<option value="'.$sub[$i]['kd_coa'].'">'.$sub[$i]['kd_coa'].'-'.$sub[$i]['nm_coa'].'</option>';
                                        			}
                                        		?>
						</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
						<div class="col-sm-4">
							<label>Is Consignee?</label>
							<div class="radio">
								<label><input type="radio" value="YA" id="is_consignee" name="is_consignee">Ya</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="TIDAK" id="is_consignee" name="is_consignee">TIDAK</label>
							</div>
						</div>
						<div class="col-sm-4">
							<label>Is Fixed Asset?</label>
							<div class="radio">
								<label><input type="radio" value="YA" id="is_fixed_asset" name="is_fixed_asset">Ya</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="TIDAK" id="is_fixed_asset" name="is_fixed_asset">TIDAK</label>
							</div>
						</div>
						<div class="col-sm-4">
							<label>Is Service? (Untuk Jenis Berupa Jasa/Pelayanan)</label>
							<div class="radio">
								<label><input type="radio" value="YA" id="is_service" name="is_service">Ya</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="TIDAK" id="is_service" name="is_service">TIDAK</label>
							</div>
						</div>
                                    	</div>
                                        <div class="form-group">
						<div class="col-sm-4">
							<label>Is Logistic?</label>
							<div class="radio">
								<label><input type="radio" value="YA" id="is_logistic" name="is_logistic">Ya</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="TIDAK" id="is_logistic" name="is_logistic">TIDAK</label>
							</div>
						</div>
						<div class="col-sm-4">
							<label>Apakah Barang Dapat Dilakukan Stock Take?</label>
							<div class="radio">
								<label><input type="radio" value="YA" id="is_stock" name="is_stock">Ya</label>
							</div>
							<div class="radio">
								<label><input type="radio" value="TIDAK" id="is_stock" name="is_stock">TIDAK</label>
							</div>
						</div>
                                            <div class="col-sm-4">
                                            	<label>Jenis Barang</label>                                           
                                                <select class="form-control" id="jenis_barang" name="jenis_barang" required="required">
                                                	<option value="">--Pilih Jenis Barang--</option>
                                                	<option value="Medis">Medis</option>
                                                	<option value="Non Medis">Non Medis</option>
						</select>
                                            </div>
                                    	</div>
                                        <div class="form-actions">
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